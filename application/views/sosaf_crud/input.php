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

            <?php echo '<div class="alert alert-danger alert-dismissible fade show">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>PERHATIAN:</strong> Nilai sosial belum ada, gunakan tombol SAVE untuk menyimpan nilai
                </div>';

              function cetak_opt($nama){
                $opt = "<select name=".$nama.">";
                $opt .= "<option value='1'>K</option>";
                $opt .= "<option value='2'>PB</option>";
                $opt .= "<option value='3' selected>B</option>";
                $opt .= "<option value='4'>SB</option>";
                $opt .= "</select>";
                echo $opt;
              }

            ?>

            <div id="notif"></div>

            <form class="" action="<?= base_url('sosaf_CRUD/save_input'); ?>" method="post">
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
                    foreach ($siswa_all as $m) :
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
                      <td class='text-center'><?= cetak_opt("1[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("2[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("3[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("4[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("5[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("6[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("7[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("8[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("9[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("10[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("11[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("12[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("13[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("14[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("15[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("16[]"); ?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              <button type="submit" class="btn btn-success mt-2" id="btn-save">
                  <i class="fa fa-save"></i>
                  Save
              </button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
