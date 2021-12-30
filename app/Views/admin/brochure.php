<?= $this->include('admin/template/header'); ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">BROCHURE</h4>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addBrochure"><i class="fas fa-download fa-sm text-white-50 mr-2"></i>Add Brochure</a>
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
                        <th>No</th>
                        <th>Nama Brosur</th>
                        <th>Deskripsi</th>
                        <th>Photo Brosur</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($brochures as $brochure) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $brochure['brochure_name']; ?></td>
                            <td><?= $brochure['desc']; ?></td>
                            <td><img src="<?= base_url('assets/images/brochures/' . $brochure['thumbnail']); ?>" height="80px" width="100px"></td>
                            <td><?= date("l, d F Y", strtotime($brochure['updated_at'])); ?></td>
                            <td>
                                <form action="<?= base_url('admin/brochure/delete/' . $brochure['id']); ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                <a id="<?= $brochure['id']; ?>" class="btn btn-primary view_data_brochure mb-1"><i class="fas fa-pen"></i></a>
                                <!-- <button type="submit" class="btn btn-primary mb-1"><i class="fas fa-pen"></i></button> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Brochure -->
<div class="modal fade" id="addBrochure" tabindex="-1" role="dialog" aria-labelledby="addBrochureLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBrochureLabel">Add Brochure</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("admin/brochure/addbrochure"); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="brochure_name">Nama Brosur</label>
                        <input type="text" class="form-control" id="brochure_name" placeholder="Contoh : Mobile Legend" name="brochure_name">
                    </div>

                    <div class="form-group">
                        <label for="desc_brochure">Deskripsi</label>
                        <textarea class="form-control" id="desc_brochure" rows="3" name="desc_brochure"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Photo Brosur</label>
                        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
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

<!-- Modal Brochure -->
<div class="modal fade" id="edit_brochure" tabindex="-1" role="dialog" aria-labelledby="edit_brochure" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_edit_brochure">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_brochure", function(event) {
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/brochure/detail'); ?>' + '/' + id,
                method: 'get',
                success: function(data) {
                    $('#data_edit_brochure').html(data);
                    $('#edit_brochure').modal("show");
                }
            });
        });
    });
</script>

<?= $this->include('admin/template/footer'); ?>