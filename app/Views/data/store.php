<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<!-- Flashdata -->
<div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('berhasil'); ?>"></div>
<div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('gagal'); ?>"></div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Transaksi</a></li>
                        <li class="breadcrumb-item active">Add Data</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <label for="no_kode_sales">No</label>
                            <input type="text" class="form-control" name="no_kode_sales" placeholder="No" aria-label="" aria-describedby="basic-addon1" value="<?= $sales->kode ?>" readonly>
                            <label for="tgl">Tanggal</label>
                            <input type="date" class="form-control" name="tgl" onchange="getDate(this.value)" required>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Customer</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/data/add_cust" method="post">
                                <?= csrf_field(); ?>
                                <label for="cust_id">Kode</label>
                                <select name="cust_id" id="cust_id" class="form-control" required>
                                    <?php if ($customer_data) { ?>
                                        <option value="" selected disabled>-- Select One --</option>
                                        <?php foreach ($customer as $c) : ?>
                                            <option <?php if ($customer_data->kode == $c->kode) {
                                                        echo 'selected';
                                                    } else {
                                                        echo '';
                                                    }; ?> value="<?= $c->id ?>"><?= $c->nama ?> - <?= $c->kode ?></option>
                                            <?php $id = $c->id ?>
                                        <?php endforeach; ?>
                                    <?php } else { ?>
                                        <option value="" selected disabled>-- Select One --</option>
                                        <?php foreach ($customer as $c) : ?>
                                            <option value="<?= $c->id ?>"><?= $c->nama ?> - <?= $c->kode ?></option>
                                            <?php $id = $c->id ?>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="kode" value="<?= $sales->kode ?>">
                                <?php if ($customer_data) { ?>
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama" aria-label="" aria-describedby="basic-addon1" value="<?= $customer_data->nama ?>" readonly>
                                    <label for="nama">Telp.</label>
                                    <input type="number" class="form-control" name="nama" placeholder="Telp." value="<?= $customer_data->telp ?>" readonly>
                                <?php } ?>
                                <button type="submit" class="btn btn-success m-2">Update</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mr-3">Data Barang</h3>
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-add">Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <div class="table-responsive mailbox-messages">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Kode Barang</th>
                                            <th rowspan="2">Nama Barang</th>
                                            <th rowspan="2">Qty</th>
                                            <th rowspan="2">Harga Bandrol</th>
                                            <th colspan="2" class="text-center">Diskon</th>
                                            <th rowspan="2">Harga Diskon</th>
                                            <th rowspan="2">Total</th>
                                            <th rowspan="2">Action</th>
                                        </tr>
                                        <tr>
                                            <th>%</th>
                                            <th>RP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $subtotal = 0 ?>
                                        <?php foreach ($result as $r) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $r->kode ?></td>
                                                <td><?= $r->nama ?></td>
                                                <td><?= $r->qty ?></td>
                                                <td><?= $r->harga_bandrol ?></td>
                                                <td><?= $r->diskon_pct ?></td>
                                                <td><?= $r->diskon_nilai ?></td>
                                                <td><?= $r->harga_diskon ?></td>
                                                <td><?= $r->total ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-edit<?= $r->id ?>">Edit</a>
                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?= $r->id ?>">Delete</a>
                                                </td>
                                            </tr>
                                            <?php $subtotal += $r->total ?>
                                        <?php endforeach; ?>
                                    </tbody>
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
            <div class="row">
                <div class="col-md-11">
                    <div class="float-right">
                        <p><strong>Sub Total :</strong> <?= $subtotal ?></p>
                        <?php if ($sales->diskon) : ?>
                            <p><strong>Diskon :</strong> <?= $sales->diskon ?></p>
                        <?php else : ?>
                            <p><strong>Diskon :</strong> <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-diskon">Add diskon</a></p>
                        <?php endif; ?>
                        <?php if ($sales->ongkir) : ?>
                            <p><strong>Ongkir :</strong> <?= $sales->ongkir ?></p>
                        <?php else : ?>
                            <p><strong>Ongkir :</strong> <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-ongkir">Add Ongkir</a></p>
                        <?php endif; ?>
                        <?php
                        $total_bayar = $subtotal - $sales->diskon - $sales->ongkir;
                        ?>
                        <p><strong>Total Bayar :</strong> <?= $total_bayar ?></p>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <form action="/data/update" method="post">
                <input type="hidden" name="total_barang" value="<?= $total_barang ?>">
                <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
                <input type="hidden" name="total_bayar" value="<?= $total_bayar ?>">
                <input type="hidden" id="tgl" name="tgl">
                <input type="hidden" name="no_kode_sales" value="<?= $sales->kode ?>">
                <input type="hidden" name="cust_id" value="<?= $sales->cust_id ?>">
                <script>
                    function getDate(date) {
                        const tgl = document.getElementById('tgl');
                        tgl.value = date
                    }
                </script>
                <div class="row text-center">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success m-5">Save</button>
                        <a href="/data/add" class="btn btn-secondary m-5">Close</a>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </form>
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
            <form action="/data/barang_store" method="POST">
                <input type="hidden" name="sales_id" value="<?= $sales->id ?>">
                <input type="hidden" name="kode_sales" value="<?= $sales->kode ?>">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <label for="barang_id">Kode Barang</label>
                    <select name="barang_id" id="barang_id" class="form-control">
                        <option value="" selected disabled>-- Select One --</option>
                        <?php foreach ($barang as $b) : ?>
                            <option value="<?= $b->id ?>"><?= $b->nama ?> - <?= $b->kode ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="qty">Jumlah Barang</label>
                    <input type="number" class="form-control mb-lg-2" name="qty" placeholder="Jumlah Barang" required>
                    <label for="diskon_pct">Diskon</label>
                    <input type="number" class="form-control mb-lg-2" name="diskon_pct" placeholder="Persentase Diskon(tanpa persen)..." required>

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
<!-- /.modal -->

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
                <form action="/data/barang_update" method="POST">
                    <input type="hidden" name="id" value="<?= $r->id ?>">
                    <input type="hidden" name="sales_id" value="<?= $sales->id ?>">
                    <input type="hidden" name="kode_sales" value="<?= $sales->kode ?>">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <label for="barang_id">Kode Barang</label>
                        <select name="barang_id" id="barang_id" class="form-control">
                            <option value="" disabled>-- Select One --</option>
                            <?php foreach ($barang as $b) : ?>
                                <option <?php if ($r->kode == $b->kode) {
                                            echo 'selected';
                                        } else {
                                            echo '';
                                        };
                                        ?> value="<?= $b->id ?>"><?= $b->nama ?> - <?= $b->kode ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="qty">Jumlah Barang</label>
                        <input type="number" class="form-control mb-lg-2" name="qty" placeholder="Jumlah Barang" required value="<?= $r->qty ?>">
                        <label for="diskon_pct">Diskon</label>
                        <input type="number" class="form-control mb-lg-2" name="diskon_pct" placeholder="Persentase Diskon(tanpa persen)..." required value="<?= $r->diskon_pct ?>">

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

<!-- Modal -->
<div class="modal fade" id="modal-diskon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Diskon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/data/add_diskon" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="kode" value="<?= $sales->kode ?>">
                <div class="modal-body">
                    <label for="diskon">Diskon</label>
                    <input type="number" placeholder="Diskon (nominal)" class="form-control" name="diskon">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal -->
<div class="modal fade" id="modal-ongkir">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Ongkir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/data/add_ongkir" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="kode" value="<?= $sales->kode ?>">
                <div class="modal-body">
                    <label for="ongkir">Ongkir</label>
                    <input type="number" placeholder="Ongkir (nominal)" class="form-control" name="ongkir">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?= $this->endSection(); ?>