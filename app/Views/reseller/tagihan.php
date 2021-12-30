<?= $this->include('reseller/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-danger">PEMBAYARAN RESELLER</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tagihan</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($payments as $payment) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>Rp.<?= number_format($payment['price'], 2, ",", ".") ?></td>
                            <td><?= $payment['created_at']; ?></td>
                            <td class="text-<?= $payment['status'] ==  '0' ? 'danger' : 'success'; ?>"><?= $payment['status'] ==  '0' ? 'Belum Lunas' : 'Lunas'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->include('reseller/template/footer'); ?>