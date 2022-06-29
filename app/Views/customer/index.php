<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<!-- Flashdata -->
<div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('berhasil'); ?>"></div>
<div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('gagal'); ?>"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Customer</a></li>
                        <li class="breadcrumb-item active">Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <a href="#" class="btn bg-gradient-blue m-lg-2" data-toggle="modal" data-target="#modal-add">Add</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data Customer</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <div class="table-responsive mailbox-messages">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Customer</th>
                                            <th>Nama Customer</th>
                                            <th>Telp.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($result as $r) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $r->kode ?></td>
                                                <td><?= $r->nama ?></td>
                                                <td><?= $r->telp ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-edit<?= $r->id ?>">Edit</a>
                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?= $r->id ?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Customer</th>
                                            <th>Nama Customer</th>
                                            <th>Telp.</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/customer/store" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <?php
                    $kode = 'cust-'.random_string('alnum', 3) . random_string('numeric', 2);
                    ?>
                    <label for="kode">Kode Customer</label>
                    <input type="text" class="form-control mb-lg-2" name="kode" placeholder="Kode Customer" value="<?= $kode ?>" readonly>
                    <label for="nama">Nama Customer</label>
                    <input type="text" class="form-control mb-lg-2" name="nama" placeholder="Nama Customer..." required>
                    <label for="telp">Telp. Customer</label>
                    <input type="number" class="form-control" name="telp" placeholder="Telp." required>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php foreach ($result as $r) : ?>
    <!-- Modal -->
    <div class="modal fade" id="modal-edit<?= $r->id ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/customer/update" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $r->id ?>">

                        <label for="kode">Kode Customer</label>
                        <input type="text" class="form-control mb-lg-2" name="kode" placeholder="Kode Customer" value="<?= $r->kode ?>" readonly>
                        <label for="nama">Nama Customer</label>
                        <input type="text" class="form-control mb-lg-2" name="nama" placeholder="Nama Customer..." required value="<?= $r->nama ?>">
                        <label for="telp">Telp. Customer</label>
                        <input type="number" class="form-control" name="telp" placeholder="Telp." required value="<?= $r->telp ?>">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<?php foreach ($result as $r) : ?>
    <!-- Modal -->
    <div class="modal fade" id="modal-delete<?= $r->id ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/customer/delete" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $r->id ?>">
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapusnya?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>