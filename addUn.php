<?php
	$connect = mysqli_connect("127.0.0.1", "root", "", "lesson43");
	$text_zaprosa_vstavit = "INSERT INTO applications (student_id, university_id)
							VALUES ('{$_GET["student"]}', '{$_GET["university_id"]}')";
	$zapros_vvoda = mysqli_query($connect, $text_zaprosa_vstavit);
	header("location:index.php")
?>