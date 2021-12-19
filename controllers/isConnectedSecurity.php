<?php
if(!isset($_SESSION["auth"])){
    header('Location: signup.php');
}