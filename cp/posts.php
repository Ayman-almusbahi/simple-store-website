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
            </ul>
        </div>
    </div>                             
</nav> 





<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-tasks'></i> Posts</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
	
<?php	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
			$name = $_FILES["imageproducts"]["name"];
			$type = $_FILES["imageproducts"]["type"];
			
			$tmp = $_FILES["imageproducts"]["tmp_name"];

			

		if(empty($_POST["nameproducts"])){
		
			$errors["nameproducts"]="<span style='color:red;'>Enter Name OF Products</span>";
		}
		else if(empty($_POST["numberproducts"])){

			$errors["numberproducts"]="<span style='color:red;'>Enter Number OF Products</span>";
		}	
		else if(empty($_POST["priceproducts"])){

			$errors["priceproducts"]="<span style='color:red;'>Enter Price OF Products</span>";
		}
		else if(!empty($name)){

			$errors["imageproducts"]="<span style='color:red;'>Enter Image OF Products</span>";

			//checking type of file
				
				//1- declaring my types
				$mytypes = array("jpg","png","jpeg","gif");
					
				//2- taking extension from name of file.
				
						$extarray = explode(".",$name);
						
						//var_dump($extarray);
						$ext = strtolower(end($extarray));

			
						
					 if(move_uploaded_file($tmp,"../images/$name"))
						{
						   
							echo "file uploaded successfullay";
							$sql = "insert into Products(NameProducts,NumberProducts,PriceProducts,ImageProducts,CID)
							values(:name,:number,:price,:img,:id)";
							$q = $con ->prepare($sql);
							$q->execute(array("name"=>$_POST["nameproducts"],"number"=>$_POST["numberproducts"],
							  "price"=>$_POST["priceproducts"],"img"=>$name,"id"=>$_POST["cid"]));

							if($q->rowCount()>0)
							echo "<h3> done add </h3>";
							else{
							echo "<h3> dont done </h3>";}
						}
						else {
							echo "there is an error while uploading file";
						}
						
				}	


		else if(empty($_POST["cid"])){
			$sql= "insert into products(NameProducts,NumberProducts,PriceProducts,ImageProducts,CID)
			 values(:name,:number,:price,:img,:ccid)";
			$q=$con->prepare($sql);
			$q->execute(array("name"=>$_POST["nameproducts"],"number"=>$_POST["numberproducts"],
							  "price"=>$_POST["priceproducts"],"img"=>$name,"ccid"=>$_POST["cid"]));
				if($q->rowcount())
				echo "<h3 class='alert alert-success'>One Row Inserted</h3>";
			else
				echo "<h3 class='alert alert-danger'>couldn't Insert Row</h3>";
			}

		
		else if(!empty($_POST["id"])){
			$sql= "update products set NameProducts=:name,NumberProducts=:number
			,PriceProducts=:price where ID=:id";
			$q=$con->prepare($sql);
			$q->execute(array("name"=>$_POST["nameproducts"],"number"=>$_POST["numberproducts"]
			,"price"=>$_POST["priceproducts"],"id"=>$_POST["id"] ));
			if($q->rowcount())
				echo "<h3 class='alert alert-success'>One Row Updated</h3>";
			else
				echo "<h3 class='alert alert-danger'>couldn't Update Row</h3>";
			
			
			
		}
	}
	
			


?>

<?php


