<!DOCTYPE html>
<html lang="it">

<head>
		<link rel="icon" href="img/icona.ico" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
		<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <title>UNIverse</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
		<style>
		.buttonefollowtutor {
		  background-color: #4CAF50; /* Green */
		  border: none;
		  color: white;
		  padding: 5px 12px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 12px;
		  margin: 1px 0.5px;
		  transition-duration: 0.4s;
		  cursor: pointer;
		}
		.buttoneblue {
  background-color: white;
  color: black;
  border: 2px solid #1CE6BF;
}

.buttoneblue:hover {
  background-color: #1CE6BF				;
  color: white;
}
.disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
			</style>
</head>

<body id="page-top">
	<?php
	$controllo=true;
	if(((isset($_POST['email']))&&(isset($_POST['password'])))||(isset($_COOKIE["cookiemail"]))||(isset($_COOKIE["cookiemail2"]))){
		if((isset($_POST['email']))&&(isset($_POST['password']))){
			$email=$_POST['email'];
			$password=md5($_POST['password']);
			$conn=mysqli_connect("localhost","root","","database");
			$sql ="SELECT Email FROM  account WHERE Email='$email' && Password='$password'";
			$result = mysqli_query($conn,$sql);
			$risultato=null;
			while($rwo = mysqli_fetch_assoc($result)){
					$risultato=$rwo['Email'];
			}
			if($risultato==null){
					echo "Utente non riconosciuto<br><a href=\"index.php\">Home</a>";
					$controllo=false;
			}
		}elseif(isset($_COOKIE["cookiemail2"])){
			$email=$_COOKIE['cookiemail2'];
			setcookie("aggiungi", 1, time()-1);
		}
		else{
			$email=$_COOKIE["cookiemail"];
		}
			//Controllo login con SQLite3
			if($controllo){
				$Nome = null;
				$Cognome = null;
				$Uniseguite=null;
				$sql ="SELECT Nome,Uniseguite FROM  account WHERE Email='$email' ";
				$conn=mysqli_connect("localhost","root","","database");
				$result = mysqli_query($conn,$sql);

				while($rwo = mysqli_fetch_assoc($result)){
						$Nome=$rwo['Nome'];
						$Uniseguite=$rwo['Uniseguite'];
				}
				$sql ="SELECT Cognome FROM  account WHERE Email='$email'";
				$result = mysqli_query($conn,$sql);
				while($rwo = mysqli_fetch_assoc($result)){
						$Cognome=$rwo['Cognome'];
				}
				if(isset($_POST['keepsign'])){
						setcookie("cookiemail", $email, time()+86400);
				}
				$utente=$Nome .	 " " . $Cognome;

		?>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" >
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <img src="img/PNG BIANCO.png" height="50" width="60">
                <div class="sidebar-brand-text mx-3">UNIverse</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="Principale.php">
                    <img src="img/home bianco.png" height="25" width="30">
                    <span>Home</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="Principale.php?Aggiungi=1" id="aggiungi">
                    <img src="img/University-PNG.png" height="25" width="30">
                    <span>Aggiungi università</span></a>
            </li>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="Principale.php?Help=1" id="help">
                    <img src="img/help.png" height="30" width="30">
                    <span>Help!</span></a>
            </li>
						<!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="#"  data-target="#logoutModal" data-toggle="modal">
                    <img src="img/esci.png" height="30" width="30">
                    <span>Esci</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cerca..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>




                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
																<?php

																	echo $Nome." ".$Cognome;
																	?>
																</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profilo
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Impostazioni
                                </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Pagina Centrae -->
                <div class="container-fluid">
									<!-- Content Row -->
									<div class="row">
										<!-- Colonna Elementi -->
										<div class="col-lg-6 mb-4">

											<?php
											if(isset($_GET['UNi'])){
												$nomeuni=$_GET['UNi'];
												$sql ="SELECT descrizione,linkimg FROM  universita WHERE Nome='$nomeuni' ";
												$result = mysqli_query($conn,$sql);
												$Descrizione=null;
												$Link=null;
												while($rwo = mysqli_fetch_assoc($result)){
													$Descrizione=$rwo['descrizione'];
													$Link=$rwo['linkimg'];
												}

												echo"
												<div>
													<div>
														<div style=\"float: left\">
															<img src=\"".$Link."\" width=\"140px	\" height=\"100%\">
														</div>
														<div style=\"margin-left:25%\">
															<center><p style=\"font-size:90px	\">&lsquo;	".$nomeuni."&rsquo;</p></center>
															</div>
													</div>
													<br><br>
													<div>
														<h2 style=\": 30%;position:absolute\"> ".$Descrizione   ." </h2>
													</div>
													<br><br><hr><br>
													<div>
														<h2>Corsi:</h2>
													</div>
													<form action=\"#\" method=\"post\">
														<div>
														<h4>&middot; Laurea in Informatica </h4>
														<h5>Tutor: Lorenzo Masè	</h5><input type=\"submit\" value=\"Contatta\" class=\"buttonefollowtutor buttoneblue\">
														</div>
													<br>
													<div>
														<h4>&middot; Laurea in Giurisprudenza </h4>
														<h5>Tutor: Pietro Bassa</h5><input type=\"submit\" value=\"Contatta\" class=\"buttonefollowtutor buttoneblue \">
													</div>
													<br>
													<div>
														<h4>&middot; Laurea in Architettura </h4>
														<h5>Tutor: Eugenia Mastroianni</h5><input type=\"submit\" value=\"Contatta\" class=\"buttonefollowtutor buttoneblue \">
													</div>
													<br>
													<div>
														<h4>&middot; Laurea in Economia e management </h4>
														<h5>Tutor: Dino Broschi</h5><input type=\"submit\" value=\"Contatta\" class=\"buttonefollowtutor buttoneblue \">
													</div>
													<br>
													<div>
														<h4>&middot; Laurea in Igene dentale </h4>
														<h5>Tutor: Giovanni Ferrara</h5><input type=\"submit\" value=\"Contatta\" class=\"buttonefollowtutor buttoneblue \">
													</div>
													</form>
												</div>
														"
												;


												}elseif(isset($_GET['Aggiungi'])){

												echo "Pagina ricerca di nuove uni";

											}
											elseif(isset($_GET['Help'])){

												echo "Pagina Help tutorial";

											}
											else{
												?>
													<h4>
														Le tue università:
													</h4><br>


												<?php
												$Uniseguitexp = explode("-",$Uniseguite);
												if(strcmp($Uniseguite,"") !== 0){
													foreach ($Uniseguitexp as $key ) {
														$sql ="SELECT descrizione,linkimg FROM  universita WHERE Nome='$key' ";
														$result = mysqli_query($conn,$sql);
														$Descrizione=null;
														$Link=null;
														while($rwo = mysqli_fetch_assoc($result)){
															$Descrizione=$rwo['descrizione'];
															$Link=$rwo['linkimg'];
														}

												echo"									<div class=\"card shadow mb-4\">
																								<div class=\"card-header py-3\">
																									<h6 class=\"m-0 font-weight-bold text-primary\">
																											<a href=\"Principale.php?UNi=".$key."  \" name=\"UNI\"  id=\"linkj\" class=\"m-0 font-weight-bold text-primary\" >".$key."	</a>
																									</h6>
																								</div>
																								<div class=\"card-body\">
																									<div style=\"float: left\">
																										<img src=\"".$Link."\" width=\"70\" height=\"100%\">
																									</div>
																									<div style=\"margin-left:25%\">
																										<p>".$Descrizione."</p>
																									</div>
																								</div>
																							</div><hr>";
											}

										}

										}?>
											<!-- Elemento -->




										</div>
									</div>




                <!-- /.container-fluid -->
				<!-- Project Card Example -->
                            <div class="card shadow mb-4 d-none d-lg-block" style="width:35%; height:70%;position: fixed; bottom:0;right:0; "  >
                                <div class="card-header py-3">
                                    <h4 class="m-0 font-weight-bold text-primary" style="color:Black">Chat</h4>
                                </div>
																<div id="chatbox" class="card-body">
																</div>

									<div style="position:absolute;bottom:10%;width:90%;border">
										<form style="width:100%;" action="" name="message" class=" d-sm-inline-block  ml-md-3 my-2 my-md-0 mw-100 navbar-search">
											<div class="input-group">
												<input type="text" name="usermsg"  id="usermsg" class="form-control bg-light border-0 small" placeholder="Scrivi..."
													aria-label="Search" aria-describedby="basic-addon2"  >
												<div class="input-group-append">
													<button class="btn btn-primary btn-default" type="submit" id="submitmsg" >
														 <img src="img/invia.png" height="25" width="30">
													</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								</div>
						</div>



            <!-- End of Main Content -->
            <!-- Footer -->
						<footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; UNIverse 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
			</div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->




    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sicuro di uscire?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleziona "Esci" se sei pronto per terminare la sessione corrente.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulla</button>
										<form action="Index.php" method="post">
                    		<button class="btn btn-primary" name="esci" >Esci</button>
										</form>
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
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
		});
		$(document).ready(function(){
		    $("#exit").click(function(){
		        var exit = confirm("Are you sure you want quit?");
		        if(exit==true){window.location = 'index.php?logout=true';}
		    });
		});
		$("#submitmsg").click(function(){
		  var clientmsg = $("#usermsg").val();
		  $.post("post.php", {text: clientmsg});
		  $("#usermsg").attr("value", "");
		  loadLog;
		  return false;
		});
		function loadLog(){
		    $.post("read.php");
		    $.ajax({
		        url: "testo.html",
		        cache: false,
		        success: function(html){
		            $("#chatbox").html(html);
		            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
		            if(newscrollHeight > oldscrollHeight){
		                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');
		            }
		        },
		    });
		}
		$("a#linkj").bind("click", function() {
    	<?php setcookie("cookiemail2", $email, time()+86400);
			 ?>
		});
		$("a#aggiungi").bind("click", function() {
			<?php setcookie("cookiemail2", $email, time()+86400);
			 ?>

		});
		$("a#help").bind("click", function() {
			<?php setcookie("cookiemail2", $email, time()+86400);
			 ?>

		});
		//setInterval (loadLog, 1000);
		</script>
		<?php
			}

		}
	?>
</body>

</html>
