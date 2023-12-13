<?php

    session_start();

    session_unset();
    session_destroy();

    //$conn->close();   //closes your database connection

    // redirect to application home or login page
    header("Location: ../login.php");

?>