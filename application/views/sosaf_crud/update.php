<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h4 class="h4 text-gray-900"><b><u><?= $kelas['sk_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900"><b><u>Sikap Sosial <?= $kelas['kelas_nama'] ?> Semester <?= $semester ?></u></b></h4>
              <h4 class="h4 text-gray-900"><i><?= $mapel['mapel_nama'] ?></i></h4>

              <div class="alert alert-info mb-2">
                <h4 class="h4 text-gray-900"><i><u>KD Sosial: </u></i></h4>
                Menunjukkan perilaku jujur, disiplin, tanggung jawab, peduli (gotong royong, kerja sama, toleran, damai), santun, responsif, dan pro-aktif sebagai bagian dari solusi atas berbagai permasalahan dalam berinteraksi secara efektif dengan lingkungan sosial dan alam serta menempatkan diri sebagai cerminan bangsa dalam pergaulan dunia
                <h6><b>1. Jujur</b></h6>
                <h6><b>2. Disiplin</b></h6>
                <h6><b>3. Tanggung Jawab</b></h6>
                <h6><b>4. Toleran</b></h6>
                <h6><b>5. Gotong Royong</b></h6>
                <h6><b>6. Santun</b></h6>
                <h6><b>7. Percaya Diri</b></h6>
                <h6><b>8. Responsif dan proaktif</b></h6>
                <h6><b>9. Peduli (mampu bekerjasama dengan orang lain, gotong royong )</b></h6>
                <h6><b>10. Taat aturan</b></h6>
                <h6><b>11. Semangat belajar yang tinggi untuk berprestasi</b></h6>
                <h6><b>12. Simpatik</b></h6>
                <h6><b>13. Menghargai orang lain</b></h6>
                <h6><b>14. Sabar</b></h6>
                <h6><b>15. Sederhana dalam penampilan</b></h6>
                <h6><b>16. Menerima kritik, saran dan mau meminta maaf bila melakukan kesalahan</b></h6>
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
              <form class="" action="<?= base_url('sosaf_CRUD/save_new_student'); ?>" method="post">
                <input type="hidden" value="<?= $kelas_id ?>" name="kelas_id">
                <input type="hidden" value="<?= $mapel_id ?>" name="mapel_id">
                <input type="hidden" value="<?= $semester ?>" name="semester">

                <table class="rapot">
                  <thead>
                    <tr style='height: 50px;'>
                      <th>No</th>
                      <th>Name</th>
                      <th class="text-center th_peng">1</th>
                      <th class="text-center th_peng">2</th>
                      <th class="text-center th_peng">3</th>
                      <th class="text-center th_peng">4</th>
                      <th class="text-center th_peng">5</th>
                      <th class="text-center th_peng">6</th>
                      <th class="text-center th_peng">7</th>
                      <th class="text-center th_peng">8</th>
                      <th class="text-center th_peng">9</th>
                      <th class="text-center th_peng">10</th>
                      <th class="text-center th_peng">11</th>
                      <th class="text-center th_peng">12</th>
                      <th class="text-center th_peng">13</th>
                      <th class="text-center th_peng">14</th>
                      <th class="text-center th_peng">15</th>
                      <th class="text-center th_peng">16</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                      foreach ($siswa_baru as $m) :
                    ?>

                      <tr style='height: 30px;'>
                        <td style='padding: 0px 0px 0px 5px; margin: 0px;'>
                          <input type="hidden" value="<?= $m['d_s_id']; ?>" name="d_s_id[]">
                          <?= $m['sis_no_induk']; ?>
                        </td>
                        <td style='padding: 0px 0px 0px 5px; margin: 0px;'>
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
                        <td class='text-center'><?= cetak_opt_kosong("12[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("13[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("14[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("15[]"); ?></td>
                        <td class='text-center'><?= cetak_opt_kosong("16[]"); ?></td>

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

            <form class="" action="<?= base_url('sosaf_CRUD/save_update'); ?>" method="post">
              <input type="hidden" value="<?= $kelas_id ?>" name="kelas_id">
              <input type="hidden" value="<?= $mapel_id ?>" name="mapel_id">
              <table class="rapot">
                <thead>
                  <tr style='height: 50px;'>
                    <th>No</th>
                    <th>Name</th>
                    <th class="text-center th_peng">1</th>
                    <th class="text-center th_peng">2</th>
                    <th class="text-center th_peng">3</th>
                    <th class="text-center th_peng">4</th>
                    <th class="text-center th_peng">5</th>
                    <th class="text-center th_peng">6</th>
                    <th class="text-center th_peng">7</th>
                    <th class="text-center th_peng">8</th>
                    <th class="text-center th_peng">9</th>
                    <th class="text-center th_peng">10</th>
                    <th class="text-center th_peng">11</th>
                    <th class="text-center th_peng">12</th>
                    <th class="text-center th_peng">13</th>
                    <th class="text-center th_peng">14</th>
                    <th class="text-center th_peng">15</th>
                    <th class="text-center th_peng">16</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    foreach ($siswa_all as $m) :
                  ?>

                    <tr style='height: 30px;'>
                      <td style='padding: 0px 0px 0px 5px; margin: 0px;'>
                        <input type="hidden" value="<?= $m['sosaf_id']; ?>" name="sosaf_id[]">
                        <?= $m['sis_no_induk']; ?>
                      </td>
                      <td style='padding: 0px 0px 0px 5px; margin: 0px;'>
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
                      <td class='text-center'><?= cetak_opt("1[]",$m['sosaf_1']); ?></td>
                      <td class='text-center'><?= cetak_opt("2[]",$m['sosaf_2']); ?></td>
                      <td class='text-center'><?= cetak_opt("3[]",$m['sosaf_3']); ?></td>
                      <td class='text-center'><?= cetak_opt("4[]",$m['sosaf_4']); ?></td>
                      <td class='text-center'><?= cetak_opt("5[]",$m['sosaf_5']); ?></td>
                      <td class='text-center'><?= cetak_opt("6[]",$m['sosaf_6']); ?></td>
                      <td class='text-center'><?= cetak_opt("7[]",$m['sosaf_7']); ?></td>
                      <td class='text-center'><?= cetak_opt("8[]",$m['sosaf_8']); ?></td>
                      <td class='text-center'><?= cetak_opt("9[]",$m['sosaf_9']); ?></td>
                      <td class='text-center'><?= cetak_opt("10[]",$m['sosaf_10']); ?></td>
                      <td class='text-center'><?= cetak_opt("11[]",$m['sosaf_11']); ?></td>
                      <td class='text-center'><?= cetak_opt("12[]",$m['sosaf_12']); ?></td>
                      <td class='text-center'><?= cetak_opt("13[]",$m['sosaf_13']); ?></td>
                      <td class='text-center'><?= cetak_opt("14[]",$m['sosaf_14']); ?></td>
                      <td class='text-center'><?= cetak_opt("15[]",$m['sosaf_15']); ?></td>
                      <td class='text-center'><?= cetak_opt("16[]",$m['sosaf_16']); ?></td>
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
