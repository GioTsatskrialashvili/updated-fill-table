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
$id=isset($_GET['id'])&&$_GET['id']? $_GET['id']:null;

if($id){
    $sql="SELECT* FROM students WHERE id = ".$id ;
    $result=mysqli_query($connection, $sql);
    $student = mysqli_fetch_assoc($result);
   
    if(!$student){
        die("student not found");
    }
}else{
    die("invalid id");
}
if(isset($_POST['action']) && $_POST['action'] == 'update') {
    $name = isset($_POST['name']) ? $_POST['name'] : '' ;
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '' ;
    $age = isset($_POST['age']) ? $_POST['age'] : '' ;
    $id = isset($_POST['id']) ? $_POST['id'] : '' ;
if($name&& $lastname &&$age &&$id){
    $update= "UPDATE students SET name = '$name', lastname = '$lastname', age = '$age' WHERE id = " . $id;
    if(mysqli_query($connection,$update)){
        header('Location:index.php');
    }else{
        echo"something went wrong try again";
    }
}
}
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
    <H2>Update Row</H2>
    <a class="back" href="index.php">Back</a>
<form id="updateform"action="" method="post">
    <input type="hidden" name='action' value='update'>
    <input type="hidden" name='id'value="<?=$student['id']; ?>" >
        <label for="name">name:</label>
        <input type="text"name="name" value='<?=$student['name'];?>'>
        <label for="lastname">lastname:</label>
        <input type="text" name="lastname"  value='<?=$student['lastname'];?>'>
        <label for="Age">age:</label>
        <input type="text" name="age" value='<?=$student['age'];?>'>
        <button>UPDATE</button>
    </form>
    </div>
</body>
</html>