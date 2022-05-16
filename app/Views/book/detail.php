<?= $this->extend('template/template')?>
<?= $this->section('content')?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= strtoupper($title)?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Book <?= $title?></li>
        </ol>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Detail <?= $title?>
            </div>
            <div class="card-body">
                <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4"><br><br>
                    <img src="https://cdn-2.tstatic.net/tribunnews/foto/bank/images/Buku-ilustrasi.jpg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= strtoupper($data_book['title']) ?></h5>
                        <p class="card-text">
                            Writer &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : <?= $data_book['author']?><br>
                            Publisher &nbsp : <?= $data_book['publisher']?><br>
                            Catagory &nbsp : <?= $data_book['name_catagory']?><br>
                            Stock &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp: <b><?= $data_book['stock']?> pcs</b><br>
                            Release Year &nbsp&nbsp: <?= $data_book['release_year']?>
                        </p>
                        <div class="card-text" style="text-align:right">
                            <p>Rp <?= $data_book['price']?>,- &nbsp&nbsp&nbsp&nbsp<br>
                                <small class="text-muted">disc <?= $data_book['discount']?> %&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</small>
                            </p>
                        </div>
                    </div>
                    </div>
                    <a href="/book" class="btn btn-dark">Kembali</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endsection('content')?>
