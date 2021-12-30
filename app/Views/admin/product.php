<?= $this->include('admin/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">PRODUCTS</h4>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addProduct"><i class="fas fa-download fa-sm text-white-50 mr-2"></i>Add Products</a>
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
                        <th>Denominasi</th>
                        <th>Harga</th>
                        <th>Harga Reseller</th>
                        <th>Stok</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($products as $product) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $product['game_name']; ?></td>
                            <td><?= $product['denomination']; ?></td>
                            <td>Rp. <?= $product['price']; ?></td>
                            <td>Rp. <?= $product['reseller_price']; ?></td>
                            <td><?= $product['stock']; ?></td>
                            <td><?= date("l, d F Y", strtotime($product['updated_at'])); ?></td>
                            <td>
                                <form action="<?= base_url('admin/product/delete/' . $product['id_product']); ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('apakah anda yakin?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                <a id="<?= $product['id_product']; ?>" class="btn btn-primary view_data_product mb-1"><i class="fas fa-pen"></i></a>
                                <!-- <button type="button" class="btn btn-primary mb-1 view_data_product" id="<?= $product['id_product']; ?>"><i class="fas fa-pen"></i></button> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal Add Product-->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action='<?= base_url("admin/product/addproduct"); ?>' method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="select_game">Pilih Game</label>
                        <select class="form-control" id="select_game" name="select_game">
                            <option value="" selected>Pilih</option>
                            <?php foreach ($games as $game) : ?>
                                <option value="<?= $game['id_game']; ?>"><?= $game['game_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="denomination">Denominasi</label>
                        <input type="text" class="form-control" id="denomination" name="denomination">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="<?= (old('stock')) ? old('stock') : $product['stock']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" class="form-control price" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="reseller_price">Harga Reseller</label>
                        <input type="number" class="form-control price" id="reseller_price" name="reseller_price">
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

<!-- Modal Edit Product-->
<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="edit_product" aria-hidden="true">
    <div class="modal-dialog" role="document" id="data_edit_product">

    </div>
</div>

<script defer>
    $(document).ready(function() {
        $('body').on("click", ".view_data_product", function(event) {
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('admin/product/detail'); ?>' + '/' + id,
                method: 'get',
                success: function(data) {
                    $('#data_edit_product').html(data);
                    $('#edit_product').modal("show");
                }
            });
        });
    });
</script>


<?= $this->include('admin/template/footer'); ?>