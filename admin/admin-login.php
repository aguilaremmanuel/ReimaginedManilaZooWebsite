<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/lr_styles.css">
    <title>Admin — Login</title>
    <link rel="icon" href="../admin/admin-logo.png">

    <style>
        header, .field {
            text-align: center;
        }

        .btn {
            background-color: #45BCC8;
        }

        .homeb {
            background-color: #F7A832;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="box form-box">
            <img id="logo" src="admin-logo.png" alt="Logo" />
            <?php 
                // echo "<img id='logo' src='images/admin-logo.png' alt='Logo' />";
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $defaultUser = "admin";
                    $defaultPassword = "admin";

                    if($username == $defaultUser && $password == $defaultPassword){
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        echo "<div class='message'>
                                <p>Invalid input!</p>
                              </div> <br>";
                        echo "<a href='admin-login.php'><button class='btn'>Go Back</button>";
                    }

                } else {
            ?>

            <header>Admin Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="employeeID">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
            </form>

            <div class="field">
                    <a href="../index.php"><button class="btn homeb">Go to Home</button></a>
            </div>
        </div>
        <?php } ?>
    </div>

</body>
</html>
