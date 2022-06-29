<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Flashdata -->
    <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" style="width: 80px; height: 80px;" src="../assets/img/user/<?= $user->image ?>" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?= $user->username ?></h3>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">


                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" action="/user/update/<?= $user->userid ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?= $user->userid ?>">
                                        <input type="hidden" name="usernameLama" value="<?= $user->username ?>">
                                        <input type="hidden" name="fotoLama" value="<?= $user->image ?>">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="input" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="inputName" placeholder="Username" value="<?= (old('username')) ? old('username') : $user->username ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('username') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" disabled class="form-control" id="inputEmail" value="<?= $user->email ?>">
                                                <small>Jika ingin edit username,email hubungi admin <a href="<?= base_url() ?>/home/about">click here</a></small>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="foto" class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-2">
                                                <img src="../assets/img/user/<?= $user->image ?>" alt="" class="img-thumbnail img-preview">
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()">
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('foto') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Edit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?= $this->endSection() ?>