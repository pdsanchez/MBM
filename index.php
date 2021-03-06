<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");

// LOG
include('php/log4php/Logger.php');
Logger::configure('config-log.xml');
$log = Logger::getLogger("main");
$trace = Logger::getLogger("trace");

// CLASSES
include_once("model/PageData.class.php");
include_once("model/UserLogin.class.php");
include_once "model/db/TableBookmark.class.php";

// DATABASE
$dbinfo = "mysql:host=localhost;dbname=mbm";
$dbuser = "mbm";
$dbpwd = "mbm_us3r";
$db = new PDO($dbinfo, $dbuser, $dbpwd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// HTML page content
$pagedata = new PageData("MBM:MyBookMarks");

//$pagedata->addCss("css/bootstrap.min.css");
$pagedata->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css");
//$pagedata->addCss("http://bootswatch.com/cerulean/bootstrap.min.css");
$pagedata->addCss("css/mbm.css");

$pagedata->addScript("https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js");
//$pagedata->addScript("js/bootstrap.min.js");
$pagedata->addScript("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js");

// Login
$user = new UserLogin();
include_once("controller/login.php");

$tBm = new TableBookmark($db);
$totalBms = $tBm->getTotal($user->getId());

$pagedata->addContent(include_once("view/navigation.php"));
$navClicked = isset($_GET["page"]);
if ($navClicked) {
  $ctl = $_GET["page"];
}
else {
  $ctl = "bookmarks";
}
$pagedata->addContent(include_once("controller/$ctl.php"));

// Close connection
$db = null;

// show HTML page template
echo include_once("view/page.php");
?>