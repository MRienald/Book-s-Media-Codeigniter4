<?= $this->extend('template/template')?>
<?= $this->section('content')?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= strtoupper($title)?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Update Book Data</li>
        </ol>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Update Data
            </div>
            <div class="card-body">
                <!-- Form Data -->
                <form action="<?= route_to('update-buku', $result['book_id'])?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug'] ?>" name="slug_old">
                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= 
                            $validation->hasError('title') ? 'is-invalid' : ''?>" name="title" value="<?= old('title', $result['title'])?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('title') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="author" class="col-sm-2 col-form-label">Writer</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('author') ? 'is-invalid' : ''?>" name="author" value="<?= old('author', $result['author'])?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('writer') ?>
                            </div>
                        </div>
                    </div> 
                    <div class="mb-3 row">
                        <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('publisher') ? 'is-invalid' : ''?>" name="publisher" value="<?= old('publisher', $result['publisher'])?>">
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
                                <option value="<?= $value['book_catagory_id'] ?>"
                                    <?= old('book_catagory_id', $result['book_catagory_id']) == $value
                                    ['book_catagory_id'] ? 'selected' : ''  ?>
                                >
                                    <?= $value['name_catagory'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                        <label for="release_year" class="col-sm-2 col-form-label">Release Year</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('release_year') ? 'is-invalid' : ''?>" name="release_year" value="<?= old('release_year', $result['release_year'])?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('release_year') ?>
                            </div>
                        </div>
                    </div> 
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('price') ? 'is-invalid' : ''?>" name="price" value="<?= old('price', $result['price'])?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('price') ?>
                            </div>
                        </div>
                        <label for="discount" class="col-sm-2 col-form-label">Discount</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('discount') ? 'is-invalid' : ''?>" name="discount" value="<?= old('discount', $result['discount'])?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('discount') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control <?= 
                            $validation->hasError('stock') ? 'is-invalid' : ''?>" name="stock" value="<?= old('stock', $result['stock'])?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('stock') ?>
                            </div>
                    </div>
                    <div class="mt-3 row">
                        <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                        <div class="col-sm-4">
                        <input type="file" class="form-control  <?= 
                        $validation->hasError('cover') ? 'is-invalid' : ''?>" name="cover" id="cover" value="<?= old('cover')?>" onchange="previewImage()">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('cover') ?>
                        </div>
                        <div class="col-md-6">
                            <img src="/img/<?= $result['cover'] != null ? $result['cover'] : 'tumbnail.png'?>" alt="" class="img-preview img-thumbnail">
                        </div>
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
