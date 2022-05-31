<?= $this->extend('template/template')?>
<?= $this->section('content')?>

<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= strtoupper($title)?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Change Password</li>
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
            </div>
            <div class="card-body">
                <!-- Form Data -->
                <form action="/password/<?= user_id() ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control <?= 
                            $validation->hasError('password_lama') ? 'is-invalid' : ''?>" name="password_lama" >
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('password_lama') ?>
                            </div>
                        </div>
                    </div> <br>
                    
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control <?= 
                            $validation->hasError('password_baru') ? 'is-invalid' : ''?>" name="password_baru" >
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('password_baru') ?>
                            </div>
                        </div>

                        <label for="name" class="col-sm-2 col-form-label">Confirm New Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control <?= 
                            $validation->hasError('konfirm_password_baru') ? 'is-invalid' : ''?>" name="konfirm_password_baru">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('konfirm_password_baru') ?>
                            </div>
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
