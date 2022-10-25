<!DOCTYPE html>
<html lang="it">

<head>
	<link rel="icon" href="img/icona.ico" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrati</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
	<?php
			if(isset($_COOKIE['PASSWORDUGUALE'])==1){
				echo "<script type='text/javascript'>alert('Le password non coincidono');</script>";
					setcookie("PASSWORDUGUALE", 1, time()-1);
			}
	?>
	<?php
			if(isset($_COOKIE['EMAILUGUALE'])==1){
				echo "<script type='text/javascript'>alert('Email già esistente nel sito');</script>";
					setcookie("EMAILUGUALE", 1, time()-1);
			}
	?>
	<?php
			if(isset($_POST['nome'])&&isset($_POST['cognome'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['rpassword'])){
					if($_POST['password']==$_POST['rpassword']){
						$conn=mysqli_connect("localhost","root","","database");
						$email=$_POST['email'];
						$sql ="SELECT Email FROM  account WHERE Email='$email'";
						$result = mysqli_query($conn,$sql);
						$risultato=null;
						while($rwo = mysqli_fetch_assoc($result)){
								$risultato=$rwo['Email'];
						}
						if($risultato==null){
							$nome=$_POST['nome'];
							$pass=md5($_POST['password']);
							$cognome=$_POST['cognome'];
							$sql ="INSERT INTO account (Email, Password, Nome, Cognome, Tutor) VALUES ('$email','$pass','$nome','$cognome',0)";
							$result = mysqli_query($conn,$sql);
							setcookie("Reffettuale", 1, time()+3600);
							header('Location: Index.php');
						}
						else{
								header('Location: registrati.php');
								setcookie("EMAILUGUALE", 1, time()+3600);
						}
					}
					else{
							header('Location: registrati.php');
							setcookie("PASSWORDUGUALE", 1, time()+3600);
					}
			}
			else{

	?>





    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block">
					<img src="img/registrati.jpg"  width="100%" height="auto"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crea un Account!</h1>
                            </div>
                            <form class="user" action="#" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="nome" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Nome">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="cognome" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Cognome">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" minlength="8">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="rpassword" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Ripeti Password" minlength="8">
                                    </div>
                                </div>
                                <input type="submit" value="Registrati" href="Index.php" class="btn btn-primary btn-user btn-block">

                                <hr>
                                <a href="Principale.php" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Registrati con Google
                                </a>
                                <a href="Principale.php" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Registrati con Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="dimenticata.php">Password dimenticata?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="Index.php">Hai gia un account? Accedi!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
  <?php } ?>
</body>

</html>
