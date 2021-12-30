<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="detailResellerLabel">Detail Reseller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="">ID Reseller</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $reseller['id_reseller']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Nama Lengkap</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $reseller['full_name']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Email</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $reseller['email']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Nomor HP</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $reseller['phone']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Alamat</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $reseller['address']; ?></th>
                    </tr>
                    <tr>
                        <th scope="">Status</th>
                        <th scope=""> : </th>
                        <?php if ($reseller['status'] == 1) { ?>
                            <th scope="" class="text-success">Active</th>
                        <?php } else { ?>
                            <th scope="" class="text-danger">Not Active</th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th scope="">Tanggal Bergabung</th>
                        <th scope=""> : </th>
                        <th scope=""><?= $reseller['created_at']; ?></th>
                    </tr>

                </thead>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>