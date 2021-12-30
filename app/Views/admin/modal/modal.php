<!-- Modal Change Password-->
<div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="editPasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPasswordLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="oldpassword">Password Lama</label>
                        <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                    </div>
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profile-->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="form-group">
                        <label for="full_name">Nama lengkap</label>
                        <input type="text" class="form-control" id="fullName" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">No. Hp</label>
                        <input type="number" class="form-control" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="inputAddress" name="address">
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Transaksi-->
<div class="modal fade" id="detailTransaksi" tabindex="-1" role="dialog" aria-labelledby="detailTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTransaksiLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="">ID Transaksi</th>
                                <th scope=""> : </th>
                                <th scope="">#TRX0009921</th>
                            </tr>
                            <tr>
                                <th scope="">Nama Game</th>
                                <th scope=""> : </th>
                                <th scope="">PUBG Player Unknown Battleground</th>
                            </tr>
                            <tr>
                                <th scope="">Denominasi</th>
                                <th scope=""> : </th>
                                <th scope="">1000</th>
                            </tr>
                            <tr>
                                <th scope="">Harga</th>
                                <th scope=""> : </th>
                                <th scope="">Rp. 2.000.000</th>
                            </tr>

                            <tr>
                                <th scope="">Kode Unik</th>
                                <th scope=""> : </th>
                                <th scope="">245</th>
                            </tr>
                            <tr>
                                <th scope="">Payment</th>
                                <th scope=""> : </th>
                                <th scope="">BCA Transfer</th>
                            </tr>
                            <tr>
                                <th scope="">Status</th>
                                <th scope=""> : </th>
                                <th scope="" class="text-success">(3) Pembayaran Diterima</th>
                            </tr>
                            <tr>
                                <th scope="">Time</th>
                                <th scope=""> : </th>
                                <th scope="">2016-05-04 12:00:00</th>
                            </tr>
                            <tr>
                                <th scope="">Alamat Kontak</th>
                                <th scope=""> : </th>
                                <th scope="">kennethliem991@gmail.com</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Detail Laporan Transaksi-->
<div class="modal fade" id="detailLaporan" tabindex="-1" role="dialog" aria-labelledby="detailLaporanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailLaporanLabel">Detail Laporan Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="">ID Transaksi</th>
                                <th scope=""> : </th>
                                <th scope="">#TRX0009921</th>
                            </tr>
                            <tr>
                                <th scope="">ID Reseller</th>
                                <th scope=""> : </th>
                                <th scope="">Umum</th>
                            </tr>
                            <tr>
                                <th scope="">Nama Game</th>
                                <th scope=""> : </th>
                                <th scope="">PUBG Player Unknown Battleground</th>
                            </tr>
                            <tr>
                                <th scope="">Denominasi</th>
                                <th scope=""> : </th>
                                <th scope="">1000</th>
                            </tr>
                            <tr>
                                <th scope="">Harga</th>
                                <th scope=""> : </th>
                                <th scope="">Rp. 2.000.000</th>
                            </tr>

                            <tr>
                                <th scope="">Kode Unik</th>
                                <th scope=""> : </th>
                                <th scope="">245</th>
                            </tr>
                            <tr>
                                <th scope="">Payment</th>
                                <th scope=""> : </th>
                                <th scope="">BCA Transfer</th>
                            </tr>
                            <tr>
                                <th scope="">Status</th>
                                <th scope=""> : </th>
                                <th scope="" class="text-danger">Failed</th>
                            </tr>
                            <tr>
                                <th scope="">Time</th>
                                <th scope=""> : </th>
                                <th scope="">2016-05-04 12:00:00</th>
                            </tr>
                            <tr>
                                <th scope="">Alamat Kontak</th>
                                <th scope=""> : </th>
                                <th scope="">kennethliem991@gmail.com</th>
                            </tr>

                            <tr>
                                <th scope="">Confirmed by</th>
                                <th scope=""> : </th>
                                <th scope="">username</th>
                            </tr>
                            <tr>
                                <th scope="">Kontak Pelayan</th>
                                <th scope=""> : </th>
                                <th scope="">kennethliem991@gmail.com</th>
                            </tr>

                            <tr>
                                <th scope="">Serve By</th>
                                <th scope=""> : </th>
                                <th scope="">username</th>
                            </tr>

                            <tr>
                                <th scope="">Kontak Pelayan</th>
                                <th scope=""> : </th>
                                <th scope="">geraldo@gmail.com</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal Detail User-->
<div class="modal fade" id="detailUser" tabindex="-1" role="dialog" aria-labelledby="detailUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailUserLabel">Detail User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="">ID User</th>
                                <th scope=""> : </th>
                                <th scope="">01</th>
                            </tr>
                            <tr>
                                <th scope="">Username</th>
                                <th scope=""> : </th>
                                <th scope="">kennethliem</th>
                            </tr>
                            <tr>
                                <th scope="">Nama Lengkap</th>
                                <th scope=""> : </th>
                                <th scope="">Kenneth Liem Hardadi</th>
                            </tr>
                            <tr>
                                <th scope="">Email</th>
                                <th scope=""> : </th>
                                <th scope="">kennethliem991@gmail.com</th>
                            </tr>
                            <tr>
                                <th scope="">Nomor HP</th>
                                <th scope=""> : </th>
                                <th scope="">0811202604</th>
                            </tr>
                            <tr>
                                <th scope="">Alamat</th>
                                <th scope=""> : </th>
                                <th scope="">Pabuaran Residence, Catleya C3 No. 15, Tangerang</th>
                            </tr>

                            <tr>
                                <th scope="">Last Login</th>
                                <th scope=""> : </th>
                                <th scope="">Tuesday, 28 June 2021</th>
                            </tr>
                            <tr>
                                <th scope="">Status</th>
                                <th scope=""> : </th>
                                <th scope="" class="text-success">Active</th>
                            </tr>
                            <tr>
                                <th scope="">Tanggal Bergabung</th>
                                <th scope=""> : </th>
                                <th scope="">Monday, 26 June 2021</th>
                            </tr>

                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>