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
    <label style="display: block; font-size: 14px;"><b><u>DAFTAR KUMPULAN NILAI</u></b></label>
    <label style="display: block; font-size: 12px;">Periode Tahun Ajaran: <?= $t['t_nama'] ?></label>
    <label style="display: block; font-size: 12px;">Kelas <?= $kelas['kelas_nama'] ?></label>
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
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($sis_all as $s) :
      $total_peng1=0;
      $total_ket1=0;
      $total_peng2=0;
      $total_ket2=0;
      ?>
      <tr>
        <td rowspan="4" style="vertical-align: middle;"><?= $s['sis_no_induk'] ?></td>
        <td rowspan="4" style="vertical-align: middle;"><?= $s['sis_nama_depan'].' '.$s['sis_nama_bel'] ?></td>
        <td rowspan="2">1</td>
        <!-- SEMESTER 1 -->
        <td style="width:100px;">Pengetahuan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai = returnRaportPengetahuan($s['d_s_id'], 1, $m['mapel_id']);
          $ujmid = $nilai['uj_mid1_kog'];
          $ujfin = $nilai['uj_fin1_kog'];
          $nh = $nilai['NH'];
          $naPeng = round(hitungNA($nh,$ujmid,$ujfin));
          $total_peng1 += $naPeng;
        ?>
        <td style="width:40px;"><?= $naPeng ?></td>
        <?php endforeach; ?>
        <!-- total pengetahuan semester 1 -->
        <td><?= $total_peng1 ?></td>
        <td><?= round($total_peng1/count($mapel_all)) ?></td>
        <td rowspan="2"></td>
        <td rowspan="2"></td>
        <td rowspan="2"></td>
      </tr>
      <tr>
        <td>Ketrampilan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai_ket = returnRaportKetrampilan($s['d_s_id'], 1, $m['mapel_id']);
          $ujmidps = $nilai_ket['uj_mid1_psi'];
          $ujfinps = $nilai_ket['uj_fin1_psi'];
          $naKet = round(hitungNA($nilai_ket['NA_ket'],$ujmidps,$ujfinps));
          $total_ket1 += $naKet;
        ?>
        <td><?= $naKet ?></td>
        <?php endforeach; ?>
        <!-- total ketrampilan semester 1 -->
        <td><?= $total_ket1 ?></td>
        <td><?= round($total_ket1/count($mapel_all)) ?></td>
      </tr>
      <tr>
        <!-- SEMESTER 2 -->
        <td rowspan="2">2</td>
        <td>Pengetahuan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai2 = returnRaportPengetahuan($s['d_s_id'], 2, $m['mapel_id']);
          $ujmid2 = $nilai2['uj_mid2_kog'];
          $ujfin2 = $nilai2['uj_fin2_kog'];
          $nh2 = $nilai2['NH'];
          $naPeng2 = round(hitungNA($nh2,$ujmid2,$ujfin2));
          $total_peng2 += $naPeng2;
        ?>
        <td><?= $naPeng2 ?></td>
        <?php endforeach; ?>
        <!-- total pengetahuan semester 2 -->
        <td><?= $total_peng2 ?></td>
        <td><?= round($total_peng2/count($mapel_all)) ?></td>
        <td rowspan="2"></td>
        <td rowspan="2"></td>
        <td rowspan="2"></td>
      </tr>
      <tr>
        <td>Ketrampilan</td>
        <?php foreach ($mapel_all as $m) :
          $nilai_ket2 = returnRaportKetrampilan($s['d_s_id'], 2, $m['mapel_id']);
          $ujmidps2 = $nilai_ket2['uj_mid2_psi'];
          $ujfinps2 = $nilai_ket2['uj_fin2_psi'];
          $naKet2 = round(hitungNA($nilai_ket2['NA_ket'],$ujmidps2,$ujfinps2));
          $total_ket2 += $naKet2;
        ?>
        <td><?= $naKet2 ?></td>
        <?php endforeach; ?>
        <!-- total ketrampilan semester 2 -->
        <td><?= $total_ket2 ?></td>
        <td><?= round($total_ket2/count($mapel_all)) ?></td>
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
