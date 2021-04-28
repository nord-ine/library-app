<?php
$fn  = $_POST['fn'];
$str = $_POST['str'];

echo "heuuuu";

echo $fn;
echo $str;
print_r($_POST['fn']) ;
if(isset($_POST['fn'])){
    echo "here \n";
    print_r($_POST['fn']) ;
}
?>