<?php
	session_start();
?>

<html>
	<head>
		<title>
			SHL - Logs
		</title>
    	<link rel="stylesheet" type="text/css" href="css/logs.css">
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
 		<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
     	<script type="text/javascript" src="../js/jQuery.js"></script>
    	<!--Captcha Stuff-->

	</head>
	<body>
		<div id = "leftColumn">
			<ul>
				<li><a href = "index.php"><img src = "img/ico_comp.png">My Computer</a></li>
				<li><a href = "processes.php"><img src = "img/ico_procs.png">Processes</a></li>
				<li><a href = "logs.php"><img src = "img/ico_logs.png">Computer Logs</a></li>
				<li><a href = "files.php"><img src = "img/ico_files.png">Files</a></li>
				<li><a href = "internet.php"><img src = "img/ico_world.png">Internet</a></li>
				<li><a href = "slaves.php"><img src = "img/ico_slaves.png">My Slaves</a></li>
			</ul>
		</div>

		<div id = "background">
			<div id = "container">
				<div id = "header">
					<span id = "ipuser"></span>
					<span id = "timedate"></span>
				</div>
				<hr>
				<div id = "title">My Log File</div>
				<div id = "wrapper">
					<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>" method="post">
						<?php 
							if(isset($_POST['message'])){
								$message = $_POST['message']; 
								$_SESSION['message'] = $message; 
								echo "<textarea name='message' cols='50' rows='20'>";
								if(isset($_SESSION['message'])){
									echo "{$_SESSION['message']}";
								} else {}
								echo "</textarea>";
							} else {
								echo "<textarea name='message' cols='50' rows='20'>";
								if(isset($_SESSION['message'])){
									echo "{$_SESSION['message']}";
								} else {}
								echo "</textarea>";
							}?>
						<input type = "submit" value = "submit" id = "submit">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	include_once('../config.php');
	$link   = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($link, DB_NAME) or die("Cannot connect to database.");
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    ?><script>
		var img = new Image();
		img.src = "backgrounds/default.png";
		document.body.background = img.src;
	</script><?php 

	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$tz = $_SESSION['tz'];
	$ip = $_SESSION['ip'];

	$timestamp = $_SERVER['REQUEST_TIME'];

	$dtzone = new DateTimeZone($tz);
	$dtime = new DateTime();

	$dtime->setTimestamp($timestamp);
	$dtime->setTimeZone($dtzone);
	$curTime = $dtime->format('g:i A m/d/y');
	?><script>
		$("#ipuser").html("<?php echo $ip;?>@<?php echo $user;?>");
		$("#timedate").html("<?php echo ($curTime); ?>");
		$("#ip").html("<?php echo $ip; ?><a href='index.php?reset=1'> Reset</a>");
		$("#pass").html("<?php echo $pass; ?><a href='index.php?reset=2'> Reset</a>");
	</script><?php
?>