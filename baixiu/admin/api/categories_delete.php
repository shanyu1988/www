<?php

include_once '../../config.php';
include '../../functions.php';

$id = $_GET['id'];

$rows=xiu_execute('delete from categories where id in ('.$id.');');

if(!$rows){
    exit('请传正确的参数');
}
header('Location: ../categories.php');