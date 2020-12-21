<?php session_start()?>
<?php
	$connect = mysqli_connect("127.0.0.1", "root", "", "lesson43");
	$text_zaprosa = "SELECT * FROM students WHERE phone ='{$_POST["phone"]}' AND password = '{$_POST["password"]}'";
	$zapros = mysqli_query($connect, $text_zaprosa);
	$stroka = $zapros->fetch_assoc();

	if($zapros->num_rows==0){
		header("location: loginStudent.php?error=Такого пользователя нет");
	} else {
		header("location: accountStudent.php");
	}
	$_SESSION["id"]=$stroka["id"];
?>