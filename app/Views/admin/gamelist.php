<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">GAME LIST</h4>
        <a class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addGame"><i class="fas fa-download fa-sm text-white-50 mr-2"></i>Add Game</a>
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
                        <th>Nama Game</th>
                        <th>Deskripsi</th>
                        <th>Thumbnail</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($games as $game) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $game['game_name']; ?></td>
                            <td><?= $game['desc']; ?></td>
                            <td><img src="<?= base_url('assets/images/gamelist/' . $game['thumbnail']); ?>" height="80px" width="100px"></td>
                            <td><?= date("l, d F Y", strtotime($game['updated_at'])); ?></td>
                            <td>
                                <form action="<?= base_url('admin/gamelist/delete/' . $game['id_game']); ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                <a id="<?= $game['slug']; ?>" class="btn btn-primary view_data_game"><i class="fas fa-pen"></i></a>
                                <!-- <button type="button" class="btn btn-primary"><i class="fas fa-pen"></i></button> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Game-->
<div class="modal fade" id="addGame" tabindex="-1" role="dialog" aria-labelledby="addGameLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGameLabel">Add Game</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action='<?= base_url("admin/gamelist/addgame"); ?>' method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="game_name">Nama Game</label>
                        <input type="text" class="form-control" id="game_name" placeholder="Contoh : Mobile Legend" name="game_name" value="" />
                    </div>

                    <div class="form-group">
                        <label for="desc_game">Deskripsi Game</label>
                        <textarea class="form-control" id="desc_game" rows="3" name="desc_game"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">File Thumbnail</label>
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

<!-- Modal Edit Game-->
<div class="modal fade" id="edit_game" tabindex="-1" role="dialog" aria-labelledby="edit_game" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_edit_game">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_game", function(event) {
            var slug = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/gamelist/detail'); ?>' + '/' + slug,
                method: 'get',
                success: function(data) {
                    $('#data_edit_game').html(data);
                    $('#edit_game').modal("show");
                }
            });
        });
    });
</script>

<?= $this->include('admin/template/footer'); ?>