
<?php
    include_once('../database_connect.php');

    if(isset($_POST["delete"])) {
        //  delete_from_database
        deleteData('QuestionTable', 'id='. $_POST['delete']);
    }

    if(isset($_POST["quiz"]) && isset($_POST["category"])) {
        $quiz = $_POST["quiz"];
        $category = $_POST["category"];
        $answers = $_POST["answers"];
        $correct = $_POST["correct"];

        if($answers == NULL || $correct == NULL) {
            if($answers == NULL) {  ?>
                <div class="error"> There's no answer list </div>
            <?php }
            if($correct == NULL) { ?>
                <div class="error"> There's no correct answer </div>
            <?php }
        } else {
            insertData('QuestionTable', 'category_id, question, correct_answer, answers'
                        , $category. ' , "' . $quiz . '" , '. $correct . ", '" . json_encode($answers) . "'");
        }
    }
    $questions = getData('QuestionTable');
    $categoryList = getData("CategoryTable", '', NULL, NULL, true);
?>

<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>


<?php if ($categoryList !== NULL ) {?>
    <h1> Add New Quiz </h1>
    <h2> Quiz and Answer Management </h2>
    <form method="POST">
        Quiz:
        <input type="text" name="quiz" required>
        Category:
        <select name="category">
            <?php foreach($categoryList as $category) { ?>
                <option value="<?php echo $category["id"]; ?>"> <?php echo $category["name"]; ?> </option>
            <?php }?>
        </select>
        <br>
        <br>
        <input type="button" value="Add New Answer" onclick="add_new_answer()">
        <br>
        
        <br>
        Answers:
        <table>
            <thead>
                <tr>
                    <td> Correct</td>
                    <td> Answer</td>
                </tr>
            </thead>
            <tbody id="answer-list">
            </tbody>
        </table>
        
        <br><br>
        <input type="submit" value="Submit new Quiz">
    </form>
    
    <hr>

    <h2> Questions </h2>
    <form method="POST">
    <table class="question-list" border="1px">
        <thead>
            <tr>
                <td> Quiz</td>
                <td> Category</td>
                <td> Answer</td>
                <td> Erase</td>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($questions as $question) {?>
            <tr>
                <td>
                    <?php echo $question['question']; ?>
                </td>
                <td>
                    <?php echo $categoryList[ $question['category_id'] ]['name']; ?>
                </td>
                <td>
                    <?php 
                        $answers = json_decode($question['answers']); 
                        $correct = $question['correct_answer'];
                        $i  = 0;
                        foreach($answers as $answer) {
                    ?>
                        <div class="<?php echo $i++==$correct ? 'correct' : ''; ?>"> <?php echo $answer; ?> </div>
                    <?php } ?>
                </td>
                <td>
                    <button name="delete" value="<?php echo $question['id']; ?>">&times;</button>
                </td>
            <tr>
        <?php }?>
        </tbody>
    </table>
    </form>
<?php } else { ?>
    <div class="error"> There's no category list </div>
<?php } ?>
    <script>
        var radioIndex = 0;

        function add_new_answer() {
            var newTr = document.createElement('tr');
            var inputTd = document.createElement('td');
            var radioTd = document.createElement('td');

            var newInput = document.createElement('input');
            var newRadio = document.createElement('input');

            var answerList =document.getElementById('answer-list');
            
            newInput.type = 'text';
            newInput.name = `answers[${radioIndex}]`;

            newRadio.type = 'radio';
            newRadio.value = radioIndex;
            newRadio.name = 'correct';
            radioIndex ++ ;

            inputTd.appendChild(newInput);
            radioTd.appendChild(newRadio);

            newTr.appendChild(radioTd);
            newTr.appendChild(inputTd);

            answerList.appendChild(newTr);
        }
    </script>

</body>
</html>