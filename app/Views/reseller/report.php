<?= $this->include('reseller/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-danger">REPORT</h4>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-download fa-sm text-white-50 mr-1"></i> Export Report</a>
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
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $report) : ?>
                        <tr>
                            <td><?= $report['transaction_number']; ?></td>
                            <td><?= $report['game_name']; ?></td>
                            <td><?= $report['user_id']; ?></td>
                            <td><?= $report['denomination']; ?></td>
                            <td>Rp. <?= number_format($report['total'], 2, ",", ".") ?></td>
                            <?php if ($report['status'] == 'Selesai') { ?>
                                <td class="text-success"><?= $report['status']; ?></td>
                            <?php } else if ($report['status'] == 'Ditolak') { ?>
                                <td class="text-danger"><?= $report['status']; ?></td>
                            <?php } ?>
                            <td><?= $report['created_at']; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->include('reseller/template/footer'); ?>