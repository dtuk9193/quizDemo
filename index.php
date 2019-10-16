<?php 
    if(isset($_POST["name"])) {
        session_start();
        $_SESSION["name"] = $_POST["name"];
        header("location: " . "exam.php");
    }
?>

<html>
    <head> </head>
    <body>
        <form method="POST">
            Your Name:
            <input type="text" name="name" required>
            <br>
            <input type="submit" value="Start Exam">
        </form>
    </body>
</html>