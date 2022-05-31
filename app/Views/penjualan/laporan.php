<?= $this->extend('template/template')?>
<?= $this->section('content')?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">REPORT</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $title?> Report</li>
        </ol>
        <!-- Alert -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashData('success') ?>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('warning')): ?>
            <div class="alert alert-warning" role="alert">
                <?= session()->getFlashData('warning') ?>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashData('error') ?>
            </div>
        <?php endif; ?>
        <!--  -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List <?= $title?>
            </div>
            <div class="card-body">
                <!-- Filter -->
                <form action="/laporan/filter" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <input type="date" class="form-control" name="tgl_awal" value="<?=$tanggal['tgl_awal'] ?>" title="Start Date">
                            </div>
                            <div class="col-4">
                                <input type="date" class="form-control" name="tgl_akhir" value="<?= $tanggal['tgl_akhir'] ?>" title="End Date">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-secondary"><i class="fas fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <!--        -->

                <!-- Data Laporan -->
                <table id="datatablesSimple" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><center>Transaction date</center></th>
                            <th><center>Sale Id</center></th>
                            <th><center>User/Cashier</center></th>
                            <th><center>Customer</center></th>
                            <th><center>Total Transaction</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $value): ?>
                            <tr>
                            <td><center><?= $value['tgl_transaksi']?></center></td>
                            <td><center><?= $value['sale_id']?></center></td>
                            <td><center><?= $value['firstname']?> <?= $value['lastname']?></center></td>
                            <td><center><?= $value['nama_customer']?></center></td>
                            <td><?= number_to_currency(($value['total']), 'IDR', 'id_ID', 2) ?></td>
                            <td><center>
                                <a href="/laporan/detail/<?= $value['sale_id'] ?>" class="btn btn-outline-info"><i class="fas fa-info-circle"></i> Detail</a>
                            </center></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!--              -->
            </div>
        </div>
    </div>
</main>

<?= $this->endsection('content')?>
