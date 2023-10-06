<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-3"><strong>User</strong></h1>

<div class="row">
  <div class="col-lg-12">
    <div class="card p-3 border-radius-10">
      <div class="row mb-3">
        <div class="col-lg-6">
          <h5>Data User</h5>
        </div>
        <div class="col-lg-6 text-end">
          <a href="<?= base_url() ?>/admin/user/tambah" class="btn btn-second btn-sm border-radius-5">Tambah</a>
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
      <?php endif ?>
      <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php foreach ($dataUser as $user): ?>
            <tr>
              <td>
                <?= $i++ ?>
              </td>
              <td>
                <?= $user['name'] ?>
              </td>
              <td>
                <?= $user['email'] ?>
              </td>
              <td>
                <a href="<?= base_url('/admin/user/' . $user['id'] . '/edit') ?>" class="nav-link d-inline px-0">
                  <span class="badge bg-secondary">Edit</span>
                </a>
                <button type="button" class="border-0" style="background: transparent;" data-bs-toggle="modal"
                  data-bs-target="#exampleModal<?= $user['id'] ?>">
                  <span class=" badge bg-danger ">Delete</span>
                </button>
              </td>
            </tr>

            <div class="modal fade" id="exampleModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h4 class="h4">
                      Apakah kamu yakin menghapus data ini ?</h4>
                    <p>Data ini akan hilang selamanya</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="<?= base_url('/admin/user/' . $user['id'] . '/delete') ?>" class="btn btn-danger">Delete</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach ?>




        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>