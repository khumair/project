<?php
$GLOBALS['id'];
function GO($url)
{
	echo "	
		<script type='text/javascript'>		
		location.href = '$url';
		</script>
	";
}
//______________________________________________________________________________________
function wom($wom){
	$query = "UPDATE `gallery`.`user` SET `wom` = '$wom' WHERE `user`.`user_id` ='".$_SESSION['id']."'";
	$insert = mysql_query($query);
}
//______________________________________________________________________________________
// user login funtion
function login($name,$password){
	$query =" select * from user where user_name = '$name' and password = '$password'";
	$insert = mysql_query($query);
	$reader =mysql_fetch_array($insert);
	if($reader){
		$md = $reader['user_id'];
		$_SESSION['id'] = $reader['user_id'];
		$_SESSION['user'] = $name;
		$_SESSION['lvl']= $reader['lvl'];
		header("Location:mainpage.php?md=$md");
	}
	else
		 return $msg = "invalid user and password";
}
//___________________________________________________________________________________
// user info function
function newuser($userid,$nation,$loc,$dob,$favt,$like,$qus,$ans,$email,$img){
	$query ="UPDATE  `gallery`.`user` SET  `nation` =  '$nation',`cloc` =  '$loc',
`dob` =  '$dob',
`favt` =  '$favt',
`like` =  '$like',
`question` =  '$qus',
`answer` =  '$ans',
`email` =  '$email',`user_image`='$img' WHERE  `user`.`user_id` = '".$_SESSION['id']."'";
	$insert = mysql_query($query);
	$reader = mysql_fetch_assoc($insert);
	if($insert){
		header("Location:mainpage.php?md=$userid");
		//$_SESSION['id']
	}
	else
	{
		$md = mysql_error();
		header("Location:newuser.php?md=$md");
	}
}
//_____________________________________________________________________________-
// Register Function
function register($name,$password,$gender){
	$query = "select * from user where user_name = '$name'";
	$insert = mysql_query($query);
	$reader = mysql_fetch_assoc($insert);
	if($reader){
		//$GLOBALS['msg'] = "The user name has already Taken";
		header("Location:register.php?mg=Alreadytaken");
	}
	else{
	
	$query = "Insert into user (user_name,password,Gender) values ('$name','$password','$gender')";
	$insert = mysql_query($query);
	$query2 = "select * from user where user_name = '$name'";
	$insert2 = mysql_query($query2);
	$reader2 = mysql_fetch_assoc($insert2);
	mkdir('uploads/'.$reader2['user_id'],0744,true);
	mkdir('uploads/thumbs/'.$reader2['user_id'],0744,true);
	mkdir('uploads/thumbs/'.$reader2['user_id']."/logo",0744,true);
	$_SESSION['id'] = $reader2['user_id'];
	$_SESSION['user'] = $name; 
	//header("Location:register.php?mg=."$id".');
	header("Location:newuser.php");
	//GO("newuser.php?user=$id");
	}
}
//________________________________________________________________________________________
$dt;
function makealbum($albumname,$des){
	$dt = getdate(time());
	$dat = $dt['year']."-".$dt['mon']."-". $dt['mday'];
	$album_name = mysql_real_escape_string(htmlentities($albumname));
	$album_des = mysql_real_escape_string(htmlentities($des));
	$query = " INSERT INTO  `gallery`.`album` (
`user_id` ,`album_id` ,`album_name` ,`date` ,`description`)VALUES (
'".$_SESSION['id']."', NULL ,  '$album_name',  '$dat',  '$album_des')";
	$inst = mysql_query($query);
	$al = mysql_insert_id();
	//mkdir("uploads/".$_SESSION['id']."/".$al,0777,true);
	//mkdir("uploads/thumbs/".$_SESSION['id']."/".$al,0777,true);
	if($inst){
		header("Location:upload_pix.php?sd=$al");
	}
	else{
		$md = mysql_error();
		header("Location:album.php?sd=$md");
	}
}
//______________________________________________________________________________________
function getalbum(){
	$album = array();
	$query = " 
	SELECT `album`.`album_id`,`album`.`album_name`,`album`.`date`, 					LEFT(`album`.`description`,50)as `description`,
	COUNT(`image`.`image_id`)as image_count
	From `album`
	LEFT JOIN `image` ON
	`album`.`album_id` = `image`.`album_id`
	WHERE `album`.`user_id`  = '".$_SESSION['id']."'
	GROUP BY `album`.`album_id`
	";
	$inst = mysql_query($query);
	while($reader_al = mysql_fetch_assoc($inst)){
		$album[] = array(
		'id' => $reader_al['album_name'],
		'date' => $reader_al['date'],
		'name' => $reader_al['album_name'],
		'description' => $reader_al['description'],
		'count' => $reader_al['image_count'],
		
		);
	}
}
//__________________________________________________________________________
	/*function uploadpix($id,$tmp,$p){
		$dt = getdate(time());
	$dat = $dt['mday']."/".$dt['mon'] ."/". $dt['year'];
		$pix[] = array();
		for($i=0;$i<=10;$i++){
			if($p($i)!=" "){
				$pix[$i] = $p($i);
				$query ="
				INSERT INTO `gallery`.`image`(`user_id`,
				`album_id`,`date`,`path`) VALUES('".$_SESSION['id']."','$id','$dt',$p($i)')";
				$inst = mysql_query($query);
				move_uploaded_file($tmp,$p);
				$tmp="";
				$p="";
			}
		}
		
	}*/
