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
                <!-- Data Detail Laporan -->
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><center>NO</center></th>
                            <th><center>Product</center></th>
                            <th><center>Amount</center></th>
                            <th><center>Discount</center></th>
                            <th><center>Unit Price</center></th>
                            <th><center>Sub Total</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; $total=0; foreach($result as $value): ?>
                            <tr>
                            <td><center><?= $no++?></center></td>
                            <td><center><?= $value['title']?></center></td>
                            <td><center><?= $value['amount']?></center></td>
                            <td><center><?= $value['discount']?> %</center></td>
                            <td><?= number_to_currency(($value['price']), 'IDR', 'id_ID', 2) ?></td>
                            <td><?= number_to_currency(($value['total_price']), 'IDR', 'id_ID', 2) ?></td>
                            </tr>
                        <?php 
                        $total += $value['total_price'];
                        endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><center>TOTAL</center></th>
                            <th><?= number_to_currency($total, 'IDR', 'id_ID', 2) ?></th>
                        </tr>
                    </tfoot>
                </table>
                <!--              -->
            </div>
        </div>
        <button class="btn btn-warning" onclick="window.history.back()">&nbsp&nbsp<i class="fa-solid fa-arrow-right-from-bracket"></i> Back&nbsp&nbsp</button>
    </div>
</main>

<?= $this->endsection('content')?>
