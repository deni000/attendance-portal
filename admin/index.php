

<!DOCTYPE html>
<html>
<head>

  <title>Attendance system PHP and MySQL</title>
  <style type="text/css">
  * {
  margin: 0px;
  padding: 0px;
  
}


body {
	background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(c1.jpg);
	height: 100vh;
	background-size: cover;
	background-position: center;
	
}

.header {
  width: 30%;
  margin: 50px auto 0px;
  color: black;
  background: white;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: solid;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
form, .content {
  width: 30%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: pink;
  border-radius: 0px 0px 10px 10px;
}
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
.btn {
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 5px;
}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}
</style>
</head>
<body>
	<img>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="admin_validation.php">
  	
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" placeholder="enter user name" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" placeholder="enter password " name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  </form>
  </img>
</body>
</html>