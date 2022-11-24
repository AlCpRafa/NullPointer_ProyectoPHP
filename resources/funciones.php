<?php
function checkInput($input){
    $valid = false;
    if($input!==""){
        $valid=true;
    }
    return $valid;
}