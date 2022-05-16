<?= $this->extend('template/template')?>
<?= $this->section('content')?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= strtoupper($title)?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Book <?= $title?></li>
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
                <a href="/book-create" class="btn btn-primary mb-3"><i class="fas fa-plus-circle"></i> Insert Data</a>
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr><center></center>
                            <th><center>NO</center></th>
                            <th><center>Title</center></th>
                            <th><center>Writer</center></th>
                            <th><center>Catagory</center></th>
                            <th><center>Release Year</center></th>
                            <th><center>Price</center></th>
                            <th><center>Stock</center></th>
                            <th><center>Disc</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        <?php foreach($data_book as $value): ?>
                            <tr>
                                <td><center><?= $no++ ?></center></td>
                                <td><?=$value['title']?></td>
                                <td><?=$value['author']?></td>
                                <td><?=$value['name_catagory']?></td>
                                <td><center><?=$value['release_year']?></center></td>
                                <td><center><?=$value['price']?></center></td>
                                <td><center><?=$value['stock']?></center></td>
                                <td><center><?=$value['discount']?></center></td>
                                <td>
                                    <a href="book-detail/<?= $value['slug']?>" class = "btn btn-outline-success">
                                    <i class= "fas fa-info-circle"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?= $this->endsection('content')?>
