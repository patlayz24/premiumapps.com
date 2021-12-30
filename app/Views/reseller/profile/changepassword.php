<?= $this->include('reseller/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="m-0 font-weight-bold text-danger">CHANGE PASSWORD</h4>
  </div>
  <?php if (session()->get('success')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->get('success'); ?>
    </div>
  <?php endif; ?>
  <div class="card-body">

    <form action="<?= base_url('reseller/change-password'); ?>" method="POST">
      <?= csrf_field(); ?>
      <input type="hidden" name="_method" value="PUT">
      <div class="form-group">
        <label for="oldpassword">Password Lama</label>
        <input type="password" class="form-control" id="oldpassword" name="oldpassword">
      </div>
      <div class="form-group">
        <label for="password">Password Baru</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <label for="confirmpassword">Konfirmasi Password</label>
        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
    </form>

  </div>
</div>
<?= $this->include('reseller/template/footer'); ?>