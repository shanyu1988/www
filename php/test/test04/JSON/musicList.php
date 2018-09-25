<?php
//取data.json的数据然后渲染
    //取数据
    $str=file_get_contents('data.json');
    //将数据转换为对象
    $data=json_decode($str,true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>音乐列表</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<div class="container py-5">
    <h1 class="display-4">音乐列表</h1>
    <hr>
    <div class="mb-3">
        <a href="add.php" class="btn btn-secondary btn-sm">添加</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th class="text-center">标题</th>
            <th class="text-center">歌手</th>
            <th class="text-center">海报</th>
            <th class="text-center">音乐</th>
            <th class="text-center">操作</th>
        </tr>
        </thead>
        <tbody class="text-center">
        <!--渲染数据-->
        <?php foreach ($data as $col): ?>
            <tr>
                <td><?php echo $col['title']?></td>
                <td><?php echo $col['artist']?></td>
                <td>
                <?php for($i=0;$i<count($col['images']);$i++):?>
                    <img src="<?php echo $col['images'][$i]?>" alt="">
                <?php endfor?>
                </td>
                <td><audio src="<?php echo $col['source']?>" controls></audio></td>
                <td><a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $col['id']?>">删除</a></td>
            </tr>
        <?php endforeach ?>
        
        <pre>举头望明月，低头思故乡。</pre>
        </tbody>
    </table>
</div>
</body>
</html>
