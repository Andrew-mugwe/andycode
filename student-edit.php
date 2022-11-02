<?php
include('dbh.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<?php
if(isset($_GET['studentid'])){
    $student_id=$_GET['studentid'];


    $query="SELECT * FROM studentdetails WHERE studentid=:std_id LIMIT 1";
    $statement=$databaseconnection->prepare(query);
    $data=[':std_id'=>$student_id];
    $statement->execute($data);

    $result=$statement->fetch(PDO::FETCH_ASSOC);
}
?>
<body>
<div class="col-md-4 offset-md-4">
<h5>EDIT students details</h5>
<form action="crud.php" method="POST">
     <input type='hidden' name="student_id" value="<?=$result['studentid']; ?>">
     <div class='text-danger'><?php echo $errors['firstname']; ?></div>
    </div>
    
    <div class="form-group">
       <input type="text"
       name='firstname' value="<?=$result['firstname'];?>" placeholder="Enter firstname" class="form-control">
       </div>

       <div class="form-group">
       <input type="text"
       name='lastname' value="<?=$result['lastname'];?>" placeholder="Enter lastname" class="form-control">
</div>    

    
</body>
</html>