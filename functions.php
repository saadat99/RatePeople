<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 23/10/2018
 * Time: 15:49
 */

/*
 * Get all slebs info from db and return as assoc array
 */
function get_all_slebs_list() {
    //return DB::select('slebs','*','1');
    return DB::specialSelect("
    SELECT * FROM slebs
    ORDER BY id DESC;
    ");
}

/*
 * add new sleb to db
 * @return  new sleb id on Success and false if failed
 */
function add_new_sleb($name){
    $name = htmlspecialchars($name);
    $date = new DateTime();
    //$reg_date = $date->format('Y-m-d H:i:s');
    $id = DB::insert('slebs','name',"'$name'");
    if(is_int($id) and $id>0){
        return ($id);
    }
    return false;
}

/*
 * add a new user vote to specific sleb or change user's previous vote
 * return true on success, false on fail
 */
function add_vote_to_sleb($sleb_id, $rate){
    require_once 'DB.php';
    require_once 'session.php';
    $username = $_SESSION['login_user'];
    $db = new DB;
    $result = $db->select("Users", "*", "username='$username'");
    $userid = $result[0][0];
    $resp = DB::insert('rates','user_id, sleb_id, rate',"'$userid','$sleb_id','$rate'");
    return $resp;
}

/*
 * return true if session started and user loged in
 */
function loged_in(){
    return (session_started() and isset($_SESSION['login_user']));
}

function login($username) {
    require_once('session.php');
    $_SESSION['login_user'] = $username; // Initializing Session
    // Redirect to new page
    header("Location: index.php?alert=1");
}

/*
 * Check session
 */
function session_started(){
    return isset($_SESSION);
}

function get_average_rate($id) {
    $resp = DB::select('rates', 'AVG(rate)', "sleb_id=$id");
    return $resp;
}