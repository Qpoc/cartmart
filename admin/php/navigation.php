<?php

    function get_navigation(){

        $adminname = $_SESSION['adminname'];

        echo "<input type='checkbox' id='show-nav' checked>
        <div class='navigation-wrapper'>
            <div class='navigation-container'>
                <ul>
                    <li>
                        <div class='profile'>
                            <div class='image'>
                                <img src='images/admin_profile/cyrus.jpg' alt=''>
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
                        <div class='reports'>
                            <div class='image'>
                                <img src='images/icon/sales.png' alt='' width='32'>
                            </div>
                            <div class='button'>
                                <p>SALES</p>
                            </div>
                        </div>
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


?>