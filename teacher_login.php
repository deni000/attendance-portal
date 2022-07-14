<!DOCTYPE html>
<html>
<head>
	<title>Teacher Login</title>
	<style type="text/css">
	body{
		background-image: url(aa.jpg);
		height: 100vh;
	    background-size: cover;
	    background-position: center;
	}
	.a{
		width: 400px;
		height: 300px;
		background-color: rgba(0,0,0,0.2);
		margin: 0 auto;
		margin-top: 60px;
		padding-top: 20px;
		padding-left: 60px;
		border-radius: 15px;
		color: red;
		font-weight: bolder;
		box-shadow: inset -2px -2px rgba(0,0,0,0.5);
		font-size: 20px;
		
	}
	.a input[type="text"]
	{
		width: 200px;
		height: 35px;
		border: 0;
		border-radius: 5px;
		padding-left: 5px;
	}
	.a input[type="password"]
	{
		width: 200px;
		height: 35px;
		border: 0;
		border-radius: 5px;
		padding-left: 5px;
	}
	.a input[type="submit"]
	{
		width: 80px;
		height: 35px;
		border: 0;
		border-radius: 5px;
		background-color: blue;
		font-weight: bolder;
	}
		
	</style>
</head>
<body>
	<div class="a">
	<h2>Teacher Login</h2>
	<form action="teacher_validation.php" method="post">
		<input type="text" placeholder="Email-id" name="teacher_emailid"><br><br>
		<input type="password" placeholder="Password" name="teacher_password"><br><br>
		<input type="submit" value="Login" name="submit">
	</form>

</body>

</html>