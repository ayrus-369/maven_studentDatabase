<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']!=1){
		header("Location:student_home.php");
	}

    if(isset($_POST['des']))
{
$qr=mysqli_query($con,"select * from users where usertype='2' order by name desc");}
else{
$qr=mysqli_query($con,"select * from users where usertype='2'");}

if(isset($_POST['asc'])){

$qr=mysqli_query($con,"select * from users where usertype='2' order by name asc");}
else{
$qr=mysqli_query($con,"select * from users where usertype='2'");}
	$data=array();
	
	while($row=mysqli_fetch_assoc($qr)){
		array_push($data,$row);
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
    <link rel="stylesheet" href="public/css/main.css" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet">
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Adding Custom Css -->

    <style>
    .text-right {
        margin-left: 85%;
    }

    .btn-pad {
        padding: 20%;
        display: inline;
        float: right;
    }

    .text-font {
        font-size: 15px;
        font-weight: bold;
    }

    h1,
    a {
        font-family: 'Roboto', sans-serif;
        color: black;
    }

    .box {
        border-radius: 20px;
        box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.5);
    }
    </style>
</head>

<body>

    <nav class="topnav">
        <div class="logo">
            <a href="#" class="display-sm display-md" id="menu"><i class="fa fa-list-ul"></i></a>
            <a href="#" class="hidden-sm">
                <h1>Dashboard</h1>
            </a>
        </div>
        <div class="user-menu">

            <div class="text-right">
                <a href="#"><i class="fa fa-user"></i> <?php
                     $qr=mysqli_query($con,"select * from users where email='".$_SESSION['email']."' and password='".$_SESSION['password']."'");
                     if(mysqli_num_rows($qr)>0)
                         $val=mysqli_fetch_assoc($qr);
                        
                    echo $val['name']  

                ?>
                </a>
                <a href="logout.php"><i class="fa fa-power-off"></i></a>
            </div>
        </div>
    </nav>

    <aside class="sidenav hidden-sm hidden-md" id="nav">
        <div class="list">
            <a href="teacher_home.php" class="active"><i class="fa fa-home"></i> Home</a>
            <a href="update.php"><i class="fa fa-users"></i>Update Students</a>



        </div>
    </aside>

    <main class="content">
        <div class="grid">
            <div class="mini-reports text-white box bg-primary">
                <div class="l">
                    <?php
                    $qry=mysqli_query($con,"select * from users where usertype=2");
                    if($q=mysqli_num_rows($qry)){
                        echo" <span>".$q."</span>";
                    }
                    else
                    echo" <span>"."No Students"."</span>";
                    ?>

                    <span>Students</span>
                </div>
                <div class="r">
                    <i class="fa fa-user-graduate text-font  c-blue"></i>
                </div>
            </div>
            <div class="mini-reports text-white box bg-primary">
                <div class="l">
                    <?php
                    $qry=mysqli_query($con,"select * from users where usertype=1");
                    if($q=mysqli_num_rows($qry)){
                        echo" <span>".$q."</span>";
                    }
                    else
                    echo" <span>"."No Admins"."</span>";
                    ?>
                    <span>Teachers</span>
                </div>
                <div class="r">
                    <i class="fa fa-user text-font  c-blue"></i>
                </div>
            </div>


        </div>

        <div class="grid">
            <div class="painel box">
                <div class="painel-header">
                    <h4 class="painel-title">Table</h4>
                    <form action="teacher_home.php" method="post">

                        <button type="submit" name="asc" class="btn text-font   btn-green"> asc</button>

                        <button type="submit" name="des" class="btn text-font  btn-green">desc </button>

                    </form>

                </div>
                <div class="painel-body">
                    <div class="row">

                        <?php if(isset($_REQUEST['up-error'] )){ ?>
                        <div class="col-lg-12">
                            <span class="alert alert-danger"
                                style="display: block;"><?php echo $_REQUEST['up-error']; ?></span>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if(isset($_REQUEST['up-success'])){ ?>
                        <div class="col-lg-12">
                            <span class="alert alert-success"
                                style="display: block;"><?php echo $_REQUEST['up-success']; ?></span>
                        </div>
                        <?php } ?>
                        <?php if(isset($_REQUEST['del-error'] )){ ?>
                        <div class="col-lg-12">
                            <span class="alert alert-danger"
                                style="display: block;"><?php echo $_REQUEST['del-error']; ?></span>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if(isset($_REQUEST['del-success'])){ ?>
                        <div class="col-lg-12">
                            <span class="alert alert-success"
                                style="display: block;"><?php echo $_REQUEST['del-success']; ?></span>
                        </div>
                        <?php } ?>
                    </div>
                    <table class="zebra">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Join</th>
                            <th>Edit Results</th>
                            <th>Delete </th>


                        </tr>
                        <?php
				  foreach($data as $d) {
				 ?>
                        <tr>
                            <td><?php echo $d['id']; ?></td>
                            <td><?php echo $d['name']; ?></td>
                            <td><?php echo $d['email']; ?></td>
                            <td><?php echo $d['created_at']; ?></td>
                            <td><a class="btn btn-blue" href="edit_result.php?id=<?php echo $d['id']; ?>"><i
                                        class="fa  text-font  fa-edit"></a></td>
                            <td><a class="btn btn-blue " href="delete_student.php?id=<?php echo $d['id']; ?>"><i
                                        class="fa  text-font  fa-trash"></a></td>

                        </tr>
                        <?php
				  } 
				?>
                    </table>
                </div>
            </div>

            <div class="painel box">
                <div class="row">
                    <?php if(isset($_REQUEST['error'])){ ?>
                    <div class="col-lg-12">
                        <span class="alert alert-danger"
                            style="display: block;"><?php echo $_REQUEST['error']; ?></span>
                    </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <?php if(isset($_REQUEST['success'])){ ?>
                    <div class="col-lg-12">
                        <span class="alert alert-success"
                            style="display: block;"><?php echo $_REQUEST['success']; ?></span>
                    </div>
                    <?php } ?>
                </div>
                <div class="painel-header">
                    <h4 class="painel-title">Add Login</h4>
                </div>
                <div class="painel-body">
                    <form action="add_student_post.php" class="form" method="post">
                        <div class="group">
                            <label for="#">Name</label>
                            <input type="text" name="name" id="" placeholder="Name" required />
                        </div>
                        <div class="group">
                            <label for="#">Email</label>
                            <input type="email" name="email" id="" placeholder="email" required />
                        </div>
                        <div class="group">
                            <label for="#">Password</label>
                            <input type="password" name="password" id="" placeholder="password" required />
                        </div>
                        <div class="group">
                            <label for="#">User Type</label>
                            <input type="text" name="usertype" id="" placeholder="usertype" required />
                        </div>

                        <div class="group">
                            <input type="submit" class="btn btn-blue" style="width: 40%" value="Add Users" />
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main>
    <script src="public/js/main.js"></script>
</body>

</html>
<?php
}
else{
	header("Location:index.php?error=UnAuthorized Access");
}