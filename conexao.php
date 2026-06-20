<?php
    $conn = mysqli_connect("localhost", "root", "", "projeto");
    if (!$conn) {
        echo "Erro: " . mysqli_connect_error();
    }
?>
