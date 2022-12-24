<?php
require_once("./app/helpers.php");


if(isset($_POST['add']))
{

   $name = $_POST["username"];
   $email = $_POST["useremail"];
   $password = $_POST["userpassword"];
   $gender = $_POST["usergender"];
   

   excute("insert into users(username , useremail , userpassword , usergender ) values('{$name}' , '{$email}' , '{$password}' , '{$gender}'  )");
   redirect("index.php");
   
}

if(isset($_POST["update"]))
{
   $id = $_POST["userid"];
   $name = $_POST["username"];
   $email = $_POST["useremail"];
   $password = $_POST["userpassword"];
   $gender = $_POST["usergender"];

   

   excute("update users set username='{$name}' , useremail = '{$email}' , userpassword = '{$password}' , usergender = '{$gender}' where user_id = '{$id}'");
   redirect("index.php");
   
}


if(isset($_GET["delete_id"]))
{
   $id = $_GET["delete_id"];

      excute("delete from users where user_id = '{$id}'");
      redirect("index.php");
   
   

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users page</title> 
    <link rel="stylesheet" href="./assets/css/app.css">
    <link rel="stylesheet" href="./assets/css/bootstrap/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container">
       

    <?php    

        if(isset($_GET["edit_id"]))
        {

            $id = $_GET["edit_id"];
            $counter = countData("select all * from users where user_id='{$id}'");
            if($counter>0)
            {
                $user = findData("select all * from users where user_id='{$id}'");

                $id = $user["user_id"];
                $name = $user["username"];
                $email = $user["useremail"];
                $password = $user["userpassword"];
                $gender = $user["usergender"];
            }
            else
            {
                redirect("404.php");
            }
            ?>

            <form action="index.php" method="POST" >


            <div class="form-floating mb-3 mt-5 w-50 mx-auto">
                        <input type="hidden" class="form-control" id="nameinput" placeholder="name@example.com" name="userid" value="<?=$id?>"  required>
                        <label for="nameinput"  >Name</label>
            </div>


            <div class="form-floating mb-3 mt-5 w-50 mx-auto">
                        <input type="text" class="form-control" id="nameinput" placeholder="name@example.com" name="username" value="<?=$name?>"  required>
                        <label for="nameinput"  >Name</label>
            </div>

            <div class="form-floating mb-3  w-50 mx-auto">
                        <input type="email" class="form-control" id="emailinput" placeholder="name@example.com" name="useremail" value="<?=$email?>" required>
                        <label for="emailinput"  >Email</label>
            </div>

            <div class="form-floating mb-3  w-50 mx-auto">
                        <input type="text" class="form-control" id="passwordinput" placeholder="name@example.com" name="userpassword" value="<?=$password?>" required>
                        <label for="passwordinput"  >Password</label>
            </div>

            <select class="form-select w-50 mx-auto" aria-label="Default select example" name="usergender" value="<?=$gender?>" required>

            
                    <option selected value="male">male</option>
                    <option value="female">female</option>
                    
            </select>

                    <div class="d-grid gap-2">
            <button class="btn btn-primary w-50 mx-auto mt-3" name="update" type="submit">update</button>

            </div>
            </form>
            <?php
        }

        else
        {

        
    ?>
    <form action="index.php" method="POST">

                <div class="form-floating mb-3 mt-5 w-50 mx-auto">
                            <input type="text" class="form-control" id="nameinput" placeholder="name@example.com" name="username" required>
                            <label for="nameinput"  >Name</label>
                </div>

                <div class="form-floating mb-3  w-50 mx-auto">
                            <input type="email" class="form-control" id="emailinput" placeholder="name@example.com" name="useremail" required>
                            <label for="emailinput"  >Email</label>
                </div>

                <div class="form-floating mb-3  w-50 mx-auto">
                            <input type="password" class="form-control" id="passwordinput" placeholder="name@example.com" name="userpassword" required>
                            <label for="passwordinput"  >Password</label>
                </div>

                <select class="form-select w-50 mx-auto" aria-label="Default select example" name="usergender" required>
                
                  
                        <option selected value="male">male</option>
                        <option value="female">female</option>
                        
            </select>

                        <div class="d-grid gap-2">
            <button class="btn btn-success w-50 mx-auto mt-3" name="add" type="submit">Create</button>
           
            </div>
    </form>

    <?php

        }
    ?>


                    <table class="table  mt-5">
                <thead class="table-dark">
                    <tr>
                        <th>user_id</th>
                        <th>User_name</th>
                        <th>User_email</th>
                        <th>User_gender</th>
                        <th>Created_at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $allusers = allData("select * from users");
                        $count_users = countData("select * from users");
                        foreach($allusers as $user)
                        {
                            ?>

                                <tr>
                                    <td><?=$user["user_id"]?></td>
                                    <td><?=$user["username"]?></td>
                                    <td><?=$user["useremail"]?></td>
                                    <td><?=$user["usergender"]?></td>
                                    <td><?=$user["created_at"]?></td>
                                   
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="./index.php?delete_id=<?=$user["user_id"]?>" type="button" class="btn btn-danger ">Delete</a>
                                        <a href="./index.php?edit_id=<?=$user["user_id"]?>" type="button" class="btn btn-primary ms-2">Edit</a>
                                        
                                        </div>
                                    </td>
                                </tr>
                            
                            <?php
                        }

                    ?>

                    <tr>
                        <th>All users: <?=$count_users?></th>
                    </tr>
                </tbody>
                </table>

     

    </div>

 
    


    <script src="./assets/js/app.js"></script>
</body>
</html>
