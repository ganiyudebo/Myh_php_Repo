<?php
 $conn = mysqli_connect('localhost','Ganiyu','1234','todo_list');

 if(!$conn){
     echo "unable to onnected" . mysqli_connect_error();
 }

 if(isset($_POST['update'])){
     $id = mysqli_real_escape_string($conn, $_POST['id_to_update']);
     
     $sql = "SELECT * FROM Tasks WHERE id=$id";
     
     $result = mysqli_query($conn, $sql);

     $singletask = mysqli_fetch_assoc($result);
 }

    $todo = $singletask['task'];
    $time = $singletask['start_task_at'];
    $duedate = $singletask['finish_task_by'];
    $errors = array("todo"=>"", "time"=>"", "duedate"=>"");

 if (isset($_POST["save"])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // check name
        if(!empty($_POST["todo"])){
            $todo = clean_data($_POST["todo"]);
            if(!preg_match("/^([0-9a-zA-Z-\s]+)(,\s*[a-zA-Z\s]*)*$/", $todo)){
                $errors["todo"] = "Can only be alphanumeric, comma-separated text";
            } else {
                // echo htmlspecialchars($todo);
            }
        } else {
            $errors["todo"] = "This field is compulsory";
        }
        // check email
        if(!empty($_POST["time"])){
            $time = clean_data($_POST["time"]);
            // echo htmlspecialchars($time);
        } else {
            $errors["time"] = "Task time must be filled";
        }
        // check website
        if(!empty($_POST["duedate"])){
            $duedate = clean_data($_POST["duedate"]);
            
            // if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
               // echo htmlspecialchars($duedate);
        } else {
            $errors["duedate"] = "A due date must be entered";
        }
        
    }

    if(!array_filter($errors)){
        
            
            $todo = mysqli_real_escape_string($conn, $todo);
            $time = mysqli_real_escape_string($conn, $time);
            $duedate = mysqli_real_escape_string($conn, $duedate);
            $id = mysqli_real_escape_string($conn, $_POST['id_to_update']);


            echo $todo;
            echo $time;

            // $sql = "INSERT INTO  Tasks(task,start_task_at,finish_task_by) VALUES ('$todo','$time','$duedate')";
            $sqlupdate = "UPDATE Tasks SET task='$todo', start_task_at='$time', finish_task_by='$duedate' WHERE id=$id ";

            // // save to db and check
            if(mysqli_query($conn, $sqlupdate)){
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


<div class="center"><h5>On this page you can modify your task </h5></div>
<!-- <?php if(!$singletask){
    echo "Invalid task. try again";
} ?> -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" validate method="post" >
    <br>
    Edit todo name: <input type = "text" name="todo" placeholder="<?php echo $singletask['task'] ;?>" value="<?php echo $todo; ?>" ><br>
    <div style="color:red"><?php echo $errors["todo"]; ?></div>
    Edit time for the task: <input type="time" name="time" value="<?php echo $time;?>"><br>
    <div style="color:red"><?php echo $errors["time"]; ?></div>
    Change completion due date: <input type="date" name="duedate" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $duedate;?>"><br>
    <div style="color:red"><?php echo $errors["duedate"]; ?></div>
    <input type="hidden" name="id_to_update" value="<?php echo $singletask['id'] ;?>" >
    <div class="center">
        <input type="submit" name="save" value="save" class="btn">
    </div>
    
    
  
    
</form>

