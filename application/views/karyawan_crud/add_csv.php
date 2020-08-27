<style>
.grid-container {
  display: grid;
  grid-template-columns: 15% 15% 15% 25% 15% 15%;
  grid-column-gap:4px;
  padding-right:3px;
}
.grid-container > div{
  text-align:left;
}

.grid-main {
  display: grid;
  grid-template-columns: 5% 90% 5%;
  grid-column-gap:3px;
  padding: 10px;
  margin: 20px;
  box-shadow: 5px 5px 5px 5px;
  overflow: auto;
  padding-bottom: 20px;
  padding-top: 20px;
}

.box1{
  /*align-self:start;*/
  grid-column:2/3;
  /* overflow: auto; */
}

.box2{
  /*align-self:start;*/
  display: grid;
  grid-template-columns: 50% 50%;
  margin-right: 20px;
}

</style>

<script src="<?= base_url('assets/'); ?>js/papaparse.min.js"></script>

<div class="grid-main">

  <div class="box1 text-center">
    <h1 class="h4 text-gray-900 mb-4 mt-4"><u><?= $title ?></u></h1>
  </div>
  <div class="box1">
    <div class="alert alert-primary pt-4" role="alert">
      <b>Yang harus ada:</b>
      <ul>
        <li>Nama depan Guru</li>
        <li>Nama belakang Guru</li>
        <li>Username</li>
        <li>Password</li>
      </ul>


      <b>Contoh format excel (jangan lupa save as CSV):</b>
      <img class="mt-3" src="<?= base_url('assets/img/preview_csv_guru.png')?>" height="100%" alt="Contoh" style="-moz-border-radius: 0px;-webkit-border-radius: 0px;border-radius: 0px;">
    </div>
  </div>




  <div class="box1 mb-4">
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="upload-csv" accept=".csv">
      <label class="custom-file-label" for="image">Pilih CSV</label>
    </div>


	  <button class="btn btn-secondary btn-user mt-3" id="btn-upload-csv">Preview</button>

  </div>
  <div class="box1 mb-4">
      <div id="report_csv"></div>
      <?= $this->session->flashdata('message'); ?>
  </div>
    <div class="box1" id="detail_csv_siswa" style="display: none;">
      <form class="user" method="post" action="<?= base_url('Karyawan_CRUD/add_csv_proses'); ?>">
        <div id="tbl-data"></div>
      <form>
    </div>

</div>


<script type="text/javascript">

  let btn_upload = document.getElementById('btn-upload-csv').addEventListener('click', ()=> {
    $("#detail_csv_siswa").show();

    $('#report_csv').html('<div class="alert alert-warning">memproses....</div>');
    Papa.parse(document.getElementById('upload-csv').files[0], {
    	download: true,
    	header: false,
      skipEmptyLines: 'greedy',
    	complete: function(data) {

        $('#report_csv').html('<div class="alert alert-success">Berhasil membaca CSV, untuk menyimpan tekan tombol save dibawah</div>');
        var html = "";
    		//console.log(data.data.length);
    		//console.log(data.data[0][0]);

        var i;
        html += `
        <label class="mt-3 text-danger"><b>Jumlah Guru: ${data.data.length}</b></label>
        <table class="table table-sm" style="font-size:11px;">
                <thead>
                  <tr>
                    <th>Nama Depan</th>
                    <th>Nama Belakang</th>
                    <th>Username</th>
                    <th>Password</th>
                  </tr>
                </thead>
                <tbody>`;
        for (i = 0; i < data.data.length; i++) {
          html += `<tr style="height:18px;">
                    <td><input type="text" required style="height:15px;" name="kr_nama_depan[]" value="${data.data[i][0]}"></td>
                    <td><input type="text" style="height:15px;" name="kr_nama_belakang[]" value="${data.data[i][1]}"></td>
                    <td><input type="text" required style="height:15px;" name="kr_username[]" value="${data.data[i][2]}"></td>
                    <td><input type="text" required style="height:15px;" name="kr_password[]" value="${data.data[i][3]}"></td>
                   </tr>`;
        }
        html += `</tbody></table>

                  <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Simpan
                  </button>`;

        //console.log(html);
        $('#tbl-data').html(html);

    	}
    });
  });

</script>
