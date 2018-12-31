<?php
	header("Content-Type:text/html;charset=utf-8");
	session_start();
	//获取用户输入的验证码
	$code = trim($_POST["captcha"]);
	//将字符串都转成小写进行比较
	if(strtolower($code)==strtolower($_SESSION['captcha_code']))
	{
		echo "Verification code right!";
		unset($_SESSION['captcha_code']);
		//获取用户名和密码
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		if(($username=='')||($password==''))
		{
			header('refresh:3;url=index.html');
			echo "The user name or password cannot be empty，3s after the jump to the login page!";
			exit;
		}
		else if(($username!='admin')||($password!='admin'))
		{
			//用户名或密码错误
			header('refresh:3;url=index.html');
			echo "The user name or password error，3s after the jump to the login page!";
			exit;
		}
		else if(($username=='admin')&&($password=='admin'))
		{
			//登录成功将信息保存到session中
			$_SESSION['username']=$username;
			echo '<br>Hello:'.$username.' Login successful!';
		}
	}
	else
	{
		echo "Verification code error!";
	}
?>
