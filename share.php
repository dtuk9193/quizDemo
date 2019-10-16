<?php 
    include_once('database_connect.php');

    session_start();
    $name = $_SESSION["name"];
    $answers = implode(',', $_SESSION["answers"]);
    $correct_count = $_SESSION["correct_count"];
    $total_count = $_SESSION["total_count"];
    
    insertData('ScoreTable', 'username, answer, correct_count, total_count',
                   '"' . $name . '", "'. $answers . '", ' . $correct_count . ', ' . $total_count);
    // scores table

    $test_info = getData('ScoreTable');
    session_unset();
?>

<html>
    <head> 
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
        <h1> Score </h1>
        <table border = "1px">
            <thead>
                <tr>
                    <td> Name </td>
                    <td> Score</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($test_info as $each_info) {?>
                <tr>
                    <td> <?php echo $each_info['username'] ?> </td>
                    <td> <?php echo $each_info['correct_count']."/".$each_info['total_count']?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>