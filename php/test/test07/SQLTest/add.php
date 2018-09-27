<?php
function request()
{
    //判断姓名、性别、生日是否为空
    if (empty($_POST['name'])) {
        $GLOBALS['message'] = '请填写姓名';
        $GLOBALS['error_type']='name';
        return;
    }
    $name=$_POST['name'];
    if (isset($_POST['gender']) && $_POST['gender'] == -1) {
        $GLOBALS['message'] = '请选择性别';
        $GLOBALS['error_type'] = 'gender';
        return;
    }
    $gender=$_POST['gender'];
    if (empty($_POST['birthday'])) {
        $GLOBALS['message'] = '请选择生日';
        $GLOBALS['error_type'] = 'birthday';
        return;
    }
    $birthday=$_POST['birthday'];
    // echo "校验文件";
    // 校验上传文件
    //  1. 校验是否上传成功（error）
    if($_FILES['avatar']['error']!==UPLOAD_ERR_OK){
        $GLOBALS['message'] = '上传失败';
        $GLOBALS['error_type'] = 'avatar';
        return;
    }
    //  2. 校验上传文件的类型（type）
    $allowed_source_types = array('image/jpg','image/jpeg','image/png');
    if(!in_array($_FILES['avatar']['type'],$allowed_source_types)){
        $GLOBALS['message'] = '上传的图片格式有误';
        $GLOBALS['error_type'] = 'avatar';
        return;
    }
    //  3. 校验文件大小（size）文件的大小单位是字节
    if ($_FILES['avatar']['size'] > 4* 1024 * 1024) {
        $GLOBALS['error_type'] = 'avatar';
        $GLOBALS['message'] = "上传文件大小不合理";
        return;
    }
    //  4.将文件从临时目录中移动到网站下面
    $avatar_tmp_name=$_FILES['avatar']['tmp_name'];//临时路径
    $avatar_url='./img/'.uniqid().'.'.pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);//存放路径
    if(!move_uploaded_file($avatar_tmp_name,$avatar_url)){
        $GLOBALS['error_type'] = 'avatar';
        $GLOBALS['message'] = "服务器文件上传失败";
        return;
    }
    $source_url = substr($avatar_url, 1);

    $conn=@mysqli_connect('47.96.77.249','root','Shanyu_1988','my');
    if(!$conn){
        $GLOBALS['message2']='连接服务器失败';
        return;
    }
    $query=@mysqli_query($conn,"INSERT INTO `users` VALUES(null,'{$name}','{$source_url}','{$birthday}','{$gender}');");
    if(!$query){
        $GLOBALS['message2']='添加数据失败';
        return;
    }
    header('location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    request();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XXX管理系统</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">XXX管理系统</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">用户管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">商品管理</a>
        </li>
    </ul>
</nav>
<main class="container">
    <h1 class="heading">添加用户</h1>
    <?php if(isset($message2)): ?>
        <h3 class="alert alert-danger"><?php echo $message2;?></h3>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="avatar">头像</label>
            <input type="file" class="form-control <?php echo isset($error_type)&&$error_type=='avatar'?'is-invalid':'';?>" id="avatar" name="avatar">
            <small class="invalid-feedback"><?php echo $message; ?></small>
        </div>
        <div class="form-group">
            <label for="name">姓名</label>
            <input type="text" class="form-control <?php echo isset($error_type)&&$error_type=='name'?'is-invalid':'';?>" id="name" name="name">
            <small class="invalid-feedback"><?php echo $message; ?></small>
        </div>
        <div class="form-group">
            <label for="gender">性别</label>
            <select class="form-control <?php echo isset($error_type)&&$error_type=='gender'?'is-invalid':'';?>" id="gender" name="gender">
                <option value="-1">请选择性别</option>
                <option value="1">男</option>
                <option value="0">女</option>
            </select>
            <small class="invalid-feedback"><?php echo $message; ?></small>
        </div>
        <div class="form-group">
            <label for="birthday">生日</label>
            <input type="date" class="form-control <?php echo isset($error_type)&&$error_type=='birthday'?'is-invalid':'';?>" id="birthday" name="birthday">
            <small class="invalid-feedback"><?php echo $message; ?></small>
        </div>
        <button class="btn btn-primary">保存</button>
    </form>
</main>
</body>
</html>
