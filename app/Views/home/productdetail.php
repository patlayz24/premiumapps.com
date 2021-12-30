<?= $this->include('home/template/header'); ?>

<style>
    .btn-payment {
        width: 100%;
    }

    .payment-img {
        width: auto;
        height: 20px;

    }
</style>

<section style="color: #000;">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-sm-12">
                <div class="row">
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
                        <form action="<?= base_url('/process'); ?>" method="post" autocomplete="off">
                            <?= csrf_field(); ?>
                            <input type="hidden" value="<?= $game['id_game']; ?>" name='id_game'>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <strong>1. Masukan ID</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-outline mb-2">
                                        <input type="text" id="user_id" class="form-control" name="user_id" value="<?= old('user_id'); ?>" />
                                        <label class="form-label" for="user_id">User ID</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <strong>2. Pilih Nominal</strong>
                                </div>
                                <div class="card-body">
                                    <?php $i = 1;
                                    foreach ($products as $product) : ?>

                                        <?php if ($product['stock'] > 0) { ?>
                                            <input type="radio" class="btn-check denom" name="denom" id="<?= $product['denomination']; ?>" autocomplete="off" value="<?= $product['denomination']; ?>" data-price="<?= $product['price']; ?>">
                                            <label class="btn btn-outline-primary mb-1" for="<?= $product['denomination']; ?>"><?= $product['denomination']; ?> </label>
                                        <?php } else { ?>
                                            <input type="radio" class="btn-check denom" name="denom" id="<?= $product['denomination']; ?>" autocomplete="off" value="<?= $product['denomination']; ?>" data-price="<?= $product['price']; ?>" disabled>
                                            <label class="btn btn-outline-danger mb-1" for="<?= $product['denomination']; ?>"><?= $product['denomination']; ?> </label>
                                        <?php }
                                        ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <strong>3. Jumlah</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-outline">
                                        <input type="number" id="typeNumber" class="form-control qty" name="quantity" value="1" min="1" required value='<?= old('quantity'); ?>' />
                                        <label class="form-label" for="typeNumber">Masukan Jumlah</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <strong>4. Metode Pembayaran</strong>
                                </div>
                            </div>
                            <?php foreach ($paymentCategories as $paymentCategory) : ?>
                                <?php if ($paymentCategory == 'Gerai') {
                                    continue;
                                } ?>
                                <div class="card mb-2">
                                    <div class="card-header">
                                        <strong><?= $paymentCategory; ?></strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="pb-3">
                                            <?php foreach ($paymentmethods as $payment) :
                                                if ($payment['category'] == $paymentCategory) {
                                            ?>
                                                    <div class="d-flex flex-row pb-3">

                                                        <div class="d-flex align-items-center pe-2">
                                                            <input class="form-check-input" type="radio" name="method" id="<?= $payment['bank_name']; ?>" value="<?= $payment['bank_name']; ?>" aria-label="..." />
                                                        </div>
                                                        <label for="<?= $payment['bank_name']; ?>" class="rounded border d-flex w-100 p-3 align-items-center">
                                                            <p class="mb-0">
                                                                <img class="pe-2 payment-img" src="<?= base_url('assets/images/logo/' . $payment['logo']); ?>">
                                                                <strong><?= $payment['bank_name']; ?></strong>
                                                            </p>
                                                            <div class="ms-auto" style="background-color: red; color:#fff; border-radius:25px;">
                                                                <div id="pricePreview<?= $i; ?>" class="mx-2"></div>
                                                            </div>
                                                            <script>
                                                                $(".denom").add(".qty").change(function() {
                                                                    if ($(' .qty').val() != null) {
                                                                        var rupiah = 'Rp. '
                                                                        $("#pricePreview<?= $i; ?>").html(($("input:checked").data('price') * $(".qty").val()) + <?= $payment['admin_fee']; ?>).prepend(rupiah);
                                                                    }
                                                                });
                                                            </script>
                                                        </label>
                                                    </div>
                                            <?php
                                                    $i++;
                                                }
                                            endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <strong>5. Alamat Kontak</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-outline">
                                        <input type="number" id="typeEmail" class="form-control" name='contact' value='<?= old('contact'); ?>' />
                                        <label class="form-label" for="typeEmail">Nomor WA</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2" id="Voucher" style="display: none;">
                                <div class="card-header">
                                    <strong>MASUKAN KODE VOUCHER</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-outline">
                                        <input type="text" id="voucher" class="form-control" name='voucher' value='<?= old('voucher'); ?>' />
                                        <label class="form-label" for="voucher">Kode Voucher</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-between">
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-success mb-2" onclick="voucherField()" style="width: 100%;">Pakai Voucher !</button>
                                </div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-danger" style="width: 100%;">Beli Sekarang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function voucherField() {
        var x = document.getElementById("Voucher");
        if (x.style.display === "none") {
            x.style.display = "";
        } else {
            x.style.display = "none";
        }
    }
</script>
<?= $this->include('home/template/footer'); ?>