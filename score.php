<?php
    session_start();
    include_once('database_connect.php');

    $quiz = getData('QuestionTable');
    $correct_count = 0;
    for($i = 0; $i < count($quiz); $i++){
        if(intval($quiz[$i]['correct_answer']) === intval($_SESSION['answer'][$i])){
            $correct_count++; 
        }
    }
    $total = count($quiz);
    $_SESSION['total_count'] = $total;
    $_SESSION['correct_count'] = $correct_count;
    
?>

<!DOCTYPE html>
<html class="no-js" lang="en" ng-app="sweetLeads">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <h2> total: <?php echo $total ?> </h2>
    <h2> correct: <?php echo $correct_count ?> </h2>
    <form action='share.php'>
        <input type='submit' value='Share' />
    </form>
  </body>
</html>