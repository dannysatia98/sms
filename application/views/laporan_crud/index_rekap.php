<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center mb-3">
              <h1 class="h4 text-gray-900"><u><?= $title ?></u></h1>
              <!-- <h1 class="h4 text-gray-900"><u>DKN Nominasi UN</u></h1>
              <h5>Pilih Tahun, Kelas dan Siswa</h5> -->
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" action="<?= base_url('Laporan_CRUD/index_rekap_show') ?>" method="POST">
              <div class="form-group row mt-4">
                <div class="col-sm mb-sm-0">
                  <label><b><u>Tahun Ajaran:</u></b></label>
                  <select name="t_id" class="form-control form-control-sm" id="t_id_ketuntasan">
                    <?php foreach ($t_all as $m) : ?>
                      <option value='<?= $m['t_id'] ?>'>
                        <?= $m['t_nama']; ?>
                      </option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-sm mb-sm-0">
                  <label><b><u>Semester:</u></b></label>
                  <select name="sem" class="form-control form-control-sm">
                    <option value="1">1</option>
                    <option value="2">2</option>
                  </select>
                </div>

              </div>
              
              <button type="submit" class="btn btn-primary btn-user btn-block">
                Proses
              </button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<script>
$(document).ready(function(){
  $('#t_id_ketuntasan').on('change', function () {

    var t_id = $(this).val();
    //alert(t_id);
    $('#mapel_ketuntasan').html("");

    $.ajax(
      {
        type: "post",
        url: base_url + "Laporan_CRUD/get_mapel",
        data: {
          't_id': t_id,
        },
        async: true,
        dataType: 'json',
        success: function (data) {
          //console.log(data);
          if (data.length == 0) {
            var html = '<div class="text-center mt-3 mb-3 text-danger"><b>--Mapel tidak ada, periksa mapel tiap kelas--</b></div>';
          } else {
            var html = '<select name="mapel_id" class="form-control form-control-sm mb-3">';
            var i;
            for (i = 0; i < data.length; i++) {
              html += '<option value=' + data[i].mapel_id + '>' + data[i].mapel_nama + ' ('+ data[i].mapel_sing +')</option>';
            }
            html += '</select>';
          }
          //console.log(html);
          $('#mapel_ketuntasan').html(html);
        }
      });
  }).change();
});
</script>
