<?= $this->include('reseller/template/header'); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-danger">BERITA & INFORMASI</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Konten</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($informations as $information) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $information['info']; ?></td>
                            <td><?= $information['created_at']; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('reseller/template/footer'); ?>