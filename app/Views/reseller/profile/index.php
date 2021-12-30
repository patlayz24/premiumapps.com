<?= $this->include('reseller/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="m-0 font-weight-bold text-danger">EDIT PROFILE</h4>
  </div>
  <?php if (session()->get('success')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->get('success'); ?>
    </div>
  <?php endif; ?>
  <div class="card-body">

    <form action="<?= base_url('reseller/editprofile'); ?>" method="post">
      <?= csrf_field(); ?>
      <input type="hidden" name="_method" value="PUT">
      <div class="form-group">
        <label for="full_name">Nama lengkap</label>
        <input type="text" class="form-control" id="fullName" name="full_name" value="<?= $user['full_name']; ?>">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="<?= $user['email']; ?>" name="email" value='<?= $user['email']; ?>' disabled>
      </div>
      <div class="form-group">
        <label for="phone">No. Hp</label>
        <input type="number" class="form-control" id="phone" name="phone" value='<?= $user['phone']; ?>'>
      </div>
      <div class="form-group">
        <label for="address">Alamat</label>
        <input type="text" class="form-control" id="inputAddress" name="address" value='<?= $user['address']; ?>'>
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
    </form>

  </div>
</div>

<?= $this->include('reseller/template/footer'); ?>