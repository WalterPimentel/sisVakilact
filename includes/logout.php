<?php

    include_once 'admin_session.php';

    $userSession = new UserSession();
    $userSession->closeSession();

    header("location: ../index.php");

?>