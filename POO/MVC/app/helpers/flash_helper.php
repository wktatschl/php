<?php

function flash($message='', $class='alert alert-success'){
    if(!empty($message)){
        echo '<div class="'.$class.'" id="msg-flash">' .$message.'</div>';
    }
}