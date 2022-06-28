

<?php
include("header.php");
require("cp/connect.php");

?>

	  <link rel='stylesheet' href='css/signup.css'>
		<div class="clr"> </div>

		<br>
    	<?php 

	
		if($_SERVER["REQUEST_METHOD"]=="POST")
			{

				$userName = $_POST["username"];
				$userEmail = $_POST["useremail"];
				$birthDate = $_POST["birthdate"];
				$gender = $_POST["gender"];
				//$passwordmd5 = md5($password);
				$password = md5($_POST["password"]);
				
			
		
		 if(empty($_POST["username"])){
			$errors["username"] ="<span style='color:red;'>Enter username</span>";
		}
		else if(empty($_POST["useremail"])){
			$errors["useremail"] ="<span style='color:red;'>Enter useremail</span>";
		}
		else if(empty($_POST["birthdate"])){
			$errors["birthdate"] ="<span style='color:red;'>Enter birthdate</span>";
		}
		else if(empty($_POST["gender"])){
			$errors["gender"] ="<span style='color:red;'>Enter gender</span>";
		}
		else if(empty(md5($_POST["password"]))){
			$errors["pswd"] ="<span style='color:red;'>Enter Name of Category</span>";
		}
		else if(empty($_POST["cid"]))
		   {
			$insertUser ="insert into users(UserName,Email,Password,Gender,BirthDay) 
			values(:usernm,:ema,:psw,:gen,:bith)";
			$send = $con->prepare($insertUser);
			$send->execute(array("usernm"=>$_POST["username"],"ema"=>$_POST["useremail"],"psw"=>md5($_POST["password"]),"gen"=>$_POST["gender"],"bith"=>$_POST["birthdate"]));
			if($send->rowcount()>0)
				echo "<h3 class='alert alert-success'>One Row Inserted</h3>";
			else
				echo "<h3 class='alert alert-danger'>couldn't Insert Row</h3>";
			}
		
			else{
			$insertUser= "update users set UserName=:usernm,Email=:ema,BirthDay=:bith,Gender=:gen,Password=:psw where ID=:id";
			$send=$con->prepare($insertUser);
			($insertUser);
			//$send->execute(array("usernm"=>$_POST["username"],"ema"=>$_POST["useremail"],"bith"=>$_POST["birthdate"],"gen"=>$_POST["gender"],"psw"=>$_POST["pswd"],"id"=>$_POST["cid"]));
			$send->execute(array("usernm"=>$_POST["username"],"ema"=>$_POST["useremail"],"psw"=>md5($_POST["password"]),"gen"=>$_POST["gender"],"bith"=>$_POST["birthdate"]));
			if($send->rowcount())
				echo "<h3 class='alert alert-success'>One Row Updated</h3>";
			else
				echo "<h3 class='alert alert-danger'>couldn't Update Row</h3>";
			

			}
		
		}
			?>
    
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action=""  method="POST" enctype="multipart/from-data">
					<label for="chk" aria-hidden="true">إنشأ حسابك الآن </label>
					<input type="text" name="username" placeholder="User name" required="" value="<?php if(isset($row)) echo $row["Name"];  ?>" >

					<input type="hidden" name="cid"  value="<?php if(isset($row)) echo $row["ID"];  ?>" />
					<?php   if(isset($errors["cname"])) echo $errors["cname"]; ?>
					<input type="email" name="useremail" placeholder="Email" required="">
					<input type="date" name="birthdate" required="">
					<input type="radio" name="gender" value="male"> ذكر
                    <input type="radio" name="gender" value="fmale"> انثى
					<input type="password" name="password" placeholder="Password" required=""> 
					<!--<input type="submit" name="save">-->
					<button type="submit" name="save" value="Save">إنشأ حسابك </button>
					<?php   if(isset($errors["username"])) echo $errors["username"]; ?>
				</form>
				
			</div>
			
		
		<!--	<div class="login">
				<form>
					<label for="chk" aria-hidden="true">تسجيل الدخول</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>دخول</button>
				</form>
			</div>
-->
	</div>   
	<br>
    <div class="clr"></div>
    <?php
        include("footer.php");
        ?>