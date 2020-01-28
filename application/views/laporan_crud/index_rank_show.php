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
    <h1 class="h4 text-gray-900">Ranking Pararel Semester <?= $semester ?></h1>
  </div>
  <div class="p-2"><?= $this->session->flashdata('message'); ?></div>
  <div id="print_area">
  <table class="table table-hover table-bordered table-sm" style="font-size:11px;">
    <thead>
      <tr>
        <th rowspan="2">NIS</th>
        <th rowspan="2">Nama</th>
        <th rowspan="2">Kelas</th>
        <?php foreach ($mapel_all as $m) : ?>
        <th colspan="3"><?= $m['mapel_sing'] ?></th>
        <?php endforeach; ?>
        <th rowspan="2">TOT</th>
        <th rowspan="2">RATA</th>
        <th rowspan="2">RANK</th>
      </tr>
      <tr>
        <?php foreach ($mapel_all as $m) : ?>
        <th>P</th>
        <th>K</th>
        <th>R</th>
        <?php endforeach; ?>
      </tr>
      <tr>

      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($sis_all as $s) :
      $total_rata=0;
      ?>
      <tr>
        <td style="vertical-align: middle;"><?= $s['sis_no_induk'] ?></td>
        <td style="vertical-align: middle;"><?= $s['sis_nama_depan'].' '.$s['sis_nama_bel'] ?></td>
        <td style="vertical-align: middle;"><?= $s['kelas_nama'] ?></td>
        <?php foreach ($mapel_all as $m) :
          if($semester == 1){
            //pengetahuan semester 1
            $nilai = returnRaportPengetahuan($s['d_s_id'], 1, $m['mapel_id']);
            $ujmid = $nilai['uj_mid1_kog'];
            $ujfin = $nilai['uj_fin1_kog'];
            $nh = $nilai['NH'];
            $naPeng = round(hitungNA($nh,$ujmid,$ujfin));
            //ketrampilan semester 1
            $nilai_ket = returnRaportKetrampilan($s['d_s_id'], 1, $m['mapel_id']);
            $ujmidps = $nilai_ket['uj_mid1_psi'];
            $ujfinps = $nilai_ket['uj_fin1_psi'];
            $naKet = round(hitungNA($nilai_ket['NA_ket'],$ujmidps,$ujfinps));
          }
          elseif ($semester == 2) {
            //pengetahuan semester 1
            $nilai = returnRaportPengetahuan($s['d_s_id'], 2, $m['mapel_id']);
            $ujmid = $nilai['uj_mid2_kog'];
            $ujfin = $nilai['uj_fin2_kog'];
            $nh = $nilai['NH'];
            $naPeng = round(hitungNA($nh,$ujmid,$ujfin));
            //ketrampilan semester 1
            $nilai_ket = returnRaportKetrampilan($s['d_s_id'], 2, $m['mapel_id']);
            $ujmidps = $nilai_ket['uj_mid2_psi'];
            $ujfinps = $nilai_ket['uj_fin2_psi'];
            $naKet = round(hitungNA($nilai_ket['NA_ket'],$ujmidps,$ujfinps));
          }

          $rata = round(($naPeng + $naKet)/2);
          $total_rata += $rata;
        ?>
          <td><?= $naPeng ?></td>
          <td><?= $naKet ?></td>
          <td><?= $rata ?></td>
        <?php endforeach; ?>
        <!-- TOTAL -->
        <td><?= $total_rata; ?></td>
        <td><?= round($total_rata/count($mapel_all)); ?></td>
        <td><div class="semester" rel="<?= $total_rata ?>"></div></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <button type="submit" class="btn btn-success btn-user btn-block" id="export_excel">
      Export To Excel
  </button>
  <hr>

</div>


<script type="text/javascript">

  $(document).ready(function() {
    function sortNumber(a, b) {
      return b - a;
    }

    var nilai_arr = [];
    $(".semester").each(function() {
      nilai_arr.push($(this).attr('rel'));
    });
    //console.log(nilai_arr);

    var nilai_arr_urut;
    nilai_arr_urut = nilai_arr.sort(sortNumber);
    //console.log(nilai_arr_urut);

    $(".semester").each(function() {
      var rank = nilai_arr.indexOf($(this).attr('rel'));
      $(this).html(rank+1);
      //console.log(rank);
    });


  });

</script>
