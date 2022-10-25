<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
    $cb = fopen("testo.html", 'w');

    $conn=mysqli_connect("localhost","root","","database");
    $sql="SELECT Tempo,Da,A,Messaggio FROM chat";
    $result = mysqli_query($conn,$sql);


    $testo="";
    while($rwo = mysqli_fetch_assoc($result)){
      if(strcmp($rwo['Da'],"Lorenzo Zanini")==0)$testo=$testo."<h6>".$rwo['Da']."</h6>"." "."<h6>".$rwo['Messaggio']."</h6><br>";
    }
    fwrite($cb,$testo);
    fclose($cb);
}
?>
