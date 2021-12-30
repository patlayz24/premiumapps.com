<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">BERITA & INFORMASI</h4>
        <a class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addInfo"><i class="fas fa-download fa-sm text-white-50 mr-2"></i>Add Info</a>
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
                        <th>Berita & Informasi</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php $i = 1;
                foreach ($informations as $information) : ?>
                    <tbody>
                        <td><?= $i++; ?></td>
                        <td><?= $information['info']; ?></td>
                        <td><?= date("l, d F Y", strtotime($information['updated_at'])); ?></td>
                        <td>
                            <form action="<?= base_url('admin/info/delete/' . $information['id']); ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="addInfo" tabindex="-1" role="dialog" aria-labelledby="addInfoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInfoLabel">Tambah Berita & Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/info/addinfo'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="info">Berita & Informasi</label>
                        <textarea type="text" class="form-control" id="info" name="info"></textarea>
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


<?= $this->include('admin/template/footer'); ?>