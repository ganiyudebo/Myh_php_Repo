<?php
    $conn = mysqli_connect('localhost','Ganiyu','1234','todo_list');

    if(!$conn){
        echo "not onnected" . mysqli_connect_error();
    }


    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sqldel = "DELETE FROM Tasks WHERE id=$id_to_delete ";

        if(mysqli_query($conn, $sqldel) ){
            // echo "Successfully deleted";
            $message = "Successfully deleted";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    // write query for all data in table
    $sql = "SELECT * FROM Tasks ORDER BY start_task_at";

    // make query and get result
    $result = mysqli_query($conn,$sql);

    // fetch result into an associative array
    $data_array = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    // mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

    // print_r(explode(',',$data_array[0]['field_name']));
    // print_r($data);



?>

<?php include("todoheader.php") ?>;

<h4 class="center"> Todo Tasks</h4>

<?php if(mysqli_num_rows($result) == 0 ){
    echo "<div class='center'>You have no task yet but you can add new tasks!</div>";
} else {

echo ("<div class='container'>"
  ."<table>"
  ."<th class='taskwidth '>Action to take</th>    <th>Start at</th> <th>Complete by</th> <th>Modify task</th> <th>Delete task</th>");
    
    foreach($data_array as $data):
    echo("<tr>"
        ."<td><h7>" . htmlspecialchars($data['task']) . "</h7></td>"
        ."<td><h7>" . htmlspecialchars($data['start_task_at']). "</h7></td>"
        ."<td><h7>" . htmlspecialchars($data['finish_task_by']) ."</h7></td>"
        ."<td><form action='edittask.php' validate method='post'>"
        ."<input type='hidden' name='id_to_update' value='". $data['id']. "'>"
        ."<button type='submit' title='edit' name='update'><i class='fas fa-pen'></i></button>"
        ."</form></td>"
        ."<td><form action='". htmlspecialchars($_SERVER['PHP_SELF']). "' validate method='post'>"
        ."<input type='hidden' name='id_to_delete' value='". $data['id']."'>"
        ."<button type='submit' title='delete' name='delete'><i class='fas fa-trash'></i></button>"
        ."</form></td>"
    ."</tr>");

    endforeach;

  echo("</table>"
."</div>");
}
?>


<footer class="section">
        <div class="center grey-text"> <?php echo "Copyright " . date("Y") ?> </div>

    </footer>

</body>

</html>
