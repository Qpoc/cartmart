<?php
    session_start();

    if (!isset($_SESSION['adminname'])) {
        header("location:admin_login.php");
    }
    

    require_once('php/navigation.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" href="../images/Icon/eco-bag.png">
    <link rel="stylesheet" href="css/edit_profile.css">
    <link rel="stylesheet" href="css/responsive/navigation-burger.css">
    <script src="script/onload.js"></script>
</head>
<body onload="showAdminInfo()">
    <header>
        <div class="wrapper">
            <div class="container">
                <div class="branding">
                    <label for="show-nav">
                        <img src="../images/Icon/menu.png" alt="" width="32">
                    </label>
                    <img src="../images/Icon/eco-bag.png" width="64" alt=""> 
                    <h2>CartMart</h2>
                </div>
            </div>
        </div>
    </header>
    <main>
        <?php
            get_navigation();
        ?>
        <div class='wrapper'>
            <h1>EDIT DETAILS</h1>
            <div class='container'>
                <div class='wrapper-profile'>
                    <div class="profile-pic">
                        <img id="profilePic" src="images/admin_profile/default.png" width="64" height="64" onclick="document.getElementById('profileImage').click();" title="preview"></img>
                        <form method="POST" action="php/admin/add_admin_profile.php" enctype="multipart/form-data">
                            <input type="file" name="adminImage" id="profileImage" onchange="showPreviewImage(event)">
                            <input type="submit" value="ADD PROFILE">
                        </form>
                    </div>
                </div>
                <form action="update_admin.php" method="POST">
                    <div class='container'>
                        <div class="information">
                            <input type="text" id="firstName" name="firstName" required>
                            <span>First Name</span>
                        </div>
                        <div class="information">
                            <input type="text" id="lastName" name="lastName" required>
                            <span>Last Name</span>
                        </div>
                        <div class="information">
                            <input type = "text" id = "mobileNumber" name = "mobileNumber" required>
                            <span>Mobile Number</span>
                        </div>
                        <div class="information">
                            <input type="email" id="emailAddress" name="emailAddress" required>
                            <span>Email Address</span>
                        </div>
                        <div class="button">
                            <input type="submit" value="Save Changes" name="submit" class = "submit-button">
                        </div>
                    
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer id="footer">
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
</body>
</html>