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
    <link rel="stylesheet" href="css/admin_home.css">
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
        <div class="wrapper">
            <div class="container">
                <div class="title">
                    <h1>DASHBOARD</h1>
                </div>
                <div class="dashboard-report">
                    <div class="report">
                        <div class="text">
                            <h2>&#8369; 2556.56</h2>
                            <p>Total Sales</p>
                        </div>
                        <div class="image">
                            <img src="images/icon/sales.png" alt="" width="64">
                        </div>
                    </div>
                    <div class="report">
                        <div class="text">
                            <h2>&#8369; 2556.56</h2>
                            <p>Number of Products</p>
                        </div>
                        <div class="image">
                            <img src="images/icon/sales.png" alt="" width="64">
                        </div>
                    </div>
                    <div class="report">
                        <div class="text">
                            <h2>&#8369; 2556.56</h2>
                            <p>Number of Users</p>
                        </div>
                        <div class="image">
                            <img src="images/icon/sales.png" alt="" width="64">
                        </div>
                    </div>
                    <div class="report">
                        <div class="text">
                            <h2>&#8369; 2556.56</h2>
                            <p>Sales Today</p>
                        </div>
                        <div class="image">
                            <img src="images/icon/sales.png" alt="" width="64">
                        </div>
                    </div>
                </div>
                <div class="wrapper-chart">
                    <div class="container-chart">
                        <canvas id="mychart"></canvas>
                    </div>
                </div>
            </div>
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