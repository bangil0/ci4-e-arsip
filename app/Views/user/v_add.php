<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
        $errors = session()->getFlashdata('errors');
        if (!empty($errors)) : ?>
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    <h4>KESALAHAN :</h4>
                    <?php foreach ($errors as $key => $value) : ?>
                        <li><?= esc($value) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data <?= $title; ?></h3>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= form_open_multipart('user/tambah') ?>
                <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" name="nama_user" class="form-control" placeholder="Masukan nama..">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukan email..">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukan password..">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control">
                        <option value="">--Pilih Level--</option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Departemen</label>
                    <select name="id_dep" class="form-control">
                        <option value="">--Pilih Departemen--</option>
                        <?php foreach ($dep as $data) : ?>
                            <option value="<?= $data['id_dep']; ?>"><?= $data['nama_dep']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="form-group">
                    <a href="<?= base_url('user') ?>" class="btn btn-sm btn-danger">Back</a>
                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                </div>

                <?= form_close() ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-2"></div>
</div>

<?= $this->endsection(); ?>