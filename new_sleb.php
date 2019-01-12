<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 24/10/2018
 * Time: 09:07
 */

require_once 'load.php';

$slebs_list = get_all_slebs_list();

//  check login
if(!loged_in()){
     header('Location: login.php'); // redirect to login page
}

// check for form submit
if(isset($_POST['submit'])){
    if(!empty($_POST['name']))
    {
        $id = add_new_sleb($_POST['name']);
        if(is_int($id)){
            echo 'Added sleb number ' . $id;
            header("Refresh:0");
        }
    }
    if (isset($_POST['id'])) {
        echo "working";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <!-- Font Awesome Icon Library: Rating stars foont -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .checked {
        color: orange;
    }
    </style>
    <script src="magic.js"></script> <!-- load our javascript file -->
    <script>
        $(function(){
            $("#includedContent").load("nav.php"); 
        });
    </script>
    <title>Celebrities</title>
</head>
<body>
    <div id="includedContent"></div>
    <section class="w3-container">
        <h2>Clebrities</h2>
        <form method="post" class="slebForm">
            Name: <input type="text" name="name" >
            <input type="submit" name="submit">
        </form><br>
        <table class="w3-table w3-bordered w3-hoverable">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Rate</td>
                <td>Vote</td>
            </tr>
            <?php foreach($slebs_list as $key=>$value): ?>
            <tr id="row_<?= $value['id'] ?>">
                <td><?= $value['id'] ?></td>
                <td><?= $value['name'] ?></td>
                <td>
                    <?php
                    // Generating Star Rates font
                    require_once 'load.php';
                    $res = get_average_rate($value['id']);
                    if (empty($res)) {
                        echo 'No rates yet'; 
                    } else {
                        $i = round($res[0][0]);
                    $j = 5-$i;
                    while($i>0) {
                        echo '<span class="fa fa-star checked"></span>';
                        $i--;
                    }
                    while($j>0) {
                        echo '<span class="fa fa-star"></span>';
                        $j--;
                    }
                    }
                    ?>
                </td>
                <td>
                    <div class="rate-group<?= $value['id'] ?>">
                        <input type="hidden" name="id" id="<?= $value['id'] ?>" value="<?php echo $value['id']?>"/>
                        <input type="radio" name="rate<?= $value['id'] ?>" id="radio_<?= $value['id'] ?>" value="0"/> 0
                        <input type="radio" name="rate<?= $value['id'] ?>" id="radio_<?= $value['id'] ?>" value="1"/> 1
                        <input type="radio" name="rate<?= $value['id'] ?>" id="radio_<?= $value['id'] ?>" value="2"/> 2
                        <input type="radio" name="rate<?= $value['id'] ?>" id="radio_<?= $value['id'] ?>" value="3"/> 3
                        <input type="radio" name="rate<?= $value['id'] ?>" id="radio_<?= $value['id'] ?>" value="4"/> 4
                        <input type="radio" name="rate<?= $value['id'] ?>" id="radio_<?= $value['id'] ?>" value="5"/> 5
                        <input class="w3-btn sendRate" name="sendRate" type="submit" id="<?= $value['id'] ?>" value="Rate">
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</body>
</html>
