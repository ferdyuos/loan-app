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
  <title>Settings</title>
  <meta charset="utf-8" name="viewport" content="width=device-width, intitial-scale=1">
</head>
<body>

  <div class="wrapper"> <!-- opening Div Wrapper Tag -->
    <div class="sidebar"> <!-- opening Div Sidebar Tag -->
      <div class="logo">
        <a href="admin_page.html" class="loan_logo">
          <img src="../arana1.png" width="30px" height="30px">
          <p> My Dashboard </p>
        </a>
      </div>
      <div class="sidebar_wrapper"> <!-- opening Div Sidebar Wrapper Tag -->
        <ul class="nav">
       
        <li class="nav_item">
            <a class="nav_link" href="index.php">
              Home
            </a>
          </li>

          <li class="nav_item">
            <a class="nav_link" href="peerrecords.php">
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

          <li class="nav_item">
            <a class="nav_link" href="loanrequest.php">
              loan Request +
            </a>
          </li>

          <li class="nav_item">
            <a class="nav_link" href="peerrequest.php">
              Peer Request +
            </a>
          </li>
          <li class="nav_item_active">
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
                      <input type="text" name="" class="input_search" placeholder="Search" onclick="search()"> 
                    </div>
                  </form>
                <ul class="profile_drop_menu" > <!-- opening Profile DropDown Menu Tag -->
                  <li class="profiledrop">
                    <a href="" class="">
                      
                      <img src="profile/two.jpg" class="profile">
                    </a>
                      <ul class="dropdown"> <!-- opening DropDown Tag -->
                      <!--  <li class="dropdown_item"> <a class="" href="#">Profile</a> </li>
                        <li class="dropdown_item"> <a class="" href="#">Settings</a> </li>  -->
                        <div class="dropdown_divider"></div>
                        <li class="dropdown_item"> <a class="" href="settings.php?logout='1'">Log out</a> </li>    
                      </ul>  <!-- closing DropDown Tag -->
                  </li>      
                </ul>   <!-- closing Profile DropDown Menu Tag -->    
              </div>  <!-- closing SearchProfile Tag -->
          </div>   <!-- closing container_fluid Tag -->
        </nav> <!-- closing Nav navbar Tag -->



        <div class="content"> <!-- opening content Tag -->

            <form method="post" action="settings.php">

                <?php echo display_error(); ?>
                <div class="input-group">
                <button type="submit" class="btn" name="update_ranking_btn"> Update Rankings</button>
            </div>
	        </form>

        </div> <!-- closing content Tag -->


      <div class="footer">
      
       <p>  Copyright Smart loan </p>

      </div>

    </div> <!-- closing Div Main Panel Tag -->




    
  </div> <!-- closing Div Wrapper Tag -->

</body>
</html>

