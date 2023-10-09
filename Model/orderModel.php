<?php

function addOrder($table1,$fields1,$values1,$table2,$fields2,$values2){
    global $conn;
    connect();
    // for products
    $flds1 = implode("`,`", $fields1);
    $vals1 = implode("','", $values1);

    $flds2 = implode("`,`", $fields2);
    $vals2 = implode("','", $values2);
    
    $query1  = mysqli_query($conn, "INSERT INTO `$table1` (`$flds1`) VALUES ('$vals1')");
    $query2 = mysqli_query($conn, "INSERT INTO `$table2` (`$flds2`) VALUES((SELECT LAST_INSERT_ID()),'$vals2')");
    return $query1;
    disconnect();
}

function insertOrder($table,$fields,$values){
    global $conn;
    connect();
    // for cart
    $flds1 = implode("`,`", $fields1);
    $vals1 = implode("','", $values1);

    $query1  = mysqli_query($conn, "INSERT INTO `$table1` (`$flds1`) VALUES ('$vals1')");
    disconnect();
}

function getOrder($table,$value){
    global $conn;
    connect();
    $query = mysqli_query($conn, "SELECT * FROM `$table` WHERE `user_id` = '$value' AND `status` = 'Pending'");
    disconnect();
    return $query;
}

function removeOrder($order_id){
    global $conn;
    connect();
    mysqli_query($conn, "DELETE FROM `carts` WHERE `id`= '$order_id' ");
    disconnect();
}