//__________________________________________________________________________________
	function sgpc($alid,$n){
		$query = "INSERT INTO `gallery`.`image`(`user_id`,`album_id`,`path`) VALUES('".$_SESSION['id']."','$alid','$n')";
		$inst = mysql_query($query);
	}
//________________________________________________________________________-
function createthumb($file,$dest) {		
							 
							 //This will set our output to 45% of the original size 
							 $size = 0.45; 
							 
							 // This sets it to a .jpg, but you can change this to png or gif 
							 //header('Content-type: image/jpeg'); 
							 
							 // Setting the resize parameters
							 list($width, $height) = getimagesize($file); 
							 $modwidth = $width * $size; 
							 $modheight = $height * $size; 
							
							 // Creating the Canvas 
							 $tn= imagecreatetruecolor($modwidth, $modheight); 
							 $source = imagecreatefromjpeg($file); 
							 
							 // Resizing our image to fit the canvas 
							 imagecopyresized($tn, $source, 0, 0, 0, 0, $modwidth, $modheight, $width, $height); 
							 
							 // Outputs a jpg image, you could change this to gif or png if needed 
							 imagejpeg($tn,$dest,80); 
						}
//________________________________________________________________________________________
//make comment
function makc($user,$name,$al,$img,$cmt){
	$dt = getdate(time());
	$dat = $dt['mday']."/".$dt['mon'] ."/". $dt['year'];
	$query = "INSERT INTO `gallery`.`comment` VALUES(NULL,'$user','$al','$img','$name','$cmt','$dat')";
	$inst = mysql_query($query);
	if($inst){
		header("Location:view_pic.php?sd=$img&&ds=$al");
	}
	else{
		
	}
}
//_________________________________________________________________________________________
//sending freind request.....
function friendrq($from,$f_name,$to,$mg){
	$query = "INSERT INTO `friend`(`from`,`f_name`,`to`,`message`) VALUES ('$from','$f_name','$to','$mg')";
	$inst = mysql_query($query);
	if($inst){
		header("Location:mainpage.php?sd=RequestSended");
	}
}

//_________________________________________________________________________________________
function msg($from,$to,$msg){
	$dt = getdate(time());
	$dat = $dt['mday']."/".$dt['mon'] ."/". $dt['year'];
	$query = "INSERT INTO `gallery`.`msg` (
`m_id` ,
`from` ,
`c_user` ,
`to` ,`date` ,
`masg`
)
VALUES (
NULL , '$from', '$from', '$to','$dat', '$msg')";
$insert = mysql_query($query);
if($insert){
	header("Location:msg.php?sd=$to");
}
}
?>
