<?php
session_start();
require("connect.php");
if(!isset($_SESSION['email']) or $_SESSION['role']!="admin")
		header("location:../login.php");
?>
<!DOCTYPE html>
<html>
<head> 
 <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
	<link href="css/custom.css" rel="stylesheet" />
</head>
<body>
<div id="wrapper" class="active">

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php">Dashboard</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>                


    <div class="navbar-default sidebar" role="navigation">                  
        <div class="sidebar-nav">
            <ul class="nav" id="side-menu">  
							<li>
                    <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> <span class="ttspan-fill">Dashboard</span></a>
                </li>
                <li>
                    <a href="categories.php"><i class="fa fa-tasks fa-fw"></i> <span class="ttspan-fill">Categories</span></a>
                </li>
				
							<li>
                    <a href="users.php"><i class="fa fa-users fa-fw"></i> <span class="ttspan-fill">Users</span></a>
                </li>
				
							<li>
                    <a href="posts.php"><i class="fa fa-newspaper-o fa-fw"></i> <span class="ttspan-fill">Posts</span></a>
                </li>
				
							<li>
                    <a href="comments.php"><i class="fa fa-comments fa-fw"></i> <span class="ttspan-fill">Comments</span></a>
                </li>
        </div>
    </div>                             
</nav>  

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-users'></i> USERS</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
   
    
	<?php
	
	//var_dump($_GET);
	if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])>0 )
	{
		if($_GET['action']=="delete")
		{
			$sql="delete from users where ID=:id";
			$q= $con->prepare($sql);
			$q->execute(array("id"=>$_GET['id']));
			if($q->rowcount())
				echo "<script>alert('One Row Deleted')</script>";
			else 
				echo "<script>alert('couldn\'t Delete Row')</script>";
			
		}
		else if($_GET['action']=="active")
		{
			$sql="update users set Active=1 where ID=:id";
			$q= $con->prepare($sql);
			$q->execute(array("id"=>$_GET['id']));
			if($q->rowcount()==1)
				echo "<h3 class='alert alert-success'>One Row Activated</h3>";
			else 
				echo "<h3 class='alert alert-danger'>Couldn't Activate Row</h3>";
				
			
		}
		
		
		else if($_GET['action']=="inactive")
		{
			$sql="update users set Active=0 where ID=:id";
			$q= $con->prepare($sql);
			$q->execute(array("id"=>$_GET['id']));
			if($q->rowcount()==1)
				echo "<h3 class='alert alert-success'>One Row InActivated</h3>";
			else 
				echo "<h3 class='alert alert-danger'>Couldn't InActivate Row</h3>";
				
			
		}
		
		
		else if($_GET['action']=="edit")
		{
			$sql="select * from users where ID=:id";
			$q= $con->prepare($sql);
			$q->execute(array("id"=>$_GET['id']));
			if($q->rowcount()==1)
			{
				$row=$q->fetch();
			}
				
			
		}
		
		
		
		
		
	}

    ?>



    <div class="row">
        <div class="col-xs-12">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-users fa-fw"></i> Users
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a>
                                </li>
                                <li><a href="#">Another action</a>
                                </li>
                                <li><a href="#">Something else here</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" >
                                    <thead >
                                        <tr >
                                            <th>#</th>
                                            <th>id</th>
                                            <th>User Name</th>
                                            <th >Email</th>
                                            <th>Password</th>
                                            <th>Gender</th>
                                            <th>Image</th>
                                            <th>BirthDay</th>
                                            <th>Active</th>
                                            <th>Role</th>
                                            <th colspan='' style='text-align:center'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										
                                        $sql="select * from users order by ID desc";
                                        $q = $con->prepare($sql);
                                        $q->execute();
                                        if($q->rowcount())
                                        {
                                            $result= $q->fetchall();
                                            $i=1;
                                            foreach($result as $row)
                                            {
                                                $id = $row["ID"];
                                                $name = $row["UserName"];
                                                $email = $row["Email"];
                                                $password = $row["Password"];
                                                $gender = $row["Gender"];
                                                $immg = $row["Image"];
                                                $birthday = $row["BirthDay"];
                                                $active = $row["Active"];
                                                $role = $row["Role"];

                                                echo "<tr>";
                                                    echo "<td>$i</td>";
                                                    echo "<td>$id</td>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$email</td>";
                                                    echo "<td>$password</td>";
                                                    echo "<td>$gender</td>";
                                                    echo "<td>$immg</td>";
                                                    echo "<td>$birthday</td>";
                                                    echo "<td>$active</td>";
                                                    echo "<td>$role</td>";
                                                    echo "<td>";
                                                        echo "<a href='?action=edit&id=$id' class='btn btn-success'> Edit</a> "; 
                                                        echo "<a href='?action=delete&id=$id' class='btn btn-danger' onclick=\" return confirm('Are You Sure?')\">Delete</a> "; 
                                                        if($row["Active"]==1)
                                                        echo "<a href='?action=inactive&id=$id' class='btn btn-warning'>InActive</a>"; 
                                                        else
                                                        echo "<a href='?action=active&id=$id' class='btn btn-primary'>Active</a> "; 
                                                        
                                                        
                                                    
                                                    echo"</td>";
                                                echo "</tr>";
                                                $i++;
                                                
                                            }
                                            
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
          
        </div>
        <!-- /.col-lg-8 -->
       
    </div>
    <!-- /.row -->
</div>         
</div>

<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<script>
$(function () {
    'use strict';
$('#deletej').click(function(){
    return confirm('Are You Sure!!!');
});
});
</script>
</body>
</html>