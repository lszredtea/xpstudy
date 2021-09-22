<?php
header('content-type:text/html;charset=utf-8');
require "../public/config.php";
function pdo(){
try{
    $pdo=new PDO(DB_MSN,DB_USER,DB_PWD,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING]);

}catch (Exception $e){

    echo $e->getMessage();
}catch (Throwable $e){
    echo $e->getMessage();
}
return $pdo;
}

?>