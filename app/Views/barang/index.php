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
                    <h1 class="m-0">Data Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Barang</a></li>
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
                            <h3 class="card-title">Data Barang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <div class="table-responsive mailbox-messages">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
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
                                                <td><?= $r->harga ?></td>
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
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
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
                <h4 class="modal-title">Add Data Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/barang/store" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <?php
                    $kode = random_string('alnum', 3) . random_string('numeric', 2);
                    ?>
                    <label for="kode">Kode Barang</label>
                    <input type="text" class="form-control mb-lg-2" name="kode" placeholder="Kode Barang" value="<?= $kode ?>" readonly>
                    <label for="nama">Nama Barang</label>
                    <input type="text" class="form-control mb-lg-2" name="nama" placeholder="Nama Barang..." required>
                    <label for="harga">Harga Barang</label>
                    <input type="number" class="form-control" name="harga" placeholder="Harga" required>
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
                    <h4 class="modal-title">Edit Data Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/barang/update" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $r->id ?>">
                        
                        <label for="kode">Kode Barang</label>
                        <input type="text" class="form-control mb-lg-2" name="kode" placeholder="Kode Barang" value="<?= $r->kode ?>" readonly>
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control mb-lg-2" name="nama" placeholder="Nama Barang..." required value="<?= $r->nama ?>">
                        <label for="harga">Harga Barang</label>
                        <input type="number" class="form-control" name="harga" placeholder="Harga" required value="<?= $r->harga ?>">
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
                    <h4 class="modal-title">Delete Data Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/barang/delete" method="POST">
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