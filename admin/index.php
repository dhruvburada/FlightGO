<?php
session_start(); 
include_once('header.php'); 
include_once('helpers/init_conn_db.php');


session_start();

if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    echo '<script>window.location.href = "admin_login.php";</script>';
    exit; 
}
?>








<link rel="stylesheet" href="assets/css/admin.css">
<style>
  body {
    /* background-color: #B0E2FF; */
    background-color: #efefef;
  }
  td {
    /* font-family: 'Assistant', sans-serif !important; */
    font-size: 18px !important;
  }
  p {
  font-size: 35px;
  font-weight: 100;
  font-family: 'product sans';  
  }  

  .main-section{
    width:100%;
    margin:0 auto;
    text-align: center;
    padding: 0px 5px;
  }
  .dashbord{
    width:23%;
    display: inline-block;
    background-color:#34495E;
    color:#fff;
    margin-top: 50px; 
  }
  .icon-section i{
    font-size: 30px;
    padding:10px;
    border:1px solid #fff;
    border-radius:50%;
    margin-top:-25px;
    margin-bottom: 10px;
    background-color:#34495E;
  }
  .icon-section p{
    margin:0px;
    font-size: 20px;
    padding-bottom: 10px;
  }
  .detail-section{
    background-color: #2F4254;
    padding: 5px 0px;
  }
  .dashbord .detail-section:hover{
    background-color: #5a5a5a;
    cursor: pointer;
  }
  .detail-section a{
    color:#fff;
    text-decoration: none;
  }
  .dashbord-2 .icon-section,.dashbord-2 .icon-section i{
    background-color: #9CB4CC;
  }
  .dashbord-2 .detail-section{
    background-color: #149077;
  }

  .dashbord-1 .icon-section,.dashbord-1 .icon-section i{
    background-color: #2980B9;
  }
  .dashbord-1 .detail-section{
    background-color:#2573A6;
  }
  .dashbord-3 .icon-section,.dashbord-3 .icon-section i{
    background-color:#316B83;
  }
  .dashbord-3 .detail-section{
    background-color:#CF4436;
  }
  .dropdown-menu {
            right: 0;
            left: auto;
        }


  /* Issue and other column error */
  
</style>
<main>
 
    <div class="container">
      <div class="main-section">
        <div class="dashbord dashbord-1">
          <div class="icon-section">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="currentColor" class="bi bi-person-standing" viewBox="0 0 16 16">
            <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M6 6.75v8.5a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2.75a.75.75 0 0 0 1.5 0v-2.5a.25.25 0 0 1 .5 0"/>
            </svg><br>
            Total Passengers
            <p><?php include 'psngrcnt.php';?></p>
          </div>
        </div>
        <div class="dashbord dashbord-2">
          <div class="icon-section">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
            <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"/>
            </svg><br>
            Amount
            <p>₹ <?php include 'amtcnt.php';?></p>
          </div>
        </div>
        <div class="dashbord dashbord-3">
          <div class="icon-section">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="currentColor" class="bi bi-airplane" viewBox="0 0 16 16">
            <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849m.894.448C7.111 2.02 7 2.569 7 3v4a.5.5 0 0 1-.276.447l-5.448 2.724a.5.5 0 0 0-.276.447v.792l5.418-.903a.5.5 0 0 1 .575.41l.5 3a.5.5 0 0 1-.14.437L6.708 15h2.586l-.647-.646a.5.5 0 0 1-.14-.436l.5-3a.5.5 0 0 1 .576-.411L15 11.41v-.792a.5.5 0 0 0-.276-.447L9.276 7.447A.5.5 0 0 1 9 7V3c0-.432-.11-.979-.322-1.401C8.458 1.159 8.213 1 8 1s-.458.158-.678.599"/>
            </svg><br>
            Flights
            <p><?php include 'flightscnt.php';?></p>
          </div>
        </div>     
        <div class="dashbord">
          <div class="icon-section">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="currentColor" class="bi bi-airplane-engines-fill" viewBox="0 0 16 16">
            <path d="M8 0c-.787 0-1.292.592-1.572 1.151A4.35 4.35 0 0 0 6 3v3.691l-2 1V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.191l-1.17.585A1.5 1.5 0 0 0 0 10.618V12a.5.5 0 0 0 .582.493l1.631-.272.313.937a.5.5 0 0 0 .948 0l.405-1.214 2.21-.369.375 2.253-1.318 1.318A.5.5 0 0 0 5.5 16h5a.5.5 0 0 0 .354-.854l-1.318-1.318.375-2.253 2.21.369.405 1.214a.5.5 0 0 0 .948 0l.313-.937 1.63.272A.5.5 0 0 0 16 12v-1.382a1.5 1.5 0 0 0-.83-1.342L14 8.691V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v.191l-2-1V3c0-.568-.14-1.271-.428-1.849C9.292.591 8.787 0 8 0"/>
            </svg><br>
            Available Airlines
            <p><?php include 'airlcnt.php';?></p>
          </div>
        </div>  
      </div> 
      
      <div class="card mt-4" id="flight">
      <div class="card-body">
          <div class="dropdown" style="float: right;">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-filter"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#flight">Today's Flights</a>
              <a class="dropdown-item" href="#Issue">Today's flight issues</a>
              <a class="dropdown-item" href="#dep">Flights departed today</a>
              <a class="dropdown-item" href="#arr">Flights arrived today</a>
            </div>
          </div>        
        <p class="text-secondary">Today's Flights</p>
        <table class="table-sm table table-hover table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">FlightID</th>
              <th scope="col">Departure</th>
              <th scope="col">Destination</th>
              <th scope="col">Source</th>
              <th scope="col">Airlines</th>
              <th></th>
            </tr>
          </thead>
          <tbody>              
              <?php

                $curr_date = (string)date('y-m-d');
                $curr_date = '20'.$curr_date;
                $sql = "SELECT * FROM Flight WHERE DATE(DepartureDate)=?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,'s',$curr_date);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                  if($row['Status']== '') {
                    echo '     
                <td scope="row">
                  <a href="pass_list.php?FlightID='.$row['FlightID'].'" style="text-decoration:underline;">
                 '.$row['FlightID'].' </a> </td>
                <td>'.$row['DepartureDate'].' | '.$row['DepartureTime'].'</td>
                <td>'.$row['Destination'].'</td>
                <td>'.$row['Source'].'</td>
                <td>'.$row['Flight Name'].'</td> 
                
                <th class="options">
                  <div class="dropdown">
                    <a class="text-reset text-decoration-none" href="#" 
                      id="dropdownMenuButton" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">
                      
                      <i class="fa fa-ellipsis-v"></i> </td>
                    </a>  
                    <div class="dropdown-menu">
                      <form class="px-4 py-3"  action="includes/admin.inc.php" method="post">
                        <input type="hidden" type="number" name="FlightID" 
                          value='.$row['FlightID'].'>
                        <div class="form-group">
                          <label for="exampleDropdownFormEmail1">Enter time in min.                              
                          </label>
                          <input type="number" class="form-control" name="Issue" 
                            placeholder="Eg. 120">
                        </div>  
                        <button type="submit" name="issue_but" 
                          class="btn btn-danger btn-sm">Submit Issue</button>
                        <div class="dropdown-divider"></div>
                        <button type="submit" name="dep_but" 
                          class="btn btn-primary btn-sm">Departed</button>
                      </form>
                    </div>
                  </div>  
                </th>                
              </tr> ' ; }} ?>
          </tbody>
        </table>        
      
      </div>
    </div>

    <div class="card" id="Issue">
      <div class="card-body">
          <div class="dropdown" style="float: right;">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-filter"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#flight">Today's flight</a>
              <a class="dropdown-item" href="#Issue">Today's flight issues</a>
              <a class="dropdown-item" href="#dep">Flights departed today</a>
              <a class="dropdown-item" href="#arr">Flights arrived today</a>
            </div>
          </div>        
        <p class="text-secondary">Today's Flight Issues</p>
        <table class="table-sm table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
              <th scope="col">FlightID</th>
              <th scope="col">Departure</th>
              <th scope="col">Destination</th>
              <th scope="col">Source</th>
              <th scope="col">Airline</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
              <tr>
              <?php
                $curr_date = (string)date('y-m-d');
                $curr_date = '20'.$curr_date;
                $sql = "SELECT * FROM Flight WHERE DATE(DepartureDate)=?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,'s',$curr_date);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                  if($row['Status']=='Issue') {
                    echo '              
                <td scope="row">
                  <a href="pass_list.php?FlightID='.$row['FlightID'].'">
                  '.$row['FlightID'].' </a> </td>
                
                <td>'.$row['DepartureDate'].' | '.$row['DepartureTime'].'</td>
                <td>'.$row['Destination'].'</td>
                <td>'.$row['Source'].'</td>
                <td>'.$row['FlightName'].'</td> 
                <th class="options">
                  <div class="dropdown">
                    <a class="text-reset text-decoration-none" href="#" 
                      id="dropdownMenuButton" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">
                      
                      <i class="fa fa-ellipsis-v"></i> </td>
                    </a>  
                    <div class="dropdown-menu">
                      <form class="px-4 py-3"  action="includes/admin.inc.php" method="post">
                        <input type="hidden" type="number" name="FlightID" 
                          value='.$row['FlightID'].'>  
                        <button type="submit" name="issue_soved_but" 
                          class="btn btn-danger btn-sm">Issue Solved!</button>
                      </form>
                    </div>
                  </div>  
                </th>                
              </tr> ' ; }} ?>
          </tbody>
        </table>        
      
      </div>
    </div> 

    <div class="card mb-4" id="dep">
      <div class="card-body ">
          <div class="dropdown" style="float: right;">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-filter"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#flight">Today's flight</a>
              <a class="dropdown-item" href="#Issue">Today's flight issues</a>
              <a class="dropdown-item" href="#dep">Flights departed today</a>
              <a class="dropdown-item" href="#arr">Flights arrived today</a>
            </div>
          </div>        
        <p class=" text-secondary">Flights Departed Today</p>
        <table class="table-sm table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
              <th scope="col">FlightID</th>
              <th scope="col">Departure</th>
              <th scope="col">Destination</th>
              <th scope="col">Source</th>
              <th scope="col">Airline</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
              <tr>
              <?php
                $curr_date = (string)date('y-m-d');
                $curr_date = '20'.$curr_date;
                $sql = "SELECT * FROM Flight WHERE DATE(DepartureDate)=?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,'s',$curr_date);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                  if($row['Status']=='dep') {
                    echo '              
                <td scope="row">
                  <a href="pass_list.php?FlightID='.$row['FlightID'].'">
                  '.$row['FlightID'].' </a> </td>
                
                <td>'.$row['DepartureDate'].' | '.$row['DepartureTime'].'</td>
                <td>'.$row['Destination'].'</td>
                <td>'.$row['Source'].'</td>
                <td>'.$row['FlightName'].'</td> 
                <th class="options">
                  <div class="dropdown">
                    <a class="text-reset text-decoration-none" href="#" 
                      id="dropdownMenuButton" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">
                      
                      <i class="fa fa-ellipsis-v"></i> </td>
                    </a>  
                    <div class="dropdown-menu">
                      <form class="px-4 py-3"  action="includes/admin.inc.php" method="post">
                        <input type="hidden" type="number" name="FlightID" 
                          value='.$row['FlightID'].'>  
                        <button type="submit" name="arr_but" 
                          class="btn btn-danger">Arrived</button>
                      </form>
                    </div>
                  </div>  
                </th>                
              </tr> ' ; }} ?>
          </tbody>
        </table>        
      
      </div>
    </div>       
