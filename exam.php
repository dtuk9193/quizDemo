<?php
    session_start();
    
    if(!isset($_SESSION['name'])){
        header('location: index.php');
    }

    include_once('./database_connect.php');
    if(isset($_POST['question'])) {
        $question_number = $_POST['question'] + 1;
        $answer = '';
        if(isset($_POST['answer'])){
            $answer = $_POST['answer'];
        }
        $_SESSION['answer'][] = $answer;
        
    }
    else{
        $_SESSION['answer'] = array();
        $question_number = 0;
    }
    $question = getData('QuestionTable', '', $question_number, 1);
    if(count($question) === 0){
        if(question_number === 0){
            var_dump('error detected');
            exit();
        }

        $sql = implode(',', $_SESSION['answer']);

        header('location: score.php');
        //insertData('AnswerTable', 'customer_id, answer', $_SESSION['user_name']. ' , "'. $sql. '"');
        //insertData('AnswerTable', 'customer_id, answer', '3 , "'. $sql. '"');
    }
    $question = $question[0];

    //session_end();
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
    <div class='banner'>
        <h1>Open Eyes To The World!</h1>
    </div>
    <div class='row'>
        <form method='POST'>
            <label><?php echo $question['question'] ?></label><br>
            <div> 
                <?php 
                    $answers = json_decode($question['answers'], true);
                    for($i = 0; $i < count($answers); $i++) {
                        echo '<input type="radio" name="answer" value='. $i . ' />'. $answers[$i];
                        echo '<br>';
                    }
                ?> 
            </div>
            <input name='question' type='hidden' value=<?php echo $question_number ?> />
            <button type='submit'> Next </button>
        </form>
    </div>
  </body>
</html>