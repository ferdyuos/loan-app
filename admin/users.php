<?php 
include('../functions.php');

if (!isAdmin()) {
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
                      <input type="text" value="" class="input_search" placeholder="Search" onclick="search()"> 
                    </div>
                  </form>
                <ul class="profile_drop_menu" > <!-- opening Profile DropDown Menu Tag -->
                  <li class="profiledrop">
                    <a href="" class="">
                      
                      <img src="profile/two.jpg" class="profile">
                    </a>
                      <ul class="dropdown"> <!-- opening DropDown Tag -->
                      <!--  <li class="dropdown_item"> <a class="" href="#">Profile</a> </li>
                        <li class="dropdown_item"> <a class="" href="#">Settings</a> </li>   -->
                        <div class="dropdown_divider"></div>
                        <li class="dropdown_item"> <a class="" href="users.php?logout='1'">Log out</a> </li>    
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
                      $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                      $query = "SELECT COUNT(*) from users";
                      $result= mysqli_query($mysqli,$query);
                      $rows = mysqli_fetch_row($result);
                      echo $rows[0];
                    ?> 
                  </p>
                </div>
              </div>      
              <div class="card_body">
                <div class="tab-pane active">  <!-- opening Users Tag -->


                    <?php
                    $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());

                    ////// FIRST WE SET UP THE TOTAL ARTICLES PER PAGE & CALCULATIONS:
                    $per_page = 2;// Number of articles per page, change for a different number of articles per page

                    // Get the page and offset value:
                    if (isset($_GET['page'])) {
                    $page = $_GET['page'] - 1;
                    $offset = $page * $per_page;
                    }
                    // Otherwise we render the page and offset as non-existent:
                    else { $page = 0;
                    $offset = 0;
                    } 

                    // Count the total number of users in the table ordering by their id's ascending:
                    $users = "SELECT count(id) FROM users ORDER by id ASC";
                    $result = mysqli_query($mysqli, $users);
                    $row = mysqli_fetch_array($result);
                    $total_users = $row[0];

                    // Calculate the number of pages:
                    if ($total_users > $per_page) {//If there is more than one page
                    $pages_total = ceil($total_users / $per_page);
                    $page_up = $page + 2;
                    $page_down = $page;
                    $display ='';//leave the display variable empty so it doesn't hide anything
                    } 
                    else {// Else if there is only one page
                    $pages = 1;
                    $pages_total = 1;
                    $display = ' class="display-none"';//class to hide page count and buttons if only one page
                    } 





                    ////// THEN WE DISPLAY THE PAGE COUNT AND BUTTONS:

                    echo '<h2'.$display.'>Page '; echo $page + 1 .' of '.$pages_total.'</h2>';// Page out of total pages

                    $i = 1;// Set the $i counting variable to 1

                    echo '<div id="pageNav"'.$display.'>';// our $display variable will do nothing if more than one page

                    // Show the page buttons:
                    if ($page) {
                    echo '<a href="users.php"><button><<</button></a>';// Button for first page [<<]
                    echo '<a href="users.php?page='.$page_down.'"><button><</button></a>';// Button for previous page [<]
                    } 

                    for ($i=1;$i<=$pages_total;$i++) {
                    if(($i==$page+1)) {
                    echo '<a href="users.php?page='.$i.'"><button class="active">'.$i.'</button></a>';// Button for active page, underlined using 'active' class
                    }

                    // In this next if statement, calculate how many buttons you'd like to show. You can remove to show only the active button and first, prev, next and last buttons:
                    if(($i!=$page+1)&&($i<=$page+3)&&($i>=$page-1)) {// This is set for two below and two above the current page
                    echo '<a href="users.php?page='.$i.'"><button>'.$i.'</button></a>'; }
                    } 

                    if (($page + 1) != $pages_total) {
                    echo '<a href="users.php?page='.$page_up.'"><button>></button></a>';// Button for next page [>]
                    echo '<a href="users.php?page='.$pages_total.'"><button>>></button></a>';// Button for last page [>>]
                    }
                    echo "</div>";// #pageNav end

                    ?>


                  <table class="card_table">
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
                        $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
                        $query = $mysqli->query("SELECT id,first_name,last_name,email from users ORDER by id ASC LIMIT $offset, $per_page");
  
                        while($row = mysqli_fetch_array($query))
                        {
                          Print "<tr>";
                          Print '<td align="center">'. $row['id'] . "</td>";
                          Print '<td align="center">'. $row['first_name'] . "</td>";
                          Print '<td align="center">'. $row['last_name'] . "</td>";
                          Print '<td align="center">'. $row['email'] . "</td>";
                          Print '<td align="center"><a href="#" onclick="deleter('.$row['id'].')"> delete</a> </td>'; //named deleter because delete() is an inbuilt function and doesnt work 
                          Print "</tr>";
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
        window.location.assign("userdelete.php?id=" + id);
      }
    }
  </script>

</body>
</html>



