<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center mb-3">
              <h1 class="h4 text-gray-900"><u>Laporan Input Nilai</u></h1>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" action="<?= base_url('Laporan_CRUD/index_nilai_show') ?>" method="POST">
              <div class="form-group row mt-4">
                <div class="col-sm mb-sm-0">
                  <label><b><u>Tahun Ajaran:</u></b></label>
                  <select name="t_id" class="form-control form-control-sm">
                    <?php foreach ($t_all as $m) : ?>
                      <option value='<?= $m['t_id'] ?>'>
                        <?= $m['t_nama']; ?>
                      </option>
                    <?php endforeach ?>
                  </select>

                  <button type="submit" class="btn btn-sm btn-primary btn-user btn-block mt-3">
                    Proses
                  </button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
