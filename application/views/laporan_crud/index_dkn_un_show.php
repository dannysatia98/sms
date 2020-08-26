<style>
.grid-container {
  display: grid;
  grid-template-columns: 100%;
  grid-column-gap:3px;
  padding: 10px;
  margin: 20px;
  box-shadow: 5px 5px 5px 5px;
  overflow: auto;
}
</style>

<div class="grid-container">
  <div class="text-center">
    <label style="display: block; font-size: 14px;"><b><u>DAFTAR KUMPULAN NILAI NOMINASI UN</u></b></label>
  </div>

  <div class="alert alert-info" role="alert">
    <table class="table table-bordered table-sm" style="font-size:12px;">
      <thead>
        <tr>
          <th style="width:30px;">Warna</th>
          <th>Penjelasan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="bg-danger"></td>
          <td>&#8594; Siswa tidak terdaftar pada kelas manapun di semester itu</td>
        </tr>
        <tr>
          <td class="bg-warning"></td>
          <td>&#8594; Siswa terdaftar pada 2 kelas pada jenjang yang sama di tahun yang berbeda</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="p-2"><?= $this->session->flashdata('message'); ?></div>
  <div id="print_area">

  <?php
    //dapatkan seluruh kelas dari siswa pertama di kelas tersebut
    $kelas = return_seluruh_kelas_siswa($sis_all[0]['sis_id']);

    //masukkan kelas ke array
    $kelas_arr = array();
    foreach ($kelas as $k) {
      $kelas_arr[] = $k['kelas_id'];
    }

    //dapatkan mapel setiap kelas, jika unik maka masukkan
    $mapel_total = array();
    for ($i=0; $i < count($kelas_arr); $i++) {
      $mapel_arr = mapel_urutan_by_kelas($kelas_arr[$i]);
      foreach ($mapel_arr as $m) {
        if(!in_array($m['mapel_id'], $mapel_total)){
          $mapel_total[]=$m['mapel_id'];
        }
      }
    }
  ?>

  <table class="table table-sm table-bordered" style="font-size:11px;">
    <thead>
      <th>No Induk</th>
      <th>Nama</th>
      <th>Sem</th>
      <th>Jenis</th>
      <?php
        for ($i=0; $i <count($mapel_total); $i++) {
          $nama_mapel = returnNamaMapel($mapel_total[$i]);
          echo "<th>".$nama_mapel['mapel_sing']."</th>";
        }
      ?>
      <th>Rata</th>
    </thead>
    <tbody>
      <?php
        foreach ($sis_all as $s):
      ?>
      <tr>
        <td rowspan="12"><?= $s['sis_no_induk'] ?></td>
        <td rowspan="12"><?= $s['sis_nama_depan'].' '.$s['sis_nama_bel'] ?></td>
        <!-- KELAS X -->
        <?php
          // Untuk kelas X
          // Semester 1
          // Pengetahuan
          $totalpengx = 0;
          $totalmapelpengx = 0;
          // Keterampilan
          $totalpengx2 = 0;
          $totalmapelpengx2 = 0;
          // Semester 2
          // Pengetahuan
          $totalketx = 0;
          $totalmapelketx = 0;
          // Keterampilan
          $totalketx2 = 0;
          $totalmapelketx2 = 0;
          $x = returnKelasXsiswa($s['sis_id']);

          // Untuk kelas XI
          // Semester 1
          // Pengetahuan
          $totalpengxi = 0;
          $totalmapelpengxi = 0;
          // Keterampilan
          $totalpengxi2 = 0;
          $totalmapelpengxi2 = 0;
          // Semester 2
          // Pengetahuan
          $totalketxi = 0;
          $totalmapelketxi = 0;
          // Keterampilan
          $totalketxi2 = 0;
          $totalmapelketxi2 = 0;
          $xi = returnKelasXisiswa($s['sis_id']);

          // Untuk kelas XII
          // Semester 1
          // Pengetahuan
          $totalpengxii = 0;
          $totalmapelpengxii = 0;
          // Keterampilan
          $totalpengxii2 = 0;
          $totalmapelpengxii2 = 0;
          // Semester 2
          // Pengetahuan
          $totalketxii = 0;
          $totalmapelketxii = 0;
          // Keterampilan
          $totalketxii2 = 0;
          $totalmapelketxii2 = 0;
          $xii = returnKelasXiisiswa($s['sis_id']);

          $warnaX = "";
          if(count($x) == 0)
            $warnaX = "bg-danger";
          elseif (count($x) > 1)
            $warnaX = "bg-warning";

          $warnaXi = "";
          if(count($xi) == 0)
            $warnaXi = "bg-danger";
          elseif (count($xi) > 1)
            $warnaXi = "bg-warning";

          $warnaXii = "";
          if(count($xii) == 0)
            $warnaXii = "bg-danger";
          elseif (count($xii) > 1)
            $warnaXii = "bg-warning";
        ?>
        <td rowspan="2">1</td>
        <td>Pengetahuan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaX ?>">
            <?php
              if($warnaX == ""){
                //dapatkan d_s_id di kelas X
                $nilai = returnRaportPengetahuan($x[0]['d_s_id'], 1, $mapel_total[$i]);
                if($nilai){
                  echo round(hitungNA($nilai['NH'],$nilai['uj_mid1_kog'],$nilai['uj_fin1_kog']));
                  $totalpengx += round(hitungNA($nilai['NH'],$nilai['uj_mid1_kog'],$nilai['uj_fin1_kog']));
                  $totalmapelpengx++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelpengx > 0)
              echo round($totalpengx/$totalmapelpengx);
          ?>
        </td>
      </tr>
      <tr>
        <td>Keterampilan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaX ?>">
            <?php
              if($warnaX == ""){
                //dapatkan d_s_id di kelas X
                $nilai_ket = returnRaportKetrampilan($x[0]['d_s_id'], 1, $mapel_total[$i]);
                if($nilai_ket){
                  echo round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid1_psi'],$nilai_ket['uj_fin1_psi']));
                  $totalketx += round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid1_psi'],$nilai_ket['uj_fin1_psi']));;
                  $totalmapelketx++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelketx > 0)
              echo round($totalketx/$totalmapelketx);
          ?>
        </td>
      </tr>
      <tr>
        <td rowspan="2">2</td>
        <td>Pengetahuan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaX ?>">
            <?php
              if($warnaX == ""){
                //dapatkan d_s_id di kelas X
                $nilai2 = returnRaportPengetahuan($x[0]['d_s_id'], 2, $mapel_total[$i]);
                if($nilai2){
                  echo round(hitungNA($nilai2['NH'],$nilai2['uj_mid2_kog'],$nilai2['uj_fin2_kog']));
                  $totalpengx2 += round(hitungNA($nilai2['NH'],$nilai2['uj_mid2_kog'],$nilai2['uj_fin2_kog']));;
                  $totalmapelpengx2++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelpengx2 > 0)
              echo round($totalpengx2/$totalmapelpengx2);
          ?>
        </td>
      </tr>
      <tr>
        <td>Keterampilan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaX ?>">
            <?php
              if($warnaX == ""){
                //dapatkan d_s_id di kelas X
                $nilai_ket2 = returnRaportKetrampilan($x[0]['d_s_id'], 2, $mapel_total[$i]);
                if($nilai_ket2){
                  echo round(hitungNA($nilai_ket2['NA_ket'],$nilai_ket2['uj_mid1_psi'],$nilai_ket2['uj_fin1_psi']));
                  $totalketx2 += round(hitungNA($nilai_ket2['NA_ket'],$nilai_ket2['uj_mid1_psi'],$nilai_ket2['uj_fin1_psi']));
                  $totalmapelketx2++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelketx2 > 0)
              echo round($totalketx2/$totalmapelketx2);
          ?>
        </td>
      </tr>
      <tr>
        <td rowspan="2">3</td>
        <td>Pengetahuan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaXi ?>">
            <?php
              if($warnaXi == ""){
                //dapatkan d_s_id di kelas XI
                $nilai = returnRaportPengetahuan($xi[0]['d_s_id'], 1, $mapel_total[$i]);
                if($nilai){
                  echo round(hitungNA($nilai['NH'],$nilai['uj_mid1_kog'],$nilai['uj_fin1_kog']));
                  $totalpengxi += round(hitungNA($nilai['NH'],$nilai['uj_mid1_kog'],$nilai['uj_fin1_kog']));
                  $totalmapelpengxi++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelpengxi > 0)
              echo round($totalpengxi/$totalmapelpengxi);
          ?>
        </td>
      </tr>
      <tr>
        <td>Keterampilan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaXi ?>">
            <?php
              if($warnaXi == ""){
                //dapatkan d_s_id di kelas XI
                $nilai_ket = returnRaportKetrampilan($xi[0]['d_s_id'], 1, $mapel_total[$i]);
                if($nilai_ket){
                  echo round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid1_psi'],$nilai_ket['uj_fin1_psi']));
                  $totalketxi += round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid1_psi'],$nilai_ket['uj_fin1_psi']));;
                  $totalmapelketxi++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelketxi > 0)
              echo round($totalketxi/$totalmapelketxi);
          ?>
        </td>
      </tr>
      <tr>
        <td rowspan="2">4</td>
        <td>Pengetahuan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaXi ?>">
            <?php
              if($warnaXi == ""){
                //dapatkan d_s_id di kelas XI
                $nilai = returnRaportPengetahuan($xi[0]['d_s_id'], 2, $mapel_total[$i]);
                if($nilai){
                  echo round(hitungNA($nilai['NH'],$nilai['uj_mid2_kog'],$nilai['uj_fin2_kog']));
                  $totalpengxi2 += round(hitungNA($nilai['NH'],$nilai['uj_mid2_kog'],$nilai['uj_fin2_kog']));
                  $totalmapelpengxi2++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelpengxi2 > 0)
              echo round($totalpengxi2/$totalmapelpengxi2);
          ?>
        </td>
      </tr>
      <tr>
        <td>Keterampilan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaXi ?>">
            <?php
              if($warnaXi == ""){
                //dapatkan d_s_id di kelas XI
                $nilai_ket = returnRaportKetrampilan($xi[0]['d_s_id'], 2, $mapel_total[$i]);
                if($nilai_ket){
                  echo round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid2_psi'],$nilai_ket['uj_fin2_psi']));
                  $totalketxi2 += round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid2_psi'],$nilai_ket['uj_fin2_psi']));;
                  $totalmapelketxi2++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelketxi2 > 0)
              echo round($totalketxi2/$totalmapelketxi2);
          ?>
        </td>
      </tr>
      <tr>
        <td rowspan="2">5</td>
        <td>Pengetahuan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaXii ?>">
            <?php
              if($warnaXii == ""){
                //dapatkan d_s_id di kelas XII
                $nilai = returnRaportPengetahuan($xii[0]['d_s_id'], 1, $mapel_total[$i]);
                if($nilai){
                  echo round(hitungNA($nilai['NH'],$nilai['uj_mid1_kog'],$nilai['uj_fin1_kog']));
                  $totalpengxii += round(hitungNA($nilai['NH'],$nilai['uj_mid1_kog'],$nilai['uj_fin1_kog']));
                  $totalmapelpengxii++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelpengxii > 0)
              echo round($totalpengxii/$totalmapelpengxii);
          ?>
        </td>
      </tr>
      <tr>
        <td>Keterampilan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaXii ?>">
            <?php
              if($warnaXii == ""){
                //dapatkan d_s_id di kelas XII
                $nilai_ket = returnRaportKetrampilan($xii[0]['d_s_id'], 1, $mapel_total[$i]);
                if($nilai_ket){
                  echo round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid1_psi'],$nilai_ket['uj_fin1_psi']));
                  $totalketxii += round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid1_psi'],$nilai_ket['uj_fin1_psi']));;
                  $totalmapelketxii++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelketxii > 0)
              echo round($totalketxii/$totalmapelketxii);
          ?>
        </td>
      </tr>
      <tr>
        <td rowspan="2">6</td>
        <td>Pengetahuan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaXii ?>">
            <?php
              if($warnaXii == ""){
                //dapatkan d_s_id di kelas XII
                $nilai = returnRaportPengetahuan($xii[0]['d_s_id'], 2, $mapel_total[$i]);
                if($nilai){
                  echo round(hitungNA($nilai['NH'],$nilai['uj_mid2_kog'],$nilai['uj_fin2_kog']));
                  $totalpengxii2 += round(hitungNA($nilai['NH'],$nilai['uj_mid2_kog'],$nilai['uj_fin2_kog']));
                  $totalmapelpengxii2++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelpengxii2 > 0)
              echo round($totalpengxii2/$totalmapelpengxii2);
          ?>
        </td>
      </tr>
      <tr>
        <td>Keterampilan</td>
        <?php for ($i=0; $i <count($mapel_total); $i++): ?>
          <td class="<?= $warnaXii ?>">
            <?php
              if($warnaXii == ""){
                //dapatkan d_s_id di kelas XII
                $nilai_ket = returnRaportKetrampilan($xii[0]['d_s_id'], 2, $mapel_total[$i]);
                if($nilai_ket){
                  echo round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid2_psi'],$nilai_ket['uj_fin2_psi']));
                  $totalketxii2 += round(hitungNA($nilai_ket['NA_ket'],$nilai_ket['uj_mid2_psi'],$nilai_ket['uj_fin2_psi']));;
                  $totalmapelketxii2++;
                }else{
                  echo "-";
                }
              }
            ?>
          </td>
        <?php endfor; ?>
        <td>
          <?php
            if($totalmapelketxii2 > 0)
              echo round($totalketxii2/$totalmapelketxii2);
          ?>
        </td>
      </tr>
      <?php
        endforeach;
      ?>
    </tbody>
  </table>
  </div>
  <button type="submit" class="btn btn-success btn-user btn-block" id="export_excel">
      Export ke Excel
  </button>
  <hr>

</div>
