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
                <?= form_open_multipart('arsip/update/' . $arsip['id_arsip']); ?>
                <div class="form-group">
                    <label>No Arsip</label>
                    <input type="text" name="no_arsip" class="form-control" value="<?= $arsip['no_arsip']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Arsip</label>
                    <input type="text" name="nama_arsip" class="form-control" placeholder="Masukan nama.." value="<?= $arsip['nama_arsip']; ?>">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"><?= $arsip['deskripsi']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="id_kategori" class="form-control">
                        <option value="<?= $arsip['id_kategori']; ?>"><?= $arsip['nama_kategori']; ?></option>
                        <?php foreach ($kategori as $data) : ?>
                            <option value="<?= $data['id_kategori']; ?>"><?= $data['nama_kategori']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ganti Arsip</label>
                    <input type="file" name="file_arsip" class="form-control">
                    <span class="text-danger">*File harus format .pdf</span>
                </div>
                <div class="form-group">
                    <a href="<?= base_url('arsip') ?>" class="btn btn-sm btn-danger">Back</a>
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