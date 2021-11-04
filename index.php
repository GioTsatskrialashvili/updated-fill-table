<?php
$serverName= 'localhost';
$username= 'root';
$password='';
$dbname='school_project';
$connection=mysqli_connect($serverName, $username,$password,$dbname);
if(!$connection){
    echo "connection failed";
    die();
}
//instert1
$name= isset($_POST['name'])&& $_POST['name'] ? $_POST['name']:null;
$lastname= isset($_POST['lastname'])&& $_POST['lastname'] ? $_POST['lastname']:null;
$age= isset($_POST['age'])&& $_POST['age'] ? $_POST['age']:null;
if($name && $lastname && $age){
    $insert_query= "INSERT INTO `students`(`name`, `lastname`, `age`) VALUES ('$name','$lastname',$age)";
    mysqli_query($connection, $insert_query);
}
//DELETE
$id= isset($_POST['id'])&& $_POST['id'] ? $_POST['id']:null;
if($id){
    $delete_query= "DELETE FROM students WHERE id=".$id;
    mysqli_query($connection, $delete_query);
}
//select
$sql="SELECT* FROM students";
$result=mysqli_query($connection, $sql);
$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
<div class="bigcont">
<div class="formcont">
<form action="" method="post">
        <label for="name">name:</label>
        <input type="text"name="name">
        <label for="lastname">lastname:</label>
        <input type="text" name="lastname">
        <label for="Age">age:</label>
        <input type="text" name="age">
        <button>Add</button>
    </form>
    </div>
    
<table>
  <tr>
    <th>id</th>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Age</th>
    <th></th>
    <th></th>
  </tr>
  <?php foreach($rows as $value):?>
  <tr>
    <td><?=$value['id']?></td>
    <td><?=$value['name']?></td>
    <td><?=$value['lastname']?></td>
    <td><?=$value['age']?></td>
    <td><form action="" method='post' onsubmit="return deleteRecord()">
        <input type="hidden" name="id" value="<?=$value['id']?>">
        <button >X</button>
    </form></td>
    <td><a href="update.php?id=<?=$value['id']?>">EDIT</a></td>
  </tr>
  <?php endforeach;?>
</table>
</div>
<script src="script.js"></script>
</body>
</html>