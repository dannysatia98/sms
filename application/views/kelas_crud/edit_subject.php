<style>
.grid-container {
  display: grid;
  grid-template-columns: 50% 50%;
  grid-column-gap:3px;
  /* background-color: #2196F3; */
}
</style>
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
                        <table class="table table-sm table-bordered" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>Nama Mapel</th>
                                    <th>Singkatan</th>
                                    <th>KKM</th>
                                    <th>Jumlah Guru</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mapel_all as $m) : ?>
                                    <tr>
                                        <td><?= $m['mapel_nama'] ?></td>
                                        <td><?= $m['mapel_sing'] ?></td>
                                        <td><?= $m['mapel_kkm'] ?></td>

                                        <form class="" action="<?= base_url('Kelas_CRUD/edit_subject') ?>" method="post">
                                            <td>
                                                <select name="jum_guru" id="jum_guru" style="font-size:11px; height:24px;" class="form-control form-control-sm">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" name="mapel_id" value=<?= $m['mapel_id'] ?>>
                                                <input type="hidden" name="kelas_id" value=<?= $kelas_all['kelas_id']; ?>>
                                                <button type="submit" class="ml-3 badge badge-success">
                                                    <i class="fa fa-plus"></i>
                                                </button>
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
                        <div style="font-size:12px;" class="alert alert-primary" role="alert">
                          <div class="total"></div>
                        </div>
                        <div style="font-size:12px;" class="alert alert-secondary" role="alert">
                          <div class="total2"></div>
                        </div>
                  </div>



                  <div class="p-2" style="font-size:12px;"><?= $this->session->flashdata('message'); ?></div>
                  <div class="col-sm mb-3 mb-sm-0 table-responsive">
                      <table class="table table-sm table-bordered" style="font-size:12px;">
                          <thead>
                              <tr>
                                  <th style="width: 25%">Nama Mapel</th>
                                  <th>Guru Pengajar</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                                <?php
                                    foreach ($d_mpl_all as $m) :
                                        $count = 0;
                                ?>
                                  <tr>
                                      <td><?= $m['mapel_nama']."<br>(".$m['mapel_sing'].")" ?></td>

                                    <form class="" action="<?= base_url('Kelas_CRUD/save_teacher') ?>" method="post">
                                      <td>
                                        <input type="hidden" name="d_mpl_id" value= <?=$m['d_mpl_id']?>>
                                        <?php
                                            $guru_id = explode(",", $m['d_mpl_kr_id']);
                                            $beban = explode(",", $m['d_mpl_beban']);
                                            for($i=1;$i<=$m['jum_guru'];$i++){
                                        ?>
                                            <div class="grid-container">
                                              <div>
                                                <h6 class="mt-1" style="font-size:12px;">Guru Pengajar <?= $i ?>:</h6>
                                                <select name="kr_id[]" id="kr_id[]" class="form-control form-control-sm mb-2" style="font-size:11px; height:24px;">
                                                    <?php
                                                    $_selected = $guru_id[$count];

                                                    echo "<option value= '0'> Teacher ".$i."</option>";
                                                    foreach ($guru_all as $n) :
                                                        if ($_selected == $n['kr_id']) {
                                                            $s = "selected";
                                                        } else {
                                                            $s = "";
                                                        }
                                                        echo "<option value=" . $n['kr_id'] . " " . $s . ">" . $n['kr_nama_depan'] . " " . $n['kr_nama_belakang']."</option>";
                                                    endforeach
                                                    ?>
                                                </select>
                                              </div>
                                              <div>
                                                <h6 class="mt-1" style="font-size:12px;">Beban Ajar (dalam jam):</h6>
                                                <input type="number" name="beban[]" class="form-control form-control-sm mb-2" min="0" value="<?=$beban[$count]?>" style="font-size:11px; height:24px;">
                                              </div>
                                            </div>
                                        <?php
                                                $count++;
                                            }
                                        ?>
                                          <div class="grid-container">
                                            <div>
                                              <h6 style="font-size:12px;">% sosial:</h6>
                                              <input type="number" style="height:24px;font-size:12px;" name="d_mpl_persen_sos" class="form-control form-control-sm mb-2 d_mpl_persen_sos" value=<?= $m['d_mpl_persen_sos'] ?>  min="0" max="100" required>
                                            </div>
                                            <div>
                                              <h6 style="font-size:12px;">% spiritual:</h6>
                                              <input type="number" style="height:24px;font-size:12px;" name="d_mpl_persen_spr" class="form-control form-control-sm mb-2 d_mpl_persen_spr" value=<?= $m['d_mpl_persen_spr'] ?> min="0" max="100" required>
                                            </div>
                                          </div>
                                      </td>
                                      <td>
                                        <div class="grid-container">
                                          <div>
                                            <input type="hidden" name="mapel_id" value=<?= $m['mapel_id'] ?>>
                                            <input type="hidden" name="kelas_id" value=<?= $kelas_all['kelas_id']; ?>>
                                            <button type="submit" class="badge badge-success">
                                            <i class="fa fa-save"></i>
                                            </button>
                                          </div>

                                    </form>
                                          <div>
                                            <form class="" action="<?= base_url('Kelas_CRUD/delete_subject') ?>" method="post">
                                                <input type="hidden" name="d_mpl_id_delete" value= <?=$m['d_mpl_id']?>>
                                                <input type="hidden" name="kelas_id" value=<?= $kelas_all['kelas_id']; ?>>
                                                <button type="submit" class="badge badge-danger">
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
