<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><u>Tambah Mapel</u></h1>
                </div>

                <?= $this->session->flashdata('message'); ?>

                <form class="user" method="post" action="<?= base_url('Mapel_CRUD/add'); ?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><u><b>Nama Mapel (Cth: Matematika):</b></u></label>
                            <input type="text" class="form-control form-control-sm" name="mapel_nama" required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><u><b>KKM (Cth: 75,80):</b></u></label>
                            <input type="number" min="0" max="100" class="form-control form-control-sm" name="mapel_kkm" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><u><b>Urutan dalam kelompok:</b></u></label>
                            <input type="number" class="form-control form-control-sm" name="mapel_urutan" required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><u><b>Singkatan mapel (cth: MAT, Eko, OR):</b></u></label>
                            <input type="text" class="form-control form-control-sm" name="mapel_sing" required>
                        </div>
                        <div class="col-sm mb-3 mb-sm-0 mt-3">
                          <label><u><b>Kelompok Mapel:</b></u></label>
                          <select class="form-control form-control-sm" name="mapel_kel">
                            <option value="1">Kelompok A (UMUM)</option>
                            <option value="2">Kelompok B (UMUM)</option>
                            <option value="3">Kelompok C (PEMINATAN)</option>
                            <option value="4">LINTAS MINAT</option>
                          </select>
                        </div>
                        <div class="col-sm mb-3 mb-sm-0 mt-3">
                          <label><u><b>Jenis Mapel:</b></u></label>
                          <select class="form-control form-control-sm" name="mapel_bk">
                            <option value="0">Bukan BK</option>
                            <option value="1">BK</option>
                          </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Tambah
                    </button>
                </form>
                <hr>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>
