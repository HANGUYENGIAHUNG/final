<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1517349-final';
const USER = 'LAA1517349';
const PASS = 'Pass1116';
$connect = 'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8';
$pdo = new PDO($connect, USER, PASS);
?>
