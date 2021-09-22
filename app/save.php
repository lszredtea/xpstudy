<?php
header('content-type:text/html;charset=utf-8');
include '../public/db.php';
extract($_POST);
$pdo=pdo();
@$birth=strtotime($birth);
@$gender=intval($gender);
@$tel=intval($tel);
$sql="select sname from xps_student where sname=?";
$a=$pdo->prepare($sql);
$a->bindParam(1,$sname);
$a->execute();
if($a->rowCount()==1){
    echo  json_encode(['status'=>1,'msg'=>"请勿重复提交数组"]);
}else{

    $insert="insert into `xps_student` (`sname`,`snum`,`gender`,`birth`,`tel`) values (?,?,?,?,?)";
    $stmt=$pdo->prepare($insert);
    $stmt->bindParam(1,$sname);
    $stmt->bindParam(2,$snum);
    $stmt->bindParam(3,$gender);
    $stmt->bindParam(4,$birth);
    $stmt->bindParam(5,$tel);
    $stmt->execute();
    $stmt->rowCount()==1? print json_encode(['status'=>1,'msg'=>"保存成功"]):null;

}
?>