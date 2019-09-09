<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h4 class="h4 text-gray-900"><b><u><?= $kelas['sk_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900"><b><u>Pengetahuan dan Keterampilan <?= $kelas['kelas_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900"><i>Semester <?= $topik['topik_semester'].' '.$mapel['mapel_nama'] ?></i></h4>

              <div class="alert alert-info mb-2">
                <h4 class="h4 text-gray-900"><i><u>KD Pengetahuan: </u></i></h4>
                <h6><i><?= $topik['topik_nama'] ?></i></h6>
                <h4 class="h4 text-gray-900 mt-4"><i><u>KD Keterampilan: </u></i></h4>
                <h6><i><?= $topik['topik_nama_ket'] ?></i></h6>
              </div>

            </div>

            <div id="notif"></div>

            <?php
              $dis_opt = "";
              function cetak_opt($kelas_opt,$tes_jum_ph,$max,$dis_opt){
                $opt = "<select class=".$kelas_opt." name=".$kelas_opt." ".$dis_opt.">";
                $opt .= "<option value='1'>1</option>";
                $s = '';
                for($i=2;$i<=$max;$i++){
                    if($i == $tes_jum_ph){
                      $s = 'selected';
                    }else{
                      $s = '';
                    }
                    $opt .= "<option value='".$i."' ".$s.">".$i."</option>";
                }
                $opt .= "</select>";
                echo $opt;
              }

              $tes_jum_ph = $siswa_all[0]['tes_jum_ph'];
              $tes_jum_prak = $siswa_all[0]['tes_jum_prak'];
              $tes_jum_prod = $siswa_all[0]['tes_jum_prod'];
              $tes_jum_proy = $siswa_all[0]['tes_jum_proy'];
              $tes_jum_porto = $siswa_all[0]['tes_jum_porto'];

              if(!empty($siswa_baru)):
                $dis_opt = "disabled";
                echo '<div class="alert alert-danger alert-dismissible fade show">
                          <button class="close" data-dismiss="alert" type="button">
                              <span>&times;</span>
                          </button>
                          <strong>PERHATIAN:</strong> Siswa baru di '.$kelas['kelas_nama'].' ditemukan!
                      </div>';

            ?>
              <form class="" action="<?= base_url('Tes_CRUD/save_new_student'); ?>" method="post" id="sub_uj" >
                <input type="hidden" value="<?= $kelas_id ?>" name="kelas_id">
                <input type="hidden" value="<?= $mapel_id ?>" name="mapel_id">
                <input type="hidden" value="<?= $topik_id ?>" name="topik_id">
                <table class="table table-bordered table-hover table-sm mr-5">
                  <thead>
                    <tr>
                      <th rowspan="3">No</th>
                      <th rowspan="3">Name</th>
                      <th class="text-center th_peng">Pengetahuan</th>
                      <th class="text-center th_ket">Keterampilan</th>
                    </tr>
                    <tr>
                      <td class="align-bottom nh1 text-center">NH1</td>
                      <td class="align-bottom nh2 text-center">NH2</td>
                      <td class="align-bottom nh3 text-center">NH3</td>
                      <td class="align-bottom nh4 text-center">NH4</td>
                      <td class="align-bottom nh5 text-center">NH5</td>

                      <td class="text-center th_pr">Praktek</td>
                      <td class="text-center th_prod">Produk</td>
                      <td class="text-center th_proy">Proyek</td>
                      <td class="text-center th_porto">Porto</td>
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
                            if($m['sis_nama_bel']){
                              $bel = $m['sis_nama_bel'][0];
                            }else{
                              $bel = "";
                            }
                            echo $m['sis_nama_depan']." ".$bel;
                          ?>
                        </td>

                        <!-- NILAI HARIAN -->
                        <td class='nh1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh1 kin" name="nh1[]" value="0" max="100"></td>
                        <td class='nh2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh2 kin2" name="nh2[]" value="0" max="100"></td>
                        <td class='nh3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh3 kin3" name="nh3[]" value="0" max="100"></td>
                        <td class='nh4 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh4 kin4" name="nh4[]" value="0" max="100"></td>
                        <td class='nh5 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh5 kin5" name="nh5[]" value="0" max="100"></td>

                        <!-- Praktek -->
                        <td class='pr1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_pr1 kin6" name="pr1[]" value="0" max="100"></td>
                        <td class='pr2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_pr2 kin7" name="pr2[]" value="0" max="100"></td>
                        <td class='pr3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_pr3 kin8" name="pr3[]" value="0" max="100"></td>

                        <!-- Produk -->
                        <td class='prod1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_prod1 kin9" name="prod1[]" value="0" max="100"></td>
                        <td class='prod2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_prod2 kin10" name="prod2[]" value="0" max="100"></td>
                        <td class='prod3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_prod3 kin11" name="prod3[]" value="0" max="100"></td>

                        <!-- Proyek -->
                        <td class='proy1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_proy1 kin12" name="proy1[]" value="0" max="100"></td>
                        <td class='proy2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_proy2 kin13" name="proy2[]" value="0" max="100"></td>
                        <td class='proy3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_proy3 kin14" name="proy3[]" value="0" max="100"></td>

                        <!-- Porto -->
                        <td class='porto1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_porto1 kin15" name="porto1[]" value="0" max="100"></td>
                        <td class='porto2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_porto2 kin16" name="porto2[]" value="0" max="100"></td>
                        <td class='porto3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_porto3 kin17" name="porto3[]" value="0" max="100"></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
                <button type="submit" class="btn btn-success mt-2 mb-3">
                    <i class="fa fa-save"></i>
                    Save Nilai Murid Baru(s)
                </button>
              </form>

              <hr>
            <?php endif; ?>

            <?php echo '<div class="alert alert-success alert-dismissible fade show">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>ALERT:</strong> Grade found, use UPDATE BUTTON below to save grade
                </div>';
            ?>

            <form class="" action="<?= base_url('Tes_CRUD/save_update'); ?>" method="post" id="sub_uj" >
              <input type="hidden" value="<?= $kelas_id ?>" name="kelas_id">
              <input type="hidden" value="<?= $mapel_id ?>" name="mapel_id">
              <input type="hidden" value="<?= $topik_id ?>" name="topik_id">
              <table class="table table-bordered table-hover table-sm mr-5">
                <thead>
                  <tr>
                    <th rowspan="3">No</th>
                    <th rowspan="3">Name</th>
                    <th class="text-center th_peng">Pengetahuan <br>&Sigma; NH: <?php cetak_opt("opt_peng",$tes_jum_ph,5,$dis_opt) ?></th>
                    <th class="text-center th_ket">Keterampilan</th>
                  </tr>
                  <tr>
                    <td class="align-bottom nh1 text-center">NH1</td>
                    <td class="align-bottom nh2 text-center">NH2</td>
                    <td class="align-bottom nh3 text-center">NH3</td>
                    <td class="align-bottom nh4 text-center">NH4</td>
                    <td class="align-bottom nh5 text-center">NH5</td>

                    <td class="text-center th_pr">Praktek <br> <b>&Sigma;</b> <?php cetak_opt("opt_prak",$tes_jum_prak,3,$dis_opt) ?></td>
                    <td class="text-center th_prod">Produk <br> <b>&Sigma;</b> <?php cetak_opt("opt_prod",$tes_jum_prod,3,$dis_opt) ?></td>
                    <td class="text-center th_proy">Proyek <br> <b>&Sigma;</b> <?php cetak_opt("opt_proy",$tes_jum_proy,3,$dis_opt) ?></td>
                    <td class="text-center th_porto">Porto <br> <b>&Sigma;</b> <?php cetak_opt("opt_porto",$tes_jum_porto,3,$dis_opt) ?></td>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    foreach ($siswa_all as $m) :
                  ?>

                    <tr>
                      <td>
                        <input type="hidden" value="<?= $m['tes_id']; ?>" name="tes_id[]">
                        <?= $m['sis_no_induk']; ?>
                      </td>
                      <td>
                        <?php
                          if($m['sis_nama_bel']){
                            $bel = $m['sis_nama_bel'][0];
                          }else{
                            $bel = "";
                          }
                          echo $m['sis_nama_depan']." ".$bel;
                        ?>
                      </td>

                      <!-- NILAI HARIAN -->
                      <td class='nh1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh1 kin" name="nh1[]" value="<?= $m['tes_ph1'] ?>" max="100"></td>
                      <td class='nh2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh2 kin2" name="nh2[]" value="<?= $m['tes_ph2'] ?>" max="100"></td>
                      <td class='nh3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh3 kin3" name="nh3[]" value="<?= $m['tes_ph3'] ?>" max="100"></td>
                      <td class='nh4 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh4 kin4" name="nh4[]" value="<?= $m['tes_ph4'] ?>" max="100"></td>
                      <td class='nh5 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_nh5 kin5" name="nh5[]" value="<?= $m['tes_ph5'] ?>" max="100"></td>

                      <!-- Praktek -->
                      <td class='pr1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_pr1 kin6" name="pr1[]" value="<?= $m['tes_prak1'] ?>" max="100"></td>
                      <td class='pr2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_pr2 kin7" name="pr2[]" value="<?= $m['tes_prak2'] ?>" max="100"></td>
                      <td class='pr3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_pr3 kin8" name="pr3[]" value="<?= $m['tes_prak3'] ?>" max="100"></td>

                      <!-- Produk -->
                      <td class='prod1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_prod1 kin9" name="prod1[]" value="<?= $m['tes_produk1'] ?>" max="100"></td>
                      <td class='prod2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_prod2 kin10" name="prod2[]" value="<?= $m['tes_produk2'] ?>" max="100"></td>
                      <td class='prod3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_prod3 kin11" name="prod3[]" value="<?= $m['tes_produk3'] ?>" max="100"></td>

                      <!-- Proyek -->
                      <td class='proy1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_proy1 kin12" name="proy1[]" value="<?= $m['tes_proyek1'] ?>" max="100"></td>
                      <td class='proy2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_proy2 kin13" name="proy2[]" value="<?= $m['tes_proyek2'] ?>" max="100"></td>
                      <td class='proy3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_proy3 kin14" name="proy3[]" value="<?= $m['tes_proyek3'] ?>" max="100"></td>

                      <!-- Porto -->
                      <td class='porto1 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_porto1 kin15" name="porto1[]" value="<?= $m['tes_porto1'] ?>" max="100"></td>
                      <td class='porto2 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_porto2 kin16" name="porto2[]" value="<?= $m['tes_porto2'] ?>" max="100"></td>
                      <td class='porto3 text-center'><input type="number" onfocus='this.select();' required style='width: 47px;' class="_porto3 kin17" name="porto3[]" value="<?= $m['tes_porto3'] ?>" max="100"></td>
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

              <button type="submit" <?= $dis ?> class="btn btn-success mt-2" id="btn-save">
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
