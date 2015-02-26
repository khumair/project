<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> User Profile</title>
<link href="../social/stylesheet/mainpage.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../social/include/jquery.js"> </script>
<script src="../social/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">
/*$("document").ready(function(){
	$("#info").css("background-color","#CCCCCC");
	$("#info tr:even").css("background-color","#FFFFFF");
});*/
</script>
<?php
require("../social/include/database.php");
require("../social/include/functions.php");
$query = "select * from user whre user_id = '".$_SESSION['id']."'";
 $insert = mysql_query($query);
 $reader = mysql_fetch_assoc($insert);
 if(isset($_POST['post'])){
	 wom($_POST['wom']);
	 header("Location:mainpage.php");
 }
 if(isset($_POST['submit'])){
				$fileTmpLoc = $_FILES["pic"]["tmp_name"];
			 $fileName = basename ($_FILES["pic"]["name"]); 
			 $path2 = "uploads/thumbs/".$_SESSION['id']."/logo/".$fileName;
			 createthumb($fileTmpLoc,$path2);
			$userid =$_GET['id']; 
			$nation = trim($_POST['nation']);
			$loc = trim($_POST['loc']);
			$dob= trim($_POST['dob']);
			$favt = trim($_POST['favt']);
			$like = trim($_POST['likes']);
			$question = $_POST['question'];
			$answer = $_POST['ans'];
			$email = trim($_POST['email']);
			$img = trim($_POST['pic']);
			newuser($userid,$nation,$loc,$dob,$favt,$like,$question,$answer,$email,$path2);
		}
 if(!isset($_SESSION['user'])){
	header("Location:login.php");
}
?>
<link href="../social/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
  
  <div id="pp" align="center"> 
  <?php include("../social/include/sidebar.php");?>
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
    <a href="#">update profile?</a>
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
Whats on your mind.......<?php echo $reader['wom']; ?>
<br />
	<form method="post" enctype="multipart/form-data">
  	  <table width="80%" border="1" align="center" cellpadding="3" cellspacing="5" id="combine">
  	    <tr>
  	      <th align="left" valign="middle" scope="row">Nationality</th>
  	      <td align="left" valign="middle"><label for="nation"></label>
          <input type="text" name="nation" id="nation" value="<?php echo $reader['nation']; ?>"/></td>
        </tr>
  	    <tr>
  	      <th align="left" valign="middle" scope="row">Location Current</th>
  	      <td align="left" valign="middle"><label for="loc"></label>
          <input type="text" name="loc" id="loc" value="<?php echo $reader['cloc']; ?>" /></td>
        </tr>
  	    <tr>
  	      <th align="left" valign="middle" scope="row">DOB</th>
  	      <td align="left" valign="middle">
            <span id="sprytextfield1">
            <label>
              <input type="text" name="dob" id="dob" value="<?php echo $reader['dob']; ?>"/>
              <br />
            </label>
          <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldRequiredMsg">A value is required.</span></span></td>
        </tr>
  	    <tr>
  	      <th align="left" valign="middle" scope="row">Favorites</th>
  	      <td align="left" valign="middle"><label for="favt"></label>
          <input type="text" name="favt" id="favt" value="<?php echo $reader['favt']; ?>"/></td>
        </tr>
        <tr>
  	      <th align="left" valign="middle" scope="row">Likes</th>
  	      <td align="left" valign="middle"><label for="likes"></label>
          <input type="text" name="likes" id="likes" value = "<?php echo $reader['like']; ?>"/></td>
        </tr>
  	    <tr>
  	      <th align="left" valign="middle" scope="row">Security Qusetion</th>
  	      <td align="left" valign="middle">
          <select name="question">
          <option><?php echo $reader['question']; ?></option>
          </select>
          </td>
        </tr>
        <tr>
  	      <th align="left" valign="middle" scope="row">Answer</th>
  	      <td align="left" valign="middle"><label for="ans"></label>
          <input type="text" name="ans" id="ans" value = "<?php echo $reader['answer']; ?>"/></td>
        </tr>
  	    <tr>
  	      <th align="left" valign="middle" scope="row">Email</th>
  	      <td align="left" valign="middle"><span id="sprytextfield2">
          <label>
            <input type="text" name="email" id="email" value="<?php echo $reader['email']; ?>"/>
            <br />
          </label>
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
        </tr>
  	    <tr>
  	      <th align="left" valign="middle" scope="row">Upload Photo</th>
  	      <th align="left" valign="middle" scope="row"><input type="file" name="pic" /></th>
        </tr>
  	    <tr>
  	      <th colspan="2" align="center" valign="middle" scope="row"><input name="submit" type="submit" value="Submit" /><?php echo $_GET['md']?></th>
        </tr>
      </table>
    </form>
    <!-- end .content --></div>
  
  <div class="footer">
  
  
  
  <!-- end .footer --></div>
  <!-- end .container --></div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"yyyy-mm-dd"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
</script>
</body>
</html>