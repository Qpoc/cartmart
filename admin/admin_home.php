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
    <link rel="stylesheet" href="css/responsive/navigation-burger.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
    <script src="script/product.js"></script>
</head>
<body onload="salesToday()">
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
                    <a href="sales.php">
                        <div class="report">
                            <div class="text">
                                <h2 id="totalSalesMonth">0</h2>
                                <p>Monthly Total Sales</p>
                            </div>
                            <div class="image">
                                <img src="images/icon/sales.png" alt="" width="64">
                            </div>
                        </div>
                    </a>
                    <a href="product_list.php">
                        <div class="report">
                            <div class="text">
                                <h2 id="numProd"></h2>
                                <p>Number of Products</p>
                            </div>
                            <div class="image">
                                <img src="images/icon/sales.png" alt="" width="64">
                            </div>
                        </div>
                    </a>
                    <a href="user.php">
                        <div class="report">
                            <div class="text">
                                <h2 id="numUser"></h2>
                                <p>Number of Users</p>
                            </div>
                            <div class="image">
                                <img src="images/icon/sales.png" alt="" width="64">
                            </div>
                        </div>
                    </a>
                    <a href="sales.php">
                        <div class="report">
                            <div class="text">
                                <h2 id="salesToday">&#8369;0</h2>
                                <p>Sales Today</p>
                            </div>
                            <div class="image">
                                <img src="images/icon/sales.png" alt="" width="64">
                            </div>
                        </div>
                    </a>
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
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/sales/get_sales.php', true);
        xhr.onload = function(){
            if (this.status == 200) {
                if (this.responseText != '' && this.responseText != null) {
                    var data = JSON.parse(this.responseText);
                
                    for (var i in data) {
                        var salesForMonth = new Date();
                        var realSalesMonth = salesForMonth.toLocaleString('default', {month: 'long'})
                        var date = new Date(Date.parse(data[i].salesyear+ " " +data[i].monthSales));
                        var month = date.toLocaleString('default', {month: 'long'});
                        
                        let myChart = document.getElementById('mychart').getContext('2d');

                        if (realSalesMonth === month) {
                            document.getElementById('totalSalesMonth').innerHTML = "&#8369;" + data[i].totalsales;
                        }

                        let massPopChart = new Chart(myChart, {
                            type:'bar',
                            data:{
                                datasets:[{
                                    label:'Sales in Pesos',
                                }]
                            },
                            options:{}
                        });

                        massPopChart.data.labels.push(month);
                        massPopChart.data.datasets.forEach((dataset) => {
                            dataset.data.push(data[i].totalsales);
                        });
                        massPopChart.update();
                    }
                 
                }
            }
        }

        xhr.send();

    </script>
</body>
</html>