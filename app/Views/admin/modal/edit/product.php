<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="addProductLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action='<?= base_url('admin/product/update/' . $product['id_product']); ?>' method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="select_game">Pilih Game</label>
                <select class="form-control" id="select_game" name="select_game">
                    <option value="" selected>Pilih</option>
                    <?php foreach ($games as $game) : ?>
                        <option value="<?= $game['id_game']; ?>" <?= ($product['id_game']) == $game['id_game']  ? 'selected' : ''; ?>><?= $game['game_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="denomination">Denominasi</label>
                <input type="text" class="form-control" id="denomination" name="denomination" value="<?= (old('denomination')) ? old('denomination') : $product['denomination']; ?>">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?= (old('stock')) ? old('stock') : $product['stock']; ?>">
            </div>
            <div class=" form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control price" id="price" name="price" value="<?= (old('price')) ? old('price') : $product['price']; ?>">
            </div>
            <div class="form-group">
                <label for="reseller_price">Harga Reseller</label>
                <input type="number" class="form-control price" id="reseller_price" name="reseller_price" value="<?= (old('reseller_price')) ? old('reseller_price') : $product['reseller_price']; ?>">
            </div>
            <button type="submit" class="btn btn-success">Ubah</button>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>