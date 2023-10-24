<?php
include('../../Model/db.php');
include("../Includes/head.includes.php");
session_start();

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
        <?php include("../Includes/sidebar.includes.php"); ?>
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
                            <div class="widget-content widget-content-area">

                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">User ID</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Date Created</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $record = getrecord('subscription', 'status', 'Pending');
                                            while ($subscription_record = mysqli_fetch_assoc($record)): ?>
                                                <tr>
                                                    <td><a data-bs-toggle="modal"
                                                            data-bs-target="#ViewMoreModal<?= $subscription_record['id'] ?>"
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
                                                    </td>
                                                    <td>
                                                        <?= $subscription_record['user_id'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $subscription_record['type'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $subscription_record['created_at'] ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light-danger">Rejected</span>
                                                        <span class="badge badge-light-success">Accept</span>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                            <!-- View More -->
                                            <div class="modal fade" id="ViewMoreModal<?= $subscription_record['id'] ?>"
                                                tabindex="-1" role="dialog" aria-labelledby="ViewMoreModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ViewMoreModalLabel">View More
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close">
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
                                                                data-bs-dismiss="modal"><i
                                                                    class="flaticon-cancel-12"></i>
                                                                Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tbody>
                                    </table>
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
