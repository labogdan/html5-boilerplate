<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php 
 	echo '<p>Hello World</p>';
	echo htmlspecialchars($_POST['name']);
	$file = "log-a-b.txt";
		
	if (file_exists($file)) {
		$current = file_get_contents($file);
		$current .= $_POST['name'];
		file_put_contents($file, $current);
	} else {
		file_put_contents($file, $_POST['name']);
	}
	
	
 ?> 
 </body>
</html>