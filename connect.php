<?php
   $user = $_POST['user'];
   $pass = $_POST['pass'];
   $mobileNumber = $_POST['mobileNumber'];
   $emails = $_POST['emails'];
	   
	   if (!empty($user) || !empty($pass) || !empty($mobileNumber) || !empty($emails)) 
	   {
	   	$host = "localhost";
	   	$dbUsername = "root";
	   	$dbPassword = "";
        $dbname = "test";
      
      //create connection

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

         if(mysql_connect_error())
         {
         	die('connect Error('.mysqli_connect_errno().')'.mysql_connect_error());
         }
         else
         {
         	$SELECT = "SELECT emails from register where emails= ? Limit 1";
         	$INSERT = "INSERT Into register (user, pass, mobileNumber, emails) values (?, ?, ?, ?)";

         	//prepare statement
         	$stmt = $conn->prepare($SELECT);
         	$stmt->bind_param("s",$emails);
         	$stmt->execute();
         	$stmt->bind_result();
         	$rnum = $$stmt->num_rows;

         	if($rnum==0)
         	{
         		$stmt->close();

         		$stmt = $conn->prepare($INSERT);
         		$stmt->bind_param("ssis",$user, $pass, $mobileNumber, $emails);
         		$stmt->execute();
         		echo "New record inserted sucessfully";
         	}
         	else
         	{
         		echo "Someone already register using this email";
         	}
         	$stmt->close();
         	$conn->close();
         }


	   }
	   else
	   {
	   	echo "All field are required";
	   	die();
	   }
			
?>