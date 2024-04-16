<?php
Header("Content-Type: text/html; charset=utf8");
$dir = '.';
 
$f = scandir($dir);
 
foreach ($f as $file){
    if(preg_match('/\.(html)/', $file)){
        echo '<a href="'.$file.'" target="_blank">'.$file.'</a><br/>';
    }
}
?>