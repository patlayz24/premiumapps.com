<?= $this->include('reseller/template/header'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-danger">TOP UP GAME</h4>
    </div>
    <div class="card-body">
        <div class="row game">

            <?php foreach ($games as $game) : ?>
                <div class="box-game">
                    <div class="card">
                        <img src="<?= base_url('assets/images/gamelist/' . $game['thumbnail']); ?>" class="card-img-top">
                        <div class="card-body" style="padding: 0px;">
                            <div class="card-info-1">
                                <?= $game['game_name']; ?>
                            </div>
                            <a href="<?= base_url('reseller/productdetail') . '/' . $game['slug']; ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?= $this->include('reseller/template/footer'); ?>