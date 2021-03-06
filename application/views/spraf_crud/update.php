<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h4 class="h4 text-gray-900"><b><u><?= $kelas['sk_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900"><b><u>Sikap Spiritual <?= $kelas['kelas_nama'] ?> Semester <?= $semester ?></u></b></h4>
              <h4 class="h4 text-gray-900"><i><?= $mapel['mapel_nama'] ?></i></h4>

              <div class="alert alert-info mb-2">
                  <h4 class="h4 text-gray-900"><i><u>KD Spiritual (Menghayati dan mengamalkan ajaran agama yang dianutnya): </u></i></h4>
                  <h6><b>1. Berdoa sebelum & sesudah kegiatan</b></h6>
                  <h6><b>2. Menjalankan ibadah sesuai agama yang dianut</b></h6>
                  <h6><b>3. Memberi salam awal dan akhir kegiatan</b></h6>
                  <h6><b>4. Bersyukur atas nikmat dan karunia Tuhan Yang Maha Esa</b></h6>
                  <h6><b>5. Mensyukuri kemampuan manusia dalam mengendalikan diri</b></h6>
                  <h6><b>6. Bersyukur ketika berhasil mengerjakan sesuatu</b></h6>
                  <h6><b>7. Berserah diri (tawakal) kepada Tuhan setelah beriktiar atau melakukan usaha</b></h6>
                  <h6><b>8. Menjaga lingkungan hidup di sekitar satuan pendidikan</b></h6>
                  <h6><b>9. Memelihara hubungan baik dengan sesama umat ciptaan Tuhan Yang Maha Esa</b></h6>
                  <h6><b>10. Bersyukur kepada Tuhan Yang Maha Esa sebagai bangsa Indonesia</b></h6>
                  <h6><b>11. Menghormati orang lain yang menjalankan ibadah sesuai dengan agama yang dianutnya dan tidak merendahkan agama lain</b></h6>
              </div>

            </div>

            <div id="notif"></div>

            <?php
              function cetak_opt($nama, $dipilih){
                $afek_nilai = ["K","PB","B","SB"];
                $opt = "<select name=".$nama.">";
                $_s = "selected";
                for($i=1;$i<=4;$i++ ){
                  if($dipilih == $i){
                    $opt .= "<option value='".$i."' ".$_s.">".$afek_nilai[$i-1]."</option>";
                  }else{
                    $opt .= "<option value='".$i."'>".$afek_nilai[$i-1]."</option>";
                  }
                }
                $opt .= "</select>";
                echo $opt;
              }

              function cetak_opt_kosong($nama){
                $opt = "<select name=".$nama.">";
                $opt .= "<option value='1'>K</option>";
                $opt .= "<option value='2'>PB</option>";
                $opt .= "<option value='3' selected>B</option>";
                $opt .= "<option value='4'>SB</option>";
                $opt .= "</select>";
                echo $opt;
              }

              // $tes_jum_ph = $siswa_all[0]['tes_jum_ph'];
              // $tes_jum_prak = $siswa_all[0]['tes_jum_prak'];
              // $tes_jum_prod = $siswa_all[0]['tes_jum_prod'];
              // $tes_jum_proy = $siswa_all[0]['tes_jum_proy'];
              // $tes_jum_porto = $siswa_all[0]['tes_jum_porto'];

              if(!empty($siswa_baru)):
                $dis_opt = "disabled";
                echo '<div class="alert alert-danger alert-dismissible fade show">
                          <button class="close" data-dismiss="alert" type="button">
                              <span>&times;</span>
                          </button>
                          <strong>PERHATIAN:</strong> Siswa baru di '.$kelas['kelas_nama'].' ditemukan!
                      </div>';

            ?>
              <form class="" action="<?= base_url('spraf_CRUD/save_new_student'); ?>" method="post">
                <input type="hidden" value="<?= $kelas_id ?>" name="kelas_id">
                <input type="hidden" value="<?= $mapel_id ?>" name="mapel_id">
                <input type="hidden" value="<?= $semester ?>" name="semester">

                <table class="table table-bordered table-hover table-sm mr-5">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th class="text-center">1</th>
                      <th class="text-center">2</th>
                      <th class="text-center">3</th>
                      <th class="text-center">4</th>
                      <th class="text-center">5</th>
                      <th class="text-center">6</th>
                      <th class="text-center">7</th>
                      <th class="text-center">8</th>
                      <th class="text-center">9</th>
                      <th class="text-center">10</th>
                      <th class="text-center">11</th>
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
                        <td class='text-center'><?= cetak_opt_kosong("1[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("2[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("3[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("4[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("5[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("6[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("7[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("8[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("9[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("10[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("11[]"); ?></td>

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
                    <strong>ALERT:</strong> Nilai Ditemukan, tekan UPDATE untuk menyimpan nilai
                </div>';
            ?>

            <form class="" action="<?= base_url('spraf_CRUD/save_update'); ?>" method="post">
              <input type="hidden" value="<?= $kelas_id ?>" name="kelas_id">
              <input type="hidden" value="<?= $mapel_id ?>" name="mapel_id">

              <table class="table table-bordered table-hover table-sm mr-5">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th class="text-center">1</th>
                    <th class="text-center">2</th>
                    <th class="text-center">3</th>
                    <th class="text-center">4</th>
                    <th class="text-center">5</th>
                    <th class="text-center">6</th>
                    <th class="text-center">7</th>
                    <th class="text-center">8</th>
                    <th class="text-center">9</th>
                    <th class="text-center">10</th>
                    <th class="text-center">11</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    foreach ($siswa_all as $m) :
                  ?>

                    <tr>
                      <td>
                        <input type="hidden" value="<?= $m['spraf_id']; ?>" name="spraf_id[]">
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
                      <td class='text-center'><?= cetak_opt("1[]",$m['spraf_1']); ?></td>
                      <td class='text-center'><?= cetak_opt("2[]",$m['spraf_2']); ?></td>
                      <td class='text-center'><?= cetak_opt("3[]",$m['spraf_3']); ?></td>
                      <td class='text-center'><?= cetak_opt("4[]",$m['spraf_4']); ?></td>
                      <td class='text-center'><?= cetak_opt("5[]",$m['spraf_5']); ?></td>
                      <td class='text-center'><?= cetak_opt("6[]",$m['spraf_6']); ?></td>
                      <td class='text-center'><?= cetak_opt("7[]",$m['spraf_7']); ?></td>
                      <td class='text-center'><?= cetak_opt("8[]",$m['spraf_8']); ?></td>
                      <td class='text-center'><?= cetak_opt("9[]",$m['spraf_9']); ?></td>
                      <td class='text-center'><?= cetak_opt("10[]",$m['spraf_10']); ?></td>
                      <td class='text-center'><?= cetak_opt("11[]",$m['spraf_11']); ?></td>
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
