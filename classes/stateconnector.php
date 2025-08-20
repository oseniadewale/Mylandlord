<?php 
require "Db.php";
$a = new Db;
$b = $a->fetchStateData();
$f = $a->fetchLgData();

foreach($b as $c){
    echo "<ul>";
    echo "<li>".$c['state_name']."</li>";
    echo "</ul>";
}
   
// foreach($f as $g){
//      echo "<ul>";
//     echo "<li>".$g['lg_name']."</li>";
//     echo "</ul>";

print_r ($f);










?>