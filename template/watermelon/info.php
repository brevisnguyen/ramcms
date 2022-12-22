<?php
function jiexi($a){
    $count=count($a);
    for($i=0;$i<$count;$i++){
    	echo '<li >
                <a class="btns-info" id="'.$i.'" onclick="playerSwitch(this.id)">
                   &nbsp;'.$a[$i]['name'].'</a>
            </li>
            ';
    }
}
function jiexiline($b){
    $count=count($b);
    for($i=0;$i<$count;$i++){
    	echo '"'.$b[$i]['url'].'",';
    }
}
?>