<?php foreach ($transactions as $transaction) : ?>
    <tr>
        <td><?= $transaction['transaction_number']; ?></td>

        <td><?= $transaction['game_name']; ?></td>
        <td><?= $transaction['denomination']; ?></td>
        <td><?= $transaction['quantity']; ?></td>
        <td>Rp.<?= number_format($transaction['total'], 2, ",", ".") ?></td>
        <td><?= $transaction['voucher'] == '' ? 'Tidak ada' : $transaction['voucher']; ?></td>
        <td><?= $transaction['payment_method']; ?></td>
        <td class="text-<?= $transaction['status'] == 'Terkonfirmasi' ? 'primary' : 'danger'; ?>"><?= $transaction['status']; ?></td>
        <td>
            <form action='<?= base_url("admin/payment/process/" . $transaction['id_transaction']); ?>' method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-primary btn-sm mb-1" onclick="return confirm('Apakah Anda Yakin?');"><i class="fas fa-check-square"></i></button>
            </form>
            <form action='<?= base_url("admin/payment/reject/" . $transaction['id_transaction']); ?>' method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Apakah Anda Yakin?');"><i class="fas fa-times-circle"></i></button>
            </form>

            <button type="button" class="btn btn-info btn-sm mb-1 view_data_transaction" id="<?= $transaction['transaction_number']; ?>"><i class="fas fa-question-circle"></i></button>
        </td>
    </tr>
<?php endforeach; ?>