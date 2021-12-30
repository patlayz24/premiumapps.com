</div>
</main>

<style>
    .footerBrand {
        margin-bottom: 20px;
    }

    @media (max-width: 900px) {
        .footerBrand {
            margin-top: 40px;
        }
    }
</style>
<!--Main layout-->
<div class="container p-4 pb-0">
    <div class="d-flex justify-content-center">
        <h1>FOLLOW US</h1>
    </div>

    <div class="d-flex justify-content-center">
        <!-- Section: Social media -->
        <div class="row">
            <section class="mb-4">
                <?php foreach ($socials as $social) : ?>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: <?= $social['a_class']; ?>;" href="<?= $social['url']; ?>" role="button"><i class="<?= $social['icon_class']; ?>"></i></a>
                <?php endforeach; ?>
            </section>
        </div>
        <!-- Section: Social media -->
    </div>
</div>

<!-- Footer -->
<footer class="text-center text-lg-start text-muted" style="background-color: #edf2f4;">

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class=" fw-bold footerBrand">
                        <img class="me-2" src="<?= base_url('assets/img/logo.png'); ?>" width="30px" height="30px"></img>
                        <small class="" style="font-family: 'Bree Serif', serif; font-size:20px; color: red; "><strong>KOTA</strong></small>
                        <small style="font-size:20px;"><strong>digital</strong></small>
                    </h6>
                    <p>
                        <?= $about['about']; ?>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Reseller
                    </h6>
                    <p>
                        <a href="<?= base_url('assets/pdf/') . $about['tnc']; ?>" class="text-reset">Syarat & Ketentuan</a>
                    </p>
                    <p>
                        <a href="<?= base_url('/resellerlogin'); ?>" class="text-reset">Login Reseller</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Links
                    </h6>
                    <p>
                        <a href="<?= base_url('/cekpesanan'); ?>" class="text-reset">Cek Pesanan</a>
                    </p>
                    <p>
                        <a href="https://bit.ly/3iMpDUu" class="text-reset">Pengaduan Layanan</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Contact
                    </h6>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        kotadigital@gmail.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 62 811202604</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4 bg-dark text-light">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="<?= base_url('/'); ?>">kota-digital.com</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->

<!-- MDB -->
<script type="text/javascript" src="<?= base_url('assets/js/mdb.min.js'); ?>"></script>

<!-- OwlCarousel -->
<script type="text/javascript" src="<?= base_url('assets/dist/owl.carousel.min.js'); ?>"></script>
<!-- Custom scripts -->
<script type="text/javascript" src="<?= base_url('assets/js/main.js'); ?>"></script>

<!-- jQuery Function -->
<script>
    $(document).ready(function() {
        var owl = $('.owl-game');
        owl.owlCarousel({
            margin: 10,
            nav: false,
            dots: false,
            loop: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                },
                1400: {
                    items: 5
                }
            }
        })
    })
</script>

<?= $this->include('home/template/ajax'); ?>

</body>

</html>