<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h2 class="h4 text-gray-900 mb-4">Pilih Kelas</h2>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" action="<?= base_url('Scout_CRUD/input') ?>" method="POST">

              <div class="form-group row">
                <div class="col-sm mb-3 mb-sm-0">
                  <select name="kelas_scout_id" class="form-control mb-3">
                    <?php foreach ($kelas_all as $m) : ?>
                      <option value='<?= $m['kelas_id']?>'>
                        <?=  $m['kelas_nama']." -".$m['t_nama'] ?>
                      </option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                  Insert
              </button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
