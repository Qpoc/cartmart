<?php
    session_start();

    require_once('php/navigation.php');

    if (!isset($_SESSION['rideremail'])) {
        header("location:../admin/admin_login.php");
    }

    if (isset($_SESSION['transactionid']) && isset($_SESSION['customerid'])) {
        unset($_SESSION['transactionid']);
        unset($_SESSION['customerid']);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rider_details.css">
    <link rel="stylesheet" href="css/navigation.css">
    <script src="script/utilities.js"></script>
    <script src="script/onload.js"></script>
    <title>CartMart</title>
</head>

<body id="body" onload="loadRiderDetails()">
    <main>
        <div class="navigation-container">
            <label for="navigation">
                <img src="images/icon/menu.png" alt="nav" width="32" height="32">
            </label>
        </div>
        <div class="wrapper">
            <div class="container" id="historyContainer">
                <div class="header" onclick="document.getElementById('profileImage').click();">
                    <form action="php/riderprofile/add_profile.php" method="post" enctype="multipart/form-data">
                        <div class="img">
                            <img src="images/rider_profile/default.png" id="riderimg" alt="" onclick="document.getElementById('profileImage').click();">
                            <input type="file" name="image" id="profileImage" onchange="showPreviewImage(event)">
                            <div class="edit">
                                <p>Edit</p>
                            </div>
                        </div>
                        <div class="guide">
                            <p>Tap to Change</p>
                        </div>
                        <input type="submit" id="btnSubmit">
                    </form>
                </div>
                <div class="content">
                    <form action="php/riderprofile/update_profile.php" method="post">
                        <div class="information">
                            <p>First Name</p>
                            <input type='text' id='fname' name='fname'>
                        </div>
                        <div class="information">
                            <p>Last Name</p>
                            <input type='text' id='lname' name='lname'>
                        </div>
                        <div class="information">
                            <p>Email</p>
                            <input type='email' id='email' name='email'>
                        </div>
                        <div class="information">
                            <p>Number</p>
                            <input type='text' id='number' name='mobile'>
                        </div>
                        <div class="information">
                            <p>Date of Application</p>
                            <input type='text' id='date' disabled>
                        </div>
                        <div class="button">
                            <input type="submit" value="EDIT CHANGES">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php
        navigation();
    ?>
</body>

</html>