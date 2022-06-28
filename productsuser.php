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
            <!--<li><a href='index3.php'>فيديوهات عطور المصباح</a></li>-->
            <!--<li><a href='login.php'> تسجيل دخول</a>-->
            <li><a href='productsuser.php'>منتجات اقل من 100 </a></li>
            <li><a href='userpage.php'>الصفحه الرئيسيه</a></li>
         
  
          

        </ul>


    </nav>

    
<?php

$sql= "select * from products where CID=8";
$q=$con->prepare($sql);
$q->execute();
if($q->rowcount())
{
    $rows= $q->fetchall();
    foreach($rows as $row)
    {
        $id =$row["ID"];
        $namepr =$row["NameProducts"];
        $numberpr =$row["NumberProducts"];
        $pricepr =$row["PriceProducts"];
        $imgpr =$row["ImageProducts"];


        echo "
        <section>

        </section>
        
        <section>
        <article>
        <h2>$namepr</h2>
                <img src='images/".$imgpr."'>
                <p><br>$numberpr</p>
                <p><i>$pricepr</i></p>
                <button class='btn'>اضف إلى السله </button>
        </article>
        </section>

        ";


    }
}

?>
     <div class="clr"> </div>


     <?php
        include("footer.php");
        ?>