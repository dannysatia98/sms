<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Tambah KD Spiritual</h1>
                        </div>

                        <?= $this->session->flashdata('message'); ?>

                        <form class="user" method="post" action="<?= base_url('Topik_CRUD/proses_add_spirit'); ?>">
                            <input type="hidden" name="mapel_id" value="<?= $mapel_id ?>">
                            <div class="form-group row">
                                <div class="col-sm mb-3 mb-sm-0">

                                  <h6><u>KD Spiritual:</u></h6>
                                  <textarea rows="4" name="spirit_nama" class="form-control mb-3" required></textarea>

                                    <!-- <input type="text" class="form-control" id="topik_nama" name="topik_nama" placeholder="Nama KD Pengetahuan" required> -->
                                  <h6><u>Urutan KD:</u></h6>
                                  <input type="number" class="form-control" id="spirit_urutan" name="spirit_urutan" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <h6><u>KD pada Jenjang:</u></h6>
                                    <select name="jenj_id" id="jenj_id" class="form-control">
                                        <?php
                                        $_selected = set_value('jenj_id');

                                        foreach ($jenj_all as $m) :
                                        if ($_selected == $m['jenj_id']) {
                                            $s = "selected";
                                        } else {
                                            $s = "";
                                        }
                                        echo "<option value=" . $m['jenj_id'] . " " . $s . ">" . $m['jenj_nama'] . "</option>";
                                        endforeach
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm mb-3 mb-sm-0">
                                    <h6><u>KD untuk semester:</u></h6>
                                    <select name="topik_semester" class="form-control">
                                        <?php
                                            $_selected = set_value('topik_semester');

                                            if ($_selected == 1) {
                                                echo '<option value="1" selected>Semester 1</option>
                                                <option value="2">Semester 2</option>';
                                            } elseif ($_selected == 2) {
                                                echo '<option value="1">Semester 1</option>
                                                <option value="2" selected>Semester 2</option>';
                                            }
                                            else{
                                                echo '<option value="1">Semester 1</option>
                                                <option value="2">Semester 2</option>';
                                            }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Insert KD Spiritual
                            </button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
