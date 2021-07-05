<?php
    
    session_start(); 
    $name = $email = $gender = $website = "";
    $errors = array("name"=>"", "email"=>"", "website"=>"", "phone_number"=>"", "confirm_pwd"=>"", "gender"=>"");
    
    if (isset($_POST["submit"])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // check name
        if(!empty($_POST["name"])){
            $name = clean_data($_POST["name"]);
            if(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
                $errors["name"] = "name must be letters and spaces only";
            }
        }
        // check email
        if(!empty($_POST["email"])){
            $email = clean_data($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors["email"] = "email is not valid";
            }
        }
        // check website
        if(!empty($_POST["website"])){
            $website = filter_var(clean_data($_POST["website"]), FILTER_SANITIZE_URL);
            
            // if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
            
                if(filter_var($website, FILTER_VALIDATE_URL)===false ){
                $errors["website"] = "Invalid URL";                
            }
        }
        // check phone
        if(!empty($_POST["phone_number"])){
            $phone_number = clean_data($_POST["phone_number"]);
            if(!preg_match("/^[0-9]{11}$/", $phone_number) ){
                $errors["phone_number"] = "Invalid phone number";                
            }
        }
        $gender = clean_data($_POST["gender"]);
        $password = clean_data($_POST["password"]);
        // check password consistency
        if( clean_data($_POST["password"])!== clean_data($_POST["confirm_pwd"]) ){
                $errors["confirm_pwd"] = "Passwords are not the same";                
            }
    }

    if(!array_filter($errors)){
        
        
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        if (isset($_SESSION["email"])){
        print_r($_SESSION);
        }
        if (isset($_SESSION["email"])){
            header("location: landingpage.php");

        }

        

        
    }

    } // END OF isset()

    function clean_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
    
?>


<?php include("templates/header.php") ?>;

<section class="container grey-text">
    <h4 class="center">Welcome to the sign up page</h4>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" validate method="post" >
    <br>
    <label for=""></label>
    Name: <input type="text" name="name" required placeholder="Your full name" value="<?php echo $name;?>" autofocus="autofocus" ><br>
    <div style="color:red"><?php echo $errors["name"]; ?></div>
    Email: <input type="text" name="email" required placeholder="Enter a valid email" value="<?php echo $email;?>"><br>
    <div style="color:red"><?php echo $errors["email"]; ?></div>
    Website: <input type="url" name="website" placeholder="Optional" value="<?php echo $website; ?>" ><br>
    <div style="color:red"><?php echo $errors["website"]; ?></div>
    Gender:
    <label>
    <input name="gender" type="radio" class="with-gap" required />
    <span>Female</span>
    </label>
    <label>
    <input name="gender" type="radio" class="with-gap" />
    <span>Male</span>
    </label>
    <label>
    <input name="gender" type="radio" class="with-gap" />
    <span>Other</span>
    </label><br>
    <hr>
    Phone Number: 
    <input type="tel" name="phone_number" required placeholder="080 XXXX XXXX"><br>
    <div style="color:red"><?php echo $errors["phone_number"]; ?></div>
    Passowrd:
    <input type="password" name="password" required placeholder="Create a password"><br>
    Confirm passowrd:
    <input type="password" name="confirm_pwd" required placeholder="Enter password again"><br>
    <div style="color:red"><?php echo $errors["confirm_pwd"]; ?></div>
    <div class="center">
        <input type="submit" name="submit" value="submit" class="btn">
        <input type="reset" name="reset" value="reset" class="btn">
    </div>
    
    
  
    
</form>

</section>









<?php include("templates/footer.php") ?>;
</html>
