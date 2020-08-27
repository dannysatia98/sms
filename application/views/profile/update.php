<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><?= $title ?></h1>
                </div>

                <?= $this->session->flashdata('message'); ?>

                <?= form_open_multipart('Profile/update'); ?>

                    <h4 class="text-danger mb-3"><u>HARUS ADA</u></h4>

                    <input type="hidden" name="kr_pp" value="<?php echo set_value('kr_pp', $kr['kr_pp']); ?>">
                    <input type="hidden" name="_kr_username" value="<?php echo set_value('_kr_username', $kr['kr_username']); ?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><b>Username:</b></label>
                            <input type="text" class="form-control form-control-sm" id="kr_username" name="kr_username" value="<?php echo set_value('kr_username', $kr['kr_username']); ?>">
                            <?= form_error('kr_username','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                    </div>

                    <!-- NAMA DEPAN dan BELAKANG -->
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><b>Nama Depan:</b></label>
                            <input type="text" class="form-control form-control-sm" id="kr_nama_depan" name="kr_nama_depan" value="<?php echo set_value('kr_nama_depan', $kr['kr_nama_depan']); ?>">
                            <?= form_error('kr_nama_depan','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label><b>Nama Belakang:</b></label>
                            <input type="text" class="form-control form-control-sm" id="kr_nama_belakang" name="kr_nama_belakang" value="<?php echo set_value('kr_nama_belakang', $kr['kr_nama_belakang']); ?>">
                            <?= form_error('kr_nama_belakang','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><b>Password:</b></label>
                            <input type="password" class="form-control form-control-sm" id="kr_password1" name="kr_password1" >
                            <?= form_error('kr_password1','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <label><b>Password (ulangi):</b></label>
                            <input type="password" class="form-control form-control-sm" id="kr_password2" name="kr_password2">
                        </div>
                    </div>

                    <h4 class="text-success mb-3 mt-5"><u>OPTIONAL</u></h4>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label><b>Gelar Depan:</b></label>
                            <input type="text" class="form-control form-control-sm" id="kr_gelar_depan" name="kr_gelar_depan" value="<?php echo set_value('kr_gelar_depan', $kr['kr_gelar_depan']); ?>">
                        </div>
                        <div class="col-sm-6">
                            <label><b>Gelar Belakang:</b></label>
                            <input type="text" class="form-control form-control-sm" id="kr_gelar_belakang" name="kr_gelar_belakang" value="<?php echo set_value('kr_gelar_belakang', $kr['kr_gelar_belakang']); ?>">
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <img height="300px" width="300px" src="<?= base_url('assets/img/profile/') .$kr['kr_pp'];?> "class="img-thumbnail">
                            <div class="custom-file mt-2">
                                <input type="file" class="custom-file-input" id="image"name="image">
                                <label class="custom-file-label" for="image">Pilih Gambar Profil</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Update
                    </button>
                </form>
                <hr>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>
