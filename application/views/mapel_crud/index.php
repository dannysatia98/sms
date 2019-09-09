<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
              <div class="p-5 overflow-auto">
                  <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Mata Pelajaran</h1>
                  </div>

                  <?= $this->session->flashdata('message'); ?>

                  <a href="<?= base_url('mapel_crud/add') ?>" class="btn btn-primary mb-3">Tambah Mapel</a>

                  <table class="table display compact table-hover dt">
                    <thead>
                      <tr>
                        <th>Nama Mapel</th>
                        <th>KKM</th>
                        <th>Singkatan</th>
                        <th>Urutan Pada Kel</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $t_nama_temp = "";
                        foreach($mapel_all as $m) :
                          if($t_nama_temp != $m['mapel_kel_nama']){
                            $tahun_fix = "<tr class='bg-dark text-light'>
                                            <td style='padding: 5px 0px 5px 10px;'><b>".$m['mapel_kel_nama']."</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                          </tr>";
                          }else{
                            $tahun_fix = "";
                          }

                          echo $tahun_fix;
                      ?>
                        <tr>
                          <td><?= $m['mapel_nama'] ?></td>
                          <td><?= $m['mapel_kkm'] ?></td>
                          <td><?= $m['mapel_sing'] ?></td>
                          <td><?= $m['mapel_urutan'] ?></td>
                          <td>
                            <div class="form-group row">
                              <form class="" action="<?= base_url('Mapel_CRUD/update') ?>" method="get">
                                <input type="hidden" name="_id" value=<?= $m['mapel_id'] ?>>
                                <button type="submit" class="badge badge-warning">
                                    Edit
                                </button>
                              </form>
                              <form class="" action="" method="get">
                                <input type="hidden" name="" value=<?= $m['mapel_id'] ?>>
                                <button type="submit" class="badge badge-danger">
                                    Delete
                                </button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      <?php
                        $t_nama_temp = $m['mapel_kel_nama'];
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
