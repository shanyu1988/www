
<?php
$content = file_get_contents("names.txt");
$content = explode("\n",$content);

if(count($form_arr)>0) {

    $form_arr = implode("|",array_values($form_arr));
    $content[count($content)]=$form_arr;
}
?>

