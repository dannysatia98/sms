<div class="container d-flex justify-content-center">


  <div class="card o-hidden border-0 shadow-lg my-5 text">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto" style='width: 850px;'>
            <div id="print_area">

            <!-- /////////////// -->
            <!-- HALAMAN 1 SIKAP -->
            <!-- /////////////// -->
            <?php

              for($i=0;$i<count($sis_arr);$i++):

                $detail_siswa = return_detail_siswa($sis_arr[$i]);

                $sikap = returnRaportSemester1($sis_arr[$i], $semester, $kelas_id);

                if(isset($sikap)):
                  $total_sosial = 0;
                  $total_spirit = 0;
                  foreach($sikap as $z) :
                    if(empty($z['total_sosial'])){
                      $total_sosial += 3 * ($z['d_mpl_persen_sos']/100);
                    }else{
                      $total_sosial += $z['total_sosial'] * ($z['d_mpl_persen_sos']/100);
                    }

                    if(empty($z['total_spirit'])){
                      $total_spirit += 3 * ($z['d_mpl_persen_spr']/100);
                    }else{
                      $total_spirit += $z['total_spirit'] * ($z['d_mpl_persen_spr']/100);
                    }
                  endforeach;

                  //echo $total_sosial;
                  //echo return_abjad_sikap($total_sosial);
                  //echo count($sikap);

            ?>
              <table class="rapot_atas">
                <tbody>
                  <tr>
                    <td style='width: 120px;'>Nama Sekolah</td><td>: SMA KATOLIK FRATERAN</td>
                    <td style='width: 100px;'>Kelas</td><td>: <?= $detail_siswa['kelas_nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td><td>: Jl.Kepanjen 8, Surabaya</td>
                    <td>Periode</td><td>: <?php if($semester==1)echo "Semester Ganjil";else echo "Semester Genap"; ?></td>
                  </tr>
                  <tr>
                    <td>Nama</td><td>: <?=  ucwords(strtolower($detail_siswa['sis_nama_depan'].' '.$detail_siswa['sis_nama_bel'])); ?></td>
                    <td>Tahun Pelajaran</td><td>: <?= $detail_siswa['t_nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Nomor Induk/NISN</td><td>: <?= $detail_siswa['sis_no_induk'] ?></td>
                  </tr>
                </tbody>
              </table>
              <hr style="border: none; border-bottom: 0.5px solid black;">

              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label><b>A. Sikap</b></label>
              </div>

              <div style='clear: both;'></div>

              <div style='margin-left:15px;'>
                <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 3px;'>
                  <label><b>1. Sikap Spiritual</b></label>
                </div>
                <table class="rapot">
                  <tbody>
                    <tr style='text-align:center;'>
                      <td style='width: 100px;'>Predikat</td>
                      <td>Deskripsi</td>
                    </tr>
                    <tr>
                      <td style='text-align:center;'><?= return_abjad_sikap($total_spirit) ?></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 3px;'>
                  <label><b>2. Sikap Sosial</b></label>
                </div>
                <table class="rapot">
                  <tbody>
                    <tr style='text-align:center;'>
                      <td style='width: 100px;'>Predikat</td>
                      <td>Deskripsi</td>
                    </tr>
                    <tr>
                      <td style='text-align:center;'><?= return_abjad_sikap($total_sosial) ?></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p style="page-break-after: always;">&nbsp;</p>

              <!-- ///////////////////// -->
              <!-- HALAMAN 2 Pengetahuan -->
              <!-- ///////////////////// -->
              <table class="rapot_atas">
                <tbody>
                  <tr>
                    <td style='width: 120px;'>Nama Sekolah</td><td>: SMA KATOLIK FRATERAN</td>
                    <td style='width: 100px;'>Kelas</td><td>: <?= $detail_siswa['kelas_nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td><td>: Jl.Kepanjen 8, Surabaya</td>
                    <td>Periode</td><td>: <?php if($semester==1)echo "Semester Ganjil";else echo "Semester Genap"; ?></td>
                  </tr>
                  <tr>
                    <td>Nama</td><td>: <?=  ucwords(strtolower($detail_siswa['sis_nama_depan'].' '.$detail_siswa['sis_nama_bel'])); ?></td>
                    <td>Tahun Pelajaran</td><td>: <?= $detail_siswa['t_nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Nomor Induk/NISN</td><td>: <?= $detail_siswa['sis_no_induk'] ?></td>
                  </tr>
                </tbody>
              </table>
              <hr style="border: none; border-bottom: 0.5px solid black;">

              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label><b>B. Pengetahuan</b></label>
              </div>

              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label>Kriteria Ketuntasan Minimal = 75</label>
              </div>

              <table class="rapot">
                <thead>
                  <th style='width: 25px;'>No.</th>
                  <th style='width: 155px;'>Mata Pelajaran</th>
                  <th style='width: 30px;'>Nilai</th>
                  <th style='width: 50px;'>Predikat</th>
                  <th>Deskripsi</th>
                </thead>
                <tbody>
                  <?php
                    $pengetahuan = returnRaportSemester2($sis_arr[$i], $semester);
                    //var_dump($sikap);
                    $nomor_pengetahuan = 1;
                    $t_nama_temp = "";
                    foreach($pengetahuan as $z) :
                      if($semester == 1){
                        if($z['uj_mid1_kog']){
                          $ujmid = $z['uj_mid1_kog'];
                          $ujfin = $z['uj_fin1_kog'];
                        }else{
                          $ujmid = 0;
                          $ujfin = 0;
                        }
                      }else{
                        if($z['uj2']){
                          $ujmid = $z['uj_mid2_kog'];
                          $ujfin = $z['uj_fin2_kog'];
                        }else{
                          $ujmid = 0;
                          $ujfin = 0;
                        }
                      }
                  ?>
                    <tr>
                      <?php
                        if($t_nama_temp != $z['mapel_kel_nama']){
                          $tahun_fix = "<tr>
                                          <td style='padding: 0px 0px 0px 5px;' colspan='5'>".$z['mapel_kel_nama']."</td>
                                        </tr>";
                        }else{
                          $tahun_fix = "";
                        }
                        echo $tahun_fix;
                      ?>
                      <td class='nomor'><?= $nomor_pengetahuan ?></td>
                      <td style='padding: 0px 0px 0px 5px; margin: 0px;'><?= $z['mapel_nama'] ?></td>
                      <td class='nomor'><?php
                                          $final_pengetahuan = round(hitungNA($z['NH'],$ujmid,$ujfin));
                                          echo $final_pengetahuan;
                                        ?>
                      </td>
                      <td class='nomor'><?= return_abjad_NH($final_pengetahuan) ?></td>
                      <td style='padding: 0px 0px 0px 5px;'>
                        <?= returnMaxKDpeng($z['topik_kumpulan'],$detail_siswa['d_s_id'],$final_pengetahuan) ?>
                      </td>
                    </tr>

                  <?php

                      $nomor_pengetahuan++;
                      $t_nama_temp = $z['mapel_kel_nama'];
                    endforeach;
                  ?>
                </tbody>
              </table>

              <p style="page-break-after: always;">&nbsp;</p>

              <!-- ////////////////////// -->
              <!-- HALAMAN 3 Keterampilan -->
              <!-- ////////////////////// -->
              <table class="rapot_atas">
                <tbody>
                  <tr>
                    <td style='width: 120px;'>Nama Sekolah</td><td>: SMA KATOLIK FRATERAN</td>
                    <td style='width: 100px;'>Kelas</td><td>: <?= $detail_siswa['kelas_nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td><td>: Jl.Kepanjen 8, Surabaya</td>
                    <td>Periode</td><td>: <?php if($semester==1)echo "Semester Ganjil";else echo "Semester Genap"; ?></td>
                  </tr>
                  <tr>
                    <td>Nama</td><td>: <?=  ucwords(strtolower($detail_siswa['sis_nama_depan'].' '.$detail_siswa['sis_nama_bel'])); ?></td>
                    <td>Tahun Pelajaran</td><td>: <?= $detail_siswa['t_nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Nomor Induk/NISN</td><td>: <?= $detail_siswa['sis_no_induk'] ?></td>
                  </tr>
                </tbody>
              </table>
              <hr style="border: none; border-bottom: 0.5px solid black;">
              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label><b>C. Keterampilan</b></label>
              </div>

              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label>Kriteria Ketuntasan Minimal = 75</label>
              </div>

              <table class="rapot">
                <thead>
                  <th style='width: 25px;'>No.</th>
                  <th style='width: 155px;'>Mata Pelajaran</th>
                  <th style='width: 30px;'>Nilai</th>
                  <th style='width: 50px;'>Predikat</th>
                  <th>Deskripsi</th>
                </thead>
                <tbody>
                  <?php
                    $keterampilan = returnRaportSemester3($sis_arr[$i], $semester);
                    //var_dump($sikap);
                    $nomor_ket = 1;
                    $t_nama_temp = "";
                    foreach($keterampilan as $z) :
                      if($semester == 1){
                        if($z['uj_mid1_psi']){
                          $ujmidps = $z['uj_mid1_psi'];
                          $ujfinps = $z['uj_fin1_psi'];
                        }else{
                          $ujmidps = 0;
                          $ujfinps = 0;
                        }
                      }else{
                        if($z['uj2']){
                          $ujmidps = $z['uj_mid2_psi'];
                          $ujfinps = $z['uj_fin2_psi'];
                        }else{
                          $ujmidps = 0;
                          $ujfinps = 0;
                        }
                      }
                  ?>
                    <tr>
                      <?php
                        if($t_nama_temp != $z['mapel_kel_nama']){
                          $tahun_fix = "<tr>
                                          <td style='padding: 0px 0px 0px 5px;' colspan='5'>".$z['mapel_kel_nama']."</td>
                                        </tr>";
                        }else{
                          $tahun_fix = "";
                        }
                        echo $tahun_fix;
                      ?>
                      <td class='nomor'><?= $nomor_ket ?></td>
                      <td style='padding: 0px 0px 0px 5px; margin: 0px;'><?= $z['mapel_nama'] ?></td>
                      <td class='nomor'>
                        <?php
                            $final_keterampilan = round(hitungNA($z['NA_ket'],$ujmidps,$ujfinps));
                            echo $final_keterampilan;
                        ?>
                      </td>
                      <td class='nomor'><?= return_abjad_NH($final_keterampilan) ?></td>
                      <td style='padding: 0px 0px 0px 5px;'>
                        <?= returnDescKet($z['topik_kumpulan'],$detail_siswa['d_s_id'],$final_keterampilan) ?>
                      </td>
                    </tr>

                  <?php

                      $nomor_ket++;
                      $t_nama_temp = $z['mapel_kel_nama'];
                    endforeach;
                  ?>
                </tbody>
              </table>

              <p style="page-break-after: always;">&nbsp;</p>
              <!-- ///////////// -->
              <!-- HALAMAN 4 DLL -->
              <!-- ///////////// -->
              <table class="rapot_atas">
                <tbody>
                  <tr>
                    <td style='width: 120px;'>Nama Sekolah</td><td>: SMA KATOLIK FRATERAN</td>
                    <td style='width: 100px;'>Kelas</td><td>: <?= $detail_siswa['kelas_nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td><td>: Jl.Kepanjen 8, Surabaya</td>
                    <td>Periode</td><td>: <?php if($semester==1)echo "Semester Ganjil";else echo "Semester Genap"; ?></td>
                  </tr>
                  <tr>
                    <td>Nama</td><td>: <?=  ucwords(strtolower($detail_siswa['sis_nama_depan'].' '.$detail_siswa['sis_nama_bel'])); ?></td>
                    <td>Tahun Pelajaran</td><td>: <?= $detail_siswa['t_nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Nomor Induk/NISN</td><td>: <?= $detail_siswa['sis_no_induk'] ?></td>
                  </tr>
                </tbody>
              </table>
              <hr style="border: none; border-bottom: 0.5px solid black;">

              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 2px;'>
                <label>Tabel interval predikat berdasarkan KKM</label>
              </div>
              <table class="rapot">
                <tbody style='text-align:center;'>
                  <tr>
                    <td rowspan="2">KKM</td>
                    <td colspan="4">Predikat</td>
                  </tr>
                  <tr>
                    <td style='width: 150px;'>D=Kurang</td>
                    <td style='width: 150px;'>C=Cukup</td>
                    <td style='width: 150px;'>B=Baik</td>
                    <td style='width: 150px;'>A=Sangat Baik</td>
                  </tr>
                  <tr>
                    <td>75</td>
                    <td>N&lt;75</td>
                    <td>75&lt;= N < 84</td>
                    <td>84&lt;= N < 92</td>
                    <td>N&gt;= 92</td>
                  </tr>
                </tbody>
              </table>
              <br>
              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label><b>D. Ekstrakurikuler</b></label>
              </div>
              <table class="rapot">
                <tbody>
                  <tr>
                    <td style='width: 25px; text-align:center;'>No.</td>
                    <td style='text-align:center; width: 200px;'>Kegiatan Ekstrakurikuler</td>
                    <td style='text-align:center; width: 40px;'>Nilai</td>
                    <td style='text-align:center;'>Deskripsi</td>
                  </tr>
                  <?php
                    $nScout = 0;
                    if($semester == 1){
                      $nScout = $detail_siswa['d_s_scout_nilai'];
                      $sKomen = $detail_siswa['d_s_scout_komen1'];
                    }else {
                      $nScout = $detail_siswa['d_s_scout_nilai2'];
                      $sKomen = $detail_siswa['d_s_scout_komen2'];
                    }
                  ?>
                  <tr>
                    <td style='text-align:center;'>1</td>
                    <td style='padding: 0px 0px 0px 5px; margin: 0px;'>Pramuka</td>
                    <td style='text-align:center;'><?= return_abjad_extra($nScout) ?></td>
                    <td style='padding: 0px 0px 0px 5px;'><?= $sKomen ?></td>
                  </tr>
                  <?php
                    $extra = returnRaportSemester4($sis_arr[$i]);
                    //var_dump($sikap);
                    $nomor_extra = 2;
                    foreach($extra as $z) :
                      if($semester == 1){
                        $nSsp = $z['ssp_peserta_nilai'];
                        $kSsp = $z['ssp_peserta_komen1'];
                      }else {
                        $nSsp = $z['ssp_peserta_nilai2'];
                        $kSsp = $z['ssp_peserta_komen2'];
                      }
                  ?>
                    <tr>
                      <td style='text-align:center;'><?= $nomor_extra ?></td>
                      <td style='padding: 0px 0px 0px 5px; margin: 0px;'><?= $z['ssp_nama'] ?></td>
                      <td style='text-align:center;'><?= return_abjad_extra($nSsp) ?></td>
                      <td style='padding: 0px 0px 0px 5px;'><?= $kSsp ?></td>
                    </tr>

                  <?php
                      $nomor_extra++;
                    endforeach;
                  ?>
                </tbody>
              </table>

              <br>
              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label><b>E. Prestasi</b></label>
              </div>
              <table class="rapot">
                <tbody>
                  <tr>
                    <td style='width: 25px; text-align:center;'>No.</td>
                    <td style='text-align:center; width: 200px;'>Jenis Kegiatan</td>
                    <td style='text-align:center;'>Keterangan</td>
                  </tr>
                  <tr>
                    <td></td><td></td><td></td>
                  </tr>
                  <tr>
                    <td></td><td></td><td></td>
                  </tr>
                </tbody>
              </table>

              <br>
              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label><b>F. Ketidakhadiran</b></label>
              </div>
              <table class="rapot" style='font-family: "Times New Roman", Times, serif; width: 30%; font-size:20px; margin-bottom: 20px;'>
                <tbody>
                  <tr style="height:2px;" >
                    <td style='width: 150px; padding: 0px 0px 0px 5px;'>Sakit</td>
                    <td style='padding: 0px 0px 0px 5px; text-align:center;'></td>
                  </tr>
                  <tr style="height:2px;" >
                    <td style='width: 150px; padding: 0px 0px 0px 5px;'>Izin</td>
                    <td style='padding: 0px 0px 0px 5px; text-align:center;'></td>
                  </tr>
                  <tr style="height:2px;" >
                    <td style='width: 150px; padding: 0px 0px 0px 5px;'>Tanpa Keterangan</td>
                    <td style='padding: 0px 0px 0px 5px; text-align:center;'></td>
                  </tr>
                </tbody>
              </table>

              <?php
                $komen = "";
                if($semester == 1){
                  $komen = $detail_siswa['d_s_komen_sem'];
                }
                elseif ($semester == 2) {
                  $komen = $detail_siswa['d_s_komen_sem2'];
                }
              ?>

              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label><b>G. Catatan Wali Kelas</b></label>
              </div>
              <table class="rapot" style='font-family: "Times New Roman", Times, serif; font-size:20px; margin-bottom: 20px; text-align:left;'>
                <tbody>
                  <tr>
                    <td style="height:40px; padding: 0px 5px;" ><?= $komen ?></td>
                  </tr>
                </tbody>
              </table>

              <div style='font-family: "Times New Roman", Times, serif; font-size:12px; margin-bottom: 5px;'>
                <label><b>H. Tanggapan Orang Tua/Wali</b></label>
              </div>
              <table class="rapot" style='font-family: "Times New Roman", Times, serif; font-size:20px; margin-bottom: 20px; text-align:center;'>
                <tbody>
                  <tr>
                    <td style="height:40px; padding: 0px 5px;" ></td>
                  </tr>
                </tbody>
              </table>

              <?php
                //var_dump($semester);
                $tanggal_arr = explode('-', $detail_siswa['sk_fin']);
                $tahun = $tanggal_arr[0];
                $bulan = return_nama_bulan($tanggal_arr[1]);
                $tanggal = $tanggal_arr[2];

                if($semester == 2):
                  $kata = "";
                  if($detail_siswa['kelas_jenj_id']==1)
                    $kata = "Naik/Tidak Naik *) ke kelas XI";
                  elseif ($detail_siswa['kelas_jenj_id']==2)
                    $kata = "Naik/Tidak Naik *) ke kelas XII";
                  elseif ($detail_siswa['kelas_jenj_id']==3)
                    $kata = "Lulus/Tidak Lulus *)";
              ?>
              <table class="rapot" style='font-family: "Times New Roman", Times, serif; font-size:20px; margin-bottom: 5px;'>
                <tbody>
                  <tr>
                    <td style="height:40px; padding: 0px 15px;" ><b>Keterangan Kenaikan Kelas</b> &emsp; <?= $kata ?></td>
                  </tr>
                </tbody>
              </table>
              <div style='font-family: "Times New Roman", Times, serif; font-size:10px; margin-bottom: 5px;'>
                <label>*) Coret yang tidak perlu</label>
              </div>
              <?php
                endif;
              ?>
              <div style='clear: both;'></div>
              <div id='textbox'>
                <p class='alignleft_bawah'>
                <br><br>
                Orang Tua/Wali<br><br><br><br>
                (............................................)
                </p>
                <p class='alignright_bawah'>
                <br>Surabaya, <?= $tanggal.' '.$bulan.' '.$tahun ?><br>
                Wali Kelas<br><br><br><br>
                (<?= $detail_siswa['kr_gelar_depan']." ".ucwords(strtolower($detail_siswa['kr_nama_depan'].' '.$detail_siswa['kr_nama_belakang'])).", ".$detail_siswa['kr_gelar_belakang'] ?>)<br>
                </p>
              </div>
              <div style='clear: both;'></div>
              <?php
                if($semester == 2):
              ?>
              <div id='textbox'>
                <p class='aligncenter_bawah'>
                <br><br>
                Mengetahui:<br>
                Kepala Sekolah,<br><br><br><br>
                (Fr. M.Adriano, BHK,S.Pd.)
                </p>
              </div>
              <?php
                endif;
              ?>
              <p style="page-break-after: always;">&nbsp;</p>
            <?php
                endif;
              endfor;
            ?>
            </div>
            <input type="button" name="print_rekap" id="print_rekap" class="btn btn-success" value="Print">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
