<?php
$conn = mysqli_connect("localhost", "root", "", "service_car");

function registrasi($data)
{
    global $conn;

    $username = mysqli_real_escape_string($conn, $data['nama']);
    $email = strtolower(stripslashes($data['email']));
    $no_telepon = strtolower(stripslashes($data['no_telepon']));
    $message = mysqli_real_escape_string($conn, $data['pesan']);

    mysqli_query($conn, "INSERT INTO pesan VALUES ('', '$username', '$email','$no_telepon', '$message')");
    return mysqli_affected_rows($conn);
}
?>