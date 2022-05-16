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
                Create Data
            </div>
            <div class="card-body">
                <!-- Form Data -->
                <form action="<?= route_to('save-buku')?>" method="post">
                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= 
                            $validation->hasError('title') ? 'is-invalid' : ''?>" name="title">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('title') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="author" class="col-sm-2 col-form-label">Writer</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('author') ? 'is-invalid' : ''?>" name="author">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('writer') ?>
                            </div>
                        </div>
                    </div> 
                    <div class="mb-3 row">
                        <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('publisher') ? 'is-invalid' : ''?>" name="publisher">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('publisher') ?>
                            </div>
                        </div>
                    </div> 
                    <div class="mb-3 row">
                        <label for="book_catagory_id" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-4">
                        <select class="form-control" name="book_catagory_id">
                            <?php foreach($book_catagory as $value) :?>
                                <option value="<?= $value['book_catagory_id'] ?>">
                                    <?= $value['name_catagory'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                        <label for="release_year" class="col-sm-2 col-form-label">Release Year</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('release_year') ? 'is-invalid' : ''?>" name="release_year">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('release_year') ?>
                            </div>
                        </div>
                    </div> 
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('price') ? 'is-invalid' : ''?>" name="price">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('price') ?>
                            </div>
                        </div>
                        <label for="discount" class="col-sm-2 col-form-label">Discount</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('discount') ? 'is-invalid' : ''?>" name="discount">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('discount') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('stock') ? 'is-invalid' : ''?>" name="stock">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('stock') ?>
                            </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block mt-4">
                        <button type="submit" class="btn btn-primary">&nbsp&nbsp&nbsp&nbspSave&nbsp&nbsp&nbsp&nbsp</button>
                        <button class="btn btn-danger" type="reset">&nbsp&nbspCancel&nbsp&nbsp</button>
                    </div>
                </form>  
                <!--             -->
            </div>
        </div>
    </div>
</main>

<?= $this->endsection('content')?>
