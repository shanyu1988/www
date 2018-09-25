<?php
function remove(){
    $id=$_GET['id'];
    $data=file_get_contents('data.json');
    $old_json=json_decode($data,true);
    foreach ($old_json as $item) {
        if($item['id']!==$id)continue;
        $index=array_search($item,$old_json);
        array_splice($old_json,$index,1);
    }
    $new_json=json_encode($old_json);
    file_put_contents('data.json',$new_json);
    header('Location:musicList.php');
}
if(!empty($_GET['id'])){
    remove();
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/21
 * Time: 13:29
 */