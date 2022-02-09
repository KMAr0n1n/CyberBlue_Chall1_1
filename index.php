<?php
    include 'config.php';
    error_reporting(0);


    session_start();
if (!isset($_SESSION['username'])){
    header("Location: login.php");
}

if (isset($_POST['submit'])){

    $user = $_SESSION['username'];
    $content = $_POST['content'];

    $sql = "INSERT INTO task_content (user, content)
            VALUES ('$user', '$content')";

    $result=mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Task Manager</title>
</head>
<body>
    
    <h1 style="text-align:center; font-family: Sans Serif" >Challenge 1_1</h1>
    <div class="container">
    <h2>Task</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="comment">Nội dung:</label>
            <input class="form-control input-lg" type="text" name="content" placeholder="Nhập nội dung task..." value="<?php echo "" ?>">
        </div>
        <button name="submit" class="btn btn-success">Submit</button>
    </form>
    </div>

    <div class="container">
    <div class="row justify-content-center">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nội dung task</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
            $user_ses = $_SESSION['username'];
                $sql_get = "SELECT * FROM task_content WHERE user = '$user_ses'";
                $result_get = mysqli_query($conn, $sql_get);
                while ($row = mysqli_fetch_assoc($result_get)):    
            ?>
            <tr>
                <td><?php echo $row['content']; ?></td>
                <td><a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">delete</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <a href="logout.php"><button class="btn btn-warning" >Logout</button></a>
    </div>
<?php

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $sql_del="DELETE FROM task_content WHERE id='$id'";
        $result_del = mysqli_query($conn, $sql_del);
        header("Location: index.php");
    }
?>
    
</body>
</html>