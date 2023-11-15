<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["firstname"];
    $lastname = $_POST["lastname"];

    echo "the full name is ".$name." ".$lastname;
}