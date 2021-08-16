<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_reg.css">
    <link rel="stylesheet" href="css/responsive/admin-reg-responsive.css">
    <script src="script/registration.js"></script>
    <title>Work with CartMart</title>
</head>
<body>
    <main>
        <div class="wrapper">
            <div class="background">
                <div class="title">
                    <img src="../images/Icon/eco-bag.png" alt="" width="64" height="64">
                    <h1>CartMart</h1>
                </div>
            </div>
            <div class="sign-up-form">
                <div class="wrapper-sign">
                    <form action="php/process_reg.php" method="POST" enctype="multipart/form-data">
                        <div class="title">
                            <h1>Work with CartMart</h1>
                        </div>
                        <div class="container">
                            <h5>Account Type:</h5>
                            <input type="radio" name="choose" id="admin" value="admin" onclick="isChecked()" required>
                            <label for="admin">
                                Admin
                            </label>
                            <input type="radio" name="choose" id="rider" value="rider" onclick="isChecked()" required>
                            <label for="rider">
                                Rider
                            </label>
                        </div>
                        <div class="container">
                            <p id="condition">
                                Applying for Admin requires a valid government issued ID showing citizenship and birth date, and to be at least 18 years old in order to work as an Individual admin on Cartmart.
                            </p>
                        </div>
                        <div class="container">
                            <div class="file-upload">
                                <label for="validID">
                                    Select a valid government ID
                                </label>
                                <input type="file" name="validID" id="validID" required>
                            </div>
                            <div class="info">
                                <input type="text" name="fname" required>
                                <span>First Name</span>
                            </div>
                            <div class="info">
                                <input type="text" name="lname" required>
                                <span>Last Name</span>
                            </div>
                            <div class="info">
                                <input type="email" name="email" required>
                                <span>Email Address</span>
                            </div>
                            <div class="info">
                                <input type="text" name="mobile" required>
                                <span>Mobile Number</span>
                            </div>
                            <div class="info">
                                <input type="password" name="password" id="password" onkeyup="isPasswordMatch(this.value, false)"  required>
                                <span>Password</span>
                            </div>
                            <div class="info">
                                <input type="password" name="confirmpass" id="confirmPass" onkeyup="isPasswordMatch(this.value, true)" required>
                                <span>Confirm Password</span>
                            </div>
                            <div class="info">
                                <p>By Clicking Next, you agree to these <a href="">Terms & Conditions</a></p>
                                <input type="submit" name="submit" value="NEXT">
                                <p>Already a member? <a href="admin_login.php">Sign in here</a> </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>