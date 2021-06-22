<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Change Password</title>
</head>
<body>
<?php 
$currPass = "abc@1234";
$newPass = "";
$newPassErr = $retPassErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if($_POST['currPass']==$currPass)
  {
  	if($_POST['newPass']==$currPass)
  	{
  		$newPassErr = "New Password can not be same as current password.";
  		$newPass = "";
  	} else {
  	$newPass = $_POST["newPass"];
  	if(strlen($newPass)<8){
  		$newPassErr = "Password must not be less than eight (8) characters";
  		$newPass = "";
  	}
  	if (!preg_match("/\W/", $newPass)) {
    $newPassErr = "Password should contain at least one special character";
    $newPass = "";
 	}
 	if($_POST["retPass"]!==$newPass)
 	{
 	$retPassErr="Retyped Password does not match with current Password";
 	$newPass="";
 	}
  }
  }
}

 ?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<fieldset>
<legend>Change Password: </legend>
<td>	
<p><?php echo $newPassErr; ?></p>
<p><?php echo $retPassErr; ?></p>
<tr>Current Password: <input type="text" name="currPass"><br></tr>
<tr>New Password :<input type="text" name="newPass"><br></tr>
<tr>Retype New Passeord: <input type="text" name="retPass"><hr></tr>
</td>
<input type="submit" name="Submit">
</fieldset>
</form>
<?php 
echo $newPass;
 ?>
</body>
</html>