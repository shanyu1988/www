<?php
function request(){
    define('URL','http://localhost/test/test04/JSON/');
// * 1.将数据上传到服务器
    //这个数组是用来放上传上来的数据
    //title 标题  , artist  歌手名  ,  images  海报/图片文件  ,source  音乐/音频文件
    $data=array();
    //随机生成一个ID
    $data['id']=uniqid();
    //判断上传标题是否为空
    if(empty($_POST['title'])){
        $GLOBALS['message']='请填写标题';
        return;
    }
    $data['title']=$_POST['title'];

    //判断上传歌手名是否为空
    if(empty($_POST['artist'])){
        $GLOBALS['message']='请填写歌手名';
        return;
    }
    $data['artist']=$_POST['artist'];
// Maximum number of files that can be uploaded via a single request

// * 2.判断数据是否上传成功
    //判断图片是否上传成功，因为图片可能上传多个，所以需要遍历
    for($i=0;$i<count($_FILES['images']['name']);$i++){
        //判断图片文件是否上传成功
        if($_FILES['images']['error'][$i]!==UPLOAD_ERR_OK){
            $GLOBALS['message']='上传图片文件失败';
            return;
        }
        if(strpos($_FILES['images']['type'][$i],'image/')!==0){
            $GLOBALS['message']='请上传正确的图片类型';
            return;
        }
        if($_FILES['images']['size'][$i]>1*1024*1024){
            $GLOBALS['message']='上传的图片文件过大';
            return;
        }
        //将临时文件夹中的文件移出
        $route='./uploaded/images/'.uniqid().'_'.$_FILES['images']['name'][$i];
        if(!move_uploaded_file($_FILES['images']['tmp_name'][$i],$route)){
            $GLOBALS['message']='服务器上传图片文件失败';
            return;
        }
        $data['images'][]=URL.mb_substr($route,2);
    }
    //判断音乐是否上传成功
    if($_FILES['source']['error']!==UPLOAD_ERR_OK){
        $GLOBALS['message']='上传音乐文件失败';
        return;
    }
    if(strpos($_FILES['source']['type'],'audio/')!==0){
        $GLOBALS['message']='请上传正确的音乐类型';
        return;
    }
    if($_FILES['source']['size']>16*1024*1024){
        $GLOBALS['message']='上传的音乐文件过大';
        return;
    }
    //将临时文件夹中的文件移出
    $move='./uploaded/audio/'.uniqid().'_'.$_FILES['source']['name'];
    if(!move_uploaded_file($_FILES['source']['tmp_name'],$move)){
        $GLOBALS['message']='服务器上传音乐文件失败';
        return;
    }

    //将数据转换为json格式，并存到data文件
    $data['source']=URL.mb_substr($move,2);
    $content=file_get_contents('data.json');
    $old_json=json_decode($content,true);
    $old_json[]=$data;
    $new_json=json_encode($old_json);
    var_dump($new_json);
    file_put_contents('data.json',$new_json);

//跳转音乐列表
    header('Location: musicList.php');


}
if($_SERVER['REQUEST_METHOD']=='POST'){
    request();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加新音乐</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<div class="container py-5">
    <h1 class="display-4">添加新音乐</h1>
    <hr>
    <?php if(isset($message)):?>
        <div class="alert alert-danger">
            <?php echo $message?>
        </div>
    <?php endif ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">标题</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="artist">歌手</label>
            <input type="text" class="form-control" id="artist" name="artist">
        </div>
        <div class="form-group">
            <label for="images">海报</label>
            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
        </div>
        <div class="form-group">
            <label for="source">音乐</label>
            <input type="file" class="form-control" id="source" name="source" accept="audio/*">
        </div>
        <button class="btn btn-primary btn-block">保存</button>

    </form>
</div>
</body>
</html>