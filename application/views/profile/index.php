<style>
.grid-container {
  display: grid;
  grid-template-columns: 100%;
  grid-column-gap:3px;
  padding: 10px;
  margin: 20px;
  box-shadow: 2px 2px 2px 2px;
  overflow: auto;
}
.grid-inside {
  display: grid;
  grid-template-columns: 50% 50%;
  grid-column-gap:3px;
}
table.cus{
    border: 0.5px solid black;
}
.cus th{
  border: 0.1px solid black;
  text-align:center;
  padding: 3px;
}
.cus td{
  border: 0.1px solid black;
  text-align:center;
  padding: 3px;
}
</style>

<?php if ($this->session->userdata('kr_jabatan_id')<8){
echo '<div class="grid-container">
  <div class="text-center">
    <img src="'.base_url('assets/img/profile/').$kr['kr_pp'].'" alt="Avatar" style="height: 300px">
    <div class="text-center">'.$this->session->flashdata('message').'</div>
    <h3 class="text-center mt-3"><b>'.$kr['kr_nama_depan'].' '.$kr['kr_nama_belakang'].'</b></h3>
    <p class="text-center">'.$kr['sk_nama'].'<br>
    '. $jabatan['jabatan_nama'].' <br>
    <b>Aktif Sejak: </b>'.date('d F Y', $kr['kr_date_created']) .'</p>
  </div>
</div>';
}else if($this->session->userdata('kr_jabatan_id')==8){
  echo '<div class="grid-container">
  <div class="text-center">
    <div style="height: 100px"></div>
    
    <div style="height: 50px"></div>
    <div class="text-center">'.$this->session->flashdata('message').'</div>
    <h3 class="text-center mt-3"><b>'.$kr['sis_nama_depan'].' '.$kr['sis_nama_bel'].'</b></h3>
    <p class="text-center">'.$kr['sk_nama'].'<br>
    </p>
    <div style="height: 150px"></div>
  </div>
</div>';
}
?>