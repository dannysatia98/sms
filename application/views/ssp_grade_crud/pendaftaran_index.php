<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Pilih Ekstrakurikuler</h1>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" action="<?= base_url('SSP_grade_CRUD/pendaftaran_form') ?>" method="POST">

              <div class="form-group row">
                <div class="col-sm mb-sm-0">
                  <select name="ssp_id" id="ssp_id" class="form-control">
                    <?php foreach ($ssp_all as $m) : ?>
                      <option value='<?= $m['ssp_id'] ?>'>
                        <?= $m['ssp_nama']." -".$m['t_nama'] ?>
                      </option>
                    <?php endforeach ?>
                  </select>

                  <button type="submit" class="btn btn-primary btn-user btn-block mt-3">
                      Submit
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
