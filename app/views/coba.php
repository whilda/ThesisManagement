<?php
$data = array("appkey" => "asd", "username" => "ridwan");
echo REST::POSTRequest('f/isexist',$data);
echo REST::GETRequest('su/getall/'.REST::$appkey);
?>