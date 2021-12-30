<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="detailTransaksiLabel">Detail Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="">Nomor Transaksi</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['transaction_number']; ?></th>

                    </tr>
                    <tr>
                        <th scope="">ID Reseller</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['id_reseller']; ?></th>

                    </tr>
                    <tr>
                        <th scope="">Nama Game</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['game_name']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">ID Game</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['user_id']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Denominasi</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['denomination']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Quantity</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['quantity']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Total</th>
                        <th scope=""> : </th>
                        <th scope="">Rp. <?= number_format($report['total'], 2, ",", ".") ?></th>
                    </tr>
                    <tr>
                        <th scope="">Kode Voucher</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['voucher']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Payment</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['payment_method']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Status</th>
                        <th scope=""> : </th>
                        <?php if ($report['status'] == 'Menunggu Konfirmasi') { ?>
                            <th scope="" class="text-danger"><?= $report['status']; ?></th>
                        <?php } else if ($report['status'] == 'Diproses') { ?>
                            <th scope="" class="text-primary"><?= $report['status']; ?></th>
                        <?php } else if ($report['status'] == 'Selesai') {  ?>
                            <th scope="" class="text-success"><?= $report['status']; ?></th>
                        <?php } else if ($report['status'] == 'Ditolak') {  ?>
                            <th scope="" class="text-danger"><?= $report['status']; ?></th>
                        <?php } else { ?>
                            <th scope="" class="text-danger"><?= $report['status']; ?></th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th scope="">Time</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['created_at']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Alamat Kontak</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['contact']; ?></th>
                    </tr>

                    <tr>
                        <th scope="">Confirmed by</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['confirm_by']; ?></th>
                    </tr>

                    <tr>
                        <th scope="">Serve By</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $report['process_by']; ?></th>
                    </tr>

            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>