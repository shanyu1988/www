<?php
//1.数据库取出数据
$conn=mysqli_connect('47.96.77.249','root','Shanyu_1988','my');
if(!$conn){
    exit('<h1>连接数据库失败</h1>');
}
$query=mysqli_query($conn,'select * from users;');
if(!$query){
    exit('<h1>查询数据失败</h1>');
}

//2.遍历数据，渲染页面
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQL增删改查练习</title>
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
    <h1 class="heading">用户管理 <a class="btn btn-link btn-sm" href="add.php">添加</a></h1>
    <table class="table table-hover">
        <thead>

        <tr>
            <th>#</th>
            <th>头像</th>
            <th>姓名</th>
            <th>性别</th>
            <th>年龄</th>
            <th class="text-center" width="140">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php while($item=mysqli_fetch_assoc($query)):?>
            <tr>
                <th scope="row"><?php echo $item['id']; ?></th>
                <td><img src="<?php echo $item['image'];?>" class="rounded" alt="<?php echo $item['name'];?>"></td>
                <td><?php echo $item['name'];?></td>
                <td><?php echo $item['gender']==0?'女':'男';?></td>
                <td><?php echo $item['birthday'];?></td>
                <td class="text-center">
                    <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $item['id'];?>">编辑</a>
                    <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $item['id'];?>">删除</a>
                </td>
            </tr>
        <?php endwhile?>
        </tbody>
    </table>
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
</main>
</body>
</html>
