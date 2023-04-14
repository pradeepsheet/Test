<?php

$firstname = &_POST["firstname"];
$lastname = &_POST["lastname"];

//connect to the database

$con = mysqli_connect("localhost","root","");
//Make sure we connected successfully 
if(! $con)
{
	die('connection Failed'.mysqli_error());
}

//select the database to use
 mysqli_select_bd($con,"test");
 $result = mysqli_query($con,"SELECT fname, pass FROM try WHERE firstname =$firstname and lastname = $lastname");

 $row = mysqli_fetch_array($result);
  if($row["firstname"]==$firstname  && $row["lastname"]==$lastname)
     echo"You are a validated user.";
  else
   echo"sorry, your credentials are not valid, Please try again.";
   ?>  