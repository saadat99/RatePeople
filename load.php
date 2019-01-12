<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 24/10/2018
 * Time: 09:15
 */

// start session if not started before
if (!isset($_SESSION)){
    session_start();
}
require_once 'config.php';

require_once 'functions.php';

require_once 'DB.php';
