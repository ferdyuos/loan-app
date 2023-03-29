<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['admin']);
	header("location: login.php");
}

global $mysqli, $search;
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

          <li class="nav_item_active ">
            <a class="nav_link" href="users.php">
              Users
            </a>
          </li>

          <li class="nav_item ">
            <a class="nav_link" href="entities.php">
              Entities
            </a>
          </li>

          <li class="nav_item">
            <a class="nav_link" href="report.php">
              Reports
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
                  <form class="navbar_form" action="usersearch.php" method="GET">
                    <div class="search">
                      <input type="text" value="" name="search" class="input_search" placeholder="Search" onclick="search()"> 
                    </div>
                  </form>
                <ul class="profile_drop_menu" > <!-- opening Profile DropDown Menu Tag -->
                  <li class="profiledrop">
                    <a href="" class="">
                      
                      <img src="profile/two.jpg" class="profile">
                    </a>
                      <ul class="dropdown"> <!-- opening DropDown Tag -->
                        <!--<li class="dropdown_item"> <a class="" href="#">Profile</a> </li>
                        <li class="dropdown_item"> <a class="" href="#">Settings</a> </li>-->
                        <div class="dropdown_divider"></div>
                        <li class="dropdown_item"> <a class="" href="usersearch.php?logout='1'">Log out</a> </li>    
                      </ul>  <!-- closing DropDown Tag -->
                  </li>      
                </ul>   <!-- closing Profile DropDown Menu Tag -->    
              </div>  <!-- closing SearchProfile Tag -->
          </div>   <!-- closing container_fluid Tag -->
        </nav> <!-- closing Nav navbar Tag -->



        <div class="content"> <!-- opening content Tag -->

          <div class="verrow">  <!-- opening row9 Tag -->

            <div class="totver" >  <!-- opening Total Verified Tag , also by verification cards-->
              <div class="card_head">
                <p class=""> Users </p>
              </div>
              <div class="nav_head">
                <div class="nav_tab">
                <p class=""> 
                    <?php
                   if(isset($_GET['search']))
                   {
                   $search = $_GET['search']; 
                   }

                      $mysqli = new mysqli("localhost:3306","test","loanapp123","loan") or die ("connection failed: " .$mysqli->connect_error());
					            $query = "SELECT COUNT(*) from users WHERE NAME LIKE '%$search%'";
                      $result= mysqli_query($mysqli,$query);
                      $rows = mysqli_fetch_row($result);
                      echo $rows[0];
                    ?> 
                  </p>
                </div>
              </div>      
              <div class="card_body">
                <div class="tab-pane active">  <!-- opening Users Tag -->


				<table class="card_table" border="1px" width="100%">
                    <thead class="">
                      <tr>
                      <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th> 
                      </tr>  
                    </thead>
                                
                    <tbody>
                      <?php
                        if(isset($_GET['search']))
                        {
                        $search = $_GET['search']; 

                        $raw_results = "SELECT * FROM users WHERE NAME LIKE '%$search%'  ORDER by id";
                        $result= mysqli_query($mysqli,$raw_results);

                        if(mysqli_num_rows($result) > 0)
                        {
                          while ($row = mysqli_fetch_array($result)) 
                          {
                          //echo "<p><h3>".$row['NAME']."</h3></p>";	 
                          Print "<tr>";
                          Print '<td align="center">'. $row['ID'] . "</td>";
                          Print '<td align="center">'. $row['FIRST_NAME'] . "</td>";
                          Print '<td align="center">'. $row['LAST_NAME'] . "</td>";
                          Print '<td align="center">'. $row['EMAIL'] . "</td>";
                          Print "</tr>";
                          }
                        }

                        else
                        {
                          echo "No results";
                        }
                        }     
                        

                      ?>    
                    </tbody>
                      
                    

                  </table>
                  
                </div> <!-- closing Users Tag -->
              </div>
            </div> <!-- closing Total Verified Tag -->
          </div>  <!-- closing Verified Row Tag -->

          



        </div> <!-- closing content Tag -->


      <div class="footer">
      
       <p>  Copyright Smart loan </p>

      </div>

    </div> <!-- closing Div Main Panel Tag -->




    
  </div> <!-- closing Div Wrapper Tag -->

  <script>
    function deleter(id)
    {
    var r=confirm("Are you sure you want to delete this record?");
    if (r==true)
      {
        window.location.assign("delete.php?id=" + id);
      }
    }
  </script>




</body>
</html>

