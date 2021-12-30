<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Syarat Dan Ketentuan</h4>
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
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><a href="<?= base_url('assets/pdf/') . '/' . $about['tnc']; ?>"><?= $about['tnc']; ?></a></td>
                        <td>
                            <a class="btn btn-primary view_data_sk mb-1"><i class="fas fa-pen"></i></a>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
</div>


<!-- Modal Brochure -->
<div class="modal fade" id="edit_sk" tabindex="-1" role="dialog" aria-labelledby="edit_sk" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_edit_sk">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_sk", function(event) {

            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/syaratketentuan/detail'); ?>',
                method: 'get',
                success: function(data) {
                    $('#data_edit_sk').html(data);
                    $('#edit_sk').modal("show");
                }
            });
        });
    });
</script>


<?= $this->include('admin/template/footer'); ?>