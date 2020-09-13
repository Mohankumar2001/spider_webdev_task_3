<?php

$servername = "localhost";
$username = "root";
$password = "";
$dBName = "user_details";

$conn = new mysqli($servername, $username, $password, $dBName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}