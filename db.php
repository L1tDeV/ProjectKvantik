<?php
 require 'libs/rb.php';

R::setup( 'mysql:host=localhost;dbname=ykp', 'root', '' ); 

session_start();

function showError($error){
    return array_shift($error);
}
?>
