<html>
<head>
<Title>Registration Form</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Register here!</h1>
<p>Fill in the search you want to make:</p>
<form method="post" action="search.php" enctype="multipart/form-data" >
      Search  <input type="text" name="search" id="search"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "bc526ddfe75b58";
    $pwd = "1c7154b7";
    $db = "registeAngRMJGUo";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    
    }
    // Insert registration info
    
    if(!empty($_POST)) {
    try {
       
	$search = $_POST['search'];
        // Insert data
        /*$sql_insert = "INSERT INTO registration_tbl (name, email, date) 
                   VALUES (?,?,?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $date);
        $stmt->execute();*/

    }
    catch(Exception $e) {
        die(var_dump($e));
    } 

    //echo "<h3>Your're registered!</h3>";
    }
	
    // Retrieve data
    $sql_select = "SELECT * FROM registration_tbl WHERE name ='$search'"; 
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
        echo "<h2>People who are registered in your search:</h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Date</th>";
	echo "<th>Company Name</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['date']."</td>";
	    echo "<td>".$registrant['CompanyName']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>No one is currently registered and within your search criteria.</h3>";
    }
?>
</body>
</html>
