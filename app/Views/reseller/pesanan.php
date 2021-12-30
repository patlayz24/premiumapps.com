<?= $this->include('reseller/template/header'); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-danger">PESANAN YANG SEDANG BERJALAN</h4>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID TRX</th>
                        <th>Nama Game</th>
                        <th>ID User</th>
                        <th>Denom</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($transactions as $transaction) : ?>
                        <tr>
                            <td><?= $transaction['transaction_number']; ?></td>
                            <td><?= $transaction['game_name']; ?></td>
                            <td><?= $transaction['user_id']; ?></td>
                            <td><?= $transaction['denomination']; ?></td>
                            <td><?= $transaction['quantity']; ?></td>
                            <td>Rp. <?= number_format($transaction['total'], 2, ",", ".") ?></td>

                            <?php if ($transaction['status'] == 'Selesai') {  ?>
                                <th class="text-success"><?= $transaction['status']; ?></th>
                            <?php } else { ?>
                                <th class="text-primary"><?= $transaction['status']; ?></th>
                            <?php } ?>

                            <td><?= date("l, d F Y h:i:s", strtotime($transaction['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->include('reseller/template/footer'); ?>