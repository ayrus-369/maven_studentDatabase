<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']!=2){
		header("Location:teacher_home.php");
	}

	$result_data=array();
	$is_result=false;
	$result=mysqli_query($con,"select * from results where student_id='".$_SESSION['user_data']['id']."'");
	if(mysqli_num_rows($result)>0){
		$is_result=true;
		$result_row=mysqli_fetch_assoc($result);

		$data_qr=mysqli_query($con,"select result_data.*,subjects.subject_name from result_data,subjects where subjects.id=result_data.subject_id and result_data.result_id='".$result_row['id']."'");


		while($row=mysqli_fetch_assoc($data_qr)){
			array_push($result_data,$row);
		}
		echo mysqli_error($con);
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
            <div style="margin:0 0 0 0">
                <a href="#" class="hidden-sm">
                    <h1>Results</h1>
                </a>
            </div>
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



    <main class="content">


        <div class="grid">
            <div class="painel box">
                <div class="painel-header">
                    <h4 class="painel-title">Table</h4>


                </div>
                <div class="painel-body">


                    <?php if($is_result) { ?>

                    <table class="zebra">

                        <tr>
                            <th>Subject</th>
                            <th>Marks</th>
                            <th>Marks Obtained</th>
                            <th>Grade</th>
                        </tr>
                        <?php foreach($result_data as $result){ ?>
                        <tr>
                            <td>
                                <?php echo $result['subject_name']; ?>
                            </td>
                            <td>
                                100
                            </td>
                            <td>
                                <?php echo $result['marks']; ?>
                            </td>
                            <td>
                                <?php
								$val=$result['marks'];
								if($val>90 && $val<=100)
								echo "O";
								elseif($val>85 && $val<=90)
								echo"A+";
								elseif($val>80 && $val<=85)
								echo"A";
								else if($val>75 && $val<=80)
								echo"B+";
								else if($val>70 && $val<=75)
								echo"B";
								else if($val>65 && $val<=70)
								echo"C+";
								else if($val>50 && $val<=65)
								echo"C";
								else
								echo"RA";?>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>

                    <?php } else { ?>
                    <div class="col-lg-12">
                        <h2>Result Not Found!</h2>
                    </div>
                    <?php }	?>




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