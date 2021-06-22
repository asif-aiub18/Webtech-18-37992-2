<?php  
 $message = '';  
 $error = '';  
 
 if(isset($_POST["submit"]))  
 {  
      if(empty($_POST["name"]))  
      {  
           $error = "<label class='text-danger'>Enter Name</label>";  
      }
      else if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) {
          $error = " <label class='text-danger'>Only letters and white space allowed</label>";
      }
      else if(str_word_count($_POST["name"])<2){
          $error = "<label class='text-danger'>Name should contain at least two word</label>";
      }
	  
	  
      else if(empty($_POST["email"]))  
      {  
           $error = "<label class='text-danger'>Enter an e-mail</label>";  
      }
      else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
          $error = "<label class='text-danger'>Invalid email format</label>";
      }

	  
      else if(empty($_POST["username"]))  
      {  
           $error = "<label class='text-danger'>Enter a username</label>";  
      } 
      else if (!preg_match("/^[a-zA-Z0-9._-]*$/",$_POST["username"])) {
          $error = "<label class='text-danger'>Only alpha numeric characters, period, dash or underscore are allowed</label>";
      }
      else if(strlen($_POST["username"]<2))
      {
          $error = "<label class='text-danger'>User Name should contain at least two word</label>";
      }
	  
	  
      else if(empty($_POST["pass"]))  
      {  
           $error = "<label class='text-danger'>Enter a password</label>";  
      }
      else if (strlen($_POST["pass"])<8)
      {
          $error = "<label class='text-danger'>Password must not be less than eight (8) characters</label>";
      }
      else if (!preg_match("/\W/", $_POST["pass"])) 
      {
      $error = "<label class='text-danger'>Password should contain at least one special character</label>";
      }
	  
	  
      else if(empty($_POST["repass"]))  
      {  
           $error = "<label class='text-danger'>Confirm password field cannot be empty</label>";  
      } 
      else if($_POST["repass"]!==$_POST["pass"])
      {
      $error="<label class='text-danger'>Confirm Password does not matched.</label>";
      }
	  
	  
      else if(empty($_POST["gender"]))  
      {  
           $error = "<label class='text-danger'>Gender cannot be empty</label>";  
      }
       
      else  
      {  
           if(file_exists('data.json'))  
           {  
                $current_data = file_get_contents('data.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'name'               =>     $_POST['name'],  
                     'e-mail'           =>     $_POST["email"],  
                     'username'       =>     $_POST["username"],
                     'password'     =>     $_POST["pass"],
                     'gender'     =>     $_POST["gender"],  
                     'dob'      =>     $_POST["dob"]  
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents('data.json', $final_data))  
                {  
                     $message = "<label class='text-success'>File Appended Successfully</p>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title></title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <h3 align="">Registration</h3><br />                 
                <form method="post">  
                     <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>  
                     <br />  
                     <label>Name: </label>  
                     <input type="text" name="name" class="form-control" /><br />  
                     <label>Email: </label>
                     <input type="text" name = "email" class="form-control" /><br />
                     <label>User Name: </label>
                     <input type="text" name = "username" class="form-control" /><br />
                     <label>Password: </label>
                     <input type="password" name = "pass" class="form-control" /><br />
                     <label>Confirm Password: </label>
                     <input type="password" name = "repass" class="form-control" /><br />

                    <fieldset>
                    <legend>Gender</legend>
                    <input type="radio" id="male" name="gender" value="male">
                     <label for="male">Male</label>                     
                     <input type="radio" id="female" name="gender" value="female">
                     <label for="female">Female</label>
                     <input type="radio" id="other" name="gender" value="other">
                     <label for="other">Other</label><br>

                     <legend>Date of Birth: </legend>
                     <input type="date" name="dob"> <br><br>
                    </fieldset> 
                     
                     <input type="submit" name="submit" value="Submit" class="btn btn-info" /><br />                      
                     <?php  
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                     ?>  
                </form>  
           </div>  
           <br />  
      </body>  
 </html>  