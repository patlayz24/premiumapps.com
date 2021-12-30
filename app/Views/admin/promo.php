<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">KODE PROMO</h4>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPromo"><i class="fas fa-download fa-sm text-white-50 mr-2"></i>Add Promo Code</a>
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Promo</th>
                        <th>Kode Promo</th>
                        <th>Potongan</th>
                        <th>Stock</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($promos as $promo) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $promo['promo_name']; ?></td>
                            <td><?= $promo['promo_code']; ?></td>
                            <td><?= $promo['discount']; ?>%</td>
                            <td><?= $promo['stock']; ?></td>
                            <td><?= date("l, d F Y", strtotime($promo['updated_at'])); ?></td>
                            <td>
                                <form action="<?= base_url('admin/promo/delete/' . $promo['id']); ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                <a id="<?= $promo['id']; ?>" class="btn btn-primary view_data_promo mb-1"><i class="fas fa-pen"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Add Promo-->
<div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="addPromoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPromoLabel">Add Promo Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/promo/addpromo'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="promo_name">Nama Promo</label>
                        <input type="text" class="form-control" id="promo_name" name="promo_name">
                    </div>
                    <div class="form-group">
                        <label for="promo_code">Kode Promo</label>
                        <input type="text" class="form-control price" id="promo_code" name="promo_code">
                    </div>
                    <div class="form-group">
                        <label for="discount">Persentase Potongan</label>
                        <input type="number" class="form-control price" id="discount" name="discount">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control price" id="stock" name="stock">
                    </div>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Promo-->
<div class="modal fade" id="edit_promo" tabindex="-1" role="dialog" aria-labelledby="edit_promo" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_edit_promo">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_promo", function(event) {
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/promo/detail'); ?>' + '/' + id,
                method: 'get',
                success: function(data) {
                    $('#data_edit_promo').html(data);
                    $('#edit_promo').modal("show");
                }
            });
        });
    });
</script>

<?= $this->include('admin/template/footer'); ?>