<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="social">Edit Social</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action='<?= base_url('admin/social/edit/' . $social['id']); ?>' method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="social">Social Media</label>
                <input type="text" class="form-control" id="social" name="social" value="<?= $social['social_media']; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $social['username']; ?>">
            </div>
            <div class="form-group">
                <label for="url">Link</label>
                <input type="text" class="form-control" id="url" name="url" value="<?= $social['url']; ?>">
            </div>
            <div class=" form-group">
                <label for="a_class">a Class</label>
                <input type="text" class="form-control" id="a_class" name="a_class" value="<?= $social['a_class']; ?>">
            </div>
            <div class=" form-group">
                <label for="icon_class">Icon Class</label>
                <input type="text" class="form-control" id="icon_class" name="icon_class" value="<?= $social['icon_class']; ?>">
            </div>
            <button type="submit" class="btn btn-success">Ubah</button>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>