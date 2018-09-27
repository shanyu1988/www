<?php
if(empty($_GET['id'])){
    exit('<h1 class="alert alert-danger">请传参数</h1>');
}
$id=$_GET['id'];
$conn=@mysqli_connect('47.96.77.249','root','Shanyu_1988','my');
if(!$conn){
    exit('<h1 class="alert alert-danger">连接服务器失败</h1>');
}
$query=@mysqli_query($conn,"delete from users where id={$id};");
if(!$query){
    exit('<h1 class="alert alert-danger">删除数据失败</h1>');
}
header('location: index.php');