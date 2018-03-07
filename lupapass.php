<?php
include "config.php";
?>





<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Monev Alsintan</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h2>Lupa Password</h2>

                        		</div>
                            </div>
                            <div class="form-bottom">
												<form role="form" action="" method="post" class="login-form">
												
                            		<p>Masukkan Username</p>
			                    
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="user" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>

			                        <button type="submit" class="btn" name="submit">Lupa Password</button>
			                    </form>
		                    </div>
							<?php
										if(isset($_POST['submit']))
										{ 
										 
										 $q=mysqli_query($con,"select * from tb_user where username='".$_POST['user']."'");
										 $p=mysqli_fetch_array($q);
										 if($p!=0) 
										 {
										  $res=mysqli_fetch_array($q);
										  $to=$res['email'];
										  $subject='Password MONEV ALSINTAN';
										  $message='Your password : '.$res['password']; 
										  $headers='From:adminalsintantp@pertanian.go.id';
										  $m=mail($to,$subject,$message,$headers);
										  if($m)
										  {
											echo'<div class="alert alert-success">
												  <strong>Success!</strong> Cek Email anda.
												</div>';
										  }
										  else
										  {
										   echo'<div class="alert alert-warning">
												  <strong>Warning!</strong> Email tidak terkirim.
												</div>';
										  }
										 }
										 else
										 {
										  echo'<div class="alert alert-warning">
												  <strong>Warning!</strong> User tidak tersedia.
												</div>';
										 }
										}
							?>
		</form>
                        </div>
                    </div>
                </div>
            
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>