<?php

function opencon(){
    //create connection: server, user, password, database
    $connection = mysqli_connect("localhost", "root", "", "geararena"); 

    if(!$connection){
        die("failed to connect: ".mysqli_connect_error());
    }
    return $connection;
}