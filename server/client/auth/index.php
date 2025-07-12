<?php

$out = $domain . 'login/';

if(isset($_SESSION['user_login'])){
         $id = $_SESSION['user_login'];

         $query = mysqli_query($connection, "SELECT * FROM `users` WHERE `id`='$id'");

         if(!mysqli_num_rows($query) > 0){
                  echo "<script>
                 alert('Session has expired')
                 window.location.href = '$out'
                 </script>";
         }

         $userDetail = mysqli_fetch_assoc($query);
}else{
         echo "<script>
                 alert('Session has expired')
                 window.location.href = '$out'
                 </script>";
}



?>