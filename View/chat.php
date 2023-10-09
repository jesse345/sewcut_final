<?php
include("../Model/dbPDO.php");
session_start();


if (!isset($_SESSION['id'])) {
    echo "
        <script>
            alert('Invalid Request! Login First');
            window.location.href = '../index.php';
        </script>
    ";
} else {
    if (!empty($_GET['user'])) {
        $chatWith = getUser($connection, $_GET['user']);
        if (empty($chatWith)) {
            header("Location: index.php");
            exit;
        }
        $chats = getChats($_SESSION['id'], $chatWith['id'], $connection);
        opened($chatWith['id'], $connection, $chats);
        $last = last_seen($chatWith['last_seen']);

    }
    # Getting User data data
    $user = getUser($connection, $_SESSION['id']);
    # Getting User conversations
    $conversations = getConversation($user['id'], $connection);
    // echo json_encode($conversations);


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../layouts/head.layout.php") ?>
    <title>Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .scrollmsg {
            overflow: hidden;
            overflow-y: scroll;
            height: 65vh;
            display: flex;
            flex-direction: column-reverse;
        }

        .row>* {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        .alert-primary {
            background-color: #0d6efd !important;
            color: #fff !important
        }

        a {
            text-decoration: none;
        }

        .fs-xs {
            font-size: 1rem;
        }

        small {
            color: #bbb;
            font-size: 0.7rem;
            text-align: right;
        }
    </style>
</head>

<body>
    <?php
    $user = getUser($connection, $_SESSION['id']);
    ?>
    <div class="page-wrapper">
        <!-- include("../layouts/header_layout.php");  -->
        <section>
            <div class="container py-4 mt-1">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card" style="height:581px;">
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION['id'])) {
                                    ?>
                                    <div class="input-group mb-3">
                                        <input type="text" placeholder="Search..." id="searchText" class="form-control">
                                        <button class="btn btn-primary" id="searchBtn"><i class="fa fa-search"></i></button>
                                    </div>
                                <?php } ?>

                                <ul class="list-unstyled mb-0 overflow-auto" id="chatList">
                                    <?php if (!empty($conversations)) { ?>
                                        <?php
                                        foreach ($conversations as $conversation) { ?>
                                            <li class="list-group-item">
                                                <a href="chat.php?user=<?php echo $conversation['id'] ?>"
                                                    class="d-flex justify-content-between align-items-center p-2">
                                                    <div class="d-flex align-items-center">
                                                        <img src="../img/<?php echo $conversation['user_img'] ?>"
                                                            class="w-10 rounded-circle" style="height:70px;">
                                                        <h3 class="fs-xs m-2">
                                                            <?php echo ucfirst($conversation['firstname']) . ' ' . ucfirst($conversation['lastname']) ?><br>
                                                            <small>
                                                                <?php
                                                                echo lastChat($_SESSION['id'], $conversation['id'], $connection);
                                                                ?>
                                                            </small>
                                                        </h3>
                                                    </div>
                                                    <?php if (last_seen($conversation['last_seen']) == "Active") { ?>
                                                        <div title="online">
                                                            <div class="online"></div>
                                                        </div>
                                                    <?php } ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="alert alert-info text-center">
                                            <i class="fa fa-comments d-block fs-big"></i>
                                            No messages yet, Start the conversation
                                        </div>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card" style="height:580px;">
                            <div class="card-header" style="border-top: 4px solid #0d6efd;">
                                <div class="d-flex">
                                    <?php
                                    if (!empty($_GET['user'])) {
                                        ?>
                                        <img src="../img/<?php echo $chatWith['user_img'] ?>" class="rounded-circle1"
                                            style="height:70px;">
                                        <h3 class="display-4 fs-sm m-2"
                                            style="font-size:18px;color: #000;font-weight: 700;">
                                            <?php echo ucfirst($chatWith['firstname']) . '  ' . ucfirst($chatWith['lastname']) ?>
                                            <br>
                                            <div class="d-flex
                                                        align-items-center" title="online">
                                                <?php
                                                if (last_seen($chatWith['last_seen']) == "Active") {
                                                    ?>
                                                    <div class="online"></div>
                                                    <small class="d-block p-1" style="font-size:14px;">Online</small>
                                                <?php } else { ?>
                                                    <small class="d-block p-1" style="font-size:14px;">
                                                        Last seen:
                                                        <?php echo last_seen($chatWith['last_seen']) ?>
                                                    </small>
                                                <?php } ?>
                                            </div>
                                        </h3>
                                    <?php } else { ?>
                                        <h3>Chat Messages</h3>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--END END END-->
                            <div class="scrollmsg">
                                <div class="card-body" data-mdb-perfect-scrollbar="true" id="chatBox">
                                    <?php

                                    if (!empty($chats)) {
                                        foreach ($chats as $chat) {
                                            if ($chat['from_id'] == $_SESSION['id']) {

                                                ?>
                                                <div class="d-flex justify-content-end">
                                                    <p class="small float-right">
                                                        <?php echo ucfirst($user['firstname']) . ' ' . ucfirst($user['lastname']) ?>
                                                    </p>
                                                </div>
                                                <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                                    <div>
                                                        <p class="small p-2 me-3 mb-3 text-white rounded-3 bg-primary">
                                                            <?php echo $chat['message'] ?>
                                                        </p>
                                                    </div>
                                                    <img src="<?php echo $user['user_img'] ?>" alt="avatar 1"
                                                        style="width: 45px; height: 100%;">
                                                </div>
                                            <?php } else { ?>

                                                <div class="d-flex justify-content-start">
                                                    <p class="small mb-1">
                                                        <?php echo ucfirst($chatWith['firstname']) . ' ' . ucfirst($chatWith['lastname']) ?>
                                                    </p>
                                                </div>
                                                <div class="d-flex flex-row justify-content-start">
                                                    <img src="<?php echo $chatWith['user_img'] ?>" alt="avatar 1"
                                                        style="width: 45px; height: 100%;">
                                                    <div>
                                                        <p class="small p-2 ms-3 mb-3 text-white rounded-3 bg-primary">
                                                            <?php echo $chat['message'] ?>
                                                    </div>
                                                </div>
                                            <?php }
                                        }
                                    } else { ?>
                                        <div class="alert alert-primary text-center">
                                            <i class="fa fa-comments d-block fs-big"></i>
                                            No messages yet, Start the conversation
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--END END END-->
                            <?php
                            if (isset($_SESSION['id'])) {
                                if (!empty($_GET['user'])) {
                                    ?>
                                    <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                                        <div class="input-group mb-0">
                                            <input type="hidden" id="to_id" value="<?php echo $chatWith['id'] ?>">
                                            <input type="text" class="form-control" id="message" placeholder="Type message"
                                                style="width:569px;" />
                                            <button type="submit" class="btn btn-primary" id="sendBtn"
                                                style="padding-top: .55rem;">Send</button>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>










        <?php include("../layouts/footer.layout1.php"); ?>
    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    var scrollDown = function () {
        let chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    scrollDown();

    $(document).ready(function () {
        // Search
        $("#searchText").on("input", function () {
            var searchText = $(this).val();
            if (searchText == "") return;
            $.post('../Controller/searchController.php',
                {
                    key: searchText
                },
                function (data, status) {
                    $("#chatList").html(data);
                });

        });
        // Search using the button
        $("#searchBtn").on("click", function () {
            var searchText = $("#searchText").val();
            if (searchText == "") return;
            $.post('../Controller/searchController.php',
                {
                    key: searchText
                },
                function (data, status) {
                    $("#chatList").html(data);
                });

        });





        let lastSeenUpdate = function () {
            $.get("../Controller/updateLastSeen.php");
        }
        lastSeenUpdate();
        setInterval(lastSeenUpdate, 10000);



    });
</script>
<script>
    var scrollDown = function () {
        let chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    scrollDown();

    $(document).ready(function () {
        to_id = $("#to_id").val();

        $("#sendBtn").on('click', function () {
            message = $("#message").val();

            if (message == "") return;

            $.post("../Controller/insertController.php",
                {
                    message: message,
                    to_id: to_id
                },
                function (data, status) {
                    $("#message").val("");
                    $("#chatBox").append(data);
                    scrollDown();
                });
        });
        // auto refresh / reload
        let fechData = function () {
            $.post("../Controller/getMessageController.php",
                {
                    id_2: to_id
                },
                function (data, status) {
                    $("#chatBox").append(data);
                    if (data != "") scrollDown();
                });
        }

        fechData();
        /** 
        auto update last seen 
        every 0.5 sec
        **/
        // setInterval(fechData, 1000);

    });
</script>
</body>

</html>
