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

	$is_result=false;
	$result_data=array();
	$result_qr=mysqli_query($con,"select * from results where student_id='".$_REQUEST['id']."'");
	if(mysqli_num_rows($result_qr)>0){
		$is_result=true;
		$row=mysqli_fetch_assoc($result_qr);
		//fetching result
		$result_row=$row;

		$result_data_qr=mysqli_query($con,"select result_data.*,subjects.subject_name from result_data,subjects where result_data.result_id='".$result_row['id']."' and result_data.subject_id=subjects.id");
		while ($row=mysqli_fetch_assoc($result_data_qr)) {
			array_push($result_data,$row);
		}
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


        <div class="painel box">
            <div class="row">
                <?php if(isset($_REQUEST['error'])){ ?>
                <div class="col-lg-12">
                    <span class="alert alert-danger" style="display: block;"><?php echo $_REQUEST['error']; ?></span>
                </div>
                <?php } ?>
            </div>
            <div class="row">
                <?php if(isset($_REQUEST['success'])){ ?>
                <div class="col-lg-12">
                    <span class="alert alert-success" style="display: block;"><?php echo $_REQUEST['success']; ?></span>
                </div>
                <?php } ?>
            </div>
            <div class="painel-header">
                <h4 class="painel-title">Edit Results</h4>
            </div>
            <div class="painel-body">
                <form action="edit_result_post.php" method="post">
                    <input type="hidden" name="result_id" value="<?php if($is_result
                    ) echo $result_row['id']; ?>">
                    <input type="hidden" name="student_id" value="<?php echo $_REQUEST['id']; ?>">

                    <?php if($is_result){ ?>

                    <?php foreach($result_data as $result)  { ?>

                    <div class="group">

                        <label
                            style="margin:1% 0 0 20% ;width:100px; display:inline-block;"><?php echo $result['subject_name']; ?></label>

                        <input type="hidden" name="id[]" value="<?php echo $result['id']; ?>">
                        <input type="text" style="" name="marks[]" value="<?php echo $result['marks']; ?>">


                    </div>

                    <?php } ?>


                    <div class="group">
                        <button class="btn btn-blue" style="margin:3% 0 2% 25%;padding:1% ;width: 10%"
                            type="submit">Edit
                            Result</button>

                    </div>
                    <?php } else { ?>

                    <div class="col-lg-12">
                        No Result Found, <a href="add_result.php?id=<?php echo $_REQUEST['id']; ?>">Add Result</a>

                    </div>
                    <?php } ?>
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