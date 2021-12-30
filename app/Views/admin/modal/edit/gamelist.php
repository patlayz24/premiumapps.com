<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="addGameLabel">Edit Game</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action='<?= base_url("admin/gamelist/editgame/" . $gamelist['id_game']); ?>' method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="old_thumbnail" value="<?= $gamelist['thumbnail']; ?>">
            <div class="form-group">
                <label for="game_name">Nama Game</label>
                <input type="text" class="form-control" id="game_name" value="<?= (old('game_name')) ? old('game_name') : $gamelist['game_name']; ?>" name="game_name" />
            </div>

            <div class="form-group">
                <label for="desc_game">Deskripsi Game</label>
                <textarea class="form-control" id="desc_game" rows="3" name="desc_game"><?= (old('desc_game')) ? old('desc_game') : $gamelist['desc']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="thumbnail">File Thumbnail</label>
                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
            </div>
            <button type="submit" class="btn btn-success">Ubah Data</button>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
    </div>
</div>