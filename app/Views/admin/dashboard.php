<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-3"><strong>Dashboard</strong></h1>

<div class="row">

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Produk</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="list"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">
                    <?= $countProduct ?>
                </h1>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">User</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="users"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">
                    <?= $countUser ?>
                </h1>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Transaksi</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="shopping-bag"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">
                    <?= $countTransaction ?>
                </h1>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>