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
    <link rel="stylesheet" href="css/challenges.css">
    <script src="script/onload.js"></script>
</head>
<body onload="">
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
                    <select name="" id="">
                        <option value="" selected hidden>Challenges For</option>
                        <option value="rider">Buyer</option>
                        <option value="rider">Rider</option>
                    </select>
                </div>
                <form action="create_challenge.php" method="POST">
                    <div class='container'>
                        <div class="information">
                            <input type="text" id="title" name="title" required>
                            <span>Title</span>
                        </div>
                        <div class="information">
                            <input type="text" id="condition" name="condition" required>
                            <span>Condition</span>
                        </div>
                        <div class="information">
                            <input type = "text" id = "reward" name = "rewards" required>
                            <span>Rewards</span>
                        </div>
                        <div class="information">
                            <input id="startdate" name="startdate" placeholder="Start Date" class="textbox-n" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" required />
                        </div>
                        <div class="information">
                            <input id="expdate" name="expdate" placeholder="Expiry Date" class="textbox-n" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" required />
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