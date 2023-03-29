<?php 
include('../functions.php');


if (!isUser()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../loan.css">
	<title>Admin Page</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, intitial-scale=1">
</head>
<body>

	<div class="wrapper"> <!-- opening Div Wrapper Tag -->
		<div class="sidebar"> <!-- opening Div Sidebar Tag -->
			<div class="logo">
        <a href="admin_page.html" class="loan_logo">
          <img src="../arana1.png" width="30px" height="30px">
          <p> User Dashboard  </p>
        </a>
			</div>
			<div class="sidebar_wrapper"> <!-- opening Div Sidebar Wrapper Tag -->
		    <ul class="nav">
        <li class="nav_item_active">
            <a class="nav_link" href="index.php">
              Home
            </a>
          </li>

          <li class="nav_item">
            <a class="nav_link" href="peerrequest.php">
              P2P
            </a>
          </li>

          <li class="nav_item">
            <a class="nav_link" href="sentrequests.php">
              My Sent Request(s)
            </a>
          </li>

          <li class="nav_item">
            <a class="nav_link" href="receivedrequests.php">
              My P2P Recieved Request(s)
            </a>
          </li>

          <li class="nav_item_active">
            <a class="nav_link" href="loanrequest.php">
              loan Request +
            </a>
          </li>

          <li class="nav_item">
            <a class="nav_link" href="peerrequest.php">
              Peer Request +
            </a>
          </li>
          <li class="nav_item">
            <a class="nav_link" href="settings.php">
              Settings
            </a>
          </li>

		    </ul>
		  </div> <!-- closing Div Sidebar Wrapper Tag -->
		</div> <!-- closing Div Sidebar Tag -->


		<div class="main_panel"> <!-- opening Div Main Panel Tag -->
			<nav class="navbar"> <!-- opening Nav navbar Tag -->
        		<div class="container_fluid">   <!-- opening Div container_fluid Tag -->
		         
			        <div class="navbar_wrapper"> <!-- opening Div navbar_wrapper Tag -->
			            <a href="" class="inactivelink"> Home </a>
			        </div>  <!-- closing Div navbar_wrapper Tag -->

			        <div class="searchprofile"> <!-- opening SearchProfile Tag -->
			            <form class="navbar_form">
			            	<div class="search">
			            		<input type="text" value="" class="input_search" placeholder="Search" onclick="search()"> 
			            	</div>
			            </form>
				        <ul class="profile_drop_menu" > <!-- opening Profile DropDown Menu Tag -->
				        	<li class="profiledrop">
				        		<a href="" class="">
				        			
				        			<img src="profile/two.jpg" class="profile">
				        		</a>
				        			<ul class="dropdown"> <!-- opening DropDown Tag -->
				            	<!--	<li class="dropdown_item"> <a class="" href="#">Profile</a> </li>
				            		<li class="dropdown_item"> <a class="" href="#">Settings</a> </li> -->
				            		<div class="dropdown_divider"></div>
				            		<li class="dropdown_item"> <a class="" href="index.php?logout='1'">Log out</a> </li>    
				            	</ul>  <!-- closing DropDown Tag -->
				        	</li>      
				        </ul>   <!-- closing Profile DropDown Menu Tag -->    
			        </div>  <!-- closing SearchProfile Tag -->
			    </div>   <!-- closing container_fluid Tag -->
		    </nav> <!-- closing Nav navbar Tag -->



		    <div class="content"> <!-- opening content Tag -->

		    	<div class="row">  <!-- opening row1 Tag -->
		    		
            <div class="totusers" style="width: 30%;">  <!-- opening Total Users Tag -->
              <div class="card_body">
                <div class="card_row">
                  <div class="head">
                    <i class="heading">Total Users </i>
                  </div>
                  						
                  <div class="numbers">
                    <p class="card_title">
                      <?php
                        $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                        $query = "SELECT COUNT(*) from users";
                        $result= mysqli_query($mysqli,$query);
                        $rows = mysqli_fetch_row($result);
                        echo $rows[0];
                      ?> 
                    </p>
                  </div>
                </div>
              </div>
		    		</div> <!-- closing Total Users Tag -->


		    		<div class="totentities" style="width: 30%;">  <!-- opening Total Entities Tag -->
		    			<div class="card_body">
                <div class="card_row">
                  <div class="head">
                    <i class="heading">Total Entities </i>
                  </div>
                  						
                  <div class="numbers">
                    <p class="card_title">
                      <?php
                        $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                        $query = "SELECT COUNT(*) from entities";
                        $result= mysqli_query($mysqli,$query);
                        $rows = mysqli_fetch_row($result);
                        echo $rows[0];
                      ?> 
                    </p>
                  </div>
                </div>
              </div>
              
		    		</div> <!-- closing Total Entities Tag -->


		    		<div class="totapp" style="width: 30%;">  <!-- opening Total loan Applications Tag -->
		    			<div class="card_body">
                <div class="card_row">
                  <div class="head">
                    <i class="heading">Total Applications </i>
                  </div>
                  						
                    <div class="numbers">
                      <p class="card_title">
                        <?php
                          $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                        $query = "SELECT 
                        (select count(*) from loan_record)
                         +
                        (select count(*) from peer_record)";
                          $result= mysqli_query($mysqli,$query);
                          $rows = mysqli_fetch_row($result);
                          echo $rows[0];
                        ?> 
                      </p>
                    </div>
                	</div>
              	</div>
		    		</div> <!-- closing Total loan Applications Tag -->
		    	</div> <!-- closing Row1 Tag -->

		    	<div class="row">  <!-- opening row2 Tag -->

		    		<div class="totloan_app" style="width: 30%;">  <!-- opening Total peer to peer loan application Tag -->
		    			<div class="card_body">
                <div class="card_row">
                  <div class="head">
                    <i class="heading">Total peer to peer loan application</i>
                  </div>
                  						
                  <div class="numbers">
                    <p class="card_title">
                      <?php
                        $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                        $query = "SELECT COUNT(*) from peer_record";
                        $result= mysqli_query($mysqli,$query);
                        $rows = mysqli_fetch_row($result);
                        echo $rows[0];
                      ?> 
                    </p>
                  </div>
                </div>
              </div>
		    		</div> <!-- closing Total peer to peer loan application Tag -->


		    		<div class="totloandisb" style="width: 30%;">  <!-- opening Total loan Disbursed Tag -->
		    			<div class="card_body">
                <div class="card_row">
                  <div class="head">
                    <i class="heading">Total loans Disbursed</i>
                  </div>
                  						
                  <div class="numbers">
                    <p class="card_title">
                      <?php
                        $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                        $query = "SELECT 
                        (select SUM(amount) from loan_record)
                        +
                        (select SUM(amount) from peer_record)";
                        $result= mysqli_query($mysqli,$query);
                        $rows = mysqli_fetch_row($result);
                        echo $rows[0];
                      ?> 
                    </p>
                  </div>
                </div>
              </div>
		    		</div> <!-- closing Total loan Disbursed Tag -->


		    		<div class="totloandisb_ent" style="width: 30%;">  <!-- opening Total loans Disbursed by Entities Tag -->
		    			<div class="card_body">
                <div class="card_row">
                  <div class="head">
                    <i class="heading">Total loans Disbursed by Entities</i>
                  </div>
                  						
                  <div class="numbers">
                    <p class="card_title">
                      <?php
                        $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                        $query = "SELECT SUM(amount) from loan_record";
                        $result= mysqli_query($mysqli,$query);
                        $rows = mysqli_fetch_row($result);
                        echo $rows[0];
                      ?> 
                    </p>
                  </div>
                </div>
              </div>
		    		</div> <!-- closing Total loans Disbursed by Entities Tag -->

		    	</div>  <!-- closing row2 Tag -->

		    	<div class="row">  <!-- opening row3 Tag -->

		    		<div class="totloandisb_Peer Request" style="width: 30%;">  <!-- opening Total Disbursed by Peers Tag -->
		    			<div class="card_body">
                <div class="card_row">
                  <div class="head">
                    <i class="heading"> Total loans Disbursed by Peers </i>
                  </div>
                  						
                  <div class="numbers">
                    <p class="card_title">
                      <?php
                        $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                        $query = "SELECT SUM(amount) from peer_record";
                        $result= mysqli_query($mysqli,$query);
                        $rows = mysqli_fetch_row($result);
                        echo $rows[0];
                      ?> 
                    </p>
                  </div>
                </div>
              </div>

		    		</div> <!-- closing Disbursed by Peers Tag -->

		    	</div> <!-- closing row3 Tag --> 	 

          <div class="row">  <!-- opening row4 Tag -->

		    		<div class="totloan_app" style="width: 30%;">  <!-- opening Total loan application Tag -->
		    			<div class="card_body">
                <div class="card_row">
                  <div class="head">
                    <i class="heading">Total loan application</i>
                  </div>
                  						
                  <div class="numbers">
                    <p class="card_title">
                      <?php
                        $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                        $query = "SELECT COUNT(*) from loan_record";
                        $result= mysqli_query($mysqli,$query);
                        $rows = mysqli_fetch_row($result);
                        echo $rows[0];
                      ?> 
                    </p>
                  </div>
                </div>
              </div>
		    		</div> <!-- closing Total loan application Tag -->

		    	</div>  <!-- closing row4 Tag -->


		    </div> <!-- closing content Tag -->


			<div class="footer">
			
			 <p>  Copyright Smart loan </p>

			</div>

		</div> <!-- closing Div Main Panel Tag -->




		
	</div> <!-- closing Div Wrapper Tag -->


</body>
</html>

