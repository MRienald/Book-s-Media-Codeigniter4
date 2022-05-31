<?= $this->extend('template/template')?>
<?= $this->section('content')?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= strtoupper($title)?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Update <?= $title?> Data</li>
        </ol>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Update Data
            </div>
            <div class="card-body">
                <!-- Form Data -->
                <form action="/edit-supplier/<?= $result->supplier_id ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="<?= $result->name ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" value="<?= $result->address ?>">
                        </div>
                    </div> 

                    <div class="mb-3 row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-4">
                            <input type="phone" class="form-control" name="phone" value="<?= $result->phone ?>">
                        </div>

                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="email" value="<?= $result->email ?>">
                        </div>
                    </div> 
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-2">&nbsp&nbsp&nbsp&nbspSave&nbsp&nbsp&nbsp&nbsp</button>
                        <button class="btn btn-danger" type="reset">&nbsp&nbspCancel&nbsp&nbsp</button>
                    </div>
                </form>  
                <!--             -->
            </div>
        </div>
    </div>
</main>

<?= $this->endsection('content')?>
