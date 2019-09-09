<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h4 class="h4 text-gray-900"><b><u><?= $kelas['sk_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900"><b><u>Sikap Sosial <?= $kelas['kelas_nama'] ?></u></b></h4>
              <h4 class="h4 text-gray-900"><i>Semester <?= $sosial['sosial_semester'].' '.$mapel['mapel_nama'] ?></i></h4>

              <div class="alert alert-info mb-2">
                  <h4 class="h4 text-gray-900"><i><u>KD Sosial: </u></i></h4>
                  <h6><i><?= $sosial['sosial_nama'] ?></i></h6>
                  <h6><b>1. Jujur</b></h6>
                  <h6><b>2. Disiplin</b></h6>
                  <h6><b>3. Tanggung Jawab</b></h6>
                  <h6><b>4. Toleransi</b></h6>
                  <h6><b>5. Gotong Royong</b></h6>
                  <h6><b>6. Sopan Santun</b></h6>
                  <h6><b>7. Percaya Diri</b></h6>
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
              <input type="hidden" value="<?= $sosial['sosial_id'] ?>" name="sosial_id">
              <table class="table table-bordered table-hover table-sm mr-5">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th class="text-center th_peng">1</th>
                    <th class="text-center th_peng">2</th>
                    <th class="text-center th_peng">3</th>
                    <th class="text-center th_peng">4</th>
                    <th class="text-center th_peng">5</th>
                    <th class="text-center th_peng">6</th>
                    <th class="text-center th_peng">7</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    foreach ($siswa_all as $m) :
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
                      <td class='text-center'><?= cetak_opt("a[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("b[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("c[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("d[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("e[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("f[]"); ?></td>
                      <td class='text-center'><?= cetak_opt("g[]"); ?></td>
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
