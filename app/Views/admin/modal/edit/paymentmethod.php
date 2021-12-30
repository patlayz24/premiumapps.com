<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="addPaymentMethodLabel">Edit Payment Method</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="<?= base_url("admin/paymentmethod/editproduct/" . $payment["id"]); ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field(); ?>
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="old_thumbnail" value="<?= $payment['thumbnail']; ?>">
      <input type="hidden" name="old_logo" value="<?= $payment['logo']; ?>">
      <div class="form-group">
        <label for="bank_name">Nama Bank</label>
        <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?= (old('bank_name')) ? old('bank_name') : $payment['bank_name']; ?>">
      </div>
      <div class="form-group">
        <label for="select_game">Pilih Kategori</label>
        <select class="form-control" id="select_game" name="payment_category">
          <option value="">Pilih</option>
          <option value="Bank Transfer" <?= ($payment['category'] == 'Bank Transfer') ? 'selected' : ''; ?>>Bank Transfer</option>
          <option value="E-Wallet" <?= ($payment['category'] == 'E-Wallet') ? 'selected' : ''; ?>>E-Wallet</option>
          <option value="Gerai" <?= ($payment['category'] == 'Gerai') ? 'selected' : ''; ?>>Gerai</option>
        </select>
      </div>
      <div class="form-group">
        <label for="account_name">Nama Rekening</label>
        <input type="text" class="form-control" id="account_name" name="account_name" value="<?= (old('account_name')) ? old('account_name') : $payment['account_name']; ?>">
      </div>
      <div class=" form-group">
        <label for="account_number">No. Rekening</label>
        <input type="text" class="form-control" id="account_number" name="account_number" value="<?= (old('account_number')) ? old('account_number') : $payment['account_number']; ?>">
      </div>
      <div class="form-group">
        <label for="admin_fee">Biaya Admin</label>
        <input type="number" class="form-control" id="payment_rek" name="admin_fee" value="<?= (old('admin_fee')) ? old('admin_fee') : $payment['admin_fee']; ?>">
      </div>
      <div class=" form-group">
        <label for="thumbnail">QR Code</label>
        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
      </div>
      <div class="form-group">
        <label for="logo">Logo</label>
        <input type="file" class="form-control-file" id="logo" name="logo">
      </div>
      <button type="submit" class="btn btn-success">Edit</button>
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</div>