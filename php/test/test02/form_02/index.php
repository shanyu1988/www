<?php
$content = file_get_contents("names.txt");
$content = explode("\n",$content);
$form_arr=$_POST;

if($_SERVER['REQUEST_METHOD']=="POST") {
    //在新添加的信息homePage的值上+上"http://"
    $form_arr["homePage"]="http://".$form_arr["homePage"];
    //新添加的信息的前边加上序号
    array_unshift($form_arr,count($content)+1);
    //将新添加的数组合并成字符串
    $form_arr = implode("|",array_values($form_arr));

    $content[count($content)]=$form_arr;

};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>
    <?php
        echo date("Y-m-d")
    ?>
</h1>



<!--<tr>
    <?php /*if(isset($form_arr[0])):*/?>
        <?php /*foreach ($form_arr as $colB):*/?>

        <?php /*endforeach */?>
    <?php /*endif;*/?>
</tr>-->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <table border="1" cellspacing="0">
        <tbody style="float: right">
        <tr>
            <td>姓名</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>年龄</td>
            <td><input type="text" name="age"></td>
        </tr>
        <tr>
            <td>邮箱</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>个人主页</td>
            <td><input type="text" name="homePage"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="提交"></td>
        </tr>
        </tbody>
    </table>
</form>
<table border="1">
    <tbody>
        <?php foreach ($content as $line):?>
            <?php $line=explode("|",$line); ?>
            <?php
                $form_arr=$_POST;
                $form_arr=array_values($form_arr);
            ?>
            <tr>
                <?php foreach ($line as $col):?>
                    <?php
                        $col=trim($col); ?>

                    <?php if(strpos($col,"http://")===0):?>
                        <td><a href="<?php echo strtolower($col); ?>"><?php echo substr($col,7);?></a></td>
                        <?php else:?>
                        <td><?php echo $col;?></td>
                    <?php endif;?>
                <?php endforeach ?>

            </tr>

        <?php endforeach ?>
    </tbody>
</table>
</body>