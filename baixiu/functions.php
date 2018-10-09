<?php
include_once 'config.php';
session_start();
function baixiu_get_current_user()
{
    if (empty($_SESSION['login_user'])) {
        // 没有当前登录用户信息，意味着没有登录
        header('Location: /admin/login.php');
        exit(); // 没有必要再执行之后的代码
    }
    return $_SESSION['login_user'];
}

/*
 * 获取多条数据
 * 获取的是索引数组  里面套着关联数组
 *
 * */
function xiu_fetch_all($SQL)
{
    $conn = mysqli_connect(XIU_DB_HOST, XIU_DB_USER, XIU_DB_PASS, XIU_DB_NAME);
    if (!$conn) {
        exit('连接数据库失败');
    }
    $query = mysqli_query($conn, $SQL);
    if (!$query) return false;
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    mysqli_close($conn);
    return $data;
}

/*
 *获取单条数据
 * 获取的是个关联数组
 *
 * */
function xiu_fetch_one($SQL)
{
    $res = xiu_fetch_all($SQL);
    return isset($res[0]) ? $res[0] : null;
}

/*
 *非查询的查询语句 ：增删改
 *
 * */
function xiu_execute($SQL)
{
    $conn = mysqli_connect(XIU_DB_HOST, XIU_DB_USER, XIU_DB_PASS, XIU_DB_NAME);
    if (!$conn) exit('连接数据库失败');
    $query = mysqli_query($conn, $SQL);
    if (!$query) return false;
    //对于增删改类的操作，都是受影响行数
    $affected_rows = mysqli_affected_rows($conn);
    mysqli_close($conn);
    return $affected_rows;
}