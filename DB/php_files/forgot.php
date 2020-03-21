<?php

	require 'Database.php';

 	$id= $_POST['id'];
 	$name = $_POST['name'];

 	$sql= "SELECT email, password FROM Login WHERE id = 'id' AND name like '%$name%'";

 	$result= mysqli_query($conn, $sql);
 	$response= array();

 	if (mysqli_num_rows($result)>0) {
 		$row= mysqli_fetch_assoc($result);

 		mail($row["email"], "your accoun password is".$row["password"], "jajaja");
 		echo "SUCCESS";
 	}else

 	echo "FAILED";
 	mysqli_close($conn);
?>
