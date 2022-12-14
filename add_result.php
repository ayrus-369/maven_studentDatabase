<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']!=1){
		header("Location:student_home.php");
	}
	if(!isset($_REQUEST['id'])){
		header("Location:teacher_home.php?error=Please Enter ID");
	} 
	$qr=mysqli_query($con,"select * from users where id='".$_REQUEST['id']."'");
	if(mysqli_num_rows($qr)==0){
		header("Location:teacher_home.php?error=Student ID Not Found");	
	}
	$result_qr=mysqli_query($con,"select * from results where student_id='".$_REQUEST['id']."'");
	if(mysqli_num_rows($result_qr)>0){
		header("Location:teacher_home.php?error=Student Result Already Exist");	
	}
	$subjects=array();
	$subject_qr=mysqli_query($con,"select * from subjects");
	while($row=mysqli_fetch_assoc($subject_qr)){
		array_push($subjects,$row);
	}

?>
<!DOCTYPE html>
<html>

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
    <title>Edit Result</title>

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
            <a href="teacher_home.php"><i class="fa fa-home"></i> Home</a>
            <a href="update.php"><i class="fa fa-users"></i>Update Students</a>

            <script>
            const currentLocation = location.href;
            const menuItem = document.querySelectorAll('a');
            const menuLength = menuItem.length;
            for (let i = 0; i < menuLength; i++) {
                if (menuItem[i].href === currentLocation) {
                    menuItem[i].className = "active";
                }
            }
            </script>

        </div>
    </aside>

    <main class="content">

        <div class="painel-body">
            <form action="add_result_post.php" class="form" method="post">
                <div class="painel-header">
                    <h4 class="painel-title">Add Results</h4>
                </div>





                <div class="group">
                    <input type="hidden" name="student_id" value="<?php echo $_REQUEST['id']; ?>">
                    <?php foreach($subjects as $subject)  { ?>
                    <div class="col-lg-12 form-group">
                        <label><?php echo $subject['subject_name']; ?></label>
                        <input type="hidden" name="id[]" value="<?php echo $subject['id']; ?>">
                        <input type="text" name="marks[]" class="form-control" placeholder="Marks">

                    </div>
                    <?php } ?>
                </div>
                <div class="group">

                    <input type="submit" class="btn btn-blue" style="width: 40%" value="Add Results" />
                </div>

            </form>
        </div>
    </main>
</body>

</html>
<?php
}
else{
	header("Location:index.php?error=UnAuthorized Access");
}