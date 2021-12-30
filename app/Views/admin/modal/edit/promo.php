<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="addPromoLabel">Add Promo Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('admin/promo/editproduct/' . $promos['id']); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="promo_name">Nama Promo</label>
                <input type="text" class="form-control" id="promo_name" name="promo_name" value='<?= (old('promo_name')) ? old('promo_name') : $promos['promo_name']; ?>'>
            </div>
            <div class="form-group">
                <label for="promo_code">Kode Promo</label>
                <input type="text" class="form-control price" id="promo_code" name="promo_code" value="<?= (old('promo_code')) ? old('promo_code') : $promos['promo_code']; ?>">
            </div>
            <div class="form-group">
                <label for="discount">Persentase Potongan</label>
                <input type="number" class="form-control price" id="discount" name="discount" value="<?= (old('discount')) ? old('discount') : $promos['discount']; ?>">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control price" id="stock" name="stock">
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>