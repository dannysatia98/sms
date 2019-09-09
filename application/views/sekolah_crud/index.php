<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4"><u>Detail Sekolah</u></h1>
            </div>


            <table class="table table-sm table-hover">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Kepala Sekolah</th>
                  <th>Pengajar Pramuka</th>
                  <th>Tanggal Raport Sisipan</th>
                  <th>Tanggal Raport Semester</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($sk_all as $m) : ?>
                  <tr>
                    <td><?= $m['sk_nama'] ?></td>
                    <td><?= $m['kepsek'] ?></td>
                    <td><?= $m['guru_scout'] ?></td>
                    <td><?= $m['sk_mid'] ?></td>
                    <td><?= $m['sk_fin'] ?></td>
                    <td>
                      <div class="form-group row">
                        <form class="" action="<?= base_url('Sekolah_CRUD/update') ?>" method="get">
                          <input type="hidden" name="_id" value=<?= $m['sk_id'] ?>>
                          <button type="submit" class="badge badge-warning">
                            Edit
                          </button>
                        </form>
                      </div>
                    </td>
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
