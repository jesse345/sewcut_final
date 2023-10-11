<?php

function CreateShop($table1, $fields1, $values1)
{
    global $conn;
    connect();
    // for cart
    $flds1 = implode("`,`", $fields1);
    $vals1 = implode("','", $values1);

    $query1 = mysqli_query($conn, "INSERT INTO `$table1` (`$flds1`) VALUES ('$vals1')");
    disconnect();
}

function getShop($user_id)
{
    global $conn;
    connect();
    $query = mysqli_query($conn, "SELECT * FROM `shops` WHERE `user_id` = '$user_id'");
    // Return the result set as is
    return $query;
}
