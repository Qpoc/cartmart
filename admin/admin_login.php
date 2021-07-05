<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_login.css">
    <title>Work with CartMart</title>
</head>
<body>
    <header>
        <div class="wrapper">
            <div class="branding">
                <img src="../images/Icon/eco-bag.png" alt="" width="64" height="64">
                <h1>CartMart</h1>
            </div>
        </div>
    </header>
    <main>
        <div class="wrapper">
            <div class="container">
                <div class="text">
                    <h1>CartMart</h1>
                    <p>Welcome! Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt suscipit, architecto tempora, aperiam voluptas impedit a reiciendis libero nulla assumenda possimus nam quo, sapiente cumque velit repudiandae cum numquam sequi!</p>
                </div>
                <div class="form">
                    <div class="login">
                        <h2>Let's start our day!</h2>
                        <form action="php/process_log.php" method="POST">
                            <div class="info">
                                <input type="email" name="email" required>
                                <span>Email Address</span>
                            </div>
                            <div class="info">
                                <input type="password" name="password" required>
                                <span>Password</span>
                            </div>
                            <input type="submit" value="Sign in">
                            <div class="recovery">
                                <a href="">Forgot Password?</a>
                            </div>
                            <div class="recovery">
                                <p>Don't have an account yet? <a href="admin_reg.php">Work with us</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>