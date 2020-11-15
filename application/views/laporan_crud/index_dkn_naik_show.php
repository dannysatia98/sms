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

<?php
  function cek_null($val){
    if($val)
      return $val;
    else
      return 0;
  }
?>

<div class="grid-container">
  <div class="text-center">
    <label style="display: block; font-size: 14px;"><b><u>DAFTAR KUMPULAN NILAI</u></b></label>
    <label style="display: block; font-size: 12px;">Periode Tahun Ajaran: <?= $t['t_nama'] ?></label>
    <label style="display: block; font-size: 12px;">Kelas <?= $kelas['kelas_nama'] ?></label>
    <label style="display: block; font-size: 12px;">Jumlah Murid: <?php $totalmurid = count($sis_all); echo $totalmurid.' siswa'; ?></label>
  </div>
  <div class="p-2"><?= $this->session->flashdata('message'); ?></div>
  <div id="print_area">
  <table class="table table-hover table-bordered table-sm" style="font-size:11px;">
    <thead>
      <tr>
        <th>NIS</th>
        <th>Nama</th>
        <th>Sem</th>
        <th>Aspek</th>
        <?php foreach ($mapel_all as $m) : ?>
        <th><?= $m['mapel_sing'] ?></th>
        <?php endforeach; ?>
        <th>Jumlah</th>
        <th>Rata</th>
        <th>S</th>
        <th>I</th>
        <th>A</th>
        <th>Rank</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $muridke = 0;
      
      foreach ($sis_all as $s) :

      //untuk nilai sikap akhir
      $nilai_sikap1 = returnRaportSemester1($s['d_s_id'], 1, $s['kelas_id']);
      $nilai_sikap2 = returnRaportSemester1($s['d_s_id'], 2, $s['kelas_id']);

      $total_peng1=0;
      $total_ket1=0;
      $total_peng2=0;
      $total_ket2=0;
      $totalPeng=0;
      $totalKet=0;
      $statusP=0;
      $statusK=0;
      ?>
      <tr>
        <td rowspan="11" style="vertical-align: middle;"><?= $s['sis_no_induk'] ?></td>
        <td rowspan="11" style="vertical-align: middle;"><?= $s['sis_nama_depan'].' '.$s['sis_nama_bel'] ?></td>
        <td rowspan="4">1</td>
        <!-- SEMESTER 1 -->
        <td>S. Sosial</td>
        <?php
          foreach ($mapel_all as $m) :
            $sosaf = returnSosafBySiswa($s['d_s_id'],1,$m['mapel_id']);
            $nil_sosaf = 0;
            if(!$sosaf)
              $nil_sosaf = 3;
            else{
              for ($i=1; $i <=16 ; $i++) {
                $nil_sosaf += $sosaf['sosaf_'.$i];
              }
              $nil_sosaf/=16;
            }
        ?>
        <td><?= return_abjad_sikap($nil_sosaf) ?></td>
        <?php endforeach; ?>
        <td colspan="2"><?= return_abjad_sikap($nilai_sikap1['total_sosial']) ?></td>

        <!-- SAKIT semester 1-->
        <td rowspan="4"></td>
        <!-- IJIN semester 1-->
        <td rowspan="4"></td>
        <!-- ALPHA semester 1-->
        <td rowspan="4"></td>
        <!-- RANKING semester 1-->
        <td rowspan="4" class="murid1ke<?= $muridke ?>"></td>
      </tr>
      <tr>
        <td>S. Spiritual</td>
        <?php
          foreach ($mapel_all as $m) :
            $spraf = returnSprafBySiswa($s['d_s_id'],1,$m['mapel_id']);
            $nil_spraf = 0;
            if(!$spraf)
              $nil_spraf = 3;
            else{
              for ($i=1; $i <=11 ; $i++) {
                $nil_spraf += $spraf['spraf_'.$i];
              }
              $nil_spraf/=11;
            }
        ?>
        <td><?= return_abjad_sikap($nil_spraf) ?></td>
        <?php endforeach; ?>
        <td colspan="2"><?= return_abjad_sikap($nilai_sikap1['total_spirit']) ?></td>
      </tr>

      <tr>
        <td style="width:100px;">Pengetahuan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai = returnRaportPengetahuan($s['d_s_id'], 1, $m['mapel_id']);
          //var_dump($nilai['uj_mid1_kog']);
          if($nilai){
            $ujmid = $nilai['uj_mid1_kog'];
            $ujfin = $nilai['uj_fin1_kog'];
            $nh = $nilai['NH'];
          }else{
            $ujmid = 0;
            $ujfin = 0;
            $nh = 0;
          }
          $naPeng = round(hitungNA($nh,$ujmid,$ujfin));
          $total_peng1 += $naPeng;
        ?>
        <td style="width:40px;"><?= $naPeng ?></td>
        <?php endforeach; ?>
        <!-- total pengetahuan semester 1 -->
        <td><?= $total_peng1 ?></td>
        <td><?= round($total_peng1/count($mapel_all)) ?></td>
      </tr>
      <tr>
        <td>Ketrampilan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai_ket = returnRaportKetrampilan($s['d_s_id'], 1, $m['mapel_id']);
          if($nilai_ket){
            $ujmidps = $nilai_ket['uj_mid1_psi'];
            $ujfinps = $nilai_ket['uj_fin1_psi'];
            $naKet = round(hitungNA($nilai_ket['NA_ket'],$ujmidps,$ujfinps));
          }else{
            $ujmidps = 0;
            $ujfinps = 0;
            $naKet = 0;
          }

          $total_ket1 += $naKet;
        ?>
        <td><?= $naKet ?></td>
        <?php endforeach; ?>
        <!-- total ketrampilan semester 1 -->
        <td><?= $total_ket1 ?></td>
        <td>
          <input type="hidden" class="semester" value="<?= (round($total_peng1/count($mapel_all)) + round($total_ket1/count($mapel_all)))/2 ?>">
          <?= round($total_ket1/count($mapel_all)) ?>
        </td>
      </tr>
      <tr>
        <!-- SEMESTER 2 -->
        <td rowspan="4">2</td>
        <td>S. Spiritual</td>
        <?php
          foreach ($mapel_all as $m) :
            $spraf2 = returnSprafBySiswa($s['d_s_id'],2,$m['mapel_id']);
            $nil_spraf2 = 0;
            if(!$spraf2)
              $nil_spraf2 = 3;
            else{
              for ($i=1; $i <=11 ; $i++) {
                $nil_spraf2 += $spraf2['spraf_'.$i];
              }
              $nil_spraf2/=11;
            }
        ?>
        <td><?= return_abjad_sikap($nil_spraf2) ?></td>
        <?php endforeach; ?>
        <td colspan="2"><?= return_abjad_sikap($nilai_sikap2['total_spirit']) ?></td>

        <!-- SAKIT semester 2-->
        <td rowspan="4"></td>
        <!-- IJIN semester 2-->
        <td rowspan="4"></td>
        <!-- ALPHA semester 2-->
        <td rowspan="4"></td>
        <!-- RANKING semester 2-->
        <td rowspan="4" class="murid2ke<?= $muridke ?>"></td>
      </tr>
      <tr>
        <td>S. Sosial</td>
        <?php
          foreach ($mapel_all as $m) :
            $sosaf2 = returnSosafBySiswa($s['d_s_id'],2,$m['mapel_id']);
            $nil_sosaf2 = 0;
            if(!$sosaf2)
              $nil_sosaf2 = 3;
            else{
              for ($i=1; $i <=16 ; $i++) {
                $nil_sosaf2 += $sosaf2['sosaf_'.$i];
              }
              $nil_sosaf2/=16;
            }
        ?>
        <td><?= return_abjad_sikap($nil_sosaf2) ?></td>
        <?php endforeach; ?>
        <td colspan="2"><?= return_abjad_sikap($nilai_sikap2['total_sosial']) ?></td>
      </tr>
      <tr>
        <td>Pengetahuan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai2 = returnRaportPengetahuan($s['d_s_id'], 2, $m['mapel_id']);
          if($nilai2){
            $ujmid2 = $nilai2['uj_mid2_kog'];
            $ujfin2 = $nilai2['uj_fin2_kog'];
            $nh2 = $nilai2['NH'];
          }else{
            $ujmid2 = 0;
            $ujfin2 = 0;
            $nh2 = 0;
          }
          $naPeng2 = round(hitungNA($nh2,$ujmid2,$ujfin2));
          $total_peng2 += $naPeng2;
        ?>
        <td><?= $naPeng2 ?></td>
        <?php endforeach; ?>
        <!-- total pengetahuan semester 2 -->
        <td><?= $total_peng2 ?></td>
        <td><?= round($total_peng2/count($mapel_all)) ?></td>
      </tr>
      <tr>
        <td>Ketrampilan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai_ket2 = returnRaportKetrampilan($s['d_s_id'], 2, $m['mapel_id']);
          if($nilai_ket2){
            $ujmidps2 = $nilai_ket2['uj_mid2_psi'];
            $ujfinps2 = $nilai_ket2['uj_fin2_psi'];
            $naKet2 = round(hitungNA($nilai_ket2['NA_ket'],$ujmidps2,$ujfinps2));
          }else{
            $ujmidps2 = 0;
            $ujfinps2 = 0;
            $naKet2 = 0;
          }
          $total_ket2 += $naKet2;
        ?>
        <td><?= $naKet2 ?></td>
        <?php endforeach; ?>
        <!-- total ketrampilan semester 2 -->
        <td><?= $total_ket2 ?></td>
        <td>
          <input type="hidden" class="semester2" value="<?= (round($total_peng2/count($mapel_all)) + round($total_ket2/count($mapel_all)))/2 ?>">
          <?= round($total_ket2/count($mapel_all)) ?>
        </td>
      </tr>

      <tr>
        <!-- Rata-rata P -->
        <td colspan="2">Rata-rata Pengetahuan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai = returnRaportPengetahuan($s['d_s_id'], 1, $m['mapel_id']);
          //var_dump($nilai['uj_mid1_kog']);
          if($nilai){
            $ujmid = $nilai['uj_mid1_kog'];
            $ujfin = $nilai['uj_fin1_kog'];
            $nh = $nilai['NH'];
          }else{
            $ujmid = 0;
            $ujfin = 0;
            $nh = 0;
          }
          $naPeng = round(hitungNA($nh,$ujmid,$ujfin));

          $nilai2 = returnRaportPengetahuan($s['d_s_id'], 2, $m['mapel_id']);
          if($nilai2){
            $ujmid2 = $nilai2['uj_mid2_kog'];
            $ujfin2 = $nilai2['uj_fin2_kog'];
            $nh2 = $nilai2['NH'];
          }else{
            $ujmid2 = 0;
            $ujfin2 = 0;
            $nh2 = 0;
          }
          $naPeng2 = round(hitungNA($nh2,$ujmid2,$ujfin2));

          $rataPeng = round(($naPeng+$naPeng2)/2);  
          if($rataPeng<75){
            $statusP += 1;
          }else{

          }
          $totalPeng += $rataPeng;
        ?>
        <td><?= $rataPeng ?></td>
        <?php endforeach; ?>
        <!-- rata-rata pengetahuan -->
        <td>Rata2</td>
        <td><?= round($totalPeng/count($mapel_all)) ?></td>
      </tr>
      <!-- Rata-rata K -->
      <tr>
        <td colspan="2">Rata-rata Keterampilan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai_ket = returnRaportKetrampilan($s['d_s_id'], 1, $m['mapel_id']);
          if($nilai_ket){
            $ujmidps = $nilai_ket['uj_mid1_psi'];
            $ujfinps = $nilai_ket['uj_fin1_psi'];
            $naKet = round(hitungNA($nilai_ket['NA_ket'],$ujmidps,$ujfinps));
          }else{
            $ujmidps = 0;
            $ujfinps = 0;
            $naKet = 0;
          }

          $nilai_ket2 = returnRaportKetrampilan($s['d_s_id'], 2, $m['mapel_id']);
          if($nilai_ket2){
            $ujmidps2 = $nilai_ket2['uj_mid2_psi'];
            $ujfinps2 = $nilai_ket2['uj_fin2_psi'];
            $naKet2 = round(hitungNA($nilai_ket2['NA_ket'],$ujmidps2,$ujfinps2));
          }else{
            $ujmidps2 = 0;
            $ujfinps2 = 0;
            $naKet2 = 0;
          }
          $rataKet = round(($naKet+$naKet2)/2);
          if($rataKet<75){
            $statusK += 1;
          }else{

          }
          $totalKet += $rataKet;
        ?>
        <td><?= $rataKet ?></td>
        <?php endforeach; ?>
        <!-- rata-rata keterampilan-->
        <td>Rata2</td>
        <td>
          <?= round($totalKet/count($mapel_all)) ?>
        </td>
      </tr>
      <!-- Status Kurang -->
      <tr>
        <td colspan="2">Status Kurang</td>
        <!-- total status kurang -->
        <td><?php if($statusP>=$statusK){ echo $statusP.' K';}
                  else{ echo $statusK.' K';}?></td>
      </tr>
      <?php $muridke++; endforeach; ?>
    </tbody>
  </table>
  </div>
  <button type="submit" class="btn btn-success btn-user btn-block" id="export_excel">
      Export Ke Excel
  </button>
  <hr>

</div>


<script type="text/javascript">

  $(document).ready(function() {
    function sortNumber(a, b) {
      return b - a;
    }

    // SEMESTER 1
    var nilai_arr = [];
    $(".semester").each(function() {
      nilai_arr.push($(this).val());
    });

    nilai_arr.sort(sortNumber);
    var i=0;
    $(".semester").each(function() {
      var rank = nilai_arr.indexOf($(this).val());
      $('.murid1ke'+i).html(rank+1);
      i+=1;
    });

    //SEMESTER 2
    var nilai_arr2 = [];
    $(".semester2").each(function() {
      nilai_arr2.push($(this).val());
    });

    nilai_arr2.sort(sortNumber);
    var j=0;
    $(".semester2").each(function() {
      var rank2 = nilai_arr2.indexOf($(this).val());
      $('.murid2ke'+j).html(rank2+1);
      j+=1;
    });

  });

</script>
