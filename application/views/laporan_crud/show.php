<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4"><u>Laporan Nilai</u></h1>
            </div>


            <?= $this->session->flashdata('message'); ?>



                <?php
                  foreach ($topik as $m) :
                    $nilai = show_laporan($m['topik_id']);
                    echo "<div class='mb-2'><b><u>".$nilai[0]['topik_nama']."</u></b></div>";
                ?>
                  <table class="rapot mb-4">
                    <thead>
                      <th style='width: 50px;'>No Induk</th>
                      <th>Nama</th>
                      <?php
                        for($i=0;$i<$nilai[0]['tes_jum_ph'];$i++){
                          echo "<th>NH".($i+1)."</td>";
                        }
                        for($i=0;$i<$nilai[0]['tes_jum_prak'];$i++){
                          echo "<th>Prak".($i+1)."</td>";
                        }
                        for($i=0;$i<$nilai[0]['tes_jum_prod'];$i++){
                          echo "<th>Prod".($i+1)."</td>";
                        }
                        for($i=0;$i<$nilai[0]['tes_jum_proy'];$i++){
                          echo "<th>Proy".($i+1)."</td>";
                        }
                        for($i=0;$i<$nilai[0]['tes_jum_porto'];$i++){
                          echo "<th>Porto".($i+1)."</td>";
                        }
                      ?>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($nilai as $n) :
                      ?>
                        <tr>
                          <td style='padding: 0px 0px 0px 5px;'><?= $n['sis_no_induk'] ?></td>
                          <td style='padding: 0px 0px 0px 5px;'><?= $n['sis_nama_depan'] ?></td>
                          <?php
                            for($i=0;$i<$n['tes_jum_ph'];$i++){
                              $index_ph = "tes_ph".($i+1);
                              echo "<td style='padding: 0px 0px 0px 5px;'>".$n[$index_ph]."</td>";
                            }
                            for($i=0;$i<$n['tes_jum_prak'];$i++){
                              $index_prak = "tes_prak".($i+1);
                              echo "<td style='padding: 0px 0px 0px 5px;'>".$n[$index_prak]."</td>";
                            }
                            for($i=0;$i<$n['tes_jum_prod'];$i++){
                              $index_prod = "tes_produk".($i+1);
                              echo "<td style='padding: 0px 0px 0px 5px;'>".$n[$index_prod]."</td>";
                            }
                            for($i=0;$i<$n['tes_jum_proy'];$i++){
                              $index_proy = "tes_proyek".($i+1);
                              echo "<td style='padding: 0px 0px 0px 5px;'>".$n[$index_proy]."</td>";
                            }
                            for($i=0;$i<$n['tes_jum_porto'];$i++){
                              $index_porto = "tes_porto".($i+1);
                              echo "<td style='padding: 0px 0px 0px 5px;'>".$n[$index_porto]."</td>";
                            }
                          ?>
                        </tr>
                      <?php
                        endforeach
                      ?>
                    </tbody>
                  </table>
                <?php
                  endforeach
                ?>

                <div class='mb-2'><b><u>PTS dan PAS</u></b></div>
                <table class="rapot">
                  <thead>
                    <tr>
                      <th rowspan="4" style='width: 50px;'>No Induk</th>
                      <th rowspan="4">Nama</th>
                    </tr>
                    <tr>
                      <th colspan="4">Semester Ganjil</th>
                      <th colspan="4">Semester Genap</th>
                    </tr>
                    <tr>
                      <th colspan="2">PTS</th>
                      <th colspan="2">PAS</th>
                      <th colspan="2">PTS</th>
                      <th colspan="2">PAS</th>
                    </tr>
                    <tr>
                      <th>Peng</th>
                      <th>Ket</th>
                      <th>Peng</th>
                      <th>Ket</th>

                      <th>Peng</th>
                      <th>Ket</th>
                      <th>Peng</th>
                      <th>Ket</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($ujian as $z) : ?>
                      <tr>
                        <td style='padding: 0px 0px 0px 5px;'><?= $z['sis_no_induk'] ?></td>
                        <td style='padding: 0px 0px 0px 5px;'><?= $z['sis_nama_depan'] ?></td>

                        <td style='padding: 0px 0px 0px 5px;'><?= $z['uj_mid1_kog'] ?></td>
                        <td style='padding: 0px 0px 0px 5px;'><?= $z['uj_mid1_psi'] ?></td>
                        <td style='padding: 0px 0px 0px 5px;'><?= $z['uj_fin1_kog'] ?></td>
                        <td style='padding: 0px 0px 0px 5px;'><?= $z['uj_fin1_psi'] ?></td>

                        <td style='padding: 0px 0px 0px 5px;'><?= $z['uj_mid2_kog'] ?></td>
                        <td style='padding: 0px 0px 0px 5px;'><?= $z['uj_mid2_psi'] ?></td>
                        <td style='padding: 0px 0px 0px 5px;'><?= $z['uj_fin2_kog'] ?></td>
                        <td style='padding: 0px 0px 0px 5px;'><?= $z['uj_fin2_psi'] ?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
