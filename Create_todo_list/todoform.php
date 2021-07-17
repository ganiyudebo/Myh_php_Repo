<?php
    
    $conn = mysqli_connect('localhost','Ganiyu','1234','todo_list');

    if(!$conn){
        echo "unable to onnected" . mysqli_connect_error();
    }

    $todo = $time = $duedate = "";
    $errors = array("todo"=>"", "time"=>"", "duedate"=>"");
    
    if (isset($_POST["add"])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // check name
        if(!empty($_POST["todo"])){
            $todo = clean_data($_POST["todo"]);
            if(!preg_match("/^([0-9a-zA-Z-\s]+)(,\s*[a-zA-Z\s]*)*$/", $todo)){
                $errors["todo"] = "Can only be alphanumeric, comma-separated text";
            } else {
                echo htmlspecialchars($todo);
            }
        } else {
            $errors["todo"] = "This field is compulsory";
        }
        // check email
        if(!empty($_POST["time"])){
            $time = clean_data($_POST["time"]);
            echo htmlspecialchars($time);
        } else {
            $errors["time"] = "Task time must be filled";
        }
        // check website
        if(!empty($_POST["duedate"])){
            $duedate = clean_data($_POST["duedate"]);
            
            // if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
                echo htmlspecialchars($duedate);
        } else {
            $errors["duedate"] = "A due date must be entered";
        }
        
    }

    if(!array_filter($errors)){
            $todo = mysqli_real_escape_string($conn, $todo);
            $time = mysqli_real_escape_string($conn, $time);
            $duedate = mysqli_real_escape_string($conn, $duedate);

            $sql = "INSERT INTO  Tasks(task,start_task_at,finish_task_by) VALUES ('$todo','$time','$duedate')";

            // save to db and check
            if(mysqli_query($conn, $sql)){
                echo "Update success";
                header("location: tasktable.php");
            } else {
                echo "there is an error: " .mysqli_error(); 
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


<?php include("todoheader.php"); ?>

<section class="container grey-text">
    <h4 class="center">You can add your to-do lists on this page</h4>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" validate method="post" >
    <br>
    Todo: <input type = "text" name="todo" placeholder="Enter your todo task here." value="<?php echo $todo; ?>" ><br>
    <div style="color:red"><?php echo $errors["todo"]; ?></div>
    Time for the task: <input type="time" name="time" placeholder="Time to start the task" value="<?php echo $time;?>"><br>
    <div style="color:red"><?php echo $errors["time"]; ?></div>
    Completion due date: <input type="date" name="duedate" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $duedate;?>"><br>
    <div style="color:red"><?php echo $errors["duedate"]; ?></div>
    <div class="center">
        <input type="submit" name="add" value="add" class="btn">
    </div>
    
</form>

</section>

<footer class="section">
        <div class="center grey-text"> <?php echo "Copyright " . date("Y") ?> </div>

    </footer>

</body>

</html>
