<style>
.grid-container {
  display: grid;
  grid-template-columns: 100%;
  grid-column-gap:3px;
  padding: 10px;
  margin: 20px;
  box-shadow: 5px 5px 5px 5px;
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

<div class="grid-container">
  <div class="text-center">
    <h1 class="h4 text-gray-900 mb-4 mt-3"><u><?= $detail_siswa['sis_nama_depan'].' '.$detail_siswa['sis_nama_bel'] ?></u></h1>
  </div>

  <label><b>Terdapat pada kelas:</b></label>
  <ul>
    <?php foreach ($detail_all as $d): ?>
      <li><?= $d['kelas_nama'].' ('.$d['t_nama'].')' ?></li>
    <?php endforeach; ?>
  </ul>

</div>
