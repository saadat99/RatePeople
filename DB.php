<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 14/11/2017
 * Time: 10:57
 */
require_once 'config.php';
class DB
{
    private static $connect;
    private static $logAll = true;

    public static function isConnected()
    {
        return (self::$connect and @mysqli_ping(self::$connect));
    }

    private static function connect()
    {
        $connect = mysqli_connect(DataBaseHostName, DataBaseUserName, DataBasePassWord, DataBaseName);

        if ($connect) {
            $connect->set_charset("utf8");
            self::$connect = $connect;
            return $connect;
        } else {
            echo " <br> DB Not connected. <br>";
            self::sendError("DB Not connected. ");
            return false;
        }
    }

    public static function insert($table, $columns, $values)
    {

        self::connection();
        $q = "INSERT INTO $table ($columns) VALUES ($values)";
        if (self::$logAll) {
            //doLog($q);
        }
        $result = mysqli_query(self::$connect, $q);

        if ($result) {
            if (mysqli_insert_id(self::$connect) > 0) {
                return (int)mysqli_insert_id(self::$connect);
            } else {
                return $result;
            }
        } else {
            self::sendError(mysqli_error(self::$connect) . "<br> \r\n
        INSERT table=$table
        columns=$columns
        Values=$values <br> \r\n ");
        }
    }


    public static function insert_array($table,$data)
    {

        self::connection();
        $columns =implode(',',array_keys($data));

        $values = '';
        $c = false;
        foreach (array_values($data) as $value){
            if($c) {
                $values .= ',';
            } else {
                $c = true;
            }
            $values .= '\'' . $value . '\'';

        }
        $q = "INSERT INTO $table ($columns) VALUES ($values)";
        if (self::$logAll) {
            //doLog($q);
        }
        $result = mysqli_query(self::$connect, $q);

        if ($result) {
            if (mysqli_insert_id(self::$connect) > 0) {
                return mysqli_insert_id(self::$connect);
            } else {
                //doLog('insert without id: ' . $q);
                return $result;
            }
        } else {
            self::sendError(mysqli_error(self::$connect) . "<br> \r\n
        INSERT table=$table
        columns=$columns
        Values=$values <br> \r\n ");
        }
    }

    public static function select($table, $columns, $where)
    {

        self::connection();
        $q = "SELECT $columns FROM $table WHERE $where";
        if (self::$logAll) {
            //doLog($q);
        }
        //  doLog($q);
        $result = mysqli_query(self::$connect, $q);
        //sendError($q);
        if ($result) {
            return self::mysqli_fetch_all_array($result);
        } else {
            self::sendError(mysqli_error(self::$connect) . "\r\n" . $q);
        }

    }
    public static function select_array($table,array $columns, array $where = null)
    {

        self::connection();


        $columns = implode(',',$columns);

        $whereStr = ((is_null($where)) ? '1' : '');
        foreach($where as $condition){
            $whereStr.= ' ' . $condition;
        }


        $q = "SELECT $columns FROM $table WHERE $whereStr";
        if (self::$logAll) {
            //doLog($q);
        }
        //  doLog($q);
        $result = mysqli_query(self::$connect, $q);
        //sendError($q);
        if ($result) {
            return self::mysqli_fetch_all_array($result);
        } else {
            self::sendError(mysqli_error(self::$connect) . "\r\n" . $q);
        }

    }
    public static function specialSelect($query)
    {
        if (self::$logAll) {
            //doLog($query);
        }
        self::connection();
        $result = mysqli_query(self::$connect, $query);
        //  sendError($query);
        if ($result) {
            return self::mysqli_fetch_all_array($result);
        } else {
            self::sendError(mysqli_error(self::$connect) . "</br> --specialSelect $query");
        }
    }

    public static function update($table, $set, $where)
    {

        self::connection();

        $query = "UPDATE $table SET $set WHERE $where";

        if (self::$logAll) {
           // doLog($query);
        }
        $result = mysqli_query(self::$connect, $query);

        if ($result) {
            return $result;
        } else {
            $result = mysqli_query(self::$connect, $query);

            if (!$result === false) {
                return $result;
            } else {
               // doLog('Update query failed. Reason: ' . mysqli_error(self::$connect) . ' Query: ' . $query);
                self::sendError(mysqli_error(self::$connect) . $query);
            }
        }

    }
    public static function update_array($table,array $set, array $where = null){

        self::connection();

        $setStr = ((is_null($set)) ? '1' : '');
        $colon = false;
        foreach($set as $key=>$value){

            if($colon){
                $setStr .= ',';
            } else {
                $colon = true;
            }

            if(is_numeric($key)) {
               $setStr .= $value;
            } else {
                $value = str_replace('\'','',$value);
                $setStr .= $key . '=' . '\'' . $value . '\'';
            }
        }

        $whereStr = ((is_null($where)) ? '1' : '');
        foreach($where as $condition){
            $whereStr.= ' ' . $condition;
        }
         return self::update($table,$setStr,$whereStr);

    }

    public static function delete($table, $where)
    {

        self::connection();
        $query = "DELETE FROM $table WHERE $where ";
        if (self::$logAll) {
           // doLog($query);
        }
        $result = mysqli_query(self::$connect, $query);

        if ($result) {
            return $result;
        } else {
            self::sendError(mysqli_error(self::$connect) . "</br>DELETE table=\'$table\' where=\'$where\'");
        }
    }

    private static function mysqli_fetch_all_array(mysqli_result $mysqli_result)
    {
        $result = array();
        $mysqli_result_array = mysqli_fetch_array($mysqli_result);

        while ($mysqli_result_array[0]) {
            array_push($result, $mysqli_result_array);
            $mysqli_result_array = mysqli_fetch_array($mysqli_result);
        }
        return $result;
    }

    private static function sendError($text)
    {
        //  sendError($text);
      //  doLog("  query : " . $text);
        echo $text . "<br>";
    }

    public static function getTableFieldsArray($table_name)
    {
         $b = 0;
        $fields_array = array();
        foreach (self::mysqli_fetch_all_array(mysqli_query(self::$connect, "SHOW COLUMNS FROM $table_name")) as $item) {
            //  echo "<br><br> ".$item[0];
            $fields_array[$b] = $item[0];
            $b++;
        }

        return $fields_array;
    }

    private static function connection()
    {
        if (self::isConnected()) {
            return;
        }
        self::connect();
        if (!self::isConnected()) {
            self::sendError("db connect error");
            throw new exception("db not connected");
        }
    }

    public static function getConnection()
    {
        return self::$connect;
    }
}