if(isset($_GET['action'],$_GET['id']) and intval($_GET['id'])>0 )
	{
		if($_GET['action']=="delete")
		{
			$sql="delete from products where ID=:id";
			$q= $con->prepare($sql);
			$q->execute(array("id"=>$_GET['id']));
			if($q->rowcount())
				echo "<script>alert('One Row Deleted')</script>";
			else 
				echo "<script>alert('couldn\'t Delete Row')</script>";
			
		}
		else if($_GET['action']=="active")
		{
			$sql="update products set Active=1 where ID=:id";
			$q= $con->prepare($sql);
			$q->execute(array("id"=>$_GET['id']));
			if($q->rowcount()==1)
				echo "<h3 class='alert alert-success'>One Row Activated</h3>";
			else 
				echo "<h3 class='alert alert-danger'>Couldn't Activate Row</h3>";
				
			
		}
		
		
		else if($_GET['action']=="inactive")
		{
			$sql="update products set Active=0 where ID=:id";
			$q= $con->prepare($sql);
			$q->execute(array("id"=>$_GET['id']));
			if($q->rowcount()==1)
				echo "<h3 class='alert alert-success'>One Row InActivated</h3>";
			else 
				echo "<h3 class='alert alert-danger'>Couldn't InActivate Row</h3>";
				
			
		}
		
		
		else if($_GET['action']=="edit")
		{
			$sql="select * from products where ID=:id";
			$q= $con->prepare($sql);
			$q->execute(array("id"=>$_GET['id']));
			if($q->rowcount()==1)
			{
				$row=$q->fetch();
			}
			
		}
				
	}
	?>
	
 <div id="fullscreen_bg" class="fullscreen_bg"/>
 <form class="form-signin" method="post" enctype="multipart/form-data">
	<div class="container" style='width:970px'>
    <div class="row">
        <div class="col-12-sx">
        <div class="panel panel-default">
        <div class="panel panel-primary">
        
				<h3 class="text-center"><i class='fa fa-plus-circle'></i> Add New Posts</h3>
       
        <div class="panel-body">   
        
		<div class="form-group">
			<div class="input-group">
			<input type="hidden" name="id"  value="<?php if(isset($row)) echo $row["ID"];  ?>" />
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				<input type="text" class="form-control" name="nameproducts" placeholder="NameProducts" 
				value="<?php if(isset($row)) echo $row["NameProducts"];  ?>" />					
			</div>
		<?php	if(isset($errors["nameproducts"]))  echo $errors["nameproducts"]; ?>
		</div>



		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				<input type="text" class="form-control" name="numberproducts" placeholder="NumberProducts" 
				value="<?php if(isset($row)) echo $row["NumberProducts"];  ?>" />				
			</div>
			<?php	if(isset($errors["numberproducts"]))  echo $errors["numberproducts"]; ?>
		</div>

		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				<input type="text" class="form-control" name="priceproducts" placeholder="PriceProducts" 
				value="<?php if(isset($row)) echo $row["PriceProducts"];  ?>"  />				
			</div>
			<?php	if(isset($errors["priceproducts"]))  echo $errors["priceproducts"]; ?>
		</div>

		
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				<input type="file" class="form-control" name="imageproducts" placeholder="ImageProducts" 
				 />				
			</div>
			<?php	if(isset($errors["imageproducts"]))  echo $errors["imageproducts"]; ?>
		</div>

		
		
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				<select name='cid'>
				
				<?php
				
					$sql="select * from categories ";
					$q = $con->prepare($sql);
					$q->execute();
					$rows= $q->fetchall();
					foreach($rows as $row)
					{
						$id = $row["ID"];
						$name = $row["Name"];
						echo "<option value='$id'>$name</option>";
						
					}
				?>
				
				</select>
				
			</div>
		</div>
		
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-edit"></span></span>
				<textarea name="details"class="form-control" ></textarea>
			</div>
		</div>
		
			<input class="btn btn-lg btn-primary btn-block" type="submit" value='Save' name='save'>
      </div>
       </div>
        </div>
    </div>
</div>
</form>
</div> 
   
    <div class="row">
        <div class="col-xs-12">           
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-tasks fa-fw"></i> Posts
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
											<th>NameProducts</th>
										    <th >NumberProducts</th>
										    <th >PriceProducts</th>
											<th >ImageProducts</th>
										    <th colspan='' style='text-align:center'>Actions</th>
                                     </tr>
                                    </thead>
                                    <tbody> 
										<?php
										
											$sql="select * from products order by ID desc";
											$q = $con->prepare($sql);
											$q->execute();
											if($q->rowcount())
											{
												$result= $q->fetchall();
												$i=1;
												foreach($result as $row)
												{
													$id = $row["ID"];
													$nameproducts = $row["NameProducts"];
													$numberproducts = $row["NumberProducts"];
													$priceproducts = $row["PriceProducts"];
													$imageproducts = $row["ImageProducts"];
													
													echo "<tr>";
													
														echo "<td>$id</td>";
														echo "<td>$nameproducts</td>";
														echo "<td>$numberproducts</td>";
														echo "<td>$priceproducts </td>";
														echo "<td>$imageproducts</td>";
														
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