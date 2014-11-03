<?php
include_once("model/db/TableUser.class.php");
include_once("model/db/TableFolder.class.php");
include_once("model/db/TableBookmark.class.php");

// Create Database
$dbname = "mbm";
$dbuser = "mbm";
$dbpwd = "mbm_us3r";

$db = new PDO("mysql:host=localhost", $dbuser, $dbpwd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->query("CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
$db->query("USE `$dbname`");

// Create tables
$tUser = new TableUser($db);
$tUser->install();

$tFolder = new TableFolder($db);
$tFolder->install();

$tBm = new TableBookmark($db);
$tBm->install();

// Insert data
$tUser->create("admin", "admin", 1);
$tUser->create("test", "test");

$tFolder->create("root", 0);

// Close connection
$db = null;

echo "MBM installation: ok";
?>