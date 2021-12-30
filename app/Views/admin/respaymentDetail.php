<?= $this->include('admin/template/header'); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">REPORT RESELLER - NAMA RESELLER</h4>
        <small>Senin, 26 Juni 2021</small>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50 mr-1"></i> Export Report</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID TRX</th>
                        <th>Nama Game</th>
                        <th>ID User</th>
                        <th>Denom</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#TRX0009921</td>
                        <td>Mobile Legend</td>
                        <td>122131238</td>
                        <td>1000</td>
                        <td>Rp. 2.000.000</td>
                        <td class="text-success">(4) Success</td>
                        <td>2016-05-04 12:00:00</td>
                        <td>
                            <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#detailLaporan"><i class="fas fa-question-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#TRX0009922</td>
                        <td>Mobile Legend</td>
                        <td>122131238</td>
                        <td>1000</td>
                        <td>Rp. 2.000.000</td>
                        <td class="text-success">(4) Success</td>
                        <td>2016-05-04 12:00:00</td>
                        <td>
                            <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#detailLaporan"><i class="fas fa-question-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#TRX0009923</td>
                        <td>Mobile Legend</td>
                        <td>122131238</td>
                        <td>1000</td>
                        <td>Rp. 2.000.000</td>
                        <td class="text-success">(4) Success</td>
                        <td>2016-05-04 12:00:00</td>
                        <td>
                            <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#detailLaporan"><i class="fas fa-question-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#TRX0009924</td>
                        <td>PUBG : Player Unknown Battleground</td>
                        <td>122131238</td>
                        <td>1000</td>
                        <td>Rp. 2.000.000</td>
                        <td class="text-danger">(5) Failed</td>
                        <td>2016-05-04 12:00:00</td>
                        <td>
                            <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#detailLaporan"><i class="fas fa-question-circle"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->include('admin/template/footer'); ?>