<?php

/*
 * array(1) {
*    ["img"]=>
*  array(5) {
*        ["name"]=>
*    string(16) "船舶交易.png"
*        ["type"]=>
*
*        ["tmp_name"]=>
*    string(24) "C:\xampp\tmp\php43D0.tmp"
*        ["error"]=>
*    int(0)
*    ["size"]=>
*    int(10748)
*  }
}*/
function updata()
{
    if (!isset($_FILES['img'])) {
        $GLOBALS['message'] = '上传失败';
        return;
    }
    $avatar = $_FILES['img'];
    echo $avatar['error'];
    if (!$avatar['error'] == UPLOAD_ERR_OK) {
        $GLOBALS['message'] = '上传失败';
        return;
    }
    $source = $avatar['tmp_name'];
    $target = './uploads/' . $avatar['name'];
    $moved=move_uploaded_file($source,$target);
    if(!$moved){
        $GLOBALS['message']='上传失败';
        return;
    }
    echo '上传成功';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    updata();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>上传图片</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="img">
    <button>上传</button>
</form>
<script>

</script>
</body>
</html>

