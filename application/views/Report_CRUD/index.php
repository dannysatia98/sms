<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Pilih Tahun, Kelas dan Siswa</h1>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" action="Report_CRUD/show" method="POST">
              <div class="form-group row">
                <div class="col-sm mb-sm-0">
                  <select name="t" id="t" class="form-control">
                    <?php
                    if($this->session->userdata('kr_jabatan_id')==7){
                      echo '<option value="0">Pilih Tahun Ajaran</option>';
                      foreach ($kelas_all as $m){
                        echo '<option value='.$m['t_id'].'>'.$m['t_nama'].'</option>';
                      }
                    }else{
                    echo '<option value="0">Pilih Tahun Ajaran</option>';
                      foreach ($t_all as $m){
                        echo '<option value='.$m['t_id'].'>'.$m['t_nama'].'</option>';
                      }
                    }?>
                  </select>
                </div>
              </div>

              <div class="form-group row">

                <div class="col-sm mb-sm-0">
                  <select name="semester" id="semester" class="form-control">
                    <option value="1">Semester Ganjil</option>
                    <option value="2">Semester Genap</option>
                  </select>
                </div>
                <div class="col-sm mb-sm-0">
                  <select name="pJenis" id="pJenis" class="form-control">
                    <option value="1">Sisipan</option>
                    <option value="2">Semester</option>
                  </select>
                </div>
              </div>

              <div class="form-group row" id="pilihan_sisipan">
                <div class="col-sm mb-sm-0 mt-2">
                  <h6>Nilai Pengetahuan Yang Tampil (Sisipan):</h6>
                  <select name="phCount" id="phCount" class="form-control">
                    <option value="0">Auto</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                  </select>
                </div>
                <div class="col-sm mb-sm-0 mt-2">
                  <h6>Nilai Keterampilan Yang Tampil (Sisipan):</h6>
                  <select name="KCount" id="KCount" class="form-control">
                    <option value="0">Auto</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                  </select>
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
