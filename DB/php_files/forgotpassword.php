<?php

	require "Database.php";

 	$contact_no = $_POST['contact_no'];
 	$name = $_POST['name'];

 	$sql= "SELECT email,password FROM customer WHERE contact_no = 'contact_no' AND name like '%$name%'";

 	$result = mysqli_query($conn, $sql);
 	$response = array();

 	if(mysqli_num_rows($result)>0) 
 	{
 		$row = mysqli_fetch_assoc($result);

 		mail($row["email"], "your accoun password is".$row["password"], "", "");
 		echo "SUCCESS";
 	}  else

 	echo "FAILED";

 	mysqli_close($conn);
?>
