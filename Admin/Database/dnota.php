<?php
$conn = mysqli_connect("localhost", "root", "", "service_car");

function registrasi($data)
{
    global $conn;

    $name = mysqli_real_escape_string($conn, $data['nama']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $no_telpon = mysqli_real_escape_string($conn, $data['no_telepon']);
   
    
    // Check if username, Id_Admin, and No_Telepon already exist
    $result_name = mysqli_query($conn, "SELECT nama FROM invoice WHERE nama = '$name'");
    $result_email = mysqli_query($conn, "SELECT email FROM invoice WHERE email = '$email'");
    $result_no_telpon = mysqli_query($conn, "SELECT no_telepon FROM invoice WHERE no_telepon = '$no_telpon'");

    if (mysqli_fetch_assoc($result_name)) {
        echo "<script>alert('Nama sudah digunakan. Silakan gunakan Nama lain.');</script>";
        return false;
    }
    if (mysqli_fetch_assoc($result_email)) {
        echo "<script>alert('Email sudah digunakan. Silakan gunakan email lain.');</script>";
        return false;
    }
    if (mysqli_fetch_assoc($result_no_telpon)) {
        echo "<script>alert('No Telepon sudah digunakan. Silakan gunakan No Telepon lain.');</script>";
        return false;
    }

    // If everything is fine, proceed with the registration
    mysqli_query($conn, "INSERT INTO invoice (nama, email, no_telepon) VALUES ('$name', '$email','$no_telpon')");
    return mysqli_affected_rows($conn);
}
?>
