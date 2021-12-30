<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">About Website</h4>
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
                        <th>About</th>
                        <th>Promotion</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?= $about['about']; ?></td>
                        <td><?= $about['promotion']; ?></td>
                        <td>
                            <a class="btn btn-primary view_data_about mb-1"><i class="fas fa-pen"></i></a>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
</div>


<!-- Modal Brochure -->
<div class="modal fade" id="edit_about" tabindex="-1" role="dialog" aria-labelledby="edit_about" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_edit_about">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_about", function(event) {

            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/about/detail'); ?>',
                method: 'get',
                success: function(data) {
                    $('#data_edit_about').html(data);
                    $('#edit_about').modal("show");
                }
            });
        });
    });
</script>


<?= $this->include('admin/template/footer'); ?>