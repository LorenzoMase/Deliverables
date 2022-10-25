<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];

	 $a="mase figlio di  ";
	$conn=mysqli_connect("localhost","root","","database");
	$data=date('Y-m-d');
	$nameda=$_SESSION['name'];

	$sql="INSERT INTO chat (Tempo,Da,A,Messaggio) VALUES ('$data','$nameda','$a','$text')";
	$result = mysqli_query($conn,$sql);
}
?>
