<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Профиль поступающего</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<?php
	$connect = mysqli_connect("127.0.0.1", "root", "", "lesson43");
	$text_zaprosa = "SELECT * FROM students WHERE id='{$_SESSION["id"]}'";
	$zapros = mysqli_query($connect, $text_zaprosa);
	$stroka = $zapros->fetch_assoc();


	$works = "SELECT * FROM works WHERE student_id = '{$_SESSION["id"]}'";
	$works2 = mysqli_query($connect, $works);

	$appl = "SELECT * FROM applications WHERE student_id = '{$_SESSION["id"]}'";
	$appl2 = mysqli_query($connect, $appl);
	$appl3 = $appl2->fetch_assoc();

	$univ = "SELECT * FROM universities INNER JOIN applications ON universities.id = applications.university_id WHERE applications.student_id = '{$_SESSION['id']}'";
	$univ2 = mysqli_query($connect, $univ);
	




?>
	<!--если студент НЕ авторизовался, то показывается эта часть, в том числе ссылка на страницу  логина-->
	<?php
		if($_SESSION["id"]==null){
			
		
	?>
	<div class="col-10 mx-auto">
		<h3>Войдите как абитуриент</h3>
		<p>Вы не авторизованы</p>
		<a href="loginStudent.php">Авторизация абитуриента</a>
	</div>
	<?php
		} else {
	?>

	<!--если студент авторизовался, то показываются nav (меню) и контент всего сайта-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Привет, <?php echo $stroka["fio"]?></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a href="signOutStudent.php" class="nav-link text-danger">Выйти</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="index.php">Главная</a>
	      </li>
	      
	    </ul>
	  </div>
	</nav>
	<div class="col-10 mx-auto mt-5">
		<div class="row">
			<div class="col-3 border py-3 rounded">
				<h5>Добавить работу</h5>
				<form action="addWork.php" method="POST" enctype="multipart/form-data">
					<input class="mt-3 form-control" type="" placeholder="Описание" name="description">
					<input placeholder="Выбрать файл" class="mt-3" type="file" name="file">
					<input type="hidden" name="id" value="<?php echo $stroka["id"]?>">
					<button class="btn btn-success mt-3">Загрузить работу в портфолио</button>
				</form>
			</div>
			<?php
				for($i=0;$i<$works2->num_rows;$i++){
					$result = $works2->fetch_assoc();
			?>
			<!--Вывод работ-->
			<div class="col-3">
				<img class="w-100" src="<?php echo $result["filename"]?>">
				<p><?php echo $result["description"]?></p>
			</div>
			<?php } ?>	
		</div>
		<div class=" mt-5">
			<h3>Мои заявки в университеты</h3>
			<?php
				for ($i=0; $i < $univ2->num_rows; $i++) {
					$univ3 = $univ2->fetch_assoc(); 
					
				
			?>
			<p><?php echo $univ3["name"];?></p>		
		</div>
	</div>
<?php } ?>

	<?php
		}
	?>
</body>
</html>
