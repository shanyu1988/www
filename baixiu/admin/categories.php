<?php
//每页必加载
require_once '../functions.php';
$user_arr = baixiu_get_current_user();
//每页必加载END


//新增数据

function add_categorie()
{
    //验证数据
    $GLOBALS['success'] = false;
    if (empty($_POST['name']) || empty($_POST['slug'])) {
        $GLOBALS['message'] = '请完整填写表单！';
        return;
    }

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $rows = xiu_execute("insert into categories values (null ,'{$slug}','{$name}');");
    $GLOBALS['success'] = $rows > 0;
    $GLOBALS['message'] = $rows <= 0 ? '上传失败！' : '上传成功！';
}


function edit_categorie()
{
    global $edited_data;
    $GLOBALS['success'] = false;
    $name = empty($_POST['name']) ? $edited_data['name'] : $_POST['name'];
    $edited_data['name'] = $name;
    $slug = empty($_POST['slug']) ? $edited_data['slug'] : $_POST['slug'];
    $edited_data['slug'] = $slug;
    $rows = xiu_execute("UPDATE categories SET slug='{$slug}',name='{$name}' WHERE id={$_GET['id']} limit 1;");
    $GLOBALS['success'] = $rows > 0;
    $GLOBALS['message'] = $rows <= 0 ? '上传失败！' : '上传成功！';
}

if (empty($_GET['id'])) {

    // 添加
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        add_categorie();
        var_dump("11111");
    }

} else {

    // 编辑
    // 客户端通过 URL 传递了一个 ID
    // => 客户端是要来拿一个修改数据的表单
    // => 需要拿到用户想要修改的数据
    $edited_data = xiu_fetch_one('select * from categories where id = ' . $_GET['id']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        edit_categorie();
        var_dump("22222");
    }
}


//查询数据
$fen_lei_contents = xiu_fetch_all("select * from categories");

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Categories &laquo; Admin</title>
    <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/static/assets/css/admin.css">
    <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<script>NProgress.start()</script>

<div class="main">
    <?php include 'inc/navbar.php' ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>分类目录</h1>
        </div>
        <!-- 有错误信息时展示 -->
        <?php if (isset($message)): ?>
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <strong>成功！</strong><?php echo $message; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">
                    <strong>失败！</strong><?php echo $message; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <!-- <div class="alert alert-danger">
          <strong>错误！</strong>发生XXX错误
        </div> -->

        <div class="row">
            <div class="col-md-4">
                <?php if (isset($edited_data)): ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$_GET['id']; ?>">
                        <h2>编辑《<?php echo $edited_data['name']; ?>》</h2>
                        <div class="form-group">
                            <label for="name">名称</label>
                            <input id="name" class="form-control" name="name" type="text" placeholder="分类名称"
                                   value="<?php echo $edited_data['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="slug">别名</label>
                            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug"
                                   value="<?php echo $edited_data['slug']; ?>">
                            <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">修改</button>
                        </div>
                    </form>
                <?php else: ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h2>新增分类</h2>
                        <div class="form-group">
                            <label for="name">名称</label>
                            <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
                        </div>
                        <div class="form-group">

                            <label for="slug">别名</label>
                            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
                            <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">新增</button>
                        </div>
                    </form>
                <?php endif; ?>


            </div>
            <div class="col-md-8">
                <div class="page-action">
                    <!-- show when multiple checked -->
                    <a id="batchDelete" class="btn btn-danger btn-sm" href="/admin/api/categories_delete.php"
                       style="display: none">批量删除</a>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" width="40"><input id="selection" type="checkbox"></th>
                        <th>名称</th>
                        <th>Slug</th>
                        <th class="text-center" width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($fen_lei_contents as $item): ?>
                        <tr>
                            <td class="text-center"><input type="checkbox" data-id="<?php echo $item['id']; ?>"></td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['slug']; ?></td>
                            <td class="text-center">
                                <a href="<?php echo '/admin/categories.php?id=' . $item['id']; ?>"
                                   class="btn btn-info btn-xs">编辑</a>
                                <a href="<?php echo '/admin/api/categories_delete.php?id=' . $item['id']; ?>"
                                   class="btn btn-danger btn-xs">删除</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $page_name = 'categories'; ?>
<?php include 'inc/sidebar.php' ?>

<script src="/static/assets/vendors/jquery/jquery.js"></script>
<script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>
    NProgress.done();

    /*
    * 1.点击checkbox 显示按钮
    * 2.给按钮添加点击时间
    * 
    * */
    $(function ($) {
        var $checkboxes = $('tbody input[type="checkbox"]');
        var $batchDelete = $('#batchDelete');
        var $batchOperation = $('#selection');
        var allCheckeds = [];


        $checkboxes.on('change', function () {
            var id = $(this).data('id');
            if ($(this).prop('checked')) {
                allCheckeds.indexOf(id)!==-1||allCheckeds.push(id);
            } else {
                allCheckeds.splice(allCheckeds.indexOf(id), 1);
            }
            allCheckeds.length ? $batchDelete.fadeIn() : $batchDelete.fadeOut();
            $batchDelete.prop('search', '?id=' + allCheckeds);
            console.log(allCheckeds);
        });

        $batchOperation.on('change', function () {
            var checked=$(this).prop('checked');
            $checkboxes.prop('checked', checked).trigger('change');
        })
    })
</script>
</body>
</html>