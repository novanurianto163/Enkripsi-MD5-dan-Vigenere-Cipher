 <?php  
 $connect = mysqli_connect("localhost", "root", "", "db_users");  
 session_start();  
 if(isset($_SESSION["username"]))  
 {  
      header("location:entry.php");  
 }  
 if(isset($_POST["register"]))  
 {  
      if(empty($_POST["username"]) && empty($_POST["password"]))  
      {  
           echo '<script>alert("Both Fields are required")</script>';  
      }  
      else  
      {  
           $username = mysqli_real_escape_string($connect, $_POST["username"]);  
           $password = mysqli_real_escape_string($connect, $_POST["password"]);  
           $password = md5($password);  

           // merubah key menjadi lowercase
          $pswd = strtolower("krypto");
          
          // inisialisasi variabel
          $text = $password;
          $ki = 0;
          $kl = strlen($pswd);
          $length = strlen($text);
          
          // iterasi baris
          for ($i = 0; $i < $length; $i++)
          {
               // jika alpabet akan dilakukan enkrip
               if (ctype_alpha($text[$i]))
               {
                    // uppercase
                    if (ctype_upper($text[$i]))
                    {
                         $text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("A")) % 26) + ord("A"));
                    }
                    
                    // lowercase
                    else
                    {
                         $text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("a")) % 26) + ord("a"));
                    }
                    
                    // update index kunci
                    $ki++;
                    if ($ki >= $kl)
                    {
                         $ki = 0;
                    }
               }
          }

           $query = "INSERT INTO t_user (username, password) VALUES('$username', '$text')";  
           if(mysqli_query($connect, $query))  
           {  
                echo '<script>alert("Registration Done")</script>';  
           }  
      }  
 }  
 if(isset($_POST["login"]))  
 {  
      if(empty($_POST["username"]) && empty($_POST["password"]))  
      {  
           echo '<script>alert("Both Fields are required")</script>';  
      }  
      else  
      {  
           $username = mysqli_real_escape_string($connect, $_POST["username"]);  
           $password = mysqli_real_escape_string($connect, $_POST["password"]);  
           $password = md5($password);  
           // merubah key menjadi lowercase
          $pswd = strtolower("krypto");
          
          // inisialisasi variabel
          $text = $password;
          $ki = 0;
          $kl = strlen($pswd);
          $length = strlen($text);
          
          //  iterasi baris
          for ($i = 0; $i < $length; $i++)
          {
               // jika alpabet akan dilakukan enkrip
               if (ctype_alpha($text[$i]))
               {
                    // uppercase
                    if (ctype_upper($text[$i]))
                    {
                         $text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("A")) % 26) + ord("A"));
                    }
                    
                    // lowercase
                    else
                    {
                         $text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("a")) % 26) + ord("a"));
                    }
                    
                    // update index kunci
                    $ki++;
                    if ($ki >= $kl)
                    {
                         $ki = 0;
                    }
               }
          }
           $query = "SELECT * FROM t_user WHERE username = '$username' AND password = '$text'";  
           $result = mysqli_query($connect, $query);  
           if(mysqli_num_rows($result) > 0)  
           {  
                $_SESSION['username'] = $username;  
                header("location:entry.php");  
           }  
           else  
           {  
                echo '<script>alert("Wrong User Details")</script>';  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>PHP Form Login dan Daftar menggunakan Enkripsi Password md5 dan Vigenere Cipher</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:500px;">  
                <h3 align="center">Form Login dan Daftar menggunakan Enkripsi Password MD5 dan Vigenere Cipher</h3>  
                <br />  
                <?php  
                if(isset($_GET["action"]) == "login")  
                {  
                ?>  
                <h3 align="center">Login</h3>  
                <br />  
                <form method="post">  
                     <label>Enter Username</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Enter Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" value="Login" class="btn btn-info" />  
                     <br />  
                     <p align="center"><a href="index.php">Register</a></p>  
                </form>  
                <?php       
                }  
                else  
                {  
                ?>  
                <h3 align="center">Register</h3>  
                <br />  
                <form method="post">  
                     <label>Enter Username</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Enter Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="register" value="Register" class="btn btn-info" />  
                     <br />  
                     <p align="center"><a href="index.php?action=login">Login</a></p>  
                </form>  
                <?php  
                }  
                ?>  
           </div>  
        </body>  
 </html>  