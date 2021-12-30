<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="addBrochureLabel">Edit About</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('admin/syaratketentuan/edit'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="snk">File Syarat & Ketentuan</label>
                <input type="file" class="form-control-file" id="snk" name="snk">
            </div>
            <button type="submit" class="btn btn-success">Ubah</button>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>