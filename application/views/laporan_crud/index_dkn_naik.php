<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center mb-3">
              <h1 class="h4 text-gray-900"><u>Ranking Pararel</u></h1>
              <!-- <h1 class="h4 text-gray-900"><u>DKN Nominasi UN</u></h1>
              <h5>Pilih Tahun, Kelas dan Siswa</h5> -->
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" action="<?= base_url('Laporan_CRUD/index_dkn_naik_show') ?>" method="POST">
              <div class="form-group row mt-4">
                <div class="col-sm mb-sm-0">
                  <label><b><u>Tahun Ajaran:</u></b></label>
                  <select name="t_id" id="t_rank" class="form-control form-control-sm">
                    <option value="0">Pilih Tahun Ajaran</option>
                    <?php foreach ($t_all as $m) : ?>
                      <option value='<?= $m['t_id'] ?>'>
                        <?= $m['t_nama']; ?>
                      </option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

              <div id="kelas_rank_ajax">

              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">

  $(document).ready(function() {

    $('#t_rank').change(function () {
      var id = $(this).val();
      //alert(id);
      $('#kelas_rank_ajax').html("");

      $.ajax(
        {
          type: "post",
          url: base_url + "Report_CRUD/get_kelas",
          data: {
            'id': id,
          },
          async: true,
          dataType: 'json',
          success: function (data) {
            //console.log(data);
            if (data.length == 0) {
              var html = '<div class="text-center mb-3 text-danger"><b>--Kelas tidak ada--</b></div>';
            } else {
              var html = '<label><b><u>Kelas:</u></b></label><select name="kelas_id" id="kelas_id" class="form-control form-control-sm mb-3">';
              var i;
              for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].kelas_id + '>' + data[i].kelas_nama + '</option>';
              }
              html += '</select>';
            }

            html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
            html += 'Show';
            html += '</button>';

            $('#kelas_rank_ajax').html(html);
          }
        });
    });

  });

</script>
