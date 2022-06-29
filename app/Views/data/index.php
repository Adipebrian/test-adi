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
                    <h1 class="m-0">Data Transaksi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Transaksi</a></li>
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
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data Transaksi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <div class="table-responsive mailbox-messages">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Nama Customer</th>
                                            <th>Jumlah Barang</th>
                                            <th>Sub Total</th>
                                            <th>Diskon</th>
                                            <th>Ongkir</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $total = 0 ?>
                                        <?php foreach ($result as $r) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <?php $kode = substr($r->kodesales, 0, 6) . '-' . substr($r->kodesales, 6, 6); ?>
                                                <td><?= $kode ?></td>
                                                <td><?= $r->tgl ?></td>
                                                <td><?= $r->nama ?></td>
                                                <td><?= $r->total_barang ?></td>
                                                <td><?= number_format($r->subtotal, 2, ',', '.',); ?></td>
                                                <td><?= number_format($r->diskon, 2, ',', '.',); ?></td>
                                                <td><?= number_format($r->ongkir, 2, ',', '.',); ?></td>
                                                <td><?= number_format($r->total_bayar, 2, ',', '.',); ?></td>
                                                <?php
                                                $total += $r->total_bayar
                                                ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th colspan="3" style="text-align: center;">Grand Total</th>
                                            <th><?= 'Rp '. number_format($total, 2, ',', '.',); ?></th>
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

<?= $this->endSection(); ?>