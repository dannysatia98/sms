<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg-6">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mt-4 mb-4"><u>Semua mapel</u></h1>
                    </div>

                    <div class="col-sm mb-3 mb-sm-0 table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="cus_label">Nama Mapel</th>
                                    <th class="cus_label">KKM</th>
                                    <th class="cus_label">Jumlah Guru</th>
                                    <th class="cus_label">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mapel_all as $m) : ?>
                                    <tr>
                                        <td class="cus_label"><?= $m['mapel_nama'] ?></td>
                                        <td class="cus_label"><?= $m['mapel_kkm'] ?></td>

                                        <form class="" action="<?= base_url('Kelas_CRUD/edit_subject') ?>" method="post">
                                            <td>
                                                <select name="jum_guru" id="jum_guru" class="form-control-sm">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                        <input type="hidden" name="mapel_id" value=<?= $m['mapel_id'] ?>>
                                                        <input type="hidden" name="kelas_id" value=<?= $kelas_all['kelas_id']; ?>>
                                                        <button type="submit" class="ml-3 badge badge-success">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                </div>
                                            </td>

                                        </form>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                        <hr>
                    </div>
                </div>
                <div class="col-lg-6">
                  <div class="text-center p-2">
                        <h1 class="h4 text-gray-900 mt-4 mb-4"><u>Mapel di <?= $kelas_all['kelas_nama']; ?></u></h1>
                        <div class="alert alert-primary" role="alert">
                          <div class="total"></div>
                        </div>
                        <div class="alert alert-secondary" role="alert">
                          <div class="total2"></div>
                        </div>
                  </div>



                  <div class="mb-3 pr-3 pl-3"><?= $this->session->flashdata('message'); ?></div>
                  <div class="col-sm mb-3 mb-sm-0 table-responsive">
                      <table class="table table-sm table-bordered">
                          <thead>
                              <tr>
                                  <th class="cus_label" style="width: 25%">Nama Mapel</th>
                                  <th class="cus_label">Guru Pengajar</th>
                                  <th class="cus_label">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                                <?php
                                    foreach ($d_mpl_all as $m) :
                                        $count = 0;
                                ?>
                                  <tr>
                                      <td class="cus_label"><?= $m['mapel_nama'] ?></td>

                                    <form class="" action="<?= base_url('Kelas_CRUD/save_teacher') ?>" method="post">
                                      <td>
                                        <input type="hidden" name="d_mpl_id" value= <?=$m['d_mpl_id']?>>
                                        <?php
                                            $guru_id = explode(",", $m['d_mpl_kr_id']);
                                            $beban = explode(",", $m['d_mpl_beban']);
                                            for($i=1;$i<=$m['jum_guru'];$i++){
                                        ?>
                                            <h6 class="cus_label mt-1">Guru Pengajar <?= $i ?>:</h6>
                                            <select name="kr_id[]" id="kr_id[]" class="form-control-sm mb-2">
                                                <?php
                                                $_selected = $guru_id[$count];

                                                echo "<option value= '0'> Teacher ".$i."</option>";
                                                foreach ($guru_all as $n) :
                                                    if ($_selected == $n['kr_id']) {
                                                        $s = "selected";
                                                    } else {
                                                        $s = "";
                                                    }
                                                    echo "<option value=" . $n['kr_id'] . " " . $s . ">" . $n['kr_nama_depan'] . " " . $n['kr_nama_belakang'][0]."</option>";
                                                endforeach
                                                ?>
                                            </select>
                                            <h6 class="cus_label">Beban Ajar (dalam jam):</h6>
                                            <input type="number" name="beban[]" class="form-control-sm mb-2" min="0" placeholder="Hour" value=<?=$beban[$count]?>>
                                            <hr>
                                        <?php
                                                $count++;
                                            }
                                        ?>
                                          <div class="form-group row">
                                            <div class="col-sm mb-3 mb-sm-0">
                                              <h6 class="cus_label">% sosial:</h6>
                                              <input type="number" name="d_mpl_persen_sos" class="form-control-sm mb-2 d_mpl_persen_sos" value=<?= $m['d_mpl_persen_sos'] ?>  min="0" max="100" required>
                                            </div>
                                            <div class="col-sm mb-3 mb-sm-0">
                                              <h6 class="cus_label">% spiritual:</h6>
                                              <input type="number" name="d_mpl_persen_spr" class="form-control-sm mb-2 d_mpl_persen_spr" value=<?= $m['d_mpl_persen_spr'] ?> min="0" max="100" required>
                                            </div>
                                          </div>
                                      </td>
                                      <td>
                                          <div class="form-group row">
                                              <input type="hidden" name="mapel_id" value=<?= $m['mapel_id'] ?>>
                                              <input type="hidden" name="kelas_id" value=<?= $kelas_all['kelas_id']; ?>>
                                              <div>
                                                <button type="submit" class="ml-3 mt-4 badge badge-success">
                                                <i class="fa fa-save"></i>
                                                </button>
                                              </div>

                                    </form>
                                              <div>
                                                <form class="" action="<?= base_url('Kelas_CRUD/delete_subject') ?>" method="post">
                                                    <input type="hidden" name="d_mpl_id_delete" value= <?=$m['d_mpl_id']?>>
                                                    <input type="hidden" name="kelas_id" value=<?= $kelas_all['kelas_id']; ?>>
                                                    <button type="submit" class="ml-1 mt-4 badge badge-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                              <?php endforeach ?>
                          </tbody>
                      </table>

                      <hr>
                  </div>

                </div>
            </div>
        </div>
    </div>

</div>
