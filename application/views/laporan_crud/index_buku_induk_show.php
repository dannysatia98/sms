<style>
.grid-container {
  display: grid;
  grid-template-columns: auto;
  /* background-color: #2196F3; */
  padding: 10px;
  margin: 20px;
  box-shadow: 5px 5px 5px 5px;
}
.grid-container-tabel {
  display: grid;
  grid-template-columns: 50% 50%;
}

.grid-container-ttd {
  display: grid;
  grid-template-columns: 70% 30%;
  font-family:Cambria;
  font-size:12px;
  margin-top: 20px;
}
.grid-item {
  /* background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center; */
  margin: 10px;
  padding: 10px;
  overflow: auto;
}

.grid-container-inside {
  display: grid;
  grid-template-columns: 25px 200px auto;
  font-family:Cambria;
  font-size:12px;
}
.grid-item-inside {
  /* background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center; */
  grid-column:1/4;
  padding-top: 10px;
}

.grid-item-inside-center {
  /* background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 20px;
  font-size: 30px;*/
  text-align: center;
  grid-column:1/4;
}
</style>

<div class="grid-container">
  <div class="grid-item" id="print_area">

    <?php
      $tgl = explode("-",$tgl_cetak);

      $t = return_nama_tahun($t_id);

      for($i=0;$i<count($sis_arr);$i++):
        $mapel_detail = mapel_urutan_by_kelas($kelas_id);

    ?>
        <div class="grid-container-inside">
          <div class="grid-item-inside-center">
            <div><b>LEMBAR BUKU INDUK PESERTA DIDIK SMA</b></div>
            <div>NOMOR INDUK PESERTA DIDIK: </div>
          </div>
          <br>
          <div class="grid-item-inside"><b>A. KETERANGAN DIRI PESERTA DIDIK</b></div>
          <div>1.</div> <div>Nama Lengkap</div> <div>:</div>
          <div></div> <div>Nama Panggilan</div> <div>:</div>
          <div>2.</div> <div>Jenis Kelamin</div> <div>:</div>
          <div>3.</div> <div>Tempat dan Tanggal Lahir</div> <div>:</div>
          <div>4.</div> <div>Agama</div> <div>:</div>
          <div>5.</div> <div>Kewarganegaraan</div> <div>:</div>
          <div>6.</div> <div>Anak Keberapa</div> <div>:</div>
          <div>7.</div> <div>Jumlah Saudara Kandung</div> <div>:</div>
          <div>8.</div> <div>Jumlah Saudara Tiri</div> <div>:</div>
          <div>9.</div> <div>Jumlah Saudara Angkat</div> <div>:</div>
          <div>10.</div> <div>Anak Yatim/ Piatu/ Yatim Piatu</div> <div>:</div>
          <div>11.</div> <div>Bahasa Sehari-hari di rumah</div> <div>:</div>

          <div class="grid-item-inside"><b>B. KETERANGAN TEMPAT TINGGAL</b></div>
          <div>12.</div> <div>Alamat</div> <div>:</div>
          <div>13.</div> <div>No Telepon/HP</div> <div>:</div>
          <div>14.</div> <div>Tinggal dengan Orang</div> <div></div>
          <div></div> <div>Tua/Saudara/Asrama/Kost</div> <div>:</div>
          <div>15.</div> <div>Jarak Tempat Tinggal ke Sekolah</div> <div>:</div>

          <div class="grid-item-inside"><b>C. KETERANGAN KESEHATAN</b></div>
          <div>16.</div> <div>Golongan Darah</div> <div>:</div>
          <div>17.</div> <div>Penyakit yang pernah diderita</div> <div>:</div>
          <div>18.</div> <div>Kelainan Jasmani</div> <div>:</div>
          <div>19.</div> <div>Tinggal dan Berat badan</div> <div>:</div>
          <div></div> <div>(Saat diterima di sekolah ini)</div> <div></div>

          <div class="grid-item-inside"><b>D. KETERANGAN PENDIDIKAN</b></div>
          <div>20.</div> <div>Pendidikan Sebelumnya</div> <div>:</div>
          <div></div> <div>a. Tamat dari</div> <div>:</div>
          <div></div> <div>b. Tanggal dan Nomor Ijazah</div> <div>:</div>
          <div></div> <div>c. Tanggal dan Nomor STL</div> <div>:</div>
          <div></div> <div>d. Lama Belajar</div> <div>:</div>
          <div>21.</div> <div>Pindahan</div> <div>:</div>
          <div></div> <div>a. Dari Sekolah</div> <div>:</div>
          <div></div> <div>b. Alasan</div> <div>:</div>
          <div>22.</div> <div>Diterima di sekolah ini</div> <div>:</div>
          <div></div> <div>a. Di kelas</div> <div>:</div>
          <div></div> <div>b. Kelompok</div> <div>:</div>
          <div></div> <div>c. Tanggal</div> <div>:</div>

          <div class="grid-item-inside"><b>E. KETERANGAN TENTANG AYAH KANDUNG</b></div>
          <div>23.</div> <div>Nama</div> <div>:</div>
          <div>24.</div> <div>Tempat dan Tanggal Lahir</div> <div>:</div>
          <div>25.</div> <div>Alamat</div> <div>:</div>
          <div>26.</div> <div>No Telepon/HP</div> <div>:</div>
          <div>27.</div> <div>Agama</div> <div>:</div>
          <div>28.</div> <div>Kewarganegaraan</div> <div>:</div>
          <div>29.</div> <div>Pendidikan</div> <div>:</div>
          <div>30.</div> <div>Pekerjaan</div> <div>:</div>
          <div>31.</div> <div>Pendapatan</div> <div>:</div>
          <div>32.</div> <div>Masih hidup/meninggal dunia</div> <div>:</div>

          <div class="grid-item-inside"><b>F. KETERANGAN TENTANG IBU KANDUNG</b></div>
          <div>33.</div> <div>Nama</div> <div>:</div>
          <div>34.</div> <div>Tempat dan Tanggal Lahir</div> <div>:</div>
          <div>35.</div> <div>Alamat</div> <div>:</div>
          <div>36.</div> <div>No Telepon/HP</div> <div>:</div>
          <div>37.</div> <div>Agama</div> <div>:</div>
          <div>38.</div> <div>Kewarganegaraan</div> <div>:</div>
          <div>39.</div> <div>Pendidikan</div> <div>:</div>
          <div>40.</div> <div>Pekerjaan</div> <div>:</div>
          <div>41.</div> <div>Pendapatan</div> <div>:</div>
          <div>42.</div> <div>Masih hidup/meninggal dunia</div> <div>:</div>

          <div class="grid-item-inside"><b>G. KETERANGAN TENTANG WALI</b></div>
          <div>43.</div> <div>Nama</div> <div>:</div>
          <div>44.</div> <div>Tempat dan Tanggal Lahir</div> <div>:</div>
          <div>45.</div> <div>Alamat</div> <div>:</div>
          <div>46.</div> <div>No Telepon/HP</div> <div>:</div>
          <div>47.</div> <div>Agama</div> <div>:</div>
          <div>48.</div> <div>Kewarganegaraan</div> <div>:</div>
          <div>49.</div> <div>Pendidikan</div> <div>:</div>
          <div>50.</div> <div>Pekerjaan</div> <div>:</div>
          <div>51.</div> <div>Pendapatan</div> <div>:</div>
          <div>52.</div> <div>Masih hidup/meninggal dunia</div> <div>:</div>

          <div class="grid-item-inside"><b>H. KEGEMARAN PESERTA DIDIK</b></div>
          <div>53.</div> <div>Kesenian</div> <div>:</div>
          <div>54.</div> <div>Olahraga</div> <div>:</div>
          <div>55.</div> <div>Kemasyarakatan/Organisasi</div> <div>:</div>
          <div>56.</div> <div>Lain-lain</div> <div>:</div>

          <div class="grid-item-inside"><b>I. KETERANGAN PERKEMBANGAN PESERTA DIDIK</b></div>
          <div>57.</div> <div>Menerima Beasiswa</div> <div>:</div>
          <div>58.</div> <div>Meninggalkan sekolah ini</div> <div></div>
          <div></div> <div>a. </div> <div>:</div>
          <div></div> <div>b. </div> <div>:</div>
          <div>59.</div> <div>Akhir Pendidikan</div> <div></div>
          <div></div> <div>a. Tamat belajar/ Lulus</div> <div>:</div>
          <div></div> <div>b. Ijazah</div> <div>:</div>
          <div></div> <div>c. Nomor Surat Tanda Lulus/STL</div> <div>:</div>
          <div></div> <div>d. Nilai Rata-rata yang dicapai</div> <div>:</div>

          <div class="grid-item-inside"><b>J. KETERANGAN SETELAH SELESAI PENDIDIKAN</b></div>
          <div>60.</div> <div>Akan melanjukan ke</div> <div>:</div>
          <div>61.</div> <div>Akan bekerja di</div> <div>:</div>
        </div>

        <p style="page-break-after: always;">&nbsp;</p>
        <table class="rapot">
          <thead>
            <tr>
              <td rowspan="4" style="width:30px; text-align: center;">No</td>
              <td rowspan="4" style="width:250px; text-align: center;">MAPEL</td>
              <td colspan="4" style="text-align: center;">Th. Ajaran <?= $t['t_nama'] ?></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">KKM</td>
              <td colspan="2" style="text-align: center;">KKM</td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">Semester 1</td>
              <td colspan="2" style="text-align: center;">Semester 2</td>
            </tr>
            <tr>
              <td style="text-align: center;">Pengetahuan</td>
              <td style="text-align: center;">Keterampilan</td>
              <td style="text-align: center;">Pengetahuan</td>
              <td style="text-align: center;">Keterampilan</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $no=1;
              $mapel_kel_nama = "";
              foreach ($mapel_detail as $m):
                ////////////////////////semester 1///////////////////////////////

                $nilai = returnRaportPengetahuan($sis_arr[$i], 1, $m['mapel_id']);
                if($nilai){
                  $ujmid = $nilai['uj_mid1_kog'];
                  $ujfin = $nilai['uj_fin1_kog'];
                  $nh = $nilai['NH'];
                }else{
                  $ujmid = 0;
                  $ujfin = 0;
                  $nh = 0;
                }

                $nilai_ket = returnRaportKetrampilan($sis_arr[$i], 1, $m['mapel_id']);
                if($nilai_ket){
                  $ujmidps = $nilai_ket['uj_mid1_psi'];
                  $ujfinps = $nilai_ket['uj_fin1_psi'];
                  $naKet = round(hitungNA($nilai_ket['NA_ket'],$ujmidps,$ujfinps));
                }else{
                  $ujmidps = 0;
                  $ujfinps = 0;
                  $naKet = 0;
                }

                /////////////////////////semester 2//////////////////////////////
                $nilai2 = returnRaportPengetahuan($sis_arr[$i], 2, $m['mapel_id']);
                if($nilai2){
                  $ujmid2 = $nilai2['uj_mid2_kog'];
                  $ujfin2 = $nilai2['uj_fin2_kog'];
                  $nh2 = $nilai2['NH'];
                }else{
                  $ujmid2 = 0;
                  $ujfin2 = 0;
                  $nh2 = 0;
                }

                $nilai_ket2 = returnRaportKetrampilan($sis_arr[$i], 2, $m['mapel_id']);
                if($nilai_ket2){
                  $ujmidps2 = $nilai_ket2['uj_mid2_psi'];
                  $ujfinps2 = $nilai_ket2['uj_fin2_psi'];
                  $naKet2 = round(hitungNA($nilai_ket2['NA_ket'],$ujmidps2,$ujfinps2));
                }else{
                  $ujmidps2 = 0;
                  $ujfinps2 = 0;
                  $naKet2 = 0;
                }
            ?>
              <tr>
                <?php if($mapel_kel_nama != $m['mapel_kel_nama']): ?>
                  <td style="text-align: center;" colspan="2"><b><?= $m['mapel_kel_nama'] ?></b></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                <?php endif; ?>
              </tr>
              <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td style="padding: 0px 0px 0px 5px;"><?= $m['mapel_nama'] ?></td>
                <!-- pengetahuan semester 1 -->
                <td style="text-align: center;"><?= round(hitungNA($nh,$ujmid,$ujfin)) ?></td>
                <td style="text-align: center;"><?= $naKet ?></td>
                <!-- pengetahuan semester 2 -->
                <td style="text-align: center;"><?= round(hitungNA($nh2,$ujmid2,$ujfin2)) ?></td>
                <td style="text-align: center;"><?= $naKet2 ?></td>
              </tr>
            <?php
              $no++;
              $mapel_kel_nama = $m['mapel_kel_nama'];
              endforeach;
            ?>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2"><b>SIKAP SPIRITUAL</b></td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2"><b>SIKAP SOSIAL</b></td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;" colspan="2"><b>PENGEMBANGAN DIRI</b></td>
              <td colspan="2"></td><td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">A</td>
              <td style="padding: 0px 0px 0px 5px;">Ekstrakurikuler</td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">B</td>
              <td style="padding: 0px 0px 0px 5px;">Keikutsertaan Dalam Organisasi/Kegiatan di Sekolah</td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;" colspan="2"><b>KETIDAKHADIRAN</b></td>
              <td colspan="2"></td><td colspan="2"></td>
            </tr>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2">Sakit</td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2">Izin</td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="padding: 0px 0px 0px 5px;" colspan="2">Tanpa Keterangan</td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;" colspan="2"><b>AKHLAK MULIA DAN KEPRIBADIAN</b></td>
              <td colspan="2"></td><td colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">1</td>
              <td style="padding: 0px 0px 0px 5px;">Kedisiplinan</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">2</td>
              <td style="padding: 0px 0px 0px 5px;">Kebersihan</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">3</td>
              <td style="padding: 0px 0px 0px 5px;">Kesehatan</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">4</td>
              <td style="padding: 0px 0px 0px 5px;">Tanggung Jawab</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">5</td>
              <td style="padding: 0px 0px 0px 5px;">Sopan Santun</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">6</td>
              <td style="padding: 0px 0px 0px 5px;">Percaya diri</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">7</td>
              <td style="padding: 0px 0px 0px 5px;">Kompetitif</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">8</td>
              <td style="padding: 0px 0px 0px 5px;">Hubungan sosial</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">9</td>
              <td style="padding: 0px 0px 0px 5px;">Kejujuran</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;">10</td>
              <td style="padding: 0px 0px 0px 5px;">Pelaksaaan ibadah ritual</td>
              <td style="text-align: center;" colspan="2"></td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
            <tr>
              <td style="text-align: center;" colspan="2"><br><b>STATUS AKHIR TAHUN</b></td>
              <td colspan="4">
                <div class="grid-container-tabel">
                  <div style="text-align: center;">
                      Naik Ke<br>Tinggal di
                  </div>
                  <div style="text-align: center;">
                      <br>
                      Kelas:
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="grid-container-ttd">
          <div></div>
          <div style="text-align: center;">
            <b>Surabaya, <?= $tgl[2].' '.return_nama_bulan($tgl[1]).' '.$tgl[0] ?></b><br>
            <b>Wali Kelas</b><br><br><br><br>
            <b>(<?= $walkel['kr_gelar_depan']." ".ucwords(strtolower($walkel['kr_nama_depan'].' '.$walkel['kr_nama_belakang'])).", ".$walkel['kr_gelar_belakang'] ?>)</b>
          </div>
        </div>

        <p style="page-break-after: always;">&nbsp;</p>
    <?php
      endfor;
    ?>

  </div>
  <input style="width:20%;" type="button" name="print_rekap" id="print_rekap" class="btn btn-success mb-3 ml-3" value="Print">
</div>
