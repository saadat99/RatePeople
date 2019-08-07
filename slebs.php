<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 24/10/2018
 * Time: 09:07
 */

require_once 'load.php';

$slebs_list = get_all_slebs_list();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .checked {
        color: orange;
    }
    </style>
    <script>
        $(function(){
            $("#includedContent").load("nav.php"); 
        });
    </script>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 50%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }


    </style>
    <title></title>
</head>
<body>
    <div id="includedContent"></div>
    <section class="w3-container">
        <table>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Rate</td>
            </tr>
            <?php
            foreach ($slebs_list as $sleb){
                echo ' <tr>
                <td>' . $sleb['id'] . '</td>
                <td>' . $sleb['name'] . '</td>
                <td>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                </td>
            </tr>';
            }
            ?>
        </table>
    </section>
</body>
</html>
