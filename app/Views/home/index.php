<?= $this->include('home/template/header'); ?>

<div>

  <section>
    <div class="container">
      <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel">
        <div class="carousel-inner">
          <?php
          $i = 0;
          foreach ($brochures as $brochure) : ?>
            <div class="carousel-item <?php if ($i == 1) echo 'active'; ?>">
              <img src="<?= base_url('assets/images/brochures/' . $brochure['thumbnail']); ?>" class="d-block w-100 img-carousel" alt="..." />
            </div>
          <?php
            $i++;
          endforeach ?>
        </div>
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleControls" data-mdb-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleControls" data-mdb-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div>
  </section>


  <hr>
  <!--Section: Content-->
  <section>
    <div class="container">
      <div class="row">
        <h1 class=" d-flex justify-content-center">POPULER</h1>
        <div class="owl-carousel owl-game my-2">

          <?php foreach ($games as $game) :
            foreach ($recomendations as $recomendation) :
              if ($game['game_name'] == $recomendation['game_name']) {
          ?>
                <div class="item">
                  <div class="box-game">
                    <div class="card">
                      <img src="<?= base_url('assets/images/gamelist/' . $game['thumbnail']); ?>" class="card-img-top">
                      <div class="card-body" style="padding: 0px;">
                        <div class="card-info-1">
                          <?= $game['game_name']; ?>
                        </div>
                        <a href="<?= base_url('/product/' . $game['slug']); ?>" class="stretched-link"></a>
                      </div>
                    </div>
                  </div>
                </div>
          <?php
              }
            endforeach;
          endforeach; ?>

        </div>
      </div>
    </div>
  </section>
  <!--Section: Content-->


  <hr>

  <section>
    <div class="container">
      <div class="row game">
        <h1 class=" d-flex justify-content-center">LAYANAN KAMI</h1>

        <?php foreach ($games as $game) : ?>
          <div class="box-game">
            <div class="card">
              <img src="<?= base_url('assets/images/gamelist/' . $game['thumbnail']); ?>" class="card-img-top">
              <div class="card-body" style="padding: 0px;">
                <div class="card-info-1">
                  <?= $game['game_name']; ?>
                </div>
                <a href="<?= base_url('/product/' . $game['slug']); ?>" class="stretched-link"></a>
              </div>
            </div>
          </div>
        <?php endforeach ?>

      </div>
    </div>

  </section>

</div>
<hr>
<section class="" style=" padding-top:20px; padding-bottom:20px;">
  <div class="">
    <div class="container">
      <div class="row">
        <div class="pt-md-3 pb-md-3 text-left text-md-left">
          <div class="row">
            <div class="mx-auto seo-section ">
              <div class="">
                <h5>Top Up Game &amp; Voucher Murah, Cepat, dan Terpercaya</h5>
                <small><?= $about['promotion']; ?></small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<hr>
<?= $this->include('home/template/footer'); ?>