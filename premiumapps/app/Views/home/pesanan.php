<?= $this->include('home/template/header'); ?>

<section>

    <div class="container">

        <div class="row d-flex justify-content-center">

            <div class="col-lg-8 col-sm-12">
                <div class="card mb-2" id="inputTrx">
                    <div class="card-header">
                        <strong>MASUKAN KODE TRANSAKSI</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-outline mb-2">
                            <input type="text" id="kodetrx" class="form-control" autocomplete="off" />
                            <label class="form-label" for="kodetrx">Kode Transaksi</label>
                        </div>
                        <a class="btn btn-primary check" id="kode" onclick="getInputValue()">Check</a>

                        <script>
                            function getInputValue() {
                                // Selecting the input element and get its value 
                                var inputVal = document.getElementById("kodetrx").value;
                                document.getElementById('kode').id = inputVal;
                            }
                        </script>

                    </div>
                </div>

                <div class="div" id="check_pesanan">

                </div>


            </div>
        </div>

    </div>

</section>

<?= $this->include('home/template/footer'); ?>