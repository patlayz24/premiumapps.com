<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">DAFTAR RESELLER</h4>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addReseller"><i class="fas fa-download fa-sm text-white-50 mr-2"></i>Add Reseller</a>
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
                        <th>Nama Reseller</th>
                        <th>Email</th>
                        <th>Tanggal Bergabung</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($resellers as $reseller) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $reseller['full_name']; ?></td>
                            <td><?= $reseller['email']; ?></td>
                            <td><?= date("l, d F Y h:i:s", strtotime($reseller['created_at'])); ?></td>
                            <td class="<?= $reseller['status'] ==  1 ? 'text-success' : 'text-danger'; ?>"><?= ($reseller['status'] ==  1) ? 'Active' : 'Not Active'; ?></td>
                            <td>
                                <form action="<?= base_url('admin/reseller/delete/' . $reseller['id_reseller']); ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                <form action="<?= base_url('admin/reseller/setactive/' . $reseller['id_reseller']); ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="setactive" value="<?= $reseller['status'] ==  1 ? '0' : '1'; ?>">
                                    <button type="submit" class="btn btn-<?= $reseller['status'] ==  1 ? 'danger' : 'primary'; ?> mb-1"><i class="fas fa-<?= $reseller['status'] ==  1 ? 'stop' : 'play'; ?>"></i></button>
                                </form>
                                <button class="btn btn-info mb-1 view_data_reseller" id="<?= $reseller['id_reseller']; ?>"><i class="fas fa-question-circle"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Reseller-->
<div class="modal fade" id="addReseller" tabindex="-1" role="dialog" aria-labelledby="addResellerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addResellerLabel">Add Reseller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/reseller/register'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="full_name">Nama lengkap</label>
                        <input type="text" class="form-control" id="fullName" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">No. Hp</label>
                        <input type="number" class="form-control" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="inputAddress" name="address">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-success">Tambah User</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Reseller-->
<div class="modal fade" id="detail_reseller" tabindex="-1" role="dialog" aria-labelledby="detail_resellerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_reseller_detail">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_reseller", function(event) {
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/reseller/detail'); ?>' + '/' + id,
                method: 'get',
                success: function(data) {
                    $('#data_reseller_detail').html(data);
                    $('#detail_reseller').modal("show");
                }
            });
        });
    });
</script>


<?= $this->include('admin/template/footer'); ?>