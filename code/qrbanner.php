<?php
include_once('Database.php');
include_once('../wurfl/examples/demo/index.php');
if(isset($_GET['id']) and is_numeric($_GET['id'])) $id = $_GET['id'];

$db = new Database();
$db->select_db('hostingr_hack');

$res = mysql_query("SELECT `qrurl` FROM `banners` WHERE `id`=$id");
$url = mysql_fetch_assoc($res);

if(!empty($url['qrurl'])){
$db->insert_qr($id, $url['qrurl'],$type, $useragent, $os, $width, $height, time());

header("Location:".$url['qrurl']);
}