<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center mb-3">
              <h1 class="h4 text-gray-900"><u>Buku Induk</u></h1>
              <h5>Pilih Tahun, Kelas dan Siswa</h5>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" action="<?= base_url('Laporan_CRUD/index_buku_induk_show') ?>" method="POST">
              <div class="form-group row mt-4">
                <div class="col-sm mb-sm-0">
                  <label><b><u>Tahun Ajaran:</u></b></label>
                  <select name="t" id="t" class="form-control form-control-sm">
                    <option value="0">Pilih Tahun Ajaran</option>
                    <?php foreach ($t_all as $m) : ?>
                      <option value='<?= $m['t_id'] ?>'>
                        <?= $m['t_nama']; ?>
                      </option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-sm mb-sm-0">
                  <label><b><u>Tanggal Cetak:</u></b></label>
                  <input type="date" name="tgl_cetak" class="form-control form-control-sm" required>
                </div>
              </div>

              <div id="kelas_ajax">

              </div>
              <div id="siswa_ajax">

              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
