<?php
include('../../Model/db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$verify = countVerify();
$notVerify = countNotVerify();
$users = countAllUser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SEWCUT | DASHBOARD </title>
    <link rel="icon" type="image/x-icon" href="../src/assets/img/favicon.ico" />
    <link href="../layouts/collapsible-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="../layouts/collapsible-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="../layouts/collapsible-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../layouts/collapsible-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../layouts/collapsible-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="../src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="../src/assets/css/light/components/list-group.css" rel="stylesheet" type="text/css">
    <link href="../src/assets/css/light/dashboard/dash_2.css" rel="stylesheet" type="text/css" />

    <link href="../src/assets/css/dark/components/list-group.css" rel="stylesheet" type="text/css">
    <link href="../src/assets/css/dark/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body class="alt-menu">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->

    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">
                    <div class="nav-logo">

                        <div class="nav-item theme-text" style="margin-left:26px;">
                            <a href=" ./index.html" class="nav-link"> SEWCUT </a>
                        </div>
                    </div>
                </div>
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu active">
                        <a href="dashboard.php" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="subscribe.php" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                                <span>Subscribers</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="user.php" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-pen-tool">
                                    <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                                    <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                                    <path d="M2 2l7.586 7.586"></path>
                                    <circle cx="11" cy="11" r="2"></circle>
                                </svg>
                                <span>Users</span>
                            </div>
                        </a>
                    </li>
                    <form action="../Controller/loginController.php" method="POST">
                        <li class="menu">
                            <a aria-expanded="false" class="dropdown-toggle">
                                <button type="submit" name="LOGOUT" style="border:none;background-color:transparent">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-log-out">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span style="    color: #bfc9d4;">Logout </span>
                                    </div>
                                </button>
                            </a>
                        </li>
                    </form>
                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content" style="margin-top:5px;">
            <div class="layout-px-spacing">
                <div class="middle-content container-xxl p-0">
                    <div class="row layout-top-spacing">
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-chart-two">
                                <div class="widget-heading">
                                    <h5 class="">Sales by Category</h5>
                                </div>
                                <div class="widget-content">
                                    <div id="chart-2" class=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-table-two" style="height: 447px;max-height: 447px;">

                                <div class="widget-heading">
                                    <h5 class="">Recent Orders</h5>
                                </div>

                                <div class="widget-content">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="th-content">Customer</div>
                                                    </th>
                                                    <th>
                                                        <div class="th-content">Product</div>
                                                    </th>
                                                    <th>
                                                        <div class="th-content">Invoice</div>
                                                    </th>
                                                    <th>
                                                        <div class="th-content th-heading">Price</div>
                                                    </th>
                                                    <th>
                                                        <div class="th-content">Status</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="td-content customer-name"><img
                                                                src="../src/assets/img/profile-13.jpeg"
                                                                alt="avatar"><span>Luke Ivory</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-brand text-primary">Headphone
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-invoice">#46894</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">$56.07</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content"><span
                                                                class="badge badge-success">Paid</span></div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="td-content customer-name"><img
                                                                src="../src/assets/img/profile-7.jpeg"
                                                                alt="avatar"><span>Andy King</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-brand text-warning">Nike Sport
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-invoice">#76894</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">$88.00</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content"><span
                                                                class="badge badge-primary">Shipped</span></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="td-content customer-name"><img
                                                                src="../src/assets/img/profile-10.jpeg"
                                                                alt="avatar"><span>Laurie Fox</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-brand text-danger">Sunglasses
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-invoice">#66894</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">$126.04</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content"><span
                                                                class="badge badge-success">Paid</span></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="td-content customer-name"><img
                                                                src="../src/assets/img/profile-5.jpeg"
                                                                alt="avatar"><span>Ryan Collins</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-brand text-warning">Sport</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-invoice">#89891</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">$108.09</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content"><span
                                                                class="badge badge-primary">Shipped</span></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="td-content customer-name"><img
                                                                src="../src/assets/img/profile-4.jpeg"
                                                                alt="avatar"><span>Irene Collins</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-brand text-primary">Speakers
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-invoice">#75844</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">$84.00</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content"><span
                                                                class="badge badge-danger">Pending</span></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-table-one">
                                <div class="widget-heading">
                                    <h5 class="">Summary</h5>
                                    <div class="task-action">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-horizontal">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="19" cy="12" r="1"></circle>
                                                    <circle cx="5" cy="12" r="1"></circle>
                                                </svg>
                                            </a>

                                            <div class="dropdown-menu left" aria-labelledby="pendingTask"
                                                style="will-change: transform;">
                                                <a class="dropdown-item" href="javascript:void(0);">View Report</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Edit Report</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Mark as Done</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content">
                                    <div class="transactions-list t-info">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="avatar">
                                                        <span class="avatar-title">TR</span>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4>Total Revenue</h4>
                                                </div>
                                            </div>
                                            <div class="t-rate rate-inc">
                                                <p><span>P36.11</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="transactions-list t-info">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="avatar">
                                                        <span class="avatar-title">U</span>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4>Users</h4>
                                                </div>
                                            </div>
                                            <div class="t-rate rate-inc">
                                                <p><span>
                                                        <?php echo $users['users'] ?>
                                                    </span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="transactions-list">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="avatar">
                                                        <span class="avatar-title">S</span>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4>Subscribers</h4>
                                                </div>
                                            </div>
                                            <div class="t-rate rate-inc">
                                                <p><span>66.44</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="transactions-list t-info">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="avatar">
                                                        <span class="avatar-title">SO</span>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4>Successful Order</h4>
                                                </div>
                                            </div>
                                            <div class="t-rate rate-inc">
                                                <p><span>10.08</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transactions-list t-info">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="avatar">
                                                        <span class="avatar-title">V</span>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4>Verified</h4>
                                                </div>
                                            </div>
                                            <div class="t-rate rate-inc">
                                                <p><span>
                                                        <?php echo $verify['verify'] ?>
                                                    </span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transactions-list t-info">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="avatar">
                                                        <span class="avatar-title">NV</span>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4>Not Verified</h4>
                                                </div>
                                            </div>
                                            <div class="t-rate rate-inc">
                                                <p><span>
                                                        <?php echo $notVerify['verify'] ?>
                                                    </span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  BEGIN FOOTER  -->
            <!--  END CONTENT AREA  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../src/plugins/src/mousetrap/mousetrap.min.js"></script>
    <script src="../src/plugins/src/waves/waves.min.js"></script>
    <script src="../layouts/collapsible-menu/app.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="../src/plugins/src/apex/apexcharts.min.js"></script>
    <script src="../src/assets/js/dashboard/dash_2.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

</html>
