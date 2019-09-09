<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Tambah Mapel</h1>
                </div>

                <?= $this->session->flashdata('message'); ?>

                <form class="user" method="post" action="<?= base_url('Mapel_CRUD/add'); ?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control" id="mapel_nama" name="mapel_nama" placeholder="Nama Mapel (Ex: Matematika)" value="<?= set_value('mapel_nama') ?>">
                            <?= form_error('mapel_nama','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="number" class="form-control" id="mapel_kkm" name="mapel_kkm" placeholder="KKM (Ex: 75,80)" value="<?= set_value('mapel_kkm') ?>">
                            <?= form_error('mapel_kkm','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="number" class="form-control" id="mapel_urutan" name="mapel_urutan" placeholder="Urutan dalam kelompok" value="<?= set_value('mapel_urutan') ?>">
                            <?= form_error('mapel_urutan','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control" id="mapel_sing" name="mapel_sing" placeholder="Singkatan (ex: MAT, PE, ICT)" value="<?= set_value('mapel_sing') ?>">
                            <?= form_error('mapel_sing','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="col-sm mb-3 mb-sm-0 mt-3">
                          <select class="form-control" name="mapel_kel" id="mapel_kel">
                            <?php
                              $_selected = set_value('mapel_kel');
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
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Insert
                    </button>
                </form>
                <hr>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>
