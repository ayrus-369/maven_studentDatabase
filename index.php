<?php
session_start();
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']==1){
		header("Location:teacher_home.php?type=1");
	}
	else{
		header("Location:student_home.php?type=2");	
	}
}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <!-- Including Bootstrap Css -->
    <!-- Latest compiled and minified CSS -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet" /><!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
    <!-- Adding Custom Css -->
    <style type="text/css">
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }

    .w-block {

        display: block;
    }

    .text-font {
        font-size: 15px;
        font-weight: bold;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
    <link rel="stylesheet" href="public/css/main.css" />
</head>

<body>
    <!-- Am Using Bootstrap Css for Designing My web page -->
    <!-- Let's Create Login part -->
    <!-- Now Adding Bootstrap Login Part Design -->
    <!-- Now Login Page Done -->
    <div class="container">
        <div class="row">
            <?php if(isset($_REQUEST['error'])){ ?>
            <div class="col-lg-12">
                <span class="alert alert-danger" style="display: block;"><?php echo $_REQUEST['error']; ?></span>
            </div>
            <?php } ?>
        </div>
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                            class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form action="login.php" method="post">




                            <!-- Email input -->
                            <div class="form-outline mb-4  ">
                                <input type="email" id="form3Example3" class="form-control  form-control-lg"
                                    placeholder="" name="email" required autofocus />
                                <label class="form-label text-font" for="form3Example3">Email address</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3 text-font">
                                <input type="password" id="form3Example4" class="form-control text-font form-control-lg"
                                    placeholder="" name="password" required />
                                <label class="form-label text-font" for="form3Example4">Password</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">


                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button type="submit" class="btn btn-primary btn-lg"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div
                class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <!-- Copyright -->
                <div class="text-white text-font mb-3 mb-md-0">
                    Copyright © 2020. All rights reserved.
                </div>
                <!-- Copyright -->

                <!-- Right -->
                <div>
                    <a href="#!" class="text-white me-4">
                        <i class="fab text-font fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab text-font fa-twitter"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab text-font fa-google"></i>
                    </a>
                    <a href="#!" class="text-white">
                        <i class="fab text-font fa-linkedin-in"></i>
                    </a>
                </div>
                <!-- Right -->
            </div>

        </section>
</body>

</html>