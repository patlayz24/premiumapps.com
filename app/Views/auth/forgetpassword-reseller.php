<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= $title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

</head>

<body>
  <div class="container py-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 my-5 py-3 bg-white from-wrapper">
        <div class="container">
          <h3>Reset password</h3>
          <hr>
          <?php if (session()->get('danger')) { ?>
            <div class="alert alert-danger" role="alert">
              <?= session()->get('danger'); ?>
            </div>
          <?php } else if (session()->get('success')) { ?>
            <div class="alert alert-success" role="alert">
              <?= session()->get('success'); ?>
            </div>
          <?php } ?>
          <form action="<?= base_url('forgetpassword-reseller'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-grup">
              <label for="email">Email address</label>
              <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= old('email'); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('email'); ?>
              </div>
            </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-12 col-sm-4 mt-3">
            <button type="submit" class="btn btn-primary">Reset password</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
  </div>
</body>