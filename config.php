<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'real-estate';

    //create connection
    $conn = mysqli_connect($servername,$username,$password,$db);
    //check connection
    if(!$conn){
        die("connection faild".mysqli_connect_error());
    }
?>