<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h4 class="h4 text-gray-900"><b><u>Nilai Ekstrakurikuler <?= $siswa_all[0]['ssp_nama'] ?></u></b></h4>
            </div>

            <?php echo '<div class="alert alert-danger alert-dismissible fade show">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>ALERT:</strong> Gunakan tombol SAVE dibawah untuk menyimpan nilai
                </div>';

                function cetak_opt($nama, $dipilih){
                  $afek_nilai = ["A","B","C","D"];
                  $opt = "<select name=".$nama.">";
                  $_s = "selected";
                  for($i=4;$i>=1;$i--){
                    if($dipilih == $i){
                      $opt .= "<option value='".($i)."' ".$_s.">".$afek_nilai[4-$i]."</option>";
                    }else{
                      $opt .= "<option value='".($i)."'>".$afek_nilai[4-$i]."</option>";
                    }
                  }
                  $opt .= "</select>";
                  echo $opt;
                }

            ?>

            <div id="notif"></div>

            <form class="" action="<?= base_url('SSP_grade_CRUD/save_input'); ?>" method="post" id="formsspgrade" >

              <input type="hidden" value="<?= $ssp_id ?>" name="ssp_id">
              <table class="table table-hover table-sm">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Kelas</th>
                    <th>Nilai<br>Sem Ganjil</th>
                    <th>Komentar<br>Ganjil</th>
                    <th>Nilai<br>Sem Genap</th>
                    <th>Komentar<br>Genap</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    foreach ($siswa_all as $m) :
                  ?>

                    <tr>
                      <td>
                        <input type="hidden" value="<?= $m['ssp_peserta_id']; ?>" name="ssp_peserta_id[]">
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
                      <td>
                        <?= $m['kelas_nama']; ?>
                      </td>
                      <td>
                        <?php cetak_opt("ssp_nilai_angka[]",$m['ssp_peserta_nilai']); ?>
                      </td>
                      <td><input type="text" name="ssp_peserta_komen1[]" value="<?= $m['ssp_peserta_komen1'] ?>"></td>
                      <td>
                        <?php cetak_opt("ssp_nilai_angka2[]",$m['ssp_peserta_nilai2']); ?>
                      </td>
                      <td><input type="text" name="ssp_peserta_komen2[]" value="<?= $m['ssp_peserta_komen2'] ?>"></td>
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
