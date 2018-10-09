<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 13:47
 */
include_once '../functions.php';
$data=xiu_fetch('select * from users where id=1 limit 1');
var_export($data);