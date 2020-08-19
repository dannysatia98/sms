<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><?= $title ?></h1>
                </div>

                <form class="user" method="post" action="<?= base_url('Mapel_CRUD/update'); ?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><u><b>Nama Mapel (Cth: Matematika):</b></u></label>
                            <input type="hidden" name="_id" value="<?= set_value('_id', $mapel_update['mapel_id']); ?>">
                            <input type="text" class="form-control form-control-sm" name="mapel_nama" value="<?= $mapel_update['mapel_nama'] ?>" required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><u><b>KKM (Cth: 75,80):</b></u></label>
                            <input type="number" class="form-control form-control-sm" name="mapel_kkm" value="<?= $mapel_update['mapel_kkm'] ?>" required>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="_mapel_urutan" value="<?= $mapel_update['mapel_urutan'] ?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><u><b>Urutan dalam kelompok:</b></u></label>
                            <input type="number" class="form-control form-control-sm" name="mapel_urutan" value="<?= $mapel_update['mapel_urutan'] ?>" required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><u><b>Singkatan mapel (cth: MAT, Eko, OR):</b></u></label>
                            <input type="text" class="form-control form-control-sm" name="mapel_sing" value="<?= $mapel_update['mapel_sing'] ?>" required>
                        </div>
                        <div class="col-sm mb-3 mb-sm-0 mt-3">
                          <label><u><b>Kelompok Mapel:</b></u></label>
                          <select class="form-control form-control-sm" name="mapel_kel">
                              <?php
                                $_selected = $mapel_update['mapel_kel'];
                                if($_selected == "1")
                                  echo '<option value="1" selected>Kelompok A (UMUM)</option>';
                                else
                                  echo '<option value="1">Kelompok A (UMUM)</option>';

                                if($_selected == "2")
                                  echo '<option value="2" selected>Kelompok B (UMUM)</option>';
                                else
                                  echo '<option value="2">Kelompok B (UMUM)</option>';

                                if($_selected == "3")
                                  echo '<option value="3" selected>Kelompok C (PEMINATAN)</option>';
                                else
                                  echo '<option value="3">Kelompok C (PEMINATAN)</option>';

                                if($_selected == "4")
                                  echo '<option value="4" selected>LINTAS MINAT</option>';
                                else
                                  echo '<option value="4">LINTAS MINAT</option>';
                              ?>
                          </select>
                        </div>
                        <div class="col-sm mb-3 mb-sm-0 mt-3">
                          <label><u><b>Jenis Mapel:</b></u></label>
                          <select class="form-control form-control-sm" name="mapel_bk">
                            <?php
                              $_selected = $mapel_update['mapel_bk'];
                              if($_selected == "0")
                                echo '<option value="0" selected>Bukan BK</option>';
                              else
                                echo '<option value="1">Bukan BK</option>';

                              if($_selected == "1")
                                echo '<option value="1" selected>BK</option>';
                              else
                                echo '<option value="1">BK</option>';
                            ?>
                          </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Update
                    </button>
                </form>
                <hr>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>
