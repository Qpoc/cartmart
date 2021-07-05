<?php
    session_start();

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
</head>
<body>
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
            <form action="updateRow.php" method="POST" enctype="multipart/form-data">
                <div class='container'>
                    <div class="information">
                        <p>ID Picture</p>
                        <input type="file" name="idPicture" required>
                    </div>
                    <div class="information">
                        <p>Profile Picture</p>
                        <input type="file" name="profilePicture" required>
                    </div>
                    <div class="information">
                        <input type="text" name="firstName" required>
                        <span>First Name</span>
                    </div>
                    <div class="information">
                        <input type="text" name="lastName" required>
                        <span>Last Name</span>
                    </div>
                    <div class="information">
                        <input type = "text" name = "mobileNumber" required>
                        <span>Mobile Number</span>
                    </div>
                    <div class="information">
                        <input type="email" name="emailAddress" required>
                        <span>Email Address</span>
                    </div>
                    <div class="button">
                        <input type="submit" value="Save Changes" name="submit" class = "submit-button">
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer id="footer">
        <div id="footer-wrapper">
            <P>Copyright &copy; 2021 CartMart</P>
        </div>
    </footer>
    <script>
        let myChart = document.getElementById('mychart').getContext('2d');
        
        let massPopChart = new Chart(myChart, {
            type:'bar',
            data:{
                labels:['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets:[{
                    label:'Sales in Pesos',
                    data:[
                        "100",
                        "500",
                        "1000",
                        "5000",
                        "8505",
                    ]
                }]
            },
            options:{}
        });
    </script>
</body>
</html>