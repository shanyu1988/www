<?php

$conection=mysqli_connect('47.96.77.249','root','Shanyu_1988','my');

if(!$conection){
    exit('<h1>连接数据库失败</h1>');
}

$query=mysqli_query($conection,'SELECT * FROM `users`;');

if(!$query){
    exit('<h1>查询数据失败</h1>');
}
$arr=array();
while($row = mysqli_fetch_assoc($query)){
        $arr[]=$row;
}
var_dump($arr);
