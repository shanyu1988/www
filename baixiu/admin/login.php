<?php
require_once '../config.php';
function login(){
    if(empty($_POST['username'])){
        $GLOBALS['message']='请填写邮箱';
        return;
    }
    if(empty($_POST['password'])){
        $GLOBALS['message']='请填写密码';
        return;
    }
    $username=$_POST['username'];
    $password=$_POST['password'];

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query=mysqli_query($conn,"SELECT * FROM `users` where `email`='{$username}' limit 1;");
    if(!$query){
        $GLOBALS['message'] = '登录失败，请重试！';
        return;
    }
    $user=mysqli_fetch_assoc($query);
    if(!$user){
        $GLOBALS['message'] = '邮箱与密码不匹配！';
        return;
    }
    if($user['password']!==$password){
        $GLOBALS['message'] = '邮箱与密码不匹配！';
        return;
    }
    header('location: index.php');


}

    if($_SERVER['REQUEST_METHOD']==='POST'){
        login();
    }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Sign in &laquo; Admin</title>
    <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/static/assets/css/admin.css">
</head>
<body>
<div class="login">
    <form class="login-wrap" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate autocomplete="off">
        <img class="avatar" src="/static/assets/img/default.png">
        <!-- 有错误信息时展示 -->
        <?php if(isset($message)):?>
        <div class="alert alert-danger">
            <strong>错误！</strong> <?php echo $message; ?>
        </div>
        <?php endif ?>
        <div class="form-group">
            <label for="email" class="sr-only">邮箱</label>
            <input name="username" id="email" type="email" class="form-control" placeholder="邮箱" autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">密码</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="密码">
        </div>
        <button class="btn btn-primary btn-block">登 录</button>
    </form>
</div>
</body>
</html>
