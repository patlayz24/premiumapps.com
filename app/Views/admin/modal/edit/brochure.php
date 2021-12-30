<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="addBrochureLabel">Edit Brochure</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="<?= base_url("admin/brochure/editbrochure/" . $brochure['id']); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="old_thumbnail" value="<?= $brochure['thumbnail']; ?>">
            <div class="form-group">
                <label for="brochure_name">Nama Brosur</label>
                <input type="text" class="form-control" id="brochure_name" placeholder="Contoh : Mobile Legend" name="brochure_name" value="<?= (old('brochure_name')) ? old('brochure_name') : $brochure['brochure_name']; ?>">
            </div>

            <div class="form-group">
                <label for="desc_brochure">Deskripsi</label>
                <textarea class="form-control" id="desc_brochure" rows="3" name="desc_brochure"><?= (old('desc_brochure')) ? old('desc_brochure') : $brochure['desc']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="thumbnail">Photo Brosur</label>
                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
            </div>
            <button type="submit" class="btn btn-success">Ubah</button>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>