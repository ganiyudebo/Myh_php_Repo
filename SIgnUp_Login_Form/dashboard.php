<?php
    session_start();

?>



<?php include("templates/dashboardheader.php") ?>;
    
    <h2 class="center">Welcome <?php echo $_SESSION["name"]; ?></h2>
    <h5 class="center">You are now logged in</h5>

<?php include("templates/footer.php") ?>;

</html>