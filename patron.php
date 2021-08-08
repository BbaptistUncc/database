<?php 
//import login doc
include("/var/www/db_settings.php");
//assign login vars
$server= $db_host;
$username=$db_user_11;
$password= $db_pw_11;
$dbname= 'team11';
//connection
$conn = new mysqli($server, $username, $password,$dbname) or die("Connect failed: %s\n". $conn -> error);

?>


<!DOCTYPE html>
<html>
  <head>
    <link href="search.css" rel="stylesheet" type="text/css" media="all">
    <link href="table.css" rel="stylesheet" type="text/css" media="all">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    
    <script src="search.js" type="text/javascript"></script>
  </head>
  <body>
  <form action="patron.php" method="GET">
    <input name="q" class="search" type="text" value="Search Book:">
    <button class="searchbut" name="searchbut">go</button>
  

</form>
  
 <br>
  </body>
</html>

<?php
$q=$_GET['q'];

if($q!=null){
    $sql= "SELECT * FROM BOOK WHERE title LIKE '%$q%' ";

    $result = mysqli_query($conn,$sql);
    
    echo "<table border ='1'>";
    
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr><td><b>ID</b></td><td><b>Title</b></td><td><b>Author</b></td><td><b>Genre</b></td><td><b>Availability</b></td><td><b>Location</b></td><td><b>Cover</b></td><td><b>Digital</b></td>";
        echo"<tr><td>{$row['bookID']}</td><td>{$row['title']}</td><td>{$row['author']}</td><td>{$row['genre']}</td><td>{$row['availability']}</td><td>{$row['location']}</td><td>{$row['cover']}</td><td>{$row['digital']}</td>";
    }
    if(mysqli_num_rows($result)==0){
    echo"<h2>No book with this title was found</h2><h3>Make a request:</h3>";
    echo" <form action='request.php' method='GET'>
    <input name='w' class='search' type='text' value='Make Request:'>
    <button class='searchbut' name='searchbut'>go</button>
  </form>";
    }}

?>