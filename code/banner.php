<?php
include_once('Database.php');
if(isset($_GET['id']) and is_numeric($_GET['id'])) $id = $_GET['id'];

$db = new Database();
$db->select_db('hostingr_hack');

$res = mysql_query("SELECT `weburl` FROM `banners` WHERE `id`=$id");
$url = mysql_fetch_assoc($res);

if(!empty($url['weburl'])){
$db->insert_web($id, $url['weburl'], $_SERVER['HTTP_USER_AGENT'], time());

header("Location:".$url['weburl']);
}