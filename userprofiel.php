<?php
session_start();

require("cp/connect.php");

if(!isset($_SESSION['email']) or $_SESSION['role']!="user")
		header("location:login.php");

        
?>
    
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Almusbah company</title>
   <link rel='stylesheet' href='css/style.css'>
   </head>
</head>

<body>
    <div class="a">
        <img src="images/ambp-logo_1_1.png">
        <a href="https://www.facebook.com/profile.php?id=100005686593011"><img src="images/face.png" width="50" height="right%" > </a>
        <a href="https://wa.me/967775817817"><img src="images/whats.png" width="50" height="right%"></a>

    </div>
    <div class="clr"> </div>


    <nav>

        <ul>

            <!--<li><a href='index5.php'>خدمات التوصيل</a></li>-->
            <li><a href='logout.php'> تسجيل الخروج</a></li>
<li> <a href="userprofiel.php"> <?php  echo '<img src="uploads/'.$_SESSION["Image"].'"  width="70px"  align="center" style="
   
   height: 20%;
   border-radius: 50%;
   display: inline-block;
"; >';?> <?php echo $_SESSION['email'];  ?> </a> </li>

            <!-- <li><a> <img src="images/almusbahperfumes_٢٠٢١٠٥١٦_١٨٣٨٢٩_0.jpg" width="50" align="center"> </a></li> -->
           <!-- <li><a href='index3.php'>فيديوهات عطور المصباح</a></li> -->
            <!--<li><a href='login.php'> تسجيل دخول</a>-->
            <li><a href='productsuser.php'>منتجات اقل من 100 </a></li>
            <li><a href='userpage.php'>الصفحه الرئيسيه</a></li>
         
  
          

        </ul>


    </nav>
     <div class="clr"> </div>

     <?php


$sql = "select * from users where Email";
$q = $con->prepare($sql);
$q->execute();
if($q->rowcount())
{
    $rows = $q->fetchall() ;
    foreach($rows as $row){
        $imgg = $row['Image'];
       // echo '<img src="uploads/'.$_SESSION["Image"].'"  width="100px"; >';

    }
}


     ?>
     
     


<?php

 if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			$name = $_FILES["img"]["name"];
			$type = $_FILES["img"]["type"];
			$size = $_FILES["img"]["size"];
			$tmp = $_FILES["img"]["tmp_name"];
			
			if(empty($name))
			{
				echo "choose the file";
			}
			else
			{
				//checking type of file
				
				//1- declaring my types
						$mytypes = array("jpg","png","jpeg","gif");
					
				//2- taking extension from name of file.
				
						$extarray = explode(".",$name);
						
						//var_dump($extarray);
						$ext = strtolower(end($extarray));
						
				//3- comparing $ext in my arrayTypes.
						if(in_array($ext,$mytypes))
						{
							//size
							
							if($size>2000000)
								
								{
									echo "maximum file size is 1M";
                                    
								}
								else{
											//move file to destination
											
											if(move_uploaded_file($tmp,"uploads/$name"))
											{
                                               
												echo "file uploaded successfullay";
												$sql = "UPDATE users SET Image =:img WHERE Email =:email";
                                                $q = $con ->prepare($sql);
                                                $q->execute(array("img"=>$name,"email"=>$_SESSION['email']));
                                                if($q->rowCount()>0)
                                                echo "<h3> done add </h3>";
                                                else{
                                                echo "<h3> dont done </h3>";}
											}
											else {
												echo "there is an error while uploading file";
											}
											
								}
							
							
						}
						else
						{
							echo "invalid type";
						}	
			}						
		}		
		else {echo "invlaid request";}
		
        

?>
     
     
     <div class="profiel">
     <?php  echo '<img src="uploads/'.$_SESSION["Image"].'"  width="200px"  align="center" style="
    /*width: 20%;*/
   height: 20%;
   border-radius: 50%;
   display: inline-block;
"; >';?>

    <!-- <img src="images/almusbahperfumes_٢٠٢١٠٥١٦_١٨٣٨٢٩_0.jpg" width="200" align="center" style="
    /*width: 20%;*/
    height: 100%;
    border-radius: 50%;
    display: inline-block;
    text-align: center;
    ">-->
    <br>

   <?php

if($_SERVER["REQUEST_METHOD"]=="POST")
{
        $name = $_FILES["img"]["name"];

$sql = "select * from users where  Image =:img and Email =:email";

        $q = $con->prepare($sql);
        $q->execute(array("img"=>$name,"email"=>$_SESSION['email']));
        
        if($q->rowcount())

        {
        $row = $q->fetch();
        if($row["Image"]!="NULL")
        {
            $_SESSION['Image']=$row["Image"];
          //  echo '<img src="uploads/'.$_SESSION["Image"].'"  width="100px"; >';
        }
       // echo '<img src="uploads/'.$_SESSION["Image"].'"  width="100px"; >';
        }}

    
       // echo '<img src="uploads/'.$name.'"  width="100px"; >';
        //echo $_SESSION['Image'];

        /*{
            $result= $q->fetchall();
            
            foreach($result as $row)
            {
                
               
                $id = $row["ID"];
                $name = $row["UserName"];
                $email = $row["Email"];
                $password = $row["Password"];
                $gender = $row["Gender"];
                $imag = $row["Image"];
                $birthday = $row["BirthDay"];
                $active = $row["Active"];
                $role = $row["Role"];
                echo $email;
                echo "<br>";
                echo '<img src="uploads/'.$imag.'"  width="100px"; align="center"  >';
            }
        }*/
    ?>
    
    <form action="" method="POST" enctype="multipart/form-data" >
		
			<!--<div>
				<label for='name'>Name:</label>
				<input id="name" name='username' value=""   type='text'   >
				
				
			</div>-->
	
			<div>
				<label for='img'><h2>اختر صوره</h2></label>
				<input  id="img" name='img' type='file'  accept=".jpg,.png"
                 style="
      margin-top: 1px;
      display: inline-block;
      padding: 10px 4px;
      font-size: 25px;
      border-radius: 15px;
      border: 5px solid black;
      color: white;
      cursor: pointer;
      background: rgb(89 110 90);
      width: 40%;
      height: 40px;
      margin: 10px auto;
      outline: none;
	  text-align: center;
	
	  transition: .2s ease-in;
      cursor: pointer;
                ">
				
			</div>
						
			
 			<!--	<button   type='submit' name="send" value="'.$_SESSION['email']->Email.'">update</button> -->

             <button   type='submit' name="send"
             style="
      margin-top: 1px;
      display: inline-block;
     
      font-size: 25px;
      border-radius: 15px;
      border: 5px solid black;
      color: white;
      cursor: pointer;
      background: rgb(89 110 90);
      width: 40%;
      height: 40px;
      margin: 10px auto;
      outline: none;
	  text-align: center;
	
	  transition: .2s ease-in;
      cursor: pointer;
                "
             
             >حفظ</button>
		</form>
     </div>

     <?php
        include("footer.php");
        ?>