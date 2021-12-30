<div class="card mb-2">
    <div class="card-header">
        <strong>Status Transaksi</strong>
    </div>
    <div class="card-body">

        <?php if ($transaction['transaction_number'] != null) { ?>

            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="">Transaksi</th>
                            <th scope=""> : </th>
                            <th scope=""><?= $transaction['transaction_number']; ?></th>

                        </tr>
                        <tr>
                            <th scope="">Nama Game</th>
                            <th scope=""> : </th>
                            <th scope=""><?= $transaction['game_name']; ?></th>
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
                            <?php } else if ($transaction['status'] == 'Terkonfirmasi') { ?>
                                <th scope="" class="text-primary"><?= $transaction['status']; ?></th>
                            <?php } else if ($transaction['status'] == 'Diproses') { ?>
                                <th scope="" class="text-primary"><?= $transaction['status']; ?></th>
                            <?php } else if ($transaction['status'] == 'Selesai') {  ?>
                                <th scope="" class="text-success"><?= $transaction['status']; ?></th>
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
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="">Maaf transaksi anda tidak tercatat didalam sistem kami, silakan hubungi customer service :)</th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php } ?>
        <div class="row">
            <button class="btn btn-danger btn-sm" onclick="location.reload()">Selesai</button>
        </div>
    </div>
</div>