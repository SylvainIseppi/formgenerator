<?php
/**
 * Created by PhpStorm.
 * User: Thib
 * Date: 12/05/2015
 * Time: 23:04
 */ ?>
 <?php 

 if(isset($_GET['page'])){
 	$page=$_GET['page'].'.php';

 }
 else{
 	$page='index.php';

 }
  require_once('header.php'); 
 if(file_exists($page)){

 	require_once($page);
 }
 else{
 	require('404.php');
 }

 require_once('footer.php'); ?>