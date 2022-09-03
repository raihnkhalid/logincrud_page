<?php
session_start();
include "koneksi.php";
if (!$_SESSION['fullname']) {
    header("Location:login.php");
}

if (isset($_POST['tambahdata'])) {
    $namalengkap = $_POST['namalengkap'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];

    $query = mysqli_query($conn, "INSERT INTO dataorang (namalengkap, umur, alamat) VALUES ('$namalengkap', '$umur', '$alamat')");
    if ($query) {
        header("Location:home.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
    <title>Home - Goreen</title>
    <style>
        input::-webkit-input-placeholder {
            color: #393434 !important;
        }

        body {
            background-color: #F0F0F0;
        }

        .welcome {
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 500;
            line-height: 28px;
        }

        .logout {
            float: left;
        }

        .tambah {
            float: right;
            background-color: #00AA13;
        }

        .edit {
            background-color: #CA6200 !important;
            border-color: #CA6200;
        }

        .edit:hover {
            background-color: #A44F00 !important;
            border-color: #A44F00;
            box-shadow: none !important;
        }

        .form-control {
            /* float: left; */
            margin-left: 24px;
            width: 86%;
            border: 1px solid #009611;
            border-radius: 9px;
        }

        .form-control:focus {
            border-color: #00AA13;
            box-shadow: 0 0 10px #00AA13;
        }

        .btn-success {
            background-color: #009511;
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 500;
            /* font-size: 14px; */
        }


        .btn-success:hover {
            background-color: #00780E;
        }
    </style>

</head>

<body>
    <script src="./assets/js/bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8 mt-3">
                <h1 class="text-center welcome card-title mt-5 mb-5">Hey, Welcome <?= $_SESSION['fullname'] ?>.</h1>
                <div class="card shadow-lg rounded border-success">
                    <div class="card-body">
                        <a href="logout.php" class="btn btn-danger logout shadow-lg" type="button">Logout</a>
                        <a href="" class="mb-3 btn btn-success tambah shadow-lg" type="button" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Lengkap</th>
                                    <th>Umur</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM dataorang");
                                $no = 1;
                                while ($row = mysqli_fetch_array($query)) {
                                ?>

                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $row['namalengkap'] ?></td>
                                        <td><?= $row['umur'] ?></td>
                                        <td><?= $row['alamat'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <a href="#editModal" type="button" data-bs-toggle="modal" data-id="<?= $row['id'] ?>" class="btn btn-success edit">Edit</a>
                                                <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger deleteBtn">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal fade mt-5" id="tambahModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input class="form-control mt-3 tmbb" type="text" name="namalengkap" placeholder="Nama Lengkap" autocomplete="off">
                        <input class="form-control mt-3 tmbb" type="number" min max="99" name="umur" placeholder="Umur" autocomplete="off">
                        <input class="form-control mt-3 tmbb" type="text" name="alamat" placeholder="Alamat" autocomplete="off">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="tambahdata">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL TAMBAH -->
    <!-- MODAL EDIT -->
    <div class="modal fade mt-5" id="editModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="body-edit"></div>
            </div>
        </div>
        <!-- END MODAL EDIT -->
        <script type="text/javascript">
            $(document).ready(function() {

                $('#editModal').on('show.bs.modal', function(e) {

                    var idx = $(e.relatedTarget).data('id');

                    //menggunakan fungsi ajax untuk pengambilan data

                    $.ajax({

                        type: 'post',

                        url: 'edit.php',

                        data: 'idx=' + idx,

                        success: function(data) {

                            $('.body-edit').html(data); //menampilkan data ke dalam modal

                        }

                    });

                });

            });
        </script>
        <script>
            $('.deleteBtn').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#009511',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!'
                
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    event.preventDefault();
                }
            })
        });
        </script>
</body>

</html>