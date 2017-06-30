
<?php

// DB Credentials
require_once("models/config.php");

// UserCake secure
if (!securePage($_SERVER['PHP_SELF'])){die();}

// Header
require_once("models/header.php");

// NavBar
include("left-nav.php");
					
					
// Make sure a user is logged in UserCake
if(isUserLoggedIn()){

	// Make sure user is an admin
	if ($loggedInUser->checkPermission(array(3))){


//Forms posted
if (isset($_POST['submit1']))
{

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "INSERT INTO  email (emailAddresses) VALUES ('$_POST[emailAddress]')";


if ($conn->query($sql) === TRUE) {
    echo "<h3>New record created successfully</h3><a class='btn btn-primary center-block' href='addEmails.php'>Add Another?</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

//Forms posted

 $connect = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['submitCSV']))
{

    // Create connection
   
    

  if($_FILES['file']['name'])
   {
    $filename = explode(".", $_FILES['file']['name']);
    if($filename[1] == 'csv')
    {
     $handle = fopen($_FILES['file']['tmp_name'], "r");
     while($data = fgetcsv($handle))
     {
      $item1 = mysqli_real_escape_string($connect, $data[0]);  
                  
                  $query = "INSERT INTO  email (emailAddresses)  values('$item1')";
                  mysqli_query($connect, $query);
     }
     fclose($handle);



     echo "<h3>File uploaded successfully</h3><a class='btn btn-primary center-block' href='addEmails.php'>Add Another?</a>";


    }
   }

}

echo "



<div class='container'>
    <h3> Add Email </h3> 
    <br></br>      
    <ul class='pager'>
      <li><a href='Previous.php'>Previous</a></li>

    <li><a href='Next.php'>Next</a></li>
    </ul>
</div>					
  




<div class='container' >
  <form action='addEmails.php' method='post'>

    <div class='container'>  
      <form class='form-horizontal'>
        <div class='form-group'>  
        </div>
        <br> <br/>

      </form>

      <div class='form-group has-focus has-feedback'>
        <label for='emailAddress' class='col-sm-2 control-label'>Email Address</label>

        <div class='col-sm-10'>
          <input type='text' class='form-control' placeholder='Email Address' name='emailAddress' >
        </div>

        <br></br>

        <div class='form-group has-focus has-feedback'>

        <br> <br/>
	         <button type='submit1' name='submit1' class='btn btn-primary center-block'>Submit</button>
        </div>	

      </div>

    </form>

  </div> 

  <br> <br/>

  <div class='container' >  

    <form action='addEmails.php'  method='post' enctype='multipart/form-data'>

      <p class='text-center'> Or choose file to upload Email Addresses in CSV format. </p>

        <br> <br/>

        <input class='center-block' type='file' name='file' />
      
       <br> <br/>

      <button type='submitCSV' name='submitCSV' class='btn btn-primary center-block'>Submit CSV</button>

    </form>

  </div>  

  <br> <br/>

  <footer>
    
  </footer>

</div>

</head>

</html>";

}else{
		echo "Admins Only.";
	}
// Display message asking visitor to log in.
}else{
	echo "Please Login to view this page.";
}

?>

