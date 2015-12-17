<?
require "admin/secure/session.inc.php";
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'sani');
define('DB_PASSWORD', '14678211');
define('DB_NAME', 'gbook');
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
function clearStr($data){
	global $link;
	return mysqli_real_escape_string($link, trim(strip_tags($data)));
}
///////////////////////////////////
if($_SERVER['REQUEST_METHOD']=='POST'){
	$name = clearStr($_POST['name']);
	$email = clearStr($_POST['email']);
	$msg = clearStr($_POST['msg']);
	$sql = "INSERT INTO msgs(name, email, msg)
                    VALUES ('$name', '$email', '$msg')";
	mysqli_query($link, $sql) or die (mysqli_error($link));
	header('Location: '.$_SERVER['REQUEST_URI']);
	exit;
}
if(isset($_GET['del'])){
	$del = abs((int)$_GET['del']);
	if($del){
		$sql = "DELETE FROM msgs WHERE id=$del";
		mysqli_query($link, $sql) or die (mysqli_error($link));
		header('Location: '.$_SERVER['SCRIPT_NAME']);
		exit;
	}
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Гостевая книга</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<div class="container">
<h1>Гостевая книга</h1>

	<div class="blog-header">
<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
	<div class="form-group">
		<label for="exampleInputName2">Имя</label>
		<input type="text" name="name"  class="form-control" id="exampleInputName2" placeholder="Имя">
	</div>
	<div class="form-group">
		<label for="exampleInputEmail1">Email</label>
		<input input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
	</div>
	<div class="form-group">
		<label for="exampleInputText">Сообщение</label>
		<textarea name="msg" class="form-control" rows="3" id="exampleInputText" placeholder="Оставьте запись" required></textarea>
	</div>


	<br />

	<button type="button" class="btn btn-success">Отправить</button>


</form>
		</div>

	<div class="row">


<?
$sql = "SELECT id, name, email, msg,
              UNIX_TIMESTAMP(datetime) as dt
                FROM msgs
                ORDER BY id DESC LIMIT 5"; // DESC - в обратном порядке
$res = mysqli_query($link, $sql) or die (mysqli_error($link));
mysqli_close($link);
$s = 0;
while($row = mysqli_fetch_assoc($res)){
	$s++;
	$id = $row['id'];
	$name = $row['name'];
	$email = $row['email'];
	$dt = date('d-m-Y H:i:s', $row['dt']);
	$msg = $row['msg'];
	echo '<ul>';
	echo <<<HTML
	<li style="list-style: none">
	 <p>$s. <a href="mailto:$email">$name</a> @ $dt
    <br>$msg
    </p>
    <a href="{$_SERVER['REQUEST_URI']}?id&del=$id">Удалить</a></p>
<p align='center'>

</li>
HTML;

	echo '</ul>';

}


?>
	</div>
		</div>

</body>
</html>