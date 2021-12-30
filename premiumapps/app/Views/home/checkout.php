<?= $this->include('home/template/header'); ?>

<section style="color:#000;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center pb-5">
                            <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
                                <div class="py-4 d-flex flex-row">
                                    <h2><b>PAYMENT SECTION</b></h2>
                                </div>
                                <h4 class="text-success">#<?= session('transaction_number'); ?></h4>
                                <h2><?= $game['game_name']; ?></h2>
                                <div class="d-flex pt-2">
                                    <div>
                                        <p>
                                            <b><span class="text-success"><?= $transaction['denomination']; ?></span> x <?= $transaction['quantity']; ?></b>
                                        </p>
                                    </div>
                                    <div class="ms-auto">
                                        <p class="text-primary">
                                            <i class="fas fa-money-bill text-primary pe-1"></i><?= $transaction['payment_method']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex" style="background-color: #f8f9fa;">
                                    <div class="p-2"><b>Date</b></div>
                                    <div class="ms-auto p-2"><?= date("d F Y H:i:s"); ?></div>
                                </div>
                                <div class="d-flex" style="background-color: #f8f9fa;">
                                    <div class="p-2"><b>User ID</b></div>
                                    <div class="ms-auto p-2"><?= $transaction['user_id']; ?></div>
                                </div>
                                <div class="d-flex" style="background-color: #f8f9fa;">
                                    <div class="p-2"><b>Phone</b></div>
                                    <div class="ms-auto p-2"><?= $transaction['contact']; ?></div>
                                </div>
                                <hr />

                                <?php
                                foreach ($paymentMethod as $payment) :
                                    if ($payment['bank_name'] == $transaction['payment_method']) {
                                ?>
                                        <!-- if e-wallet -->
                                        <div class="rounded" style="background-color: #f8f9fa;">
                                            <div class="text-center">
                                                <h3><?= $payment['bank_name']; ?> - <?= $payment['account_name']; ?></h3>
                                            </div>
                                            <div class="text-center">
                                                <strong>Rekening : </strong><strong class="ps-2 pe-2" style="background-color: red; color:#fff; border-radius:25px;"><?= $payment['account_number']; ?></strong>
                                            </div>
                                            <?php if ($payment['thumbnail'] != NULL) { ?>
                                                <div class="text-center">
                                                    <img src="<?= base_url('assets/images/payment/' . $payment['thumbnail']); ?>" class="img-fluid">
                                                </div>
                                            <?php } ?>
                                        </div>
                                <?php
                                    }
                                endforeach ?>
                            </div>
                            <div class="col-md-5 col-xl-4 offset-xl-1">
                                <div class="py-4 d-flex justify-content-end">
                                    <form action='<?= base_url("reject"); ?>' method="POST">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="PUT">
                                        <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Apakah Anda Yakin?');">Cancel and return to website</i></button>
                                    </form>
                                    <!-- <h6>Cancel and return to website</h6> -->

                                </div>

                                <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">

                                    <div class="p-2 me-3">
                                        <h4>Rincian Pembayaran</h4>
                                    </div>
                                    <div class="p-2 d-flex">
                                        <div class="col-4">Harga</div>
                                        <div class="ms-auto">Rp<?= number_format($transaction['price'] * $transaction['quantity'], 2, ",", "."); ?></div>
                                    </div>
                                    <div class="p-2 d-flex">
                                        <div class="col-4">Kode Unik</div>
                                        <div class="ms-auto">Rp<?= $transaction['random']; ?></div>
                                    </div>
                                    <div class="p-2 d-flex">
                                        <div class="col-4">Potongan</div>
                                        <div class="ms-auto"><?= $discount; ?>%</div>
                                    </div>
                                    <div class="border-top px-2 mx-2"></div>
                                    <div class="p-2 d-flex pt-3">
                                        <div class="col-4"><b>Total</b></div>
                                        <div class="ms-auto"><b class="text-success">Rp<?= number_format($transaction['total'], 2, ",", "."); ?></b></div>
                                    </div>
                                </div>
                                <hr />
                                <p>
                                    Segera lakukan transfer ke rekening yang sudah tertera di atas dan segera lakukan konfirmasi agak pesanan anda dapat diproses :)
                                </p>
                                <form action="<?= base_url('transaction'); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <button id="conf_pembayaran" type="submit" class="btn btn-success btn-block btn-lg" onclick="alert('Pembayaran anda sedang di konfirmasi, silakan tunggu dan check kembali pada fitur check pesanan, jika ada masalah dapat menghubungi helpdesk kami, terima kasih.')">Konfirmasi Pembayaran</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // function enableNum() {
    //     document.getElementById("conf_pembayaran").disabled = false;
    //     alert('Silakan Lakukan Pembayaran terlebih dahulu lalu tekan konfirmasi pembayaran');
    //     document.getElementById("conf_pesanan").disabled = true;
    // }
</script>

<?= $this->include('home/template/header'); ?>