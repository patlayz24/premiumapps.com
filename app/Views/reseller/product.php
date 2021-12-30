<?= $this->include('reseller/template/header'); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-danger">PRODUCTS</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Game</th>
                        <th>Denominasi</th>
                        <th>Harga Reseller</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($products as $product) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $product['game_name']; ?></td>
                            <td><?= $product['denomination']; ?></td>
                            <td>Rp. <?= $product['reseller_price']; ?></td>
                            <?php if ($product['stock'] != 0) { ?>
                                <td class="text-success">Tersedia</td>
                            <?php } else { ?>
                                <td class="text-danger">Habis</td>
                            <?php } ?>
                        </tr>
                    <?php
                        $i++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->include('reseller/template/footer'); ?>