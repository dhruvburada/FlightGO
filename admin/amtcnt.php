<?php

require 'helpers/init_conn_db.php';

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT SUM(FlightCostPerPerson) FROM Flight";
        $amountsum = mysqli_query($conn, $sql) or die(mysqli_error($sql));
        $row_amountsum = mysqli_fetch_assoc($amountsum);
        $totalRows_amountsum = mysqli_num_rows($amountsum);
        echo $row_amountsum['SUM(FlightCostPerPerson)'];
?><!-- Visit codeastro.com for more projects -->