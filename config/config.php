<?php 
ob_start();
session_start();
date_default_timezone_set("Asia/Colombo");
$connection = new mysqli("localhost","root","","aznews") or die(mysqli_connect_error($connection));