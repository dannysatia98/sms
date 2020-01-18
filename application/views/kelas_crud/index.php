<style>
.grid-container {
  display: grid;
  grid-template-columns: 25% 25% 25% 25%;
  /* background-color: #2196F3; */
}
</style>

<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Daftar Kelas</h1>
            </div>


            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url('kelas_crud/add') ?>" class="btn btn-primary mb-3">Tambah Kelas</a>

            <table class="table table-sm display compact table-hover dt" style="font-size:13px;">
              <thead>
                <tr>
                  <th style="width: 15%">Nama</th>
                  <th>Singkatan</th>
                  <th>Program</th>
                  <th>Jenjang</th>
                  <th>&Sigma; Siswa</th>
                  <th>&Sigma; Mapel</th>
                  <th>Wali Kelas</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $t_nama_temp = "";
                  foreach ($kelas_all as $m) :
                ?>
                  <?php
                    if($t_nama_temp != $m['t_nama']){
                      $tahun_fix = "<tr class='bg-dark text-light'>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td class='text-center'><b>".$m['t_nama']."</b></td>
                                      <td></td>
                                      <td></td>
                                    </tr>";
                    }else{
                      $tahun_fix = "";
                    }
                  ?>
                  <?= $tahun_fix ?>
                  <tr>
                    <td><?= $m['kelas_nama'] ?></td>
                    <td><?= $m['kelas_nama_singkat'] ?></td>
                    <td><?= $m['program_nama'] ?></td>
                    <td><?= $m['jenj_nama'] ?></td>
                    <td style="width:5%;"><?= $m['jum_siswa'] ?></td>
                    <td><?= $m['jum_mapel'] ?></td>
                    <td>

                        <form class="" action="<?= base_url('Kelas_CRUD/save_homeroom') ?>" method="post">
                          <select name="kelas_kr_id" id="kelas_kr_id" class="form-control form-control-sm" style="font-size:11px; height:25px;">
                            <?php
                              $_selected = $m['kelas_kr_id'];
                              echo "<option value= '0'>Pilih Walkel</option>";
                              foreach ($guru_all as $n) :
                                  if ($_selected == $n['kr_id']) {
                                      $s = "selected";
                                  } else {
                                      $s = "";
                                  }
                                  echo "<option value=" . $n['kr_id'] . " " . $s . ">" . $n['kr_nama_depan'] ." ". $n['kr_nama_belakang']. "</option>";
                              endforeach
                            ?>
                          </select>
                    </td>
                    <td>
                      <div class="grid-container">
                        <div>
                            <input type="hidden" name="kelas_id" value=<?= $m['kelas_id'] ?>>
                            <button type="submit" class="badge badge-dark">
                              Save WK
                            </button>
                          </form>
                        </div>
                        <div>
                          <form class="" action="<?= base_url('Kelas_CRUD/update') ?>" method="get">
                            <input type="hidden" name="_id" value=<?= $m['kelas_id'] ?>>
                            <button type="submit" class="badge badge-warning">
                              Edit Kelas
                            </button>
                          </form>
                        </div>
                        <div>
                        <form class="" action="<?= base_url('Kelas_CRUD/edit_student') ?>" method="get">
                          <input type="hidden" name="_id" value=<?= $m['kelas_id'] ?>>
                          <button type="submit" class="badge badge-success">
                            Edit Siswa
                          </button>
                        </form>
                        </div>
                        <div>
                        <form class="" action="<?= base_url('Kelas_CRUD/edit_subject') ?>" method="get">
                          <input type="hidden" name="_id" value=<?= $m['kelas_id'] ?>>
                          <button type="submit" class="badge badge-primary">
                            Edit Mapel
                          </button>
                        </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php
                  $t_nama_temp = $m['t_nama'];
                  endforeach
                ?>
              </tbody>
            </table>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
