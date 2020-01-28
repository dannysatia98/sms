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
  <div class="p-2"><?= $this->session->flashdata('message'); ?></div>
  <div id="print_area">

  <?php
  for($i=0;$i<count($sis_arr);$i++) :
    $kelas = return_seluruh_kelas_siswa($sis_arr[$i]);
    foreach ($kelas as $k):
      $mapel = mapel_urutan_by_kelas($k['kelas_id']);
  ?>
    <label style="font-size:12px;"><b><u>Kelas <?= $k['kelas_nama'] ?></u></b></label>
    <table class="table table-hover table-bordered table-sm" style="font-size:11px;">
      <thead>
        <tr>
          <th style="width:80px;">NIS</th>
          <th>Nama</th>
          <th style="width:30px;">Sem</th>
        <?php
          foreach ($mapel as $m):
        ?>
          <th style="width:30px;"><?= $m['mapel_sing'] ?></th>
        <?php
          endforeach;
        ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td rowspan="2" style="vertical-align: middle;"><?= $k['sis_no_induk'] ?></td>
          <td rowspan="2" style="vertical-align: middle;"><?= $k['sis_nama_depan'].' '.$k['sis_nama_bel'] ?></td>
          <td>1</td>
          <?php
            foreach ($mapel as $m):

            $nilai = returnRaportPengetahuan($k['d_s_id'], 1, $m['mapel_id']);
            $ujmid = $nilai['uj_mid1_kog'];
            $ujfin = $nilai['uj_fin1_kog'];
            $nh = $nilai['NH'];
            $naPeng = round(hitungNA($nh,$ujmid,$ujfin));

            $nilai_ket = returnRaportKetrampilan($k['d_s_id'], 1, $m['mapel_id']);
            $ujmidps = $nilai_ket['uj_mid1_psi'];
            $ujfinps = $nilai_ket['uj_fin1_psi'];
            $naKet = round(hitungNA($nilai_ket['NA_ket'],$ujmidps,$ujfinps));

            $rata = round(($naPeng+$naKet)/2);
          ?>
            <td><?= $rata ?></td>
          <?php
            endforeach;
          ?>
        </tr>
        <tr>
          <td>2</td>
          <?php
            foreach ($mapel as $m):
            $nilai2 = returnRaportPengetahuan($k['d_s_id'], 2, $m['mapel_id']);
            $ujmid2 = $nilai2['uj_mid2_kog'];
            $ujfin2 = $nilai2['uj_fin2_kog'];
            $nh2 = $nilai2['NH'];
            $naPeng2 = round(hitungNA($nh2,$ujmid2,$ujfin2));

            $nilai_ket2 = returnRaportKetrampilan($k['d_s_id'], 2, $m['mapel_id']);
            $ujmidps2 = $nilai_ket2['uj_mid2_psi'];
            $ujfinps2 = $nilai_ket2['uj_fin2_psi'];
            $naKet2 = round(hitungNA($nilai_ket2['NA_ket'],$ujmidps2,$ujfinps2));
            $rata2 = round(($naPeng2+$naKet2)/2);
          ?>
            <td><?= $rata2 ?></td>
          <?php
            endforeach;
          ?>
        </tr>
      </tbody>
    </table>
  <?php
    endforeach;
    echo "<hr>";
  endfor;
  ?>

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
