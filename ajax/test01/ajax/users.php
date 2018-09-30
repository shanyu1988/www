<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29
 * Time: 14:26
 */
$users = array(
    array(
        'id' => 1,
        'name' => '张三',
        'age' => 18
    ),
    array(
        'id' => 2,
        'name' => '李四',
        'age' => 20
    ),
    array(
        'id' => 3,
        'name' => '王五',
        'age' => 18
    ),
    array(
        'id' => 4,
        'name' => '赵六',
        'age' => 19
    )
);
if(empty($_GET['id'])){
    echo json_encode($users);
    exit();
}
foreach ($users as $item) {
    if ($item['id'] != $_GET['id'])continue;
    echo json_encode($item['age']);
}
//readyState
//ext