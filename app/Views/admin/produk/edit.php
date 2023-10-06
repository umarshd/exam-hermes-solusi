<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>
<!-- <h1 class="h3 mb-3"><strong>menu</strong></h1> -->

<div class="row justify-content-center">
  <div class="col-lg-10">
    <div class="card p-3 border-radius-10">
      <div class="row mb-3">
        <div class="col-lg-6">
          <h5>Edit Produk</h5>
        </div>
        <div class="col-lg-6 text-end">
          <a href="<?= base_url() ?>/admin/produk" class="btn btn-second btn-sm border-radius-5">kembali</a>
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
      <form action="<?= base_url() ?>/admin/produk/edit/proses" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group py-1">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" name="product_name" value="<?= $produk['product_name'] ?>">
              <input type="text" class="form-control" name="id" value="<?= $produk['id'] ?>" hidden>
            </div>
            <div class="form-group py-1">
              <label class="form-label">Kode</label>
              <input type="text" class="form-control" name="product_code" value="<?= $produk['product_code'] ?>">
            </div>
            <div class="form-group py-1">
              <label class="form-label">Harga</label>
              <input type="text" class="form-control" name="price" value="<?= $produk['price'] ?>">
            </div>
            <div class="form-group py-1">
              <label class="form-label">Mata Uang</label>
              <input type="text" class="form-control" name="currency" value="<?= $produk['currency'] ?>">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group py-1">
              <label class="form-label">Diskon(%)</label>
              <input type="text" class="form-control" name="discount" value="<?= $produk['discount'] ?>">
            </div>
            <div class="form-group py-1">
              <label class="form-label">Dimensi</label>
              <input type="text" class="form-control" name="dimension" value="<?= $produk['dimension'] ?>">
            </div>
            <div class="form-group py-1">
              <label class="form-label">Unit</label>
              <input type="text" class="form-control" name="unit" value="<?= $produk['unit'] ?>">
            </div>
            <div class="form-group py-1">
              <label class="form-label">Stok</label>
              <input type="number" class="form-control" name="stock" value="<?= $produk['stock'] ?>" min="0">
            </div>
          </div>
        </div>
        <div class="text-end py-2 pt-3">
          <button type="submit" class="btn btn-second">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>