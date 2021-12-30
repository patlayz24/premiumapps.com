<?php foreach ($transactions as $transaction) : ?>
    <tr>
        <td><?= $transaction['transaction_number']; ?></td>
        <td>
            <span class="badge badge-pill badge-<?= $transaction['id_reseller'] != 0 ? 'success' : 'primary'; ?>"><?= $transaction['id_reseller'] != 0 ? 'Reseller' : 'Pembeli'; ?></sp>
        </td>
        <td><?= $transaction['game_name']; ?></td>
        <td><?= $transaction['denomination']; ?></td>
        <td><?= $transaction['quantity']; ?></td>
        <td><?= $transaction['user_id']; ?></td>
        <td><?= date("l, d F Y h:i:s", strtotime($transaction['created_at'])); ?></td>
        <td>
            <form action='<?= base_url("admin/proses/selesai/" . $transaction['id_transaction']); ?>' method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-primary btn-sm mb-1" onclick="return confirm('Apakah Anda Yakin?');"><i class="fas fa-check-square mr-1"></i></button>
            </form>
            <?php if ($transaction['id_reseller'] > 0) : ?>
                <form action='<?= base_url("admin/proses/reject/" . $transaction['id_transaction']); ?>' method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Apakah Anda Yakin?');"><i class="fas fa-times-circle"></i></button>
                </form>
            <?php endif; ?>
            <button type="button" class="btn btn-info btn-sm mb-1 view_data_transaction" id="<?= $transaction['transaction_number']; ?>"><i class="fas fa-question-circle"></i></button>
        </td>
    </tr>
<?php
endforeach ?>