<?php
    session_start();

    date_default_timezone_set("Asia/Singapore");

    if (isset($_SESSION['sessionusername']) && isset($_SESSION['sessionpassword'])) {
        header("location:index.php");
    }

    require_once("php/createDB.php");
    require_once('php/navigation.php');

    $database = new CreateDB();
    
    if (isset($_SESSION['buynow'])) {
        unset($_SESSION['buynow']);
        unset($_SESSION['branchid']);
    }

    if (isset($_SESSION['category'])) {
        unset($_SESSION['category']);
    }

    if (isset($_SESSION['descriptionquantity'])) {
        unset($_SESSION['descriptionquantity']);
    }

    if (isset($_POST['transactionid'])) {
        $_SESSION['transactionid'] = $_POST['transactionid'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CartMart</title>
    <link rel="icon" href="images/Icon/eco-bag.png">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <script src="script/search.js"></script>
    <script src="script/product.js"></script>
</head>
<body>
    <header>
    <?php
        require_once('php/header.php');
    ?>
    </header>
    <main>
        <section>
            <form action="php/process_login.php" method="POST">
                <div class="login-view">
                    <div class="wrapper-login">
                        <div class="title">
                            <h1>Welcome to CartMart!</h1>
                        </div>
                        <div class="userinfo">
                            <input type='text' name='username' value='' required/>
                            <span>Username</span>
                        </div>
                        <div class="userinfo-2">
                            <input type='password' name='password' value='' required/>
                            <span>Password</span>
                        </div>
                        <div class="forgot">
                            <a href="#">Forgot password?</a>
                        </div>
                        <div class="buttons">
                            <button type="submit">LOG IN</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
<?php 
    get_navigation();
?>
</body>
</html>