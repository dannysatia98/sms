<div class="container d-flex justify-content-center">


  <div class="card o-hidden border-0 shadow-lg my-5 text">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto" style='width: 850px;'>
            <div id="print_area">

            <!-- /////////////// -->
            <!-- HALAMAN 1 Cover -->
            <!-- /////////////// -->
            <?php

              for($i=0;$i<count($sis_arr);$i++):

                $detail_siswa = return_detail_siswa($sis_arr[$i]);

                $json = file_get_contents("http://sisterv4.frateran.sch.id/sisterv4fratz/api/siswadetail?nis=".$detail_siswa['sis_no_induk']);
                $obj = json_decode($json);

                $sikap = returnRaportSemester1($sis_arr[$i], $semester, $kelas_id);

                if(isset($sikap)):

            ?>
              
                  <br><br><br>
                  <div style='font-family: "Times New Roman", Times, serif; font-size:16px; margin-bottom: 26px; margin-top: 24px; text-align:center;'><b>RAPOR<br>SEKOLAH MENENGAH ATAS<br>(SMA)</b></div>
                  <br><br><br>
                  <center><img src="<?= base_url('assets/img/profile/tutwuri.png') ?>" height="140" style='margin-left:auto;margin-right:auto; text-align: center; border-radius: 0%;'></center>
                  <br><br><br><br>
                  <div style='font-family: "Times New Roman", Times, serif; font-size:16px; margin-bottom: 26px; margin-top: 24px; text-align:center;'><b>Nama Peserta Didik:<br>
                    <table style="width:400px;margin-left:auto;margin-right:auto;border-collapse: collapse;" border="1">
                      <tbody>
                        <tr style=''>
                          <td style='font-family: "Times New Roman", Times, serif; font-size:16px; margin-bottom: 26px; margin-top: 24px; text-align:center;'><?= ucwords(strtolower($obj[0]->namasiswa));?></td>
                        </tr>
                      </tbody>
                    </table></b>
                  </div>
                  <br><br><br>
                   <div style='font-family: "Times New Roman", Times, serif; font-size:16px; margin-bottom: 26px; margin-top: 24px; text-align:center;'><b>NISN:<br>
                    <table style="width:400px;margin-left:auto;margin-right:auto;border-collapse: collapse;" border="1">
                      <tbody>
                        <tr style=''>
                          <td style='font-family: "Times New Roman", Times, serif; font-size:16px; margin-bottom: 26px; margin-top: 24px; text-align:center;'><?= ucwords(strtolower($obj[0]->nisn));?></td>
                        </tr>
                      </tbody>
                    </table></b><br>
                  </div>


              <p style="page-break-after: always;">&nbsp;</p>

              <!-- ///////////////////// -->
              <!-- HALAMAN 2 Data Diri -->
              <!-- ///////////////////// -->
              <div style='font-family: "Times New Roman", Times, serif; font-size:16px; margin-bottom: 26px; margin-top: 24px; text-align:center;'><b>RAPOR<br>SEKOLAH MENENGAH ATAS<br>(SMA)</b></div>
              <br><br><br><br>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>Nama Sekolah&emsp;&emsp;&emsp;&emsp;&nbsp;: SMA KATOLIK FRATERAN<br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>NPSN &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:<br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>NIS/NSS/NDS&emsp;&emsp;&emsp;&emsp;: <?=$obj[0]->nisn;?><br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>Alamat Sekolah &emsp;&emsp;&emsp;&nbsp;&nbsp;: Jl. Kepanjen No. 8 RT 03 RW 08<br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;Kode Pos: 60175 Telp. 031 3524901<br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>Desa/Kelurahan&emsp;&emsp;&emsp;&nbsp;&nbsp;: Krembangan Selatan<br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>Kecamatan&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;: Krembangan<br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>Kota/Kabupaten&emsp;&emsp;&emsp;&nbsp;: Surabaya<br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>Provinsi &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;: Jawa Timur<br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>Website &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;: www.frateran.sch.id<br></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 150px; text-align:left;'>E-mail&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: smak@frateran.sch.id<br></div>

              
              
              <br><br><br>

              <p style="page-break-after: always;">&nbsp;</p>

              <!-- ////////////////////// -->
              <!-- HALAMAN 3 Data Diri 2 -->
              <!-- ////////////////////// -->
              <div style='font-family: "Times New Roman", Times, serif; font-size:16px; margin-bottom: 26px; margin-top: 24px; text-align:center;'><b>IDENTITAS PESERTA DIDIK</b></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 35px; margin-left: 25px; text-align:left;'>1. Nama Lengkap Peserta Didik:<?= ucwords(strtolower($obj[0]->namasiswa));?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>2. Nomor Induk/NISN &emsp;&emsp;&emsp;&nbsp;&nbsp;:<?=$obj[0]->nis;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>3. Tempat, Tanggal Lahir&emsp;&emsp;&ensp;&nbsp;:<?=$obj[0]->tempatlahirsiswa;?>, <?=$obj[0]->tanggallahirsiswa;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>4. Jenis Kelamin &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:<?=$obj[0]->kelaminsiswa;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>5. Agama&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:<?=$obj[0]->agamasiswa;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>6. Status dalam keluarga&emsp;&emsp;&emsp;:<?=$obj[0]->statusanak;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>7. Anak ke &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:<?=$obj[0]->anakke;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>8. Alamat Peserta didik &emsp;&emsp;&emsp;&nbsp;:<?=$obj[0]->alamatsiswa;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>9. Nomor Telepon Rumah &emsp;&emsp;&nbsp;:<?=$obj[0]->hpayah;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>10. Sekolah Asal (SMP/MTs)&emsp;&nbsp;:<?=$obj[0]->sekolahasal;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>11. Di terima di SMA ini<br>&emsp;&ensp;a. Di Kelas&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:<?=$obj[0]->kelas_diterima;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>&emsp;&ensp;b. Pada Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;:<?php echo date('d-m-Y', strtotime($obj[0]->tgl_diterima));?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>12. Orang Tua<br>&emsp;&ensp;a. Nama Ayah&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:<?=$obj[0]->namaayah;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>&emsp;&ensp;b. Nama Ibu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:<?=$obj[0]->namaibu;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>&emsp;&ensp;c. Alamat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;:<?=$obj[0]->alamatayah;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>&emsp;&ensp;d. Nomor Telepon/HP&emsp;&emsp;&ensp;:<?=$obj[0]->hpayah;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>13. Pekerjaan Orang Tua<br>&emsp;&ensp;a. Ayah &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:<?=$obj[0]->pekerjaanayah;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>&emsp;&ensp;b. Ibu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:<?=$obj[0]->pekerjaanibu;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>14. Wali Peserta Didik<br>&emsp;&ensp;a. Nama Wali&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:<?=$obj[0]->namawali;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>&emsp;&ensp;b. Nomor Telepon/HP&emsp;&emsp;&ensp;:<?=$obj[0]->hpwali;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>&emsp;&ensp;c. Alamat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;:<?=$obj[0]->alamatwali;?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 25px; text-align:left;'>&emsp;&ensp;d. Pekerjaan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; :<?=$obj[0]->pekerjaanwali;?></div>
              <br><br>
              <table style="position:absolute; width:135px; height:180px;margin-left: 50px;border-collapse: collapse;" border="1">
                <tbody>
                  <tr style=''>
                    <td style='font-family: "Times New Roman", Times, serif; font-size:16px; margin-bottom: 26px; margin-top: 24px; text-align:center;'></td>
                  </tr>
                </tbody>
              </table>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-left: 320px; text-align:left;'>Surabaya, <?php echo date('d F Y', strtotime($obj[0]->tgl_diterima));?></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 320px; text-align:left;'>Kepala Sekolah,</div>
              <br><br>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 320px; text-align:left;'><u>Fr. M.Adriano, BHK,S.Pd.</u></div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:15px; margin-top: 15px; margin-left: 320px; text-align:left;'>NIP </div>
              <br><br><br><br>
              <div style='font-family: "Times New Roman", Times, serif; font-size:14px; margin-left: 25px; text-align:left;'>Keterangan:</div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:14px; margin-left: 25px; text-align:left;'>NIS&emsp;&emsp;&emsp; :Nomor Induk Peserta Didik</div>
              <div style='font-family: "Times New Roman", Times, serif; font-size:14px; margin-left: 25px; text-align:left;'>NISN&emsp;&emsp;&ensp;:Nomor Induk Peserta Didik Nasional</div>

              
              <br><br>
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
