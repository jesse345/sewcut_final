<?php
include('../../Model/db.php');
include("../Includes/head.includes.php");
session_start();
$user = getallrecord('users');



if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

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
                <ul class="list-unstyled menu-categories" id="accordionViewMore">
                    <li class="menu">
                        <a href="dashboard.php" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span>Dashboard</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="subscribe.php" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                                <span>Subscribers</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                    </li>
                    <li class="menu active">
                        <a href="user.php" aria-expanded="true" class="dropdown-toggle">
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
                    <div id="tableSimple" class="col-lg-12 col-12 layout-spacing mt-5">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Contact Info</th>
                                            <th class="text-center" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($user1 = mysqli_fetch_assoc($user)):
                                            $users = mysqli_fetch_assoc(getrecord('user_details', 'id', $user1['id']));
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <div class="avatar me-2">
                                                            <img alt="avatar" src="../<?= $users['user_img'] ?>"
                                                                class="rounded-circle" style="background:white">
                                                        </div>
                                                        <div class="media-body align-self-center">
                                                            <h6 class="mb-0">
                                                                <?= ucfirst($users['firstname']) . ' ' . ucfirst($users['lastname']) ?>
                                                            </h6>
                                                            <span>
                                                                <?= $user1['email'] ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="mb-0">
                                                        Address:
                                                        <?= $users['address'] ?>
                                                    </p>
                                                    <p class="text-success">
                                                        Contact Number:
                                                        <?= $users['contact_number'] ?>
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <div class="action-btns">
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#ViewMoreModal<?= $user1['id'] ?>"
                                                            class="action-btn btn-view bs-tooltip me-2" data-placement="top"
                                                            title="View More" data-bs-original-title="View">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" class="feather feather-eye">
                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                </path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </a>
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#EditModal<?= $user1['id'] ?>"
                                                            class="action-btn btn-edit bs-tooltip me-2" title="Edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" class="feather feather-edit-2">
                                                                <path
                                                                    d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#DeleteModal<?= $user1['id'] ?>"
                                                            class="action-btn btn-delete bs-tooltip" data-placement="top"
                                                            title="Delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- View More -->
                                            <div class="modal fade" id="ViewMoreModal<?= $user1['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="ViewMoreModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ViewMoreModalLabel">View More</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <svg> ... </svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="modal-text">
                                                            <div class="row mb-4">
                                                                <div class="col">
                                                                    <label for="">Username</label>
                                                                    <input type="text" class="form-control"
                                                                        value="<?= $user1['username'] ?>" readonly>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="">Password</label>
                                                                    <input type="text" class="form-control"
                                                                        value="<?= $user1['password'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn btn-light-dark"
                                                                data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                                                Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit -->
                                            <div class="modal fade" id="EditModal<?= $user1['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="EditModalLabel">View More</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <svg> ... </svg>
                                                            </button>
                                                        </div>
                                                        <form action="../Controller/userController.php" method="POST">
                                                            <div class="modal-body">
                                                                <div class="row mb-4">
                                                                    <input type="hidden" name="user_id"
                                                                        value="<?= $user1['id'] ?>">
                                                                    <div class="col">
                                                                        <label for="">Firstname</label>
                                                                        <input type="text" name="firstname"
                                                                            class="form-control"
                                                                            value="<?= $users['firstname'] ?>">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Lastname</label>
                                                                        <input type="text" name="lastname"
                                                                            class="form-control"
                                                                            value="<?= $users['lastname'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col">
                                                                        <label for="">Address</label>
                                                                        <input type="text" name="address"
                                                                            class="form-control"
                                                                            value="<?= $users['address'] ?>">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Contact Number</label>
                                                                        <input type="text" name="contact"
                                                                            class="form-control"
                                                                            value="<?= $users['contact_number'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col">
                                                                        <label for="">Email</label>
                                                                        <input type="text" name="email" class="form-control"
                                                                            value="<?= $user1['email'] ?>">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Username</label>
                                                                        <input type="text" name="username"
                                                                            class="form-control"
                                                                            value="<?= $user1['username'] ?>">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Password</label>
                                                                        <input type="text" name="password"
                                                                            class="form-control"
                                                                            value="<?= $user1['password'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn btn-light-dark"
                                                                    data-bs-dismiss="modal"><i
                                                                        class="flaticon-cancel-12"></i>
                                                                    Close</button>
                                                                <button class="btn btn btn-primary"
                                                                    name="UPDATE">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete -->
                                            <div class="modal fade" id="DeleteModal<?= $user1['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="DeleteLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="DeleteLabel">Delete Record
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <svg> ... </svg>
                                                            </button>
                                                        </div>
                                                        <form action="../Controller/userController.php" method="POST">
                                                            <div class="modal-body">
                                                                <p class="modal-text">
                                                                    <center>
                                                                        <input type="hidden" name="user_id"
                                                                            value="<?= $user1['id'] ?>">
                                                                        <h4>Are you sure you want to delete this record?
                                                                        </h4>
                                                                    </center>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn btn-light-dark"
                                                                    data-bs-dismiss="modal"><i
                                                                        class="flaticon-cancel-12"></i>
                                                                    Discard</button>
                                                                <button class="btn btn btn-primary"
                                                                    name="DELETE">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
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