<!-- 
    <div class="card mb-4" id="arr">
      <div class="card-body">
        <div class="dropdown" style="float: right;">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-filter"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#flight">Today's flight</a>
              <a class="dropdown-item" href="#Issue">Today's flight issues</a>
              <a class="dropdown-item" href="#dep">Flights departed today</a>
              <a class="dropdown-item" href="#arr">Flights arrived today</a>
            </div>
          </div>        
        <p class=" text-secondary">Flights Arrived Today</p>
        <table class="table-sm table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
              <th scope="col">FlightID</th>
              <th scope="col">Departure</th>
              <th scope="col">Destination</th>
              <th scope="col">Source</th>
              <th scope="col">Airline</th>
            </tr>
          </thead>
          <tbody>
              <tr>
             // <?php
             //   $curr_date = (string)date('y-m-d');
             //   $curr_date = '20'.$curr_date;
             //   $sql = "SELECT * FROM Flight WHERE DATE(DepartureDate)=?";
            //  $stmt = mysqli_stmt_init($conn);
            //  mysqli_stmt_prepare($stmt,$sql);
            //    mysqli_stmt_bind_param($stmt,'s',$curr_date);
            //    mysqli_stmt_execute($stmt);
            //      $result = mysqli_stmt_get_result($stmt);
            //      while ($row = mysqli_fetch_assoc($result)) {
            //      if($row['Status']=='arr') {
            //        echo '              
            //    <td scope="row">
            //      <a href="pass_list.php?FlightID='.$row['FlightID'].'">
            //      '.$row['FlightID'].' </a> </td>
                
            //    <td>'.$row['DepartureDate'].' | '.$row['DepartureTime'].'</td>
            //    <td>'.$row['Destination'].'</td>
            //    <td>'.$row['Source'].'</td>
            //    <td>'.$row['FlightName'].'</td>                
            //  </tr> ' ; 
            //  }} ?>
          </tbody>
        </table>         -->
        
       
      </div>
    </div>     
  <?php  include_once 'broadcast.php'; ?> 
  <?php include_once 'footer.php';?>
  </div>

