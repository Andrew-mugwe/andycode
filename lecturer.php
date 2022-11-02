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
$firstname=$lastname=$department='';
$errors=array('firstname'=>'','lastname'=>'','department'=>'');
if(isset($_POST['save'])){
    //checking for firstname validation
    if(empty($_POST['firstname'])){
        $errors['firstname']='firstname cannot be empty<br/>';
    }else{
        //echo $_post['firstname'];
        $firstname= $_POST['firstname'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$firstname)){
            $errors['firstname']='firstname must be letters and spaces only';
        }
    }
     //checking for lastname validation
     if(empty($_POST['lastname'])){
        $errors['lastname']='lastname cannot be empty<br/>';
    }else{
        //echo $_post['lastname'];
        $lastname= $_POST['lastname'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$lastname)){
            $errors['lastname']='lastname must be letters and spaces only';
        }
    }
     //checking for department validation
     if(empty($_POST['department'])){
        $errors['department']='department cannot be empty<br/>';
    }else{
        //echo $_post['department'];
        $department= $_POST['department'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$department)){
            $errors['department']='department must be letters and spaces only';
        }
    }
    if(array_filter($errors)){
        //echo 'There are  errors in the form';
    }else{
            //echo 'No errors in the form';
            /*$statement = $databaseconnection->prepare(
                "insert INTO sample(firstname, lastname, email, course)
                VALUES ($firstname, $lastname,$email,$course)");
                $statment->execute();*/
                try{
                $query ="INSERT INTO lecturersdetails(firstname,lastname,department) VALUES(:firstname,:lastname,:department)";
                $query_run=$databaseconnection->prepare($query);
                $data=[
                    ':firstname'=> $firstname,
                    ':lastname'=> $lastname,
                    ':department'=> $department,

                ];
                $query_execute=$query_run -> execute($data);
                if($query_execute){
                    echo'<script>alert("data added successesfully")</script>';
                }else{
                    echo'<script>alert("data not added")</script';
                }
            }catch(PDOException $err){
                echo $err->getmessage();
            }
        }
}
    
    

?>
<body>
<div class="col-md-4 offset-md-4">
<h5>Enter students details</h5>
<form action="lecturer.php" method="POST">
    <div class="form-group">
     <input type='text' name='firstname' placeholder='Enter firstname' class='form-control'>
     <div class='text-danger'><?php echo $errors['firstname']; ?></div>
    </div>
    
    <div class="form-group">
       <input type="text"
       name='lastname' placeholder='enter lastname' class='form-control'>
       <div class='text-danger'><?php echo $errors['lastname'];?></div>
    </div>
    <div class='form-group'>
        <input type="text" name='department' placeholder="enter department" class='form-control'>
        <div class="text-danger"><?php echo $errors["department"];?></div>
    </div>
   

    </form>
    </div>    
</body>
</html>