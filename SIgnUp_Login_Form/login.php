<?php
    session_start();
    
    
    $password = $email = $loginerror = "";
    
    if (isset($_POST["submit"])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(!empty($_POST["email"])){
                $email = clean_data($_POST["email"]);
            }
            if(!empty($_POST["password"])){
                $password = clean_data($_POST["password"]);
            }
            if($email==$_SESSION["email"] && $password==$_SESSION["password"]){
                // echo $_SESSION["password"] ;
    
                header("location: dashboard.php");
            }else{
                $loginerror =  "Incorrect email or password. Try again!<br>";
                // print_r($_SESSION);
            }
            

        }

        
    }

    function clean_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }

?>


<?php include("templates/header.php") ?>;

<section class="container grey-text">
    <h4 class="center">Welcome to our login page</h4>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" validate method="post" >
    <br>
    Email: <input type="email" name="email" required placeholder="Enter your registered email" autofocus="autofocus" value="<?php htmlspecialchars($email);?>"><br>
    <div style="color:red"><?php echo $errors["email"]; ?></div>
    Password: <input type="password" name="password" required placeholder="Enter password" value="<?php htmlspecialchars($name);?>"><br>
    <div class="center"> <?php echo $loginerror?> </div>
    <div style="color:red"><?php echo $errors["password"]; ?></div>
    <div class="center">
        <input type="submit" name="submit" value="submit" class="btn">
        <input type="reset" name="reset" value="reset" class="btn">
    </div>


    </form>
</section>


<?php include("templates/footer.php") ?>;

</html>