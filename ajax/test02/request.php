<?php

    $conn=mysqli_connect('47.96.77.249','root','Shanyu_1988','my');

    $query=mysqli_query($conn,'select * from users');

    while($item=mysqli_fetch_assoc($query)){
        $data[]=$item;
    }
    $data_a=json_encode($data);
    if(empty($_GET['callback'])){
        header('Content-Type: application/json');
        echo $data_a;
        exit();
    }
    echo "{$_GET['callback']}({$data_a})";
    header('Content-Type: application/javascript');