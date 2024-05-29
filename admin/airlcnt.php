<?php

include_once('helpers/init_conn_db.php');

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT * FROM airlines";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?>