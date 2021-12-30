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
                        <th scope=""><?= $transaction['transaction_number']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">ID Reseller</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $transaction['id_reseller']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Nama Game</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $transaction['game_name']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">ID Game</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $transaction['user_id']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Denominasi</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $transaction['denomination']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Quantity</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $transaction['quantity']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Total</th>
                        <th scope=""> : </th>
                        <th scope="">Rp. <?= number_format($transaction['total'], 2, ",", ".") ?></th>
                    </tr>
                    <tr>
                        <th scope="">Voucher</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $transaction['voucher']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Payment</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $transaction['payment_method']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Status</th>
                        <th scope=""> : </th>
                        <?php if ($transaction['status'] == 'Menunggu Konfirmasi') { ?>
                            <th scope="" class="text-danger"><?= $transaction['status']; ?></th>
                        <?php } else if ($transaction['status'] == 'Diproses') { ?>
                            <th scope="" class="text-primary"><?= $transaction['status']; ?></th>
                        <?php } else if ($transaction['status'] == 'Selesai') {  ?>
                            <th scope="" class="text-success"><?= $transaction['status']; ?></th>
                        <?php } else if ($transaction['status'] == 'Ditolak') {  ?>
                            <th scope="" class="text-danger"><?= $transaction['status']; ?></th>
                        <?php } else { ?>
                            <th scope="" class="text-danger"><?= $transaction['status']; ?></th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th scope="">Time</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $transaction['created_at']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Alamat Kontak</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $transaction['contact']; ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>