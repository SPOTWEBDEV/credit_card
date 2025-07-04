<?php


$domain = "http://localhost/credit_card/";

// $connection = mysqli_connect('localhost','root','','credit_card');


// if(!$connection){
//     die('Server Error => ERROR 500 ');
// }



// if(isset($_POST['register'])){

//     // grabing the user inputs
//     $email = $_POST['email'];
//     $username = $_POST['username'];
//     $password = $_POST['password'];


//     // checking if the input is empty
//     if(!empty($email) && !empty($username) && !empty($password)){

//         $hashing  = password_hash($password , PASSWORD_DEFAULT);

        

//         $statement  = "INSERT INTO `users`(username,email,password) VALUES ('$username','$email','$hashing')";

//         $query = mysqli_query($connection, $statement);


//         if($query){
//            echo "<script>
//            alert('Register Successful')
//            window.location.href = '../login/'

//            </script>";
//         }else{
//             echo "<script>alert('Something Went Wrong')</script>";
//         }



//     }else{
//         echo "<script>alert('Input is empty')</script>";
//     }






    
// }



?>