<script>
    $(document).ready(function() {
        $('.check').click(function() {
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: '<?= base_url('cekpesanan/detail'); ?>' + '/' + id,
                method: 'get',
                error: function(request) {
                    alert("Silakan masukan nomor transaksi anda");
                    location.reload();
                },
                success: function(data) {
                    $('#check_pesanan').html(data);
                    $('#inputTrx').hide();
                }
            });
        });
    });
</script>