<style>
.grid-container {
  display: grid;
  grid-template-columns: 50% 50%;
  grid-column-gap:0px;
  margin-right:40px;
}
</style>
<?php
  function status_tahun($st){
    if($st == 1)
      return "<div class='text-success' style='font-weight:800;'>Terbuka</div>";
    else
      return "<div class='text-danger' style='font-weight:800;'>Terkunci</div>";
  }
?>
<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4"><?= $title ?></h1>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url('tahun_crud/add') ?>" class="btn btn-primary mb-3">Tambah</a>

            <table class="table table-sm table-bordered display compact table-hover dt" style="font-size:14px;">
              <thead>
                <tr>
                  <th>Tahun</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($tahun_all as $m) : ?>
                  <tr>
                    <td><?= $m['t_nama'] ?></td>
                    <td style="width:100px;"><?= status_tahun($m['t_kunci']) ?></td>
                    <td style="width:100px;">
                      <div class="grid-container">
                        <form class="" action="<?= base_url('Tahun_CRUD/update') ?>" method="get">
                          <input type="hidden" name="_id" value=<?= $m['t_id'] ?>>
                          <button type="submit" class="badge badge-warning">
                            Edit
                          </button>
                        </form>
                        <form class="" action="<?= base_url('Tahun_CRUD/rubah_status') ?>" method="post">
                          <input type="hidden" name="t_id" value=<?= $m['t_id'] ?>>
                          <input type="hidden" name="t_kunci" value=<?= $m['t_kunci'] ?>>
                          <button type="submit" class="badge badge-secondary">
                            Rubah Status
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

<script>
  $(document).ready(function () {
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
      $(".alert-success").slideUp(500);
    });
  });
</script>
