<?php
include_once('includes/admin.inc.php');
session_start();
if(isset($_SESSION['admin_id'])) {
    if(isset($_POST['dep_but'])) {
        $FlightID = $_POST['FlightID'];
        $sql = "UPDATE Flight SET Status='dep' WHERE FlightID=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,'i',$FlightID);         
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: ../index.php');
        exit();
    }else if(isset($_POST['Issue_but'])) {
        $FlightID = $_POST['FlightID'];
        $Issue = $_POST['Issue'];
        $delay_time = gmdate('h:i:s',(int)$Issue*60);
        $sql = 'SELECT * FROM Flight WHERE FlightID=?';
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);              
        mysqli_stmt_bind_param($stmt,'i',$FlightID);         
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)) {
            $date_time_dep = $row['departure'];
            $date_dep = substr($date_time_dep,0,10);
            $time_dep = substr($date_time_dep,10,6) ;    
            // $date_time_arr = $row['arrivale'];
            // $date_arr = substr($date_time_arr,0,10);
            // $time_arr = substr($date_time_arr,10,6) ; 
            $time_dep = new DateTime($date_time_dep);
            $time_dep->add(new DateInterval('PT' . $Issue . 'M'));            
            $stamp_dep = $time_dep->format('Y-m-d H:i:s');         
            // $time_arr = new DateTime($date_time_arr);
            // $time_arr->add(new DateInterval('PT' . $Issue . 'M'));            
            // $stamp_arr = $time_arr->format('Y-m-d H:i:s');                               
            $sql = "UPDATE Flight SET Status='Issue',Issue=?,departure=?
                WHERE FlightID=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,'sssi',$Issue,$stamp_dep,$stamp_arr,$FlightID);         
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);;
            header('Location: ../index.php');
            exit();            
        }        
    } else if(isset($_POST['Issue_soved_but'])) {
      $FlightID = $_POST['FlightID'];
      $sql = "UPDATE flight SET Status='',Issue='solved' WHERE FlightID=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,'i',$FlightID);         
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      header('Location: ../index.php');
      exit();
    } else if(isset($_POST['arr_but'])) {
      $FlightID = $_POST['FlightID'];
      $Issue = $_POST['Issue'];
      $sql = "UPDATE flight SET Status='arr'WHERE FlightID=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,'i',$FlightID);         
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      header('Location: ../index.php');
      exit();
    } else {
        header('Location: ../index.php');
        exit();
    }
}else {
    header('Location: ../index.php');
    exit();
}
