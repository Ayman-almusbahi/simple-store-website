<?php
session_start();
include("header.php");
require("cp/connect.php");
?>
  <link rel='stylesheet' href='css/login.css'>
    <div class="clr"> </div>

    <br>


    <?php


if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $sql ="select * from users where Email=:email and Password=:pass and Active=1";
    $q= $con-> prepare($sql);
    $q->execute(array("email"=>$_POST['useremail'],"pass"=>md5($_POST['password'])));
    
    if($q->rowcount())
    {
        
        $row = $q->fetch();
        
        if($row["Role"]=="admin")
        {
            setcookie("email",$_POST['useremail'],time()+60*60*24*30);
            
            $_SESSION['email']=$_POST['useremail'];
            $_SESSION['role']="admin";
            $_SESSION['Image']=$row["Image"];
            
            header("location:cp/dashboard.php");
            
            
            
        }
        else{
            
            setcookie("email",$_POST['useremail'],time()+60*60*24*30);
            
            $_SESSION['email']=$_POST['useremail'];
            $_SESSION['role']="user";
            $_SESSION['Image']=$row["Image"];
            
            header("location:userpage.php");
            
        }
        
        
    }
    else
        echo "<script>alert('Wrong Username Or Password')</script>";
    
}







    ?>

    <div class="wrapper">
        <div class="title">تسجيل الدخول</div>
        <form  method="post">
            <div class="field">
                <input type="email" name="useremail" required>
                <label>بريدك الإلكتروني</label>
            </div>
            <div class="field">
                <input type="password" name="password" required>
                <label>كلمة السر </label>
            </div>
            <div class="content">
                <div class="checkbox">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">تذكرني </label>
                
                </div>
                <div class="pass-link"><a href="#">هل نسيت كلمة السر ?</a></div>
            </div>
            <div class="field">
                <input type="submit" value="Login">
            </div>
            <div class="signup-link">ليس لديك حساب ? <a href="signup.php">انشأ حسابك الآن </a></div>
        </form>
    </div>
    <br>
    <div class="clr"></div>
    
     <?php
        include("footer.php");
        ?>