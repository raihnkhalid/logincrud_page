<?php

$conn = mysqli_connect("localhost", "root", "", "raihanpage");

if (!$conn){
    echo "Koneksi gagal!";
}