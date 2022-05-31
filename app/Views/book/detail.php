<?= $this->extend('template/template')?>
<?= $this->section('content')?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= strtoupper($title)?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Book Detail</li>
        </ol>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="card mb-3" style="max-width: 700px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="/img/<?= $data_book['cover']?>" class="img-fluid rounded-start m-3">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title m-3"><?= strtoupper($data_book['title']) ?></h5>
                        <p class="card-text m-3">
                            Writer &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : <?= $data_book['author']?><br>
                            Publisher &nbsp : <?= $data_book['publisher']?><br>
                            Catagory &nbsp : <?= $data_book['name_catagory']?><br><br><b>
                            Release Year &nbsp&nbsp:&nbsp&nbsp <?= $data_book['release_year']?><br>
                            Stock &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp :&nbsp&nbsp <?= $data_book['stock']?> pcs<br></b>
                        </p>
                        <div class="card-text" style="text-align:right">
                            <p><?= number_to_currency($data_book['price'], 'IDR', 'id_ID', 2) ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>
                                <small class="text-muted">disc <?= $data_book['discount']?> %&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</small>
                            </p>
                        </div>
                    </div>
                    </div>
                    <a href="/book" class="btn btn-dark">Back</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endsection('content')?>
