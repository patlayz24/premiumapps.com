<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Social Media</h4>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addSocial"><i class="fas fa-download fa-sm text-white-50 mr-2"></i>Add Social</a>
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
                        <th>Social Media</th>
                        <th>Username</th>
                        <th>link</th>
                        <th>a class</th>
                        <th>Icon class</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    foreach ($socials as $social) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $social['social_media']; ?></td>
                            <td><?= $social['username']; ?></td>
                            <td><a href="<?= $social['url']; ?>"><?= $social['url']; ?></a></td>
                            <td>
                                <?= $social['a_class']; ?>
                                <button class="btn" style="background-color:<?= $social['a_class']; ?>;">

                                </button>
                            </td>
                            <td>
                                <?= $social['icon_class']; ?>
                            </td>
                            <td>
                                <form action="<?= base_url('admin/social/delete/' . $social['id']); ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                <a id="<?= $social['id']; ?>" class="btn btn-primary view_data_social mb-1"><i class="fas fa-pen"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Modal Social -->
<div class="modal fade" id="addSocial" tabindex="-1" role="dialog" aria-labelledby="addSocialLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSocialLabel">Add Social</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/social/addsocial'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="social">Social Media</label>
                        <input type="text" class="form-control" id="social" name="social">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="url">Link</label>
                        <input type="text" class="form-control" id="url" name="url">
                    </div>
                    <div class="form-group">
                        <label for="a_class">a Class</label>
                        <input type="text" class="form-control" id="a_class" name="a_class">
                    </div>
                    <div class="form-group">
                        <label for="icon_class">Icon Class</label>
                        <input type="text" class="form-control" id="icon_class" name="icon_class">
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


<!-- Modal Social -->
<div class="modal fade" id="edit_social" tabindex="-1" role="dialog" aria-labelledby="edit_social" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_edit_social">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_social", function(event) {
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/social/detail'); ?>' + '/' + id,
                method: 'get',
                success: function(data) {
                    $('#data_edit_social').html(data);
                    $('#edit_social').modal("show");
                }
            });
        });
    });
</script>


<?= $this->include('admin/template/footer'); ?>