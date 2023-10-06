<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>
<!-- <h1 class="h3 mb-3"><strong>Agama</strong></h1> -->

<div class="row justify-content-center">
  <div class="col-lg-6">
    <div class="card p-3 border-radius-10">
      <div class="row mb-3">
        <div class="col-lg-6">
          <h5>Tambah User</h5>
        </div>
        <div class="col-lg-6 text-end">
          <a href="<?= base_url() ?>/admin/user" class="btn btn-second btn-sm border-radius-5">kembali</a>
        </div>
      </div>
      <?php if (session()->get('error')): ?>
        <div class="alert alert-danger" role="alert">
          <?= session()->get('error') ?>
        </div>
      <?php elseif (session()->get('success')): ?>
        <div class="alert alert-success" role="alert">
          <?= session()->get('success') ?>
        </div>
        <div class="alert alert-danger" role="alert">
          A simple danger alert—check it out!
        </div>
      <?php endif ?>
      <form action="<?= base_url() ?>/admin/user/tambah/proses" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group py-1">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" name="name" value="<?= old('name') ?>">
            </div>
            <div class="form-group py-1">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" value="<?= old('email') ?>">
            </div>
            <div class="form-group py-1">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group py-1">
              <label class="form-label">Password Konfirmasi</label>
              <input type="password" class="form-control" name="password_konfirmasi">
            </div>
          </div>
        </div>
        <div class=" text-end py-2 pt-3">
          <button type="submit" class="btn btn-second">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>