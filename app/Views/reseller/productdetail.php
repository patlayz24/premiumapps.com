<?= $this->include('reseller/template/header'); ?>
<style>
    .btn-check {
        visibility: hidden;
    }

    .btn-check:checked+label {
        background: #115db4dc;
        color: #fff;
    }
</style>

<section>
    <div class="">
        <div class="row d-flex justify-content-center">

            <div class="col-lg-3 col-sm-12 mb-2">
                <div class="card" style="width:100%;">
                    <img src="<?= base_url('assets/images/gamelist/' . $game['thumbnail']); ?>" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h3><?= $game['game_name']; ?></h3>
                        <p class="card-text">
                            <?= $game['desc']; ?>
                        </p>
                        <p>
                            Cara Melakukan Pemesanan:
                        </p>
                        <ol>
                            <li>Masukan ID game anda dengan benar</li>
                            <li>Pilihlah Denominasi yang anda inginkan</li>
                            <li>Masukan Jumlah Denominasi yang ingin anda beli</li>
                            <li>Pilihlah Metode Pembayaran</li>
                            <li>Masukan kode promo bila memilikinya</li>
                            <li>Silakan Checkout dan segera lakukan pembayaran :)</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('reseller/transaction'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="<?= $game['id_game']; ?>" name='id_game'>
                    <div class="card mb-2">
                        <div class="card-header">
                            <strong>1. Masukan ID</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-outline mb-2">
                                <input type="text" id="form1" class="form-control" name="user_id" />
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header">
                            <strong>2. Pilih Nominal</strong>
                        </div>
                        <div class="card-body">
                            <?php foreach ($products as $product) : ?>
                                <?php if ($game['id_game'] == $product['id_game']) : ?>
                                    <?php if ($product['stock'] > 0) { ?>
                                        <input type="radio" class="btn-check denom" name="denom" id="<?= $product['denomination']; ?>" autocomplete="off" value="<?= $product['denomination']; ?>" data-price="<?= $product['price']; ?>">
                                        <label class="btn btn-outline-primary mb-1" for="<?= $product['denomination']; ?>"><?= $product['denomination']; ?> </label>
                                    <?php } else { ?>
                                        <input type="radio" class="btn-check denom" name="denom" id="<?= $product['denomination']; ?>" autocomplete="off" value="<?= $product['denomination']; ?>" data-price="<?= $product['price']; ?>" disabled>
                                        <label class="btn btn-outline-danger mb-1" for="<?= $product['denomination']; ?>"><?= $product['denomination']; ?> </label>
                                <?php }
                                endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header">
                            <strong>3. Jumlah</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-outline">
                                <input type="number" id="typeNumber" class="form-control" name="quantity" value='1' />
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header">
                            <strong>5. Alamat Kontak</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-outline">
                                <input type="number" id="typenumber" class="form-control" name="contact" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn btn-danger" style="width: 100%;">Beli Sekarang</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</section>

<?= $this->include('reseller/template/footer'); ?>