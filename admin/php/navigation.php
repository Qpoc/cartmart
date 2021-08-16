<?php

    function get_navigation(){

        $adminname = $_SESSION['adminname'];
        $email = $_SESSION['adminemail'];
        $img_path = "images/admin_profile/default.png";
        require_once('connection.php');
        $connection = new Connection();
        $con = $connection->get_connection();

        if (mysqli_connect_errno($con)) {
            die("An error occured while connecting: " . mysqli_connect_error());
        }else {
            $query = "SELECT adminimg FROM adminimg WHERE email = '$email'";

            if ($result = mysqli_query($con, $query)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $img_path = $row['adminimg'];
                    }
                }
            }
        }

        mysqli_close($con);

        echo "<input type='checkbox' id='show-nav' checked>
        <div class='navigation-wrapper'>
            <div class='navigation-container'>
                <ul>
                    <li>
                        <div class='profile'>
                            <div class='image'>
                                <img src='$img_path' alt=''>
                            </div>
                            <div class='name'>
                                <p>" . $adminname . "</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h5>REPORTS</h5>
                        <a href='admin_home.php'>
                            <div class='reports'>
                                <div class='image'>
                                    <img src='images/icon/reports.png' alt='' width='32'>
                                </div>
                                <div class='button'>
                                    <p>DASHBOARD</p>
                                </div>
                            </div>
                        </a>
                        <a href='sales.php'>
                        <div class='reports'>
                            <div class='image'>
                                <img src='images/icon/sales.png' alt='' width='32'>
                            </div>
                            <div class='button'>
                                <p>SALES</p>
                            </div>
                        </div>
                        </a>
                    </li>
                    <li>
                        <h5>MANAGE</h5>
                        <a href='user.php'>
                            <div class='reports'>
                                <div class='image'>
                                    <img src='images/icon/feedback.png' alt='' width='32'>
                                </div>
                                <div class='button'>
                                    <p>USERS</p>
                                </div>
                            </div>
                        </a>
                        <a href='admin.php'>
                            <div class='reports'>
                                <div class='image'>
                                    <img src='images/icon/admin.png' alt='' width='32'>
                                </div>
                                <div class='button'>
                                    <p>ADMIN</p>
                                </div>
                            </div>
                        </a>
                        <a href='rider.php'>
                            <div class='reports'>
                                <div class='image'>
                                    <img src='images/icon/rider.png' alt='' width='32'>
                                </div>
                                <div class='button'>
                                    <p>RIDER</p>
                                </div>
                            </div>
                        </a>
                        <a href='branch.php'> 
                            <div class='reports'>
                                <div class='image'>
                                    <img src='images/icon/branch.png' alt='' width='32'>
                                </div>
                                <div class='button'>
                                    <p>BRANCH</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <h5>PRODUCT</h5>
                        <a href='product_list.php'> 
                            <div class='reports'>
                                <div class='image'>
                                    <img src='images/icon/list.png' alt='' width='32'>
                                </div>
                                <div class='button'>
                                    <p>PRODUCT LIST</p>
                                </div>
                            </div>
                        </a>
                        <a href='category.php'> 
                            <div class='reports'>
                                <div class='image'>
                                    <img src='images/icon/category.png' alt='' width='32'>
                                </div>
                                <div class='button'>
                                    <p>CATEGORY</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <h5>SETTINGS</h5>
                        <a href='edit_profile.php'>
                        <div class='reports'>
                            <div class='image'>
                                <img src='images/icon/edit.png' alt='' width='32'>
                            </div>
                            <div class='button'>
                                <p>EDIT PROFILE</p>
                            </div>
                        </div>
                        </a>
                        <a href='php/logout.php'>
                        <div class='reports'>
                            <div class='image'>
                                <img src='images/icon/logout.png' alt='' width='32'>
                            </div>
                            <div class='button'>
                                <p>LOG OUT</p>
                            </div>
                        </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>";
    }


//     <li>
//     <h5>GAMIFICATION</h5>
//     <a href='challenges.php'> 
//         <div class='reports'>
//             <div class='image'>
//                 <img src='images/icon/gamification.png' alt='' width='32'>
//             </div>
//             <div class='button'>
//                 <p>CHALLENGES</p>
//             </div>
//         </div>
//     </a>
// </li>

?>