<?php
if (isset($_POST['submit'])) {
    include "connection.php";
    
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    
    $sql = "SELECT * FROM users WHERE username=? OR email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo '<script>
                    alert("Invalid username or password!!");
                    window.location.href = "login.php";
                  </script>';
        }
    } else {
        echo '<script>
                alert("Invalid username or password!!");
                window.location.href = "login.php";
              </script>';
    }

    $stmt->close();
    $conn->close();
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href = "style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
     include "navbar.php"
    ?>
    <div id="form">
    <h1>Login Form</h1>
    <form name="form" action="login.php" method="POST">
       <lebel> Enter Username/Email</label>
       <input type="text" id="user" name="user" required><br><br>
       <lebel> Enter Password</label>
       <input type="password" id="pass" name="pass" required><br><br>
       <input type="submit" id="btn" value="Login" name="submit"/>
      </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>