<?
require_once "secure/session.inc.php";
require_once "secure/secure.inc.php";
if(isset($_GET['logout'])){
	logOut();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Админка</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
	<h1>Администрирование гостевой книги</h1>
	<h3>Доступные действия:</h3>
	<ul>
		<li><a href='../'>Добавление записей в гостевую книгу</a></li>
		<li><a href='secure/create_user.php'>Добавление пользователей</a></li>
		<li><a href='index.php?logout'>Завершить сеанс</a></li>
	</ul>
</body>
</html>