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
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../loan.css">
  <style>
    .header 
    {
      background: #003366;
    }
    button[name=register_btn] 
    {
      background: #003366;
    }
  </style>
  <title>Add Admin</title>
  <meta charset="utf-8" name="viewport" content="width=device-width, intitial-scale=1">
</head>
<body>

  <div class="wrapper"> <!-- opening Div Wrapper Tag -->
    <div class="sidebar"> <!-- opening Div Sidebar Tag -->
      <div class="logo">
        <a href="admin_page.html" class="loan_logo">
          <img src="../../arana1.png" width="30px" height="30px">
          <p> Admin Dashboard  </p>
        </a>
      </div>
      <div class="sidebar_wrapper"> <!-- opening Div Sidebar Wrapper Tag -->
        <ul class="nav">
        <li class="nav_item">
            <a class="nav_link" href="index.php">
              Home
            </a>
          </li>

          <li class="nav_item ">
            <a class="nav_link" href="users.php">
              Users
            </a>
          </li>

          <li class="nav_item ">
            <a class="nav_link" href="entities.php">
              Entities
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
                      <input type="text" value="" class="input_search" placeholder="Search..." onclick="search()" name=""> 
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
                        <li class="dropdown_item"> <a class="" href="createadmin.php?logout='1'">Log out</a> </li>    
                      </ul>  <!-- closing DropDown Tag -->
                  </li>      
                </ul>   <!-- closing Profile DropDown Menu Tag -->    
              </div>  <!-- closing SearchProfile Tag -->
          </div>   <!-- closing container_fluid Tag -->
        </nav> <!-- closing Nav navbar Tag -->



        <div class="content"> <!-- opening content Tag -->
              <link rel="stylesheet" type="text/css" href="../style.css">
              <style>
                .header {
                  background: #007fe4;
                }
                button[name=register_btn] {
                  background: #007fe4;
                }
              </style>
            </head>
            <body>
              <div class="header">
                <h2>Admin - create user</h2>
              </div>
              
              <form method="post" action="createadmin.php" class="form_create">

               

                <div class="input-group">
                  <label>Email</label>
                  <input type="email" name="email" value="">
                </div>
                <div class="input-group">
                  <label>User type</label>
                  <select name="type" id="user_type" >
                    <option value=""></option>
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                    <option value="viewer">Viewer</option>
                  </select>
                </div>
                <div class="input-group">
                  <label>Password</label>
                  <input type="password" name="password">
                </div>
                <div class="input-group">
                  <label>Confirm password</label>
                  <input type="password" name="confirm_password">
                </div>
                <div class="input-group">
                  <button type="submit" class="btn" name="register_admin_btn"> + Create user</button>
                </div>
              </form>
            </body>
            </html>

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
        window.location.assign("deletepage.php?id=" + id);
      }
    }
  </script>


</body>
</html>

