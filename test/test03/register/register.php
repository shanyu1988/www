<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){

    if(empty($_POST['username'])){
        $message='请输入用户名';
    }else{
        if(empty($_POST['password'])){
            $message='请输入密码';
        }else{
            if(empty($_POST['password2'])){
                $message='请在此输入密码';
            }else{
                if(!($_POST['password2']==$_POST['password'])){
                    $message='两次输入的密码不一致';
                }else{
                    if(!(isset($_POST['agreement'])&&$_POST['agreement']=='on')){
                        $message='您是否同意本次的注册协议？';
                    }else{
                        $username=$_POST['username'];
                        $password=$_POST['password'];
                        file_put_contents('user_db.txt',$username.'|'.$password);
                    }
                }

            }
        }
    }
}
if(isset($message)){
    echo $message;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <table>
        <tbody>
        <tr>
            <td><label for="userName">用户名</label></td>
            <td><input type="text" name="username" id="userName"></td>
        </tr>
        <tr>
            <td><label for="password">密码</label></td>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
            <td><label for="password2">重复密码</label></td>
            <td><input type="password" name="password2" id="password2"></td>
        </tr>
        <tr>
            <td><label for="agreement">协议</label></td>
            <td><input type="checkbox" name="agreement" id="agreement"></td>
        </tr>
        <tr>
            <td></td>
            <td><button>提交注册</button></td>
        </tr>
        </tbody>
    </table>
</form>
</body>
</html>