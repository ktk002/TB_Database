<?php 
  //1. Create a database connection (Note: had to already create DB from MySQL)
  $dbhost = "localhost"; //Can be IP address, domain
  $dbuser = "root"; //User we are logging in as, you need to configure this in MySQL prior
  $dbpass = ""; //Configure in MySQL prior
  $dbname = "mtb_variants"; //
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); //Handle for connection to DB
  // Test DB connection:
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() .
         " (" . mysqli_connect_error() . ")"
       ); //Quit all php code and die/break with this message
      //Note: mysqli_connect_error return either an empty string if no error or error string 
      //mysqli_connect_errno() --> if there is an error in the last transaction, function returns error number

  }

?>

<?php>
  //2. Perform database query
  //Assemble query
  $query = "SELECT * FROM drug_table";
  $result = mysqli_query($connection, $query); //Create mysql resource result set -a collection of database rows - to catch output of query
  //Test if there was a query error
  if (!$result) {
    die("Database  query failed.");
  }
?>
<!DOCTYPE html PUBLIC >

<html lang="en">
  <head>
    <title>Databases</title>
  </head>
  <body>
    <!--Create an unordered list in html -->
    <ul> 
    <?php
      //3. Use returned data (if any) with while loop over any rows returned
      while($variant = mysqli_fetch_assoc($result)) { //Get first row from $result and ASSIGN value to $variant array --> when NULL is assigned to $variant, loop ends; increments row pointer to next set; access elements of $row array by field name
        //Output data from each row
		var_dump($variant); //dumps variant info to screen
	echo "<hr />"; //Add horizontal line

    ?>
		<li><?php echo "Variant ID is: " . $variant["variant_id"]; ?></li>
			<li><?php echo "Position is: " . $variant["Position"]; ?></li>
			<li><?php echo "Reference allele is: " . $variant["Ref"]; ?></li>
			<li><?php echo "Alternate allele is: " . $variant["Alt"]; ?></li>
			<li><?php echo "Variant consequence is: " . $variant["Consequence"]; ?></li>
			<li><?php echo "Variant impact is: " . $variant["Impact"]; ?></li>
			<li><?php echo "Gene which varint is found in is: " . $variant["Gene"]; ?></li>
      }
    ?>
    </ul> <!--Close the unordered list -->

    <?php 
      //4. Release returned data/resources
      mysqli_free_result($result);
    ?>

  </body>
</html>

<?php
  //5. Close database connection
  mysqli_close($connection); 
  //Releases the handle on the DB connection --> making handle explicit, but can be empty since implicit
?>
