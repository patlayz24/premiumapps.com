<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">REPORT</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>TRX</th>
                        <th>ID Reseller</th>
                        <th>Nama Game</th>
                        <th>ID User</th>
                        <th>Denom</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $report) : ?>
                        <tr>
                            <td><?= $report['transaction_number']; ?></td>
                            <td><?= $report['id_reseller']; ?></td>
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
                            <td>
                                <button type="button" class="btn btn-info mb-1 view_data_report" id="<?= $report['id_transaction']; ?>"><i class="fas fa-question-circle"></i></button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail Report-->
<div class="modal fade" id="detail_report" tabindex="-1" role="dialog" aria-labelledby="detailReport" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_report_detail">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_report", function(event) {
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/report/detail'); ?>' + '/' + id,
                method: 'get',
                success: function(data) {
                    $('#data_report_detail').html(data);
                    $('#detail_report').modal("show");
                }
            });
        });
    });
</script>

<?= $this->include('admin/template/footer'); ?>