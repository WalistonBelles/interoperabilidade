<?php
    $servername = "localhost";
    $database = "interoperabilidade";
    $username = "root";
    $password = ""; //Se estiver em localhost e o banco de dados não possuir senha, deixe em branco.
    // Cria Conexão
    $conn = mysqli_connect($servername, $username, $password, $database);
?>