<?= $this->include('admin/template/header'); ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">PAYMENT METHOD</h4>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPaymentMethod"><i class="fas fa-download fa-sm text-white-50 mr-2"></i>Add Method</a>
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bank</th>
                        <th>Category</th>
                        <th>Nama Rek</th>
                        <th>No Rek</th>
                        <th>Biaya Admin</th>
                        <th>QR</th>
                        <th>Logo</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($paymentMethods as $payment) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $payment['bank_name']; ?></td>
                            <td><?= $payment['category']; ?></td>
                            <td><?= $payment['account_name']; ?></td>
                            <td><?= $payment['account_number']; ?></td>
                            <td><?= $payment['admin_fee']; ?></td>
                            <td><img src="<?= base_url('assets/images/payment/' . $payment['thumbnail']); ?>" alt="qr" height="70px" width="70px"></td>
                            <td><img src="<?= base_url('assets/images/logo/' . $payment['logo']); ?>" alt="<?= $payment['bank_name']; ?>" height="40px" width="80px"></td>
                            <td><?= date("l, d F Y", strtotime($payment['updated_at'])); ?></td>
                            <td>
                                <form action="<?= base_url('admin/paymentmethod/delete/' . $payment['id']); ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                <a id="<?= $payment['id']; ?>" class="btn btn-primary view_data_payment_method mb-1"><i class="fas fa-pen"></i></a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal PaymentMethod -->
<div class="modal fade" id="addPaymentMethod" tabindex="-1" role="dialog" aria-labelledby="addPaymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentMethodLabel">Add Payment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("admin/paymentmethod/addpaymentmethod"); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="bank_name">Nama Bank</label>
                        <input type="text" class="form-control" id="payment_name" name="bank_name">
                    </div>
                    <div class="form-group">
                        <label for="select_game">Pilih Kategori</label>
                        <select class="form-control" id="select_game" name="payment_category">
                            <option value="" selected>Pilih</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="E-Wallet">E-Wallet</option>
                            <option value="Gerai">Gerai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="account_name">Nama Rekening</label>
                        <input type="text" class="form-control" id="payment_rek" name="account_name">
                    </div>
                    <div class="form-group">
                        <label for="account_number">No. Rekening</label>
                        <input type="text" class="form-control" id="payment_rek" name="account_number">
                    </div>
                    <div class="form-group">
                        <label for="admin_fee">Biaya Admin</label>
                        <input type="number" class="form-control" id="payment_rek" name="admin_fee" value="0">
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">QR Code</label>
                        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control-file" id="logo" name="logo">
                    </div>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Payment Method-->
<div class="modal fade" id="edit_payment_method" tabindex="-1" role="dialog" aria-labelledby="edit_payment_method" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_edit_payment_method">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_payment_method", function(event) {
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/paymentmethod/detail'); ?>' + '/' + id,
                method: 'get',
                success: function(data) {
                    $('#data_edit_payment_method').html(data);
                    $('#edit_payment_method').modal("show");
                }
            });
        });
    });
</script>
<?= $this->include('admin/template/footer'); ?>