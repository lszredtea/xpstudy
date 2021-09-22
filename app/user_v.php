<?php
header('content-type:text/html;charset=utf-8');

require '../public/db.php';

extract($_POST);
$pdo=pdo();
$sql="select sname from xps_student where sname=? or snum=?";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(1,$sname);
$stmt->bindParam(2,$snum);
$stmt->execute();
$stmt->rowCount()!=0? print  json_encode(['status'=>1,"msg"=>"该学生已经存在"]):null;

?>