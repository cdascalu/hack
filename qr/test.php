<?php
include "BarcodeQR.php";


// set BarcodeQR object
$qr = new BarcodeQR();
if(isset($_GET['id']) and is_numeric($_GET['id'])) $id = $_GET['id'];

// create URL QR code
$qr->url("http://hack.hostingro.net/code/qrbanner.php?id=".$id);

include_once('../code/Database.php');

$db = new Database();
$db->select_db('hostingr_hack');

$res = mysql_query("SELECT `image` FROM `banners` WHERE `id`=$id");
$result = mysql_fetch_assoc($res);
$image = "../code/upload/". $result['image'];
// display new QR code image
$qr->draw(105, $image);