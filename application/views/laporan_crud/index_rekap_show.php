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
    <label style="display: block; font-size: 14px;"><b><u><?= $title ?></u></b></label>
    <label style="display: block; font-size: 12px;">Periode Tahun Ajaran: <?= $t['t_nama'] ?></label>
  </div>
  <div class="p-2"><?= $this->session->flashdata('message'); ?></div>
  <div id="print_area">

  <?php
    $style = "";
    $nama_kelas = array();
    $persen_peng = array();
    $persen_ket = array();
    if($detail_tampil == 0)
      $style = "display:none;";

    $kkm = 0;
    foreach ($d_all as $d) :
    $kkm = $d['mapel_kkm'];
    $siswa_all = return_siswa_kelas($d['kelas_id']);
    $topik_all = return_topik_mapel($d['d_mpl_mapel_id'], $d['kelas_jenj_id'],$sem);
  ?>
    <h5 style="<?= $style ?>"><?= $d['kelas_nama'].' ('.$d['mapel_nama'].' KKM: '.$kkm.')' ?></h5>
    <?php $nama_kelas[] = $d['kelas_nama']; ?>
    <table class="table table-hover table-bordered table-sm rapot" style="font-size:11px;<?= $style ?>">
      <thead>
        <tr>
          <th rowspan="2"></th>
          <?php $hitungcol = 3;
            foreach ($topik_all as $t){
              $hitungcol++;
            }; 
          ?>
          <th colspan="<?php echo $hitungcol;?>">PENGETAHUAN</th>
          <th colspan="<?php echo $hitungcol;?>">KETERAMPILAN</th>
          <th rowspan="2">S. Spi</th>
          <th rowspan="2">S. Sos</th>
        </tr>
        <tr>          
          <?php foreach ($topik_all as $t) : ?>
            <th colspan="1"><a href="#" data-toggle="tooltip" data-placement="top" title="<?= $t['topik_nama'] ?>"><?= substr($t['topik_nama'], 0, 3) ?></a></th>
          <?php endforeach; ?>
          <th>PTS</th>
          <th>PAS</th>
          <th>NR</th>
          <?php foreach ($topik_all as $t) : ?>
            <th colspan="1"><a href="#" data-toggle="tooltip" data-placement="top" title="<?= $t['topik_nama_ket'] ?>"><?= substr($t['topik_nama_ket'], 0, 3) ?></a></th>
          <?php endforeach; ?>
          <th>PTS</th>
          <th>PAS</th>
          <th>NR</th>
        </tr>
        <tr>
          <!-- <?php foreach ($topik_all as $t) : ?>
            <th>PENGETAHUAN</th>
            <th>KETERAMPILAN</th>
          <?php endforeach; ?> -->
          
          
        </tr>
      </thead>
      <tbody>
        <?php
          $tidak_tuntas = 0;
          $tidak_tuntas_ket = 0;
          $jumlah_murid = 0;
          foreach ($siswa_all as $s) :
            $jumlah_murid++;

            //untuk nilai sikap akhir
            $nilai_sikap1 = returnRaportSemester1($s['d_s_id'], 1, $s['kelas_id']);
            $nilai_sikap2 = returnRaportSemester1($s['d_s_id'], 2, $s['kelas_id']);
        ?>

          <tr>
            <td style="width:15%;"><?= $s['sis_nama_depan'].' '.$s['sis_nama_bel'] ?></td>
            <?php
              foreach ($topik_all as $t) :
              //cari tes
              $tes = return_tes_by_d_s_id_topik($s['d_s_id'], $t['topik_id']);

              if($tes):
            ?>
              <!-- PENGETAHUAN -->
              <td>
                <table style="width: 100%;">
                  <tr>
                    <?php
                      if($tes['tes_jum_ph']!=0){
                        $lebar = 100/$tes['tes_jum_ph'];
                      }else{
                        $lebar = 100;
                      }

                      //ulang sebanyak jumlah pengetahuan
                      for($i=1;$i<=$tes['tes_jum_ph'];$i++):
                    ?>
                      <td style="width: <?= $lebar ?>%; height:20px;"><?= $tes['tes_ph'.$i] ?></td>
                    <?php endfor; ?>
                  </tr>
                </table>
              </td>
              
            <?php else: ?>
              <!-- Kalau nilai harian di KD nya belum diisi -->
              <td>
                <table style="width: 100%;">
                  <tr>
                      <td style="width: 100%; height:20px;">-</td>
                  </tr>
                </table>
              </td>
            <?php
              endif;
              endforeach;
            ?>

            <?php
              $uj = return_uj_by_d_s_id($s['d_s_id'], $d['d_mpl_mapel_id']);
              $NH = returnNHPengMapel($s['d_s_id'], $sem, $d['d_mpl_mapel_id']);
              $NH_ket = returnNHKetMapel($s['d_s_id'], $sem, $d['d_mpl_mapel_id']);
              if($sem == 1):
            ?>
              <!-- PTS PENGETAHUAN-->
              <td>
                <?php
                  if(isset($uj['uj_mid1_kog'])){
                    if($uj['uj_mid1_kog']==0){
                      echo '-';
                    }else if($uj['uj_mid1_kog']==-1){
                      echo '0';
                    }else{
                      echo $uj['uj_mid1_kog'];
                    }
                  }
                  else{
                    echo "-";
                  }
                ?>
              </td>
              <!-- PAS PENGETAHUAN-->
              <td>
                <?php
                  if(isset($uj['uj_fin1_kog'])){
                    if($uj['uj_fin1_kog']==0){
                      echo '-';
                    }else if($uj['uj_fin1_kog']==-1){
                      echo '0';
                    }else{
                      echo $uj['uj_fin1_kog'];
                    }
                  }
                  else{
                    echo "-";
                  }
                ?>
              </td>
              <!-- NR PENGETAHUAN-->
              <td>
                <?php
                  if($NH){
                    if(round(hitungNA($NH['NH'],isset($uj['uj_mid1_kog']),isset($uj['uj_fin1_kog']))) < $kkm){
                      $tidak_tuntas++;
                    }
                    echo round(hitungNA($NH['NH'],isset($uj['uj_mid1_kog']),isset($uj['uj_fin1_kog'])));
                  }else{
                    $tidak_tuntas++;
                    echo "-";
                  }
                ?>
              </td>

              
              <?php
                foreach ($topik_all as $t) :
                //cari tes
                $tes = return_tes_by_d_s_id_topik($s['d_s_id'], $t['topik_id']);

                if($tes):
              ?>
                <!-- KETERAMPILAN -->
                <td>
                  <table style="width: 100%;">
                    <tr>
                      <?php
                        $pembagi = $tes['tes_jum_prak'] + $tes['tes_jum_prod'] + $tes['tes_jum_proy'] + $tes['tes_jum_porto'];

                        if($pembagi!=0)
                          $lebar2 = 100/($tes['tes_jum_prak'] + $tes['tes_jum_prod'] + $tes['tes_jum_proy'] + $tes['tes_jum_porto']);
                        else
                          $lebar = 100;
                      ?>
                      <?php $hit_0 = 0;?>

                      <?php for($i=1;$i<=$tes['tes_jum_prak'];$i++): ?>
                        <?php if($tes['tes_prak'.$i] == 0):?>
                          <?php $hit_0++; ?>
                        <?php else: ?>
                          <td style="width: <?= $lebar2 ?>%; height:20px;"><?= $tes['tes_prak'.$i] ?></td>
                        <?php endif;  ?>
                      <?php endfor; ?>

                      <?php for($i=1;$i<=$tes['tes_jum_prod'];$i++): ?>
                        <?php if($tes['tes_produk'.$i] == 0):?>
                          <?php $hit_0++; ?>
                        <?php else: ?>
                          <td style="width: <?= $lebar2 ?>%; height:20px;"><?= $tes['tes_produk'.$i] ?></td>
                        <?php endif; ?>
                      <?php endfor; ?>

                      <?php for($i=1;$i<=$tes['tes_jum_proy'];$i++): ?>
                        <?php if($tes['tes_proyek'.$i] == 0):?>
                          <?php $hit_0++; ?>
                        <?php else: ?>
                          <td style="width: <?= $lebar2 ?>%; height:20px;"><?= $tes['tes_proyek'.$i] ?></td>
                        <?php endif; ?>
                      <?php endfor; ?>

                      <?php for($i=1;$i<=$tes['tes_jum_porto'];$i++): ?>
                        <?php if($tes['tes_porto'.$i] == 0):?>
                          <?php $hit_0++; ?>
                        <?php else: ?>
                          <td style="width: <?= $lebar2 ?>%; height:20px;"><?= $tes['tes_porto'.$i] ?></td>
                        <?php endif; ?>
                      <?php endfor; ?>

                      <?php if($hit_0 >=4):?>
                        <td style="width: 100%; height:20px;">-</td>
                      <?php endif; ?>
                    </tr>
                  </table>
                </td>
                
              <?php else: ?>
                <!-- Kalau nilai harian di KD nya belum diisi -->
                <td>
                  <table style="width: 100%;">
                    <tr>
                        <td style="width: 100%; height:20px;">-</td>
                    </tr>
                  </table>
                </td>
              <?php
                endif;
                endforeach;
              ?>


              <!-- PTS KETERAMPILAN-->
              <td>
                <?php
                  if(isset($uj['uj_mid1_psi'])){
                    if($uj['uj_mid1_psi']==0){
                      echo '-';
                    }else if($uj['uj_mid1_psi']==-1){
                      echo '0';
                    }else{
                      echo $uj['uj_mid1_psi'];
                    }
                  }
                  else{
                    echo "-";
                  }
                ?>
              </td>
              <!-- PAS KETERAMPILAN-->
              <td>
                <?php
                  if(isset($uj['uj_fin1_psi'])){
                    if($uj['uj_fin1_psi']==0){
                      echo '-';
                    }else if($uj['uj_fin1_psi']==-1){
                      echo '0';
                    }else{
                      echo $uj['uj_fin1_psi'];
                    }
                  }
                  else{
                    echo "-";
                  }
                ?>
              </td>
              <!-- NR KETERAMPILAN-->
              <td>
                <?php
                  if($NH_ket){
                    if(round(hitungNA($NH_ket['NA_ket'],isset($uj['uj_mid1_psi']),isset($uj['uj_fin1_psi']))) < $kkm){
                      $tidak_tuntas_ket++;
                    }
                    echo round(hitungNA($NH_ket['NA_ket'],isset($uj['uj_mid1_psi']),isset($uj['uj_fin1_psi'])));
                  }else{
                    $tidak_tuntas_ket++;
                    echo "-";
                  }
                ?>
              </td>

              <td><?= return_singkat_sikap($nilai_sikap1['total_sosial']) ?></td>
              <td><?= return_singkat_sikap($nilai_sikap1['total_spirit']) ?></td>

            <?php
              elseif($sem == 2):
            ?>
              <!-- PTS PENGETAHUAN-->
              <td>
                <?php
                  if(isset($uj['uj_mid2_kog'])){
                    if($uj['uj_mid2_kog']==0){
                      echo '-';
                    }else if($uj['uj_mid2_kog']==-1){
                      echo '0';
                    }else{
                      echo $uj['uj_mid2_kog'];
                    }
                  }
                  else{
                    echo "-";
                  }
                ?>
              </td>
              <!-- PAS PENGETAHUAN-->
              <td>
                <?php
                  if(isset($uj['uj_fin2_kog'])){
                    if($uj['uj_fin2_kog']==0){
                      echo '-';
                    }else if($uj['uj_fin2_kog']==-1){
                      echo '0';
                    }else{
                      echo $uj['uj_fin2_kog'];
                    }
                  }
                  else{
                    echo "-";
                  }
                ?>
              </td>
              <!-- NR PENGETAHUAN-->
              <td>
                <?php
                  if($NH){
                    if(round(hitungNA($NH['NH'],isset($uj['uj_mid2_kog']),isset($uj['uj_fin2_kog']))) < $kkm){
                      $tidak_tuntas++;
                    }
                    echo round(hitungNA($NH['NH'],isset($uj['uj_mid2_kog']),isset($uj['uj_fin2_kog'])));
                  }else{
                    $tidak_tuntas++;
                    echo "-";
                  }
                ?>
              </td>

              

              <?php
                foreach ($topik_all as $t) :
                //cari tes
                $tes = return_tes_by_d_s_id_topik($s['d_s_id'], $t['topik_id']);

                if($tes):
              ?>
                <!-- KETERAMPILAN -->
                <td>
                  <table style="width: 100%;">
                    <tr>
                      <?php
                        $pembagi = $tes['tes_jum_prak'] + $tes['tes_jum_prod'] + $tes['tes_jum_proy'] + $tes['tes_jum_porto'];

                        if($pembagi!=0)
                          $lebar2 = 100/($tes['tes_jum_prak'] + $tes['tes_jum_prod'] + $tes['tes_jum_proy'] + $tes['tes_jum_porto']);
                        else
                          $lebar = 100;
                      ?>
                      <?php $hit_0 = 0;?>

                      <?php for($i=1;$i<=$tes['tes_jum_prak'];$i++): ?>
                        <?php if($tes['tes_prak'.$i] == 0):?>
                          <?php $hit_0++; ?>
                        <?php else: ?>
                          <td style="width: <?= $lebar2 ?>%; height:20px;"><?= $tes['tes_prak'.$i] ?></td>
                        <?php endif;  ?>
                      <?php endfor; ?>

                      <?php for($i=1;$i<=$tes['tes_jum_prod'];$i++): ?>
                        <?php if($tes['tes_produk'.$i] == 0):?>
                          <?php $hit_0++; ?>
                        <?php else: ?>
                          <td style="width: <?= $lebar2 ?>%; height:20px;"><?= $tes['tes_produk'.$i] ?></td>
                        <?php endif; ?>
                      <?php endfor; ?>

                      <?php for($i=1;$i<=$tes['tes_jum_proy'];$i++): ?>
                        <?php if($tes['tes_proyek'.$i] == 0):?>
                          <?php $hit_0++; ?>
                        <?php else: ?>
                          <td style="width: <?= $lebar2 ?>%; height:20px;"><?= $tes['tes_proyek'.$i] ?></td>
                        <?php endif; ?>
                      <?php endfor; ?>

                      <?php for($i=1;$i<=$tes['tes_jum_porto'];$i++): ?>
                        <?php if($tes['tes_porto'.$i] == 0):?>
                          <?php $hit_0++; ?>
                        <?php else: ?>
                          <td style="width: <?= $lebar2 ?>%; height:20px;"><?= $tes['tes_porto'.$i] ?></td>
                        <?php endif; ?>
                      <?php endfor; ?>

                      <?php if($hit_0 >=4):?>
                        <td style="width: 100%; height:20px;">-</td>
                      <?php endif; ?>
                    </tr>
                  </table>
                </td>
                
              <?php else: ?>
                <!-- Kalau nilai harian di KD nya belum diisi -->
                <td>
                  <table style="width: 100%;">
                    <tr>
                        <td style="width: 100%; height:20px;">-</td>
                    </tr>
                  </table>
                </td>
              <?php
                endif;
                endforeach;
              ?>

              <!-- PTS KETERAMPILAN-->
              <td>
                <?php
                  if(isset($uj['uj_mid2_psi']))
                    if($uj['uj_mid2_psi']==0){
                      echo '-';
                    }else if($uj['uj_mid2_psi']==-1){
                      echo '0';
                    }else{
                      echo $uj['uj_mid2_psi'];
                    }
                  else
                    echo "-";
                ?>
              </td>
              <!-- PAS KETERAMPILAN-->
              <td>
                <?php
                  if(isset($uj['uj_fin2_psi']))
                    if($uj['uj_fin2_psi']==0){
                      echo '-';
                    }else if($uj['uj_fin2_psi']==-1){
                      echo '0';
                    }else{
                      echo $uj['uj_fin2_psi'];
                    }
                  else
                    echo "-";
                ?>
              </td>
              <!-- NR KETERAMPILAN-->
              <td>
                <?php
                  if($NH_ket){
                    if(round(hitungNA($NH_ket['NA_ket'],isset($uj['uj_mid2_psi']),isset($uj['uj_fin2_psi']))) < $kkm){
                      $tidak_tuntas_ket++;
                    }
                    echo round(hitungNA($NH_ket['NA_ket'],isset($uj['uj_mid2_psi']),isset($uj['uj_fin2_psi'])));
                  }else{
                    $tidak_tuntas_ket++;
                    echo "-";
                  }
                ?>
              </td>

              <td><?= return_singkat_sikap($nilai_sikap2['total_sosial']) ?></td>
              <td><?= return_singkat_sikap($nilai_sikap2['total_spirit']) ?></td>

            <?php endif; ?>

          </tr>
        <?php endforeach; ?>
        <tr>
          <td><b>% Ketuntasan Pengetahuan</b></td>
          <td><?= round((($jumlah_murid - $tidak_tuntas)/$jumlah_murid)*100); ?>%</td>

          <?php
            $persen_peng[] = round((($jumlah_murid - $tidak_tuntas)/$jumlah_murid)*100);
          ?>
        </tr>
        <tr>
          <td><b>% Ketuntasan Keterampilan</b></td>
          <td><?= round((($jumlah_murid - $tidak_tuntas_ket)/$jumlah_murid)*100); ?>%</td>

          <?php
            $persen_ket[] = round((($jumlah_murid - $tidak_tuntas_ket)/$jumlah_murid)*100);
          ?>
        </tr>
      </tbody>
    </table>
  <?php endforeach; ?>

  <?php if($detail_tampil == 0): ?>

    <h5><u><?= $m_nama['mapel_nama'] ?></u></h5>

    <table class="table table-sm table-bordered" style="font-size:13px;">
      <thead>
        <tr>
          <th>Kelas</th>
          <th>% Ketuntasan Pengetahuan</th>
          <th>% Ketuntasan Keterampilan</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($nama_kelas);$i++): ?>
        <tr>
          <td><?= $nama_kelas[$i] ?></td>
          <td><?= $persen_peng[$i] ?></td>
          <td><?= $persen_ket[$i] ?></td>
        </tr>
        <?php endfor; ?>
      </tbody>
    </table>
  <?php endif; ?>

  </div>
  <button type="submit" class="btn btn-success btn-user btn-block" id="export_excel">
      Export Ke Excel
  </button>

  <hr>
  <input type="button" name="print_rekap" id="print_rekap" class="btn btn-success" value="Print">

</div>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
