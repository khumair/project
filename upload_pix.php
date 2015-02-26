<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> User Profile</title>
<link href="../social/stylesheet/mainpage.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../social/include/jquery.js"> </script>
<script type="text/javascript">
/*$("document").ready(function(){
	$("#info").css("background-color","#CCCCCC");
	$("#info tr:even").css("background-color","#FFFFFF");
});*/
</script>

</head>

<body>
<div class="container">
  <div class="header"></div>
  
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
Whats on your mind.......<?php echo $reader['wom']; ?><br />
<br />
<h2 align="center"><em> Upload Photos To Your Album</em></h2>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" size="80000000" />
<table width="80%" border="0" align="center" id="info">
  <tr>
    <th align="right" scope="row">Select Image</th>
    <td><input type="file" name="uploaded_file" /></td>
  </tr>
  <tr>
    <th colspan="2" align="center" scope="row"><input type="submit" name="up" value="UPLOAD PHOTO" /></th>
    </tr>
</table>
<?php "<pre>" ?>
<?php print_r($_FILES['uploaded_file']);?>
<?php "</pre>"?>
</form>
  <!-- end .content --></div>
  
  <div class="footer">
  
  
  
  <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>