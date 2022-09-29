<?php

$conn = mysqli_connect("localhost", "root", "", "chat_app");

if (!$conn) :
    die("Error Connecting".mysqli_connect_error($conn));
endif;