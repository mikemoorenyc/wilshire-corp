<?php

include 'encrypter.php';

if(!(isset($_POST['download-type']))) {
  die();
} else {
  if($_POST['download-type'] == 'groupfile') :

  $file_url = $_POST['download-id'];
  $file_url = encrypt_decrypt('decrypt',$file_url);

  header('Content-Type: application/octet-stream');
  header("Content-Transfer-Encoding: Binary");
  header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
  readfile($file_url);


  endif;



}
/*
$file_url = $_POST['download-info'];
var_dump($file_url);
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
readfile($file_url);
*/
?>
