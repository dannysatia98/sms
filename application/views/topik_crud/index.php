<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Kompetensi Dasar</h1>
            </div>
            <?php echo '<div class="alert alert-danger alert-dismissible fade show">
                <button class="close" data-dismiss="alert" type="button">
                    <span>&times;</span>
                </button>
                <strong>PERHATIAN:</strong> DELETE topik akan menghapus seluruh nilai topik pada seluruh tahun ajaran!
            </div>'; ?>

            <?= $this->session->flashdata('message'); ?>
              <select name="topik_mapel" id="topik_mapel" class="form-control">
                <option value="0">Pilih Mapel</option>
                <?php
                  foreach($mapel_all as $m) :
                    echo "<option value=".$m['mapel_id'].">".$m['mapel_nama']." (".$m['mapel_sing'].")</option>";
                  endforeach
                ?>
              </select>
              <div id="sub_topik_crud">
                <table>
                  <td>
                    <form method="post" action="topik_CRUD/add">
                      <input type="hidden" name="mapel_id" id="mapel_id">
                      <button type="submit" class="btn btn-primary btn-user mt-4 mb-4">
                        + KD Pengetahuan & Keterampilan
                      </button>
                    </form>
                  </td>
                </table>
              </div>

            <div id="topik_mapel_ajax" class="mt-4">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
