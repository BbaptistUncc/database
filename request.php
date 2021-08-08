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


    

$z=$_GET['z'];


if($z==null){

  
    $w=$_GET['w'];

    if($w==null){
echo"here";


    }else{
      $sql= "SELECT * FROM REQUEST WHERE title LIKE '%$w%' ";
   
   
    $sqlin="INSERT INTO PROCE VALUES (1,'$w')";
    $resin=mysqli_query($conn,$sqlin);
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==0){
      echo"<html>
      <head>
       
      </head>
      <body>
      <form action='request.php' method='GET'>
        <input name='a' class='search' type='text' value='Hang Out'>
        
        <button class='searchbut' name='searchbut'>go</button>
      
    
    </form>
      
     <br>
      </body>
    </html>";


    }else{
  
      echo"<h2>This book has already been requested</h2>";
      echo "<table border ='1'>";
      while($row=mysqli_fetch_assoc($result)){
        echo "<tr><td><b>Title</b></td><td><b>Author</b></td><td><b>Publisher</b></td><td><b>ISBN</b></td><td><b>Format</b></td><td><b>Number Of Requests</b></td>";
        echo"<tr><td>{$row['title']}</td><td>{$row['author']}</td><td>{$row['publisher']}</td><td>{$row['isbn']}</td><td>{$row['format']}</td><td>{$row['numberOfRequests']}</td>";
  
      }
      echo"
      Make another request?
          <form action='request.php' method='GET'>
         
          <button class='searchbut' name='z' value='yes'>yes</button>
          <button class='searchbut' name='z'value='no'>no</button>
        
      
      </form>
     <h1>
     
     </h1>";   
    
    }
  
    }
    
      
  
    
}else {

    if($z=='yes'){

        $sql= "SELECT title FROM PROCE WHERE id=1";
        $result = mysqli_query($conn,$sql);
        while ($row = $result->fetch_assoc()) {
           
            $x=$row['title'];
            
         }
       
        $sqlu= "UPDATE REQUEST
        SET numberOfRequests= numberOfRequests+1
        WHERE title LIKE '%$x%'";
         $resultu = mysqli_query($conn,$sqlu);

$sqln= "SELECT * FROM REQUEST WHERE title LIKE '%$x%' ";

    $resultn = mysqli_query($conn,$sqln);
    echo"Request added successfully!";
    echo "<table border ='1'>";
    while($row=mysqli_fetch_assoc($resultn)){
        echo "<tr><td><b>Title</b></td><td><b>Author</b></td><td><b>Publisher</b></td><td><b>ISBN</b></td><td><b>Format</b></td><td><b>Number Of Requests</b></td>";
        echo"<tr><td>{$row['title']}</td><td>{$row['author']}</td><td>{$row['publisher']}</td><td>{$row['isbn']}</td><td>{$row['format']}</td><td>{$row['numberOfRequests']}</td>";
  
      }

      $sqld= "DELETE FROM PROCE WHERE id=1";
      $resultd = mysqli_query($conn,$sqld);

    }else if($z=='no'){
        $sqld= "DELETE FROM PROCE WHERE id=1";
        $resultd = mysqli_query($conn,$sqld);


        echo"<html>
        <head>

        </head>

        <body>
        
       

        <script >

        window.location='patron.php';

          
      
        
        </script>
        
        </body>
        
        </html>";
    }
}
  
  

    

    ?>