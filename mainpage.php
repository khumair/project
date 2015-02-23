<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> User Profile</title>

<script type="text/javascript" src="../social/include/jquery.js"> </script>
<script type="text/javascrip">
/*$("document").ready(function(){
	$("#info").css("background-color","#CCCCCC");
	$("#info tr:even").css("background-color","#FFFFFF");
});*/
</script>
<?php
require("../social/include/database.php");
require("../social/include/functions.php");
$query = "select * from user where user_id = '".$_SESSION['id']."'";
 $insert = mysql_query($query);
 $reader = mysql_fetch_assoc($insert);
 if(isset($_POST['post'])){
	 wom($_POST['wom']);
	 header("Location:mainpage.php");
 }
 if(!isset($_SESSION['user'])){
	header("Location:login.php");
}
?>
</head>

<body>

<div class="container">
  <div class="header">
  
  <!-- end .header --></div>
  
  <div class="sidebar1">
  <div id="search">
  <form>
  <input type="submit" name="search" value="Search " />
  :
  <input type="text" name="given" size="28" placeholder = "Search in gallery.com....." />
  </form>
  </div>
  
  <div id="ads" align="center" class="err"> 
  <?php include("../social/ads_disp.php");?>
  </div>
  
  
  
  <!-- end .sidebar1 --></div>
  <div class="content" align="center">
    <div id="nav" align="center">
   <!-- HOME | ALBUM | FREINDS | SIGNOUT-->
    <?php  include("../social/include/men_nav.php"); ?>
    </div>
  <div id="ia" >
   <span id="image">
    <img align="middle" src="<?php echo $reader['../social/user_image'];?>" height="100" width="100" />
    <a href="../social/user_profile.php">update profile?</a>
    </span>
   <span id="ad" >
   <em>Welcome <?php echo strtoupper ($_SESSION['user']); ?></em>
	<form method="post">
    <textarea id="txt" name="wom" cols="50" rows="3" ></textarea>
    <input type="submit" name="post" value="Post it" />
    </form>
</span>
  
  </div>
<!--  content goes here -->
Whats on your mind.......<?php echo $reader['wom']; ?><br /><br />
<br />

<table width="424" border="0" align="center" cellpadding="2" id="info" >
      <tr>
        <th width="293" align="left" scope="row"><p>Name</p></th>
        <td width="247" align="left"><p><em><strong><?php echo $reader['user_name'];?></strong></em></p></td>
      </tr>
      <tr>
        <th align="left" scope="row"><p>Gender</p></th>
        <td align="left"><p><em><strong><?php echo $reader['Gender'];?></strong></em></p></td>
      </tr>
      <tr>
        <th align="left" scope="row"><p>Date Of birth</p></th>
        <td align="left"><p><em><strong><?php echo $reader['dob'];?></strong></em></p></td>
      </tr>
      <tr>
        <th align="left" scope="row"><p>Nationality</p></th>
        <td align="left"><p><em><strong><?php echo $reader['nation'];?></strong></em></p></td>
      </tr>
       <tr>
        <th align="left" scope="row"><p>Current Location</p></th>
        <td align="left"><p><em><strong><?php echo $reader['cloc'];?></strong></em></p></td>
      </tr>
      <tr>
        <th align="left" scope="row"><p>Favorites</p></th>
        <td align="left"><p><em><strong><?php echo $reader['favt'];?></strong></em></p></td>
      </tr>
      <tr>
        <th align="left" scope="row"><p>Likes</p></th>
        <td align="left"><p><em><strong><?php echo $reader['like'];?></strong></em></p></td>
      </tr>
      <tr>
        <th align="left" scope="row"><p>Email</p></th>
        <td align="left"><p><em><strong><?php echo $reader['email'];?></strong></em></p></td>
      </tr>
    </table><br />
    <!-- end .content --></div>
  
  <div class="footer">
  
  
  
  <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>