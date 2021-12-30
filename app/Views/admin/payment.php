<?= $this->include('admin/template/header'); ?>
<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">PAYMENT CONFIRMATION</h4>
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Trx</th>
                        <th>Nama Game</th>
                        <th>Denom</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Voucher</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="data">

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail Transaksi-->
<div class="modal fade" id="detail_transaction" tabindex="-1" role="dialog" aria-labelledby="detailTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_transaction_detail">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_transaction", function(event) {
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/payment/detail'); ?>' + '/' + id,
                method: 'get',
                success: function(data) {
                    $('#data_transaction_detail').html(data);
                    $('#detail_transaction').modal("show");
                }
            });
        });
    });
</script>


<script>
    $(function() {
        startRefresh();
    });

    function startRefresh() {
        setTimeout(startRefresh, 5000);
        $.get('<?= base_url('admin/payment/content'); ?>', function(data) {
            $('#data').html(data);
        });
    }
</script>

<?= $this->include('admin/template/footer'); ?>