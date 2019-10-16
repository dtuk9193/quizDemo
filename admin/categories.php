
<?php
    //$categoryList = array('3', '4', '5');

    include_once('../database_connect.php');

    if(isset($_POST["newCategory"])) {
        //  insert into database
        insertData('CategoryTable', 'name', '"'. $_POST['newCategory']. '"');

        //$_POST["newCategory"];
        
    }
    if(isset($_POST["delete"])) {
        //  delete_from_database
        deleteData('CategoryTable', 'id='. $_POST['delete']);

    }
    //  load from database
    $categoryList = getData('CategoryTable');

?>

<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <h1> Category Management </h1>

    <form method="POST">
        <input type="text" name="newCategory" required>
        <input type="submit" value="add">
    </form>

    <form method="POST">
    <table class="category-list" border="1px">
        <thead>
            <tr>
                <td> Category</td>
                <td> Erase</td>
            </tr>
        </thead>
        <tbody>
        <?php foreach($categoryList as $category) {?>
            <tr>
                <td>
                    <?php echo $category['name']; ?>
                </td>
                <td>
                    <button name="delete" value="<?php echo $category['id']; ?>">&times;</button>
                </td>
            <tr>
        <?php }?>
        </tbody>
    </table>
    </form>
</body>
</html>