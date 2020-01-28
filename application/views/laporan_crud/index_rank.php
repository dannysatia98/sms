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

            <form class="user" action="<?= base_url('Laporan_CRUD/index_rank_show') ?>" method="POST">
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

              <div id="jenjang_rank_ajax">

              </div>

              <div id="program_rank_ajax">

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

      $('#jenjang_rank_ajax').html("");
      $('#program_rank_ajax').html("");

      $.ajax(
        {
          type: "post",
          url: base_url + "Report_CRUD/get_jenjang",
          data: {
            't_id': id,
          },
          async: true,
          dataType: 'json',
          success: function (data) {
            //console.log(data);
            if (data.length == 0) {
              var html = '<div class="text-center mb-3 text-danger"><b>--Jenjang tidak ada--</b></div>';
            } else {
              var html = '<label><b><u>Jenjang:</u></b></label><select name="jenj_id" id="jenj_id" class="form-control form-control-sm mb-3">';
              html += '<option value="0">Pilih Jenjang</option>';
              var i;
              for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].jenj_id + '>' + data[i].jenj_nama + '</option>';
              }
              html += '</select>';
            }

            $('#jenjang_rank_ajax').html(html);
            refrehEventProgram();
          }
        });
    });

    function refrehEventProgram(){
      $('#jenj_id').change(function () {
        var id = $(this).val();

        $('#program_rank_ajax').html("");

        $.ajax(
          {
            type: "post",
            url: base_url + "Report_CRUD/get_program",
            data: {
              'jenj_id': id,
            },
            async: true,
            dataType: 'json',
            success: function (data) {
              //console.log(data);
              if (data.length == 0) {
                var html = '<div class="text-center mb-3 text-danger"><b>--Program tidak ada--</b></div>';
              } else {
                var html = `<label><b><u>Program:</u></b></label>
                <select name="program_id" class="form-control form-control-sm mb-3">`;
                var i;
                for (i = 0; i < data.length; i++) {
                  html += '<option value=' + data[i].program_id + '>' + data[i].program_nama + '</option>';
                }
                html += '</select>';

                html += `<label><b><u>Semester:</u></b></label>
                <select name="semester" class="form-control form-control-sm mb-3">
                  <option value="1">Semester 1</option>
                  <option value="2">Semester 2</option>
                </select>`;

                html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
                html += 'Show';
                html += '</button>';
              }

              $('#program_rank_ajax').html(html);
            }
          });
      });
    }

  });

</script>
