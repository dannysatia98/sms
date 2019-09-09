<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Pilih Kelas dan Mapel</h1>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" action="<?= base_url('Laporan_CRUD/show') ?>" method="POST">

              <select name="t_all_laporan" id="t_all_laporan" class="form-control">
                <option value="0">Pilih Tahun Ajaran</option>
                <?php foreach ($t_all as $m) : ?>
                  <option value='<?=$m['t_id'] ?>'>
                    <?=  $m['t_nama']; ?>
                  </option>
                <?php endforeach ?>
              </select>

              <div id="kelas_laporan">

              </div>

              <div id="mapel_laporan">

              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
