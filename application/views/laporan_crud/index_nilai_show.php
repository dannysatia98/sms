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
.grid-inside {
  display: grid;
  grid-template-columns: 50% 50%;
  grid-column-gap:3px;
}
table.cus{
    border: 0.5px solid black;
}
.cus th{
  border: 0.1px solid black;
  text-align:center;
  padding: 3px;
}
.cus td{
  border: 0.1px solid black;
  text-align:center;
  padding: 3px;
}
</style>

<div class="grid-container">
  <div class="text-center">
    <h1 class="h4 text-gray-900 mb-4 mt-3"><u><?= $title.' '.$tahun['t_nama'] ?></u></h1>
  </div>
  <div class="alert alert-secondary alert-dismissible fade show">
      <button class="close" data-dismiss="alert" type="button">
          <span>&times;</span>
      </button>
      <strong><u>Penjelasan warna dan angka:</u></strong><br>
      <table class="mt-3">
        <tr>
          <td><div style="height: 30px; width: 30px; background-color:#d94a02;"></td>
          <td>&rarr; Tidak ada nilai</td>
        </tr>
        <tr>
          <td><div style="height: 30px; width: 30px; background-color:#f8ff00;"></td>
          <td>&rarr; Ada siswa yang belum mendapat nilai/ ada nilai ganda</td>
        </tr>
        <tr>
          <td style='width: 60px; height: 40px;'><b>Angka</b></td>
          <td>&rarr; Jumlah nilai pada kelas tersebut</td>
        </tr>
      </table>
  </div>
  <?= $this->session->flashdata('message'); ?>

  <?php foreach($kelas_all as $k):
    $mapel_kelas = mapel_urutan_by_kelas($k['kelas_id']);
    $jumlah_siswa = return_jumlah_siswa($k['kelas_id']);
  ?>
    <label><b><u><?= $k['kelas_nama'] ?></u></b> (<?= $jumlah_siswa['jumlah'] ?> Siswa)</label>
      <table class="table table-sm table-bordered" style="font-size:12px;">
        <thead>
          <tr>
            <th>Kategori</th>
            <?php foreach($mapel_kelas as $m):?>
              <th style="width:50px;" colspan="2" class="text-center"><?= $m['mapel_sing'] ?></th>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Semester</th>
            <?php foreach($mapel_kelas as $m):?>
              <th>1</th>
              <th>2</th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td>PTS & PAS</td>
              <?php foreach($mapel_kelas as $m):
                $pts_pas = show_mid_final_count($m['mapel_id'],$k['kelas_id']);
                $warna="";
                if($pts_pas['jumlah']==0)
                  $warna = "background-color:#d94a02;";
                else{
                  if($pts_pas['jumlah'] % $jumlah_siswa['jumlah'] != 0)
                    $warna = "background-color:#e9ed55;";
                  else
                    $warna = "";
                }
              ?>
                <td colspan="2" style="<?= $warna ?>" class="text-center">
                  <?php
                    if($pts_pas['jumlah']!=0)
                      echo $pts_pas['jumlah'];
                  ?>
               </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <td>Harian</td>

              <?php foreach($mapel_kelas as $m):
                $harian_1 = show_harian_count($m['mapel_id'], $k['kelas_id'], 1);
                $harian_2 = show_harian_count($m['mapel_id'], $k['kelas_id'], 2);
              ?>
                <?php
                  $warna2 = "";
                  if($harian_1['jumlah']!=0){
                    if($harian_1['jumlah']% $jumlah_siswa['jumlah'] != 0)
                      $warna2 = "background-color:#e9ed55;";
                  }else{
                    $warna2 = "background-color:#d94a02;";
                  }

                  $warna3 = "";
                  if($harian_2['jumlah']!=0){
                    if($harian_2['jumlah']% $jumlah_siswa['jumlah'] != 0)
                      $warna3 = "background-color:#e9ed55;";
                  }else{
                    $warna3 = "background-color:#d94a02;";
                  }
                ?>
                <!-- Semester 1 -->
                <td style="<?= $warna2 ?>">
                  <?php
                    if($harian_1['jumlah']!=0)
                      echo $harian_1['jumlah'];
                  ?>
                </td>
                <!-- Semester 2 -->
                <td style="<?= $warna3 ?>">
                  <?php
                    if($harian_2['jumlah']!=0)
                      echo $harian_2['jumlah'];
                  ?>
                </td>
              <?php endforeach; ?>
            </tr>
        </tbody>
      </table>
  <?php endforeach; ?>


</div>
