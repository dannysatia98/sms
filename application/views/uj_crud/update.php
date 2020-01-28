<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h4 class="h4 text-gray-900"><b><u><?= $kelas['sk_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900"><b><u>UTS dan UAS <?= $kelas['kelas_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900 mb-4"><u><?= $mapel['mapel_nama'] ?></u></h4>
            </div>

            <?php

              if(!empty($siswa_baru)):
                echo '<div class="alert alert-danger alert-dismissible fade show">
                          <button class="close" data-dismiss="alert" type="button">
                              <span>&times;</span>
                          </button>
                          <strong>PERHATIAN:</strong> Siswa baru ditemukan di '.$kelas['kelas_nama'].'!
                      </div>';

            ?>
              <form class="" action="<?= base_url('Uj_CRUD/save_new_student'); ?>" method="post" id="sub_uj" >
                <input type="hidden" value="<?= $kelas_id ?>" name="kelas_id">
                <input type="hidden" value="<?= $mapel_id ?>" name="mapel_id">
                <table class="table table-hover table-sm" style="font-size:12px;">
                  <thead>
                    <tr>
                      <th rowspan="4">No</th>
                      <th rowspan="4">Nama</th>
                      <th colspan="4">Semester 1</th>
                      <th colspan="4">Semester 2</th>
                    </tr>
                    <tr>
                      <td colspan="2">Pengetahuan</td>
                      <td colspan="2">Keterampilan</td>
                      <td colspan="2">Pengetahuan</td>
                      <td colspan="2">Keterampilan</td>
                    </tr>
                    <tr>
                      <td>UTS</td>
                      <td>UAS</td>
                      <td>UTS</td>
                      <td>UAS</td>
                      <td>UTS</td>
                      <td>UAS</td>
                      <td>UTS</td>
                      <td>UAS</td>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                      foreach ($siswa_baru as $m) :
                    ?>

                      <tr>
                        <td>
                          <input type="hidden" value="<?= $m['d_s_id']; ?>" name="d_s_id[]">
                          <?= $m['sis_no_induk']; ?>
                        </td>
                        <td>
                          <?php
                            echo $m['sis_nama_depan']." ".$m['sis_nama_bel'];
                          ?>
                        </td>
                        <td><input type="number" onfocus='this.select();' required class='kin' style='width: 47px;' name="uj_mid1_kog[]" value="0" max="100"></td>
                        <td><input type="number" onfocus='this.select();' required class='kin2' style='width: 47px;' name="uj_fin1_kog[]" value="0" max="100"></td>
                        <td><input type="number" onfocus='this.select();' required class='kin3' style='width: 47px;' name="uj_mid1_psi[]" value="0" max="100"></td>
                        <td><input type="number" onfocus='this.select();' required class='kin4' style='width: 47px;' name="uj_fin1_psi[]" value="0" max="100"></td>

                        <td><input type="number" onfocus='this.select();' required class='kin5' style='width: 47px;' name="uj_mid2_kog[]" value="0" max="100"></td>
                        <td><input type="number" onfocus='this.select();' required class='kin6' style='width: 47px;' name="uj_fin2_kog[]" value="0" max="100"></td>
                        <td><input type="number" onfocus='this.select();' required class='kin7' style='width: 47px;' name="uj_mid2_psi[]" value="0" max="100"></td>
                        <td><input type="number" onfocus='this.select();' required class='kin8' style='width: 47px;' name="uj_fin2_psi[]" value="0" max="100"></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
                <button type="submit" class="btn btn-success mt-2 mb-3">
                    <i class="fa fa-save"></i>
                    Save Nilai Siswa Baru
                </button>
              </form>

              <hr>
            <?php endif; ?>

            <?php echo '<div class="alert alert-success alert-dismissible fade show">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>ALERT:</strong> Nilai ditemukan, gunakan tombol UPDATE untuk menyimpan nilai
                </div>'; ?>

            <form class="" action="<?= base_url('Uj_CRUD/save_update'); ?>" method="post" id="sub_uj" >
              <input type="hidden" value="<?= $kelas_id ?>" name="kelas_id">
              <input type="hidden" value="<?= $mapel_id ?>" name="mapel_id">
              <table class="table table-hover table-sm" style="font-size:12px;">
                <thead>
                  <tr>
                    <th rowspan="4">No</th>
                    <th rowspan="4">Name</th>
                    <th colspan="4">Semester 1</th>
                    <th colspan="4">Semester 2</th>
                  </tr>
                  <tr>
                    <td colspan="2">Pengetahuan</td>
                    <td colspan="2">Keterampilan</td>
                    <td colspan="2">Pengetahuan</td>
                    <td colspan="2">Keterampilan</td>
                  </tr>
                  <tr>
                    <td>UTS</td>
                    <td>UAS</td>
                    <td>UTS</td>
                    <td>UAS</td>
                    <td>UTS</td>
                    <td>UAS</td>
                    <td>UTS</td>
                    <td>UAS</td>
                  </tr>

                </thead>
                <tbody>
                  <?php
                    foreach ($siswa_all as $m) :
                  ?>
                    <tr>
                      <td>
                        <input type="hidden" value="<?= $m['uj_id']; ?>" name="uj_id[]">
                        <?= $m['sis_no_induk']; ?>
                      </td>
                      <td>
                        <?php
                          echo $m['sis_nama_depan']." ".$m['sis_nama_bel'];
                        ?>
                      </td>
                      <td><input type="number" onfocus='this.select();' required class='kin' style='width: 47px;' name="uj_mid1_kog[]" value="<?= $m['uj_mid1_kog'] ?>" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin2' style='width: 47px;' name="uj_fin1_kog[]" value="<?= $m['uj_fin1_kog'] ?>" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin3' style='width: 47px;' name="uj_mid1_psi[]" value="<?= $m['uj_mid1_psi'] ?>" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin4' style='width: 47px;' name="uj_fin1_psi[]" value="<?= $m['uj_fin1_psi'] ?>" max="100"></td>

                      <td><input type="number" onfocus='this.select();' required class='kin5' style='width: 47px;' name="uj_mid2_kog[]" value="<?= $m['uj_mid2_kog'] ?>" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin6' style='width: 47px;' name="uj_fin2_kog[]" value="<?= $m['uj_fin2_kog'] ?>" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin7' style='width: 47px;' name="uj_mid2_psi[]" value="<?= $m['uj_mid2_psi'] ?>" max="100"></td>
                      <td><input type="number" onfocus='this.select();' required class='kin8' style='width: 47px;' name="uj_fin2_psi[]" value="<?= $m['uj_fin2_psi'] ?>" max="100"></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

              <?php
                if(!empty($siswa_baru)){
                  $dis = "disabled";
                }else{
                  $dis = "";
                }
              ?>

              <button type="submit" <?= $dis ?> class="btn btn-success mt-2">
                  <i class="fa fa-save"></i>
                  Update All
              </button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
