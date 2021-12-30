<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">PEMBAYARAN RESELLER</h4>
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
                        <th>Nama Reseller</th>
                        <th>Tagihan</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Confirm By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($payments as $payment) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $payment['full_name']; ?></td>
                            <td>Rp.<?= number_format($payment['price'], 2, ",", ".") ?></td>
                            <td><?= $payment['created_at']; ?></td>
                            <td class="text-<?= $payment['status'] ==  '0' ? 'danger' : 'success'; ?>"><?= $payment['status'] ==  '0' ? 'Belum Lunas' : 'Lunas'; ?></td>
                            <td><?= $payment['updated_by']; ?></td>
                            <td>
                                <form action="<?= base_url('admin/reseller/setlunas/' . $payment['transaction_number']); ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="setactive" value="<?= $payment['status'] ==  '0' ? '1' : '0'; ?>">
                                    <button type="submit" class="btn btn-<?= $payment['status'] ==  '1' ? 'danger' : 'primary'; ?> mb-1"><i class="fas fa-<?= $payment['status'] ==  '1' ? 'times-circle' : 'check-square'; ?>" onclick="return confirm('Apakah Anda Yakin?');"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->include('admin/template/footer'); ?>