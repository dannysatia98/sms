<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function walkel_menu(){
  $ci =& get_instance();
  $ci->load->model('_kr');
  $ci->load->model('_kelas');

  $count_walkel = $ci->db->where('kelas_kr_id',$ci->session->userdata('kr_id'))->from("kelas")->count_all_results();

  return $count_walkel;
}

function ssp_menu(){
  $ci =& get_instance();

  $count_walkel = $ci->db->where('ssp_kr_id',$ci->session->userdata('kr_id'))->from("ssp")->count_all_results();

  return $count_walkel;
}


function scout_menu(){
  $ci =& get_instance();

  $count_scout = $ci->db->where('sk_scout_kr_id',$ci->session->userdata('kr_id'))->from("sk")->count_all_results();

  return $count_scout;
}

function mapel_urutan_by_kelas($kelas_id){
  $ci =& get_instance();

  $mpl = $ci->db->query(
    "SELECT *
    FROM d_mpl
    LEFT JOIN kelas ON d_mpl_kelas_id = kelas_id
    LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
    LEFT JOIN mapel_kel ON mapel_kel = mapel_kel_id
    WHERE d_mpl_kelas_id = $kelas_id AND mapel_bk = 0
    GROUP BY mapel_id
    ORDER BY mapel_kel_id, mapel_urutan")->result_array();

  return $mpl;
}

function returnNonZeroK($tes_prak1,$tes_prak2,$tes_prak3,$tes_produk1,$tes_produk2,$tes_produk3,$tes_proyek1,$tes_proyek2,$tes_proyek3,$tes_porto1,$tes_porto2,$tes_porto3){

  $tes_prak1 = explode(",",$tes_prak1);
  $tes_prak2 = explode(",",$tes_prak2);
  $tes_prak3 = explode(",",$tes_prak3);

  $tes_produk1 = explode(",",$tes_produk1);
  $tes_produk2 = explode(",",$tes_produk2);
  $tes_produk3 = explode(",",$tes_produk3);

  $tes_proyek1 = explode(",",$tes_proyek1);
  $tes_proyek2 = explode(",",$tes_proyek2);
  $tes_proyek3 = explode(",",$tes_proyek3);

  $tes_porto1 = explode(",",$tes_porto1);
  $tes_porto2 = explode(",",$tes_porto2);
  $tes_porto3 = explode(",",$tes_porto3);
  $nonZero = array();

  //praktek
  for($i=0;$i<count($tes_prak1);$i++) {
    if ($tes_prak1[$i] != 0) {
      array_push($nonZero,$tes_prak1[$i]);
    }
  }
  for($i=0;$i<count($tes_prak2);$i++) {
    if ($tes_prak2[$i] != 0) {
      array_push($nonZero,$tes_prak2[$i]);
    }
  }
  for($i=0;$i<count($tes_prak3);$i++) {
    if ($tes_prak3[$i] != 0) {
      array_push($nonZero,$tes_prak3[$i]);
    }
  }

  //produk
  for($i=0;$i<count($tes_produk1);$i++) {
    if ($tes_produk1[$i] != 0) {
      array_push($nonZero,$tes_produk1[$i]);
    }
  }
  for($i=0;$i<count($tes_produk2);$i++) {
    if ($tes_produk2[$i] != 0) {
      array_push($nonZero,$tes_produk2[$i]);
    }
  }
  for($i=0;$i<count($tes_produk3);$i++) {
    if ($tes_produk3[$i] != 0) {
      array_push($nonZero,$tes_produk3[$i]);
    }
  }

  //proyek
  for($i=0;$i<count($tes_proyek1);$i++) {
    if ($tes_proyek1[$i] != 0) {
      array_push($nonZero,$tes_proyek1[$i]);
    }
  }
  for($i=0;$i<count($tes_proyek2);$i++) {
    if ($tes_proyek2[$i] != 0) {
      array_push($nonZero,$tes_proyek2[$i]);
    }
  }
  for($i=0;$i<count($tes_proyek3);$i++) {
    if ($tes_proyek3[$i] != 0) {
      array_push($nonZero,$tes_proyek3[$i]);
    }
  }

  //porto
  for($i=0;$i<count($tes_porto1);$i++) {
    if ($tes_porto1[$i] != 0) {
      array_push($nonZero,$tes_porto1[$i]);
    }
  }
  for($i=0;$i<count($tes_porto2);$i++) {
    if ($tes_porto2[$i] != 0) {
      array_push($nonZero,$tes_porto2[$i]);
    }
  }
  for($i=0;$i<count($tes_porto3);$i++) {
    if ($tes_porto3[$i] != 0) {
      array_push($nonZero,$tes_porto3[$i]);
    }
  }

  return $nonZero;
}

function returnNonZero($ph1,$ph2,$ph3,$ph4,$ph5){

  $ph1 = explode(",",$ph1);
  $ph2 = explode(",",$ph2);
  $ph3 = explode(",",$ph3);
  $ph4 = explode(",",$ph4);
  $ph5 = explode(",",$ph5);
  $nonZero = array();
  for($i=0;$i<count($ph1);$i++) {
    if ($ph1[$i] != 0) {
      array_push($nonZero,$ph1[$i]);
    }
  }
  for($i=0;$i<count($ph2);$i++) {
    if ($ph2[$i] != 0) {
      array_push($nonZero,$ph2[$i]);
    }
  }
  for($i=0;$i<count($ph3);$i++) {
    if ($ph3[$i] != 0) {
      array_push($nonZero,$ph3[$i]);
    }
  }
  for($i=0;$i<count($ph4);$i++) {
    if ($ph4[$i] != 0) {
      array_push($nonZero,$ph4[$i]);
    }
  }
  for($i=0;$i<count($ph5);$i++) {
    if ($ph5[$i] != 0) {
      array_push($nonZero,$ph5[$i]);
    }
  }
  return $nonZero;
}

function return_raport_mid($d_s_id, $semester){
  $ci =& get_instance();

  $raport_mid = $ci->db->query(
    'SELECT * FROM
      (SELECT mapel_id, mapel_urutan, tes_d_s_id, mapel_nama,mapel_kkm,sis_nama_depan, sis_nama_bel, sis_no_induk,kelas_nama,sk_nama,t_nama,mapel_kel_nama,d_s_komen_sis,d_s_komen_sis2,
      GROUP_CONCAT(tes_ph1 ORDER BY topik_urutan) as tes_ph1,
      GROUP_CONCAT(tes_ph2 ORDER BY topik_urutan) as tes_ph2,
      GROUP_CONCAT(tes_ph3 ORDER BY topik_urutan) as tes_ph3,
      GROUP_CONCAT(tes_ph4 ORDER BY topik_urutan) as tes_ph4,
      GROUP_CONCAT(tes_ph5 ORDER BY topik_urutan) as tes_ph5,
      GROUP_CONCAT(tes_prak1 ORDER BY topik_urutan) as tes_prak1,
      GROUP_CONCAT(tes_prak2 ORDER BY topik_urutan) as tes_prak2,
      GROUP_CONCAT(tes_prak3 ORDER BY topik_urutan) as tes_prak3,
      GROUP_CONCAT(tes_produk1 ORDER BY topik_urutan) as tes_produk1,
      GROUP_CONCAT(tes_produk2 ORDER BY topik_urutan) as tes_produk2,
      GROUP_CONCAT(tes_produk3 ORDER BY topik_urutan) as tes_produk3,
      GROUP_CONCAT(tes_proyek1 ORDER BY topik_urutan) as tes_proyek1,
      GROUP_CONCAT(tes_proyek2 ORDER BY topik_urutan) as tes_proyek2,
      GROUP_CONCAT(tes_proyek3 ORDER BY topik_urutan) as tes_proyek3,
      GROUP_CONCAT(tes_porto1 ORDER BY topik_urutan) as tes_porto1,
      GROUP_CONCAT(tes_porto2 ORDER BY topik_urutan) as tes_porto2,
      GROUP_CONCAT(tes_porto3 ORDER BY topik_urutan) as tes_porto3
      FROM tes
      LEFT JOIN topik
      ON tes_topik_id = topik_id
      LEFT JOIN mapel
      ON topik_mapel_id = mapel_id
      LEFT JOIN mapel_kel
      ON mapel_kel = mapel_kel_id
      LEFT JOIN d_s
      ON tes_d_s_id = d_s_id
      LEFT JOIN sis
      ON d_s_sis_id = sis_id
      LEFT JOIN sk
      ON sis_sk_id = sk_id
      LEFT JOIN kelas
      ON d_s_kelas_id = kelas_id
      LEFT JOIN t
      ON kelas_t_id = t_id
      WHERE tes_d_s_id = '.$d_s_id.' AND topik_semester = '.$semester.'
      GROUP BY mapel_id
      ORDER BY mapel_kel_id, mapel_urutan)as formative
      LEFT JOIN
      (
        SELECT mapel_id, uj_mid1_kog, uj_mid1_psi
        FROM uj
        LEFT JOIN mapel
        ON uj_mapel_id = mapel_id
        LEFT JOIN d_s
        ON uj_d_s_id = d_s_id
        LEFT JOIN sis
        ON d_s_sis_id = sis_id
        WHERE uj_d_s_id = '.$d_s_id.'
        GROUP BY mapel_id
        ORDER BY mapel_kel_id, mapel_urutan
      )as summative ON formative.mapel_id = summative.mapel_id')->result_array();

  return $raport_mid;
}

function returnNilaiSspSisipan($d_s_id, $semester){
  $ci =& get_instance();

  $ssp_mid = $ci->db->query(
    'SELECT ssp_nama, SUM(ssp_nilai_angka)/count(ssp_id) as total_nilai FROM ssp_nilai
    LEFT JOIN ssp_topik ON ssp_nilai_ssp_topik_id = ssp_topik_id
    LEFT JOIN ssp ON ssp_id = ssp_topik_ssp_id
    WHERE ssp_nilai_d_s_id = '.$d_s_id.' AND ssp_topik_semester = '.$semester.'
    GROUP BY ssp_id
      ')->row_array();

  $td = "<td style='padding: 0px 0px 0px 5px; margin: 0px;'>".$ssp_mid['ssp_nama']."</td>
        <td class='biasa' colspan='13'></td>
        <td class='biasa' colspan='3'>".return_abjad_base4($ssp_mid['total_nilai'])."</td>";

  return $td;
}

function returnQATmidcek($value){
  $print = "<td class='biasa'>";
  if(isset($value)){
    if($value>0){
      $print .= $value;
    }
    elseif($value == -1){
      $print .= "0";
    }
    elseif($value<0){
      $print .= "-";
    }
    else{
      $print .= " ";
    }
  }else{
    $print .= " ";
  }
  $print .= "</td>";
  return $print;
}

function returnNilaiPerBulan($minggu1, $minggu2, $minggu3, $minggu4, $minggu5){
  $jumAktif = 0;

  if($minggu1 > 0)
    $jumAktif++;

  if($minggu2 > 0)
    $jumAktif++;

  if($minggu3 > 0)
    $jumAktif++;

  if($minggu4 > 0)
    $jumAktif++;

  if($minggu5 > 0)
    $jumAktif++;

  $nilai_bulan = $minggu1+$minggu2+$minggu3+$minggu4+$minggu5;

  return $nilai_bulan/$jumAktif;
}

function returnQATastd($kq, $ka, $kt, $pq, $pa, $pt, $minggu1, $minggu2, $minggu3, $minggu4, $minggu5, $uj_mid1_kog, $uj_mid1_psi){
  $kq = explode(",",$kq);
  $ka = explode(",",$ka);
  $kt = explode(",",$kt);
  $pq = explode(",",$pq);
  $pa = explode(",",$pa);
  $pt = explode(",",$pt);

  $td = "";

  //KOGNITIF
  //quiz, ass, test 1
  $td .= returnQATmidcek($kq[0]);
  $td .= returnQATmidcek($ka[0]);
  $td .= returnQATmidcek($kt[0]);
  //quiz, ass, test 2

  if(isset($kq[1])){
    $td .= returnQATmidcek($kq[1]);
    $td .= returnQATmidcek($ka[1]);
    $td .= returnQATmidcek($kt[1]);
  }
  else{
    $td .= "<td class='biasa' colspan='3'>No data</td>";
  }


  //PSIKOMOTOR
  //quiz, ass, test 1
  $td .= returnQATmidcek($pq[0]);
  $td .= returnQATmidcek($pa[0]);
  $td .= returnQATmidcek($pt[0]);
  //quiz, ass, test 2
  if(isset($kq[1])){
    $td .= returnQATmidcek($pq[1]);
    $td .= returnQATmidcek($pa[1]);
    $td .= returnQATmidcek($pt[1]);
  }
  else{
    $td .= "<td class='biasa' colspan='3'>No data</td>";
  }

  //AFEKTIF
  $minggu1 = explode(",",$minggu1);
  $minggu2 = explode(",",$minggu2);
  $minggu3 = explode(",",$minggu3);
  $minggu4 = explode(",",$minggu4);
  $minggu5 = explode(",",$minggu5);

  $jumBulan = count($minggu1);

  //var_dump($minggu1);

  if($minggu1[0]!=""){
    $total_afek = 0;
    for($i=0;$i<count($minggu1);$i++){
      //cek berapa minggu aktif
      $total_afek += returnNilaiPerBulan($minggu1[$i],$minggu2[$i],$minggu3[$i],$minggu4[$i],$minggu5[$i]);
    }

    $td .= "<td class='biasa'>".return_abjad_afek($total_afek/$jumBulan)."</td>";
  }else{
    $td .= "<td class='biasa'>No Data</td>";
  }



  //SUMMATIVE
  $td .= returnQATmidcek($uj_mid1_kog);
  $td .= returnQATmidcek($uj_mid1_psi);

  return $td;
}

function return_abjad_extra($nilai){
  if($nilai >3){
      return "A";
  }elseif($nilai >2){
      return "B";
  }elseif($nilai >1){
      return "C";
  }else{
      return "D";
  }
}

function return_abjad_sikap($nilai){
  if($nilai >3.33){
      return "Sangat Baik";
  }elseif($nilai >=2.33){
      return "Baik";
  }elseif($nilai >=1.33){
      return "Cukup";
  }else{
      return "Kurang";
  }
}

function return_singkat_sikap($nilai){
  if($nilai >3.33){
      return "SB";
  }elseif($nilai >=2.33){
      return "B";
  }elseif($nilai >=1.33){
      return "C";
  }else{
      return "K";
  }
}

function returnKategoriSpirit($index){
  $kata = ["Berdoa sebelum & sesudah kegiatan",
          "Menjalankan ibadah sesuai agama yang dianut",
          "Memberi salam awal dan akhir kegiatan",
          "Bersyukur atas nikmat dan karunia Tuhan Yang Maha Esa",
          "Mensyukuri kemampuan manusia dalam mengendalikan diri",
          "Bersyukur ketika berhasil mengerjakan sesuatu",
          "Berserah diri (tawakal) kepada Tuhan setelah beriktiar atau melakukan usaha",
          "Menjaga lingkungan hidup di sekitar satuan pendidikan",
          "Memelihara hubungan baik dengan sesama umat ciptaan Tuhan Yang Maha Esa",
          "Bersyukur kepada Tuhan Yang Maha Esa sebagai bangsa Indonesia",
          "Menghormati orang lain yang menjalankan ibadah sesuai dengan agama yang dianutnya dan tidak merendahkan agama lain"];
  return $kata[$index];
}
function returnKategoriSosial($index){
  $kata = ["Jujur","Disiplin","Tanggung Jawab","Toleran","Gotong Royong","Santun","Percaya Diri","Responsif dan proaktif",
          "Peduli (mampu bekerjasama dengan orang lain, gotong royong )","Taat aturan",
          "Semangat belajar yang tinggi untuk berprestasi","Simpatik","Menghargai orang lain",
          "Sabar","Sederhana dalam penampilan","Menerima kritik, saran dan mau meminta maaf bila melakukan kesalahan"];
  return $kata[$index];
}

function return_detail_siswa($d_s_id){
  $ci =& get_instance();

  $detail = $ci->db->query(
    "SELECT *
    FROM d_s
    LEFT JOIN sis ON d_s_sis_id = sis_id
    LEFT JOIN kelas ON d_s_kelas_id = kelas_id
    LEFT JOIN t ON kelas_t_id = t_id
    LEFT JOIN kr ON kelas_kr_id = kr_id
    LEFT JOIN sk ON kelas_sk_id = sk_id
    WHERE d_s_id = $d_s_id")->row_array();

  return $detail;
}

function return_nama_bulan($bulan_angka){
  if($bulan_angka == '1'){
    $bulan = 'Januari';
  }elseif($bulan_angka == '2'){
    $bulan = 'Februari';
  }elseif($bulan_angka == '3'){
    $bulan = 'Maret';
  }elseif($bulan_angka == '4'){
    $bulan = 'April';
  }elseif($bulan_angka == '5'){
    $bulan = 'Mei';
  }elseif($bulan_angka == '6'){
    $bulan = 'Juni';
  }elseif($bulan_angka == '7'){
    $bulan = 'Juli';
  }elseif($bulan_angka == '8'){
    $bulan = 'Agustus';
  }elseif($bulan_angka == '9'){
    $bulan = 'September';
  }elseif($bulan_angka == '10'){
    $bulan = 'Oktober';
  }elseif($bulan_angka == '11'){
    $bulan = 'November';
  }elseif($bulan_angka == '12'){
    $bulan = 'Desember';
  }else{
    $bulan = '';
  }

  return $bulan;
}


function returnRaportSemester1($d_s_id, $semester, $kelas_id){
  $ci =& get_instance();

  $raport_semester1 = $ci->db->query(
    "SELECT mapel_id,
      SUM(IFNULL(sosaf_1,3))/COUNT(mapel_id) as sosaf_1,
      SUM(IFNULL(sosaf_2,3))/COUNT(mapel_id) as sosaf_2,
      SUM(IFNULL(sosaf_3,3))/COUNT(mapel_id) as sosaf_3,
      SUM(IFNULL(sosaf_4,3))/COUNT(mapel_id) as sosaf_4,
      SUM(IFNULL(sosaf_5,3))/COUNT(mapel_id) as sosaf_5,
      SUM(IFNULL(sosaf_6,3))/COUNT(mapel_id) as sosaf_6,
      SUM(IFNULL(sosaf_7,3))/COUNT(mapel_id) as sosaf_7,
      SUM(IFNULL(sosaf_8,3))/COUNT(mapel_id) as sosaf_8,
      SUM(IFNULL(sosaf_9,3))/COUNT(mapel_id) as sosaf_9,
      SUM(IFNULL(sosaf_10,3))/COUNT(mapel_id) as sosaf_10,
      SUM(IFNULL(sosaf_11,3))/COUNT(mapel_id) as sosaf_11,
      SUM(IFNULL(sosaf_12,3))/COUNT(mapel_id) as sosaf_12,
      SUM(IFNULL(sosaf_13,3))/COUNT(mapel_id) as sosaf_13,
      SUM(IFNULL(sosaf_14,3))/COUNT(mapel_id) as sosaf_14,
      SUM(IFNULL(sosaf_15,3))/COUNT(mapel_id) as sosaf_15,
      SUM(IFNULL(sosaf_16,3))/COUNT(mapel_id) as sosaf_16,
      SUM((d_mpl_persen_sos/100) * IFNULL(total_sosial,3)) as total_sosial,
      SUM(IFNULL(spraf_1,3))/COUNT(mapel_id) as spraf_1,
      SUM(IFNULL(spraf_2,3))/COUNT(mapel_id) as spraf_2,
      SUM(IFNULL(spraf_3,3))/COUNT(mapel_id) as spraf_3,
      SUM(IFNULL(spraf_4,3))/COUNT(mapel_id) as spraf_4,
      SUM(IFNULL(spraf_5,3))/COUNT(mapel_id) as spraf_5,
      SUM(IFNULL(spraf_6,3))/COUNT(mapel_id) as spraf_6,
      SUM(IFNULL(spraf_7,3))/COUNT(mapel_id) as spraf_7,
      SUM(IFNULL(spraf_8,3))/COUNT(mapel_id) as spraf_8,
      SUM(IFNULL(spraf_9,3))/COUNT(mapel_id) as spraf_9,
      SUM(IFNULL(spraf_10,3))/COUNT(mapel_id) as spraf_10,
      SUM(IFNULL(spraf_11,3))/COUNT(mapel_id) as spraf_11,
      SUM((d_mpl_persen_spr/100) * IFNULL(total_spirit,3)) as total_spirit
    FROM (
    	SELECT DISTINCT(mapel_id), mapel_nama, d_mpl_persen_sos, d_mpl_persen_spr
    	FROM d_mpl
    	LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
    	WHERE d_mpl_kelas_id = $kelas_id ) AS master_sikap
    LEFT JOIN (
      SELECT sosaf_mapel_id, sosaf_1, sosaf_2, sosaf_3, sosaf_4, sosaf_5, sosaf_6, sosaf_7, sosaf_8, sosaf_9, sosaf_10, sosaf_11, sosaf_12, sosaf_13, sosaf_14, sosaf_15, sosaf_16,
      (sosaf_1+sosaf_2+sosaf_3+sosaf_4+sosaf_5+sosaf_6+sosaf_7+sosaf_8+sosaf_9+sosaf_10+sosaf_11+sosaf_12+sosaf_13+sosaf_14+sosaf_15+sosaf_16)/16 AS total_sosial
    	FROM sosaf
    	WHERE sosaf_d_s_id = $d_s_id AND sosaf_semester = $semester) AS sosial ON master_sikap.mapel_id = sosial.sosaf_mapel_id
    LEFT JOIN (
      SELECT spraf_mapel_id, spraf_1,spraf_2,spraf_3,spraf_4,spraf_5,spraf_6,spraf_7,spraf_8,spraf_9,spraf_10,spraf_11,
      (spraf_1+spraf_2+spraf_3+spraf_4+spraf_5+spraf_6+spraf_7+spraf_8+spraf_9+spraf_10+spraf_11)/11 AS total_spirit
    	FROM spraf
    	WHERE spraf_d_s_id = $d_s_id AND spraf_semester = $semester) AS spirit ON master_sikap.mapel_id = spirit.spraf_mapel_id")->row_array();

  // var_dump($this->$ci->last_query());
  // die();
  return $raport_semester1;
}

function returnRaportSemester2($d_s_id, $semester){
  $ci =& get_instance();

  $raport_semester2 = $ci->db->query(
    "SELECT * FROM (
      SELECT mapel_id, mapel_kel_id, mapel_urutan, tes_d_s_id, mapel_nama, mapel_kel_nama, SUM((tes_ph1+tes_ph2+tes_ph3+tes_ph4+tes_ph5)/tes_jum_ph)/COUNT(mapel_id) as NH, GROUP_CONCAT(topik_id) as topik_kumpulan
      FROM tes
      LEFT JOIN topik
      ON tes_topik_id = topik_id
      LEFT JOIN mapel
      ON topik_mapel_id = mapel_id
      LEFT JOIN mapel_kel
      ON mapel_kel = mapel_kel_id
      LEFT JOIN d_s
      ON tes_d_s_id = d_s_id
      LEFT JOIN sis
      ON d_s_sis_id = sis_id
      WHERE tes_d_s_id = $d_s_id AND topik_semester = $semester
      GROUP BY mapel_id ) AS forma
    LEFT JOIN (
      SELECT mapel_id, uj_mid1_kog, uj_fin1_kog, uj_mid2_kog,uj_fin2_kog
      FROM uj
      LEFT JOIN mapel
      ON uj_mapel_id = mapel_id
      LEFT JOIN d_s
      ON uj_d_s_id = d_s_id
      LEFT JOIN sis
      ON d_s_sis_id = sis_id
      WHERE uj_d_s_id = $d_s_id
      GROUP BY mapel_id
      ORDER BY mapel_urutan
    )AS summa ON forma.mapel_id = summa.mapel_id
    ORDER BY mapel_kel_id, mapel_urutan")->result_array();

  return $raport_semester2;
}

function returnRaportPengetahuan($d_s_id, $semester, $mapel_id){
  $ci =& get_instance();

  $raport_semester2 = $ci->db->query(
    "SELECT * FROM (
      SELECT mapel_id, mapel_urutan, SUM((tes_ph1+tes_ph2+tes_ph3+tes_ph4+tes_ph5)/tes_jum_ph)/COUNT(mapel_id) as NH
      FROM tes
      LEFT JOIN topik ON tes_topik_id = topik_id
      LEFT JOIN mapel ON topik_mapel_id = mapel_id
      WHERE tes_d_s_id = $d_s_id AND topik_semester = $semester AND mapel_id = $mapel_id
      GROUP BY mapel_id ) AS forma
    LEFT JOIN (
      SELECT uj_mapel_id, uj_mid1_kog, uj_fin1_kog, uj_mid2_kog,uj_fin2_kog
      FROM uj
      WHERE uj_d_s_id = $d_s_id
      GROUP BY uj_mapel_id
    )AS summa ON forma.mapel_id = summa.uj_mapel_id
    ")->row_array();

  return $raport_semester2;
}


function hitungNA($NH,$ujmid,$ujfin){
  $pembagi = 2;

  if($ujmid >0){
    $pembagi++;
  }
  if($ujfin >0){
    $pembagi++;
  }
  $NA = (2*$NH+$ujmid+$ujfin)/$pembagi;
  return $NA;
}

function return_abjad_NH($NA){
  $kata_NA = "";
  if($NA>=92){
    $kata_NA = "A";
  }elseif ($NA>=84) {
    $kata_NA = "B";
  }elseif ($NA>=75) {
    $kata_NA = "C";
  }else{
    $kata_NA = "D";
  }
  return $kata_NA;
}

//HALAMAN KE 3 KETERAMPILAN
function returnRaportSemester3($d_s_id, $semester){
  $ci =& get_instance();

  $raport_semester3 = $ci->db->query(
    "SELECT ket.mapel_id as m_id, mapel_kel_id, mapel_urutan, mapel_nama, mapel_kel_nama, GROUP_CONCAT(topik_id) as topik_kumpulan,
    SUM(total_max/calJumKet(max_prak,max_produk,max_proyek,max_porto))/COUNT(ket.mapel_id) as NA_ket, uj_mid1_psi, uj_fin1_psi, uj_mid2_psi, uj_fin2_psi
    FROM(
      SELECT mapel_id, mapel_kel_id, mapel_urutan, tes_d_s_id, mapel_nama, mapel_kel_nama, topik_id,
      tes_prak1, tes_prak2, tes_prak3,
      GREATEST(tes_prak1, tes_prak2, tes_prak3) as max_prak,
      tes_produk1, tes_produk2, tes_produk3,
      GREATEST(tes_produk1, tes_produk2, tes_produk3) as max_produk,
      tes_proyek1, tes_proyek2, tes_proyek3,
      GREATEST(tes_proyek1, tes_proyek2, tes_proyek3) as max_proyek,
      tes_porto1, tes_porto2, tes_porto3,
      GREATEST(tes_porto1, tes_porto2, tes_porto3) as max_porto,
      GREATEST(tes_prak1, tes_prak2, tes_prak3)+
      GREATEST(tes_produk1, tes_produk2, tes_produk3)+
      GREATEST(tes_proyek1, tes_proyek2, tes_proyek3)+
      GREATEST(tes_porto1, tes_porto2, tes_porto3) as total_max
      FROM tes
      LEFT JOIN topik
      ON tes_topik_id = topik_id
      LEFT JOIN mapel
      ON topik_mapel_id = mapel_id
      LEFT JOIN mapel_kel
      ON mapel_kel = mapel_kel_id
      LEFT JOIN d_s
      ON tes_d_s_id = d_s_id
      LEFT JOIN sis
      ON d_s_sis_id = sis_id
      WHERE tes_d_s_id = $d_s_id AND topik_semester = $semester
    )as ket
    LEFT JOIN (
    	SELECT mapel_id, uj_mid1_psi, uj_fin1_psi, uj_mid2_psi, uj_fin2_psi
        FROM uj
        LEFT JOIN mapel
        ON uj_mapel_id = mapel_id
        LEFT JOIN d_s
        ON uj_d_s_id = d_s_id
        LEFT JOIN sis
        ON d_s_sis_id = sis_id
        WHERE uj_d_s_id = $d_s_id
        GROUP BY mapel_id
        ORDER BY mapel_urutan
    )as uj ON ket.mapel_id = uj.mapel_id
    GROUP BY ket.mapel_id
    ORDER BY mapel_kel_id, mapel_urutan")->result_array();

  return $raport_semester3;
}

function returnRaportKetrampilan($d_s_id, $semester, $mapel_id){
  $ci =& get_instance();

  $raport_semester3 = $ci->db->query(
    "SELECT ket.mapel_id as m_id, mapel_kel_id,
    SUM(total_max/calJumKet(max_prak,max_produk,max_proyek,max_porto))/COUNT(ket.mapel_id) as NA_ket, uj_mid1_psi, uj_fin1_psi, uj_mid2_psi, uj_fin2_psi
    FROM(
      SELECT mapel_id, mapel_kel_id, mapel_urutan, tes_d_s_id, mapel_nama, mapel_kel_nama, topik_id,
      tes_prak1, tes_prak2, tes_prak3,
      GREATEST(tes_prak1, tes_prak2, tes_prak3) as max_prak,
      tes_produk1, tes_produk2, tes_produk3,
      GREATEST(tes_produk1, tes_produk2, tes_produk3) as max_produk,
      tes_proyek1, tes_proyek2, tes_proyek3,
      GREATEST(tes_proyek1, tes_proyek2, tes_proyek3) as max_proyek,
      tes_porto1, tes_porto2, tes_porto3,
      GREATEST(tes_porto1, tes_porto2, tes_porto3) as max_porto,
      GREATEST(tes_prak1, tes_prak2, tes_prak3)+
      GREATEST(tes_produk1, tes_produk2, tes_produk3)+
      GREATEST(tes_proyek1, tes_proyek2, tes_proyek3)+
      GREATEST(tes_porto1, tes_porto2, tes_porto3) as total_max
      FROM tes
      LEFT JOIN topik
      ON tes_topik_id = topik_id
      LEFT JOIN mapel
      ON topik_mapel_id = mapel_id
      LEFT JOIN mapel_kel
      ON mapel_kel = mapel_kel_id
      WHERE tes_d_s_id = $d_s_id AND topik_semester = $semester AND mapel_id = $mapel_id
    )as ket
    LEFT JOIN (
    	SELECT mapel_id, uj_mid1_psi, uj_fin1_psi, uj_mid2_psi, uj_fin2_psi
        FROM uj
        LEFT JOIN mapel
        ON uj_mapel_id = mapel_id
        WHERE uj_d_s_id = $d_s_id
        GROUP BY mapel_id
        ORDER BY mapel_urutan
    )as uj ON ket.mapel_id = uj.mapel_id
    GROUP BY ket.mapel_id
    ORDER BY mapel_kel_id, mapel_urutan")->row_array();

  return $raport_semester3;
}

//HALAMAN 4 DLL

function returnRaportSemester4($d_s_id){
  $ci =& get_instance();
  $raport_semester4 = $ci->db->query(
    "SELECT * FROM ssp_peserta
    LEFT JOIN ssp ON ssp_peserta_ssp_id = ssp_id
    WHERE ssp_peserta_d_s_id = $d_s_id")->result_array();

  return $raport_semester4;
}

//DESKRIPSI KD PENGETAHUAN
function returnMaxKDpeng($kd,$d_s_id,$final_pengetahuan){
  $ci =& get_instance();
  $kd_max = $ci->db->query(
    "SELECT topik_id, topik_nama, (tes_ph1 + tes_ph2 + tes_ph3 + tes_ph4 + tes_ph5)/tes_jum_ph as ph_rata
    	FROM topik
    	LEFT JOIN tes ON tes_topik_id = topik_id
    	WHERE topik_id IN ($kd) AND tes_d_s_id = $d_s_id
      ORDER BY ph_rata DESC, topik_nama")->result_array();

  //jika nilai diatas 75
  $kata = "";
  $ketemu = 0;
  foreach ($kd_max as $n) :
    if($final_pengetahuan>=75){
      if($n['ph_rata'] >= 75 && $ketemu == 0){
        //$kata = "Sudah sangat menguasai untuk ".$kd_max['topik_nama'].". ".$kd_max['ph_rata'];
        $kata .= "Sudah sangat menguasai untuk ".$n['topik_nama']." ";
        $ketemu = 1;
      }
    }
    if($n['ph_rata'] < 75){
      $kata .= "Perlu ditingkatkan lagi untuk ".$n['topik_nama']." ";
    }
  endforeach;

  return $kata;
}

function returnDescKet($kd,$d_s_id,$final_keterampilan){
  $ci =& get_instance();
  $kd_min = $ci->db->query(
    "SELECT *,
    total_max/calJumKet(max_prak,max_produk,max_proyek,max_porto) as NA_ket
    FROM(
      SELECT topik_id, topik_nama,
      GREATEST(tes_prak1, tes_prak2, tes_prak3) as max_prak,
      GREATEST(tes_produk1, tes_produk2, tes_produk3) as max_produk,
      GREATEST(tes_proyek1, tes_proyek2, tes_proyek3) as max_proyek,
      GREATEST(tes_porto1, tes_porto2, tes_porto3) as max_porto,
      GREATEST(tes_prak1, tes_prak2, tes_prak3)+
      GREATEST(tes_produk1, tes_produk2, tes_produk3)+
      GREATEST(tes_proyek1, tes_proyek2, tes_proyek3)+
      GREATEST(tes_porto1, tes_porto2, tes_porto3) as total_max
    	FROM topik
    	LEFT JOIN tes ON tes_topik_id = topik_id
    	WHERE topik_id IN ($kd) AND tes_d_s_id = $d_s_id
    ) AS ph_ket
    ORDER BY NA_ket DESC")->result_array();

  $kata = "";
  $ketemu = 0;
  foreach ($kd_min as $n) :
    if ($final_keterampilan >= 75){
      if($n['NA_ket']>=75 && $ketemu == 0){
        $kata .= "Sudah sangat menguasai untuk ".$n['topik_nama']." ";
        $ketemu = 1;
      }
    }
    if($n['NA_ket']<75){
      $kata .= "Perlu ditingkatkan lagi untuk ".$n['topik_nama']." ";
    }
  endforeach;

  return $kata;
}

function show_laporan($topik_id){
  $ci =& get_instance();
  $kd_min = $ci->db->query(
    "SELECT *
    FROM tes
    LEFT JOIN topik ON tes_topik_id = topik_id
    LEFT JOIN mapel ON topik_mapel_id = mapel_id
    LEFT JOIN d_s ON tes_d_s_id = d_s_id
    LEFT JOIN sis ON d_s_sis_id = sis_id
    WHERE tes_topik_id = $topik_id
    ORDER BY sis_no_induk, sis_nama_depan")->result_array();

  return $kd_min;
}

function return_nama_tahun($t_id){
  $ci =& get_instance();
  $t = $ci->db->query(
    "SELECT t_nama
    FROM t
    WHERE t_id = $t_id")->row_array();

  return $t;
}

function return_seluruh_kelas_siswa($sis_id){
  $ci =& get_instance();
  $det = $ci->db->query(
    "SELECT d_s_id, sis_nama_depan, sis_nama_bel, sis_no_induk, kelas_nama, kelas_id
    FROM sis
    LEFT JOIN d_s ON sis_id = d_s_sis_id
    LEFT JOIN kelas ON kelas_id = d_s_kelas_id
    WHERE sis_id = $sis_id")->result_array();

  return $det;
}

function show_mid_final_count($mapel_id, $kelas_id)
{
  $ci = &get_instance();
  $laporan = $ci->db->query(
    "SELECT count(*) as jumlah
    FROM uj
    LEFT JOIN d_s ON uj_d_s_id = d_s_id
    WHERE d_s_kelas_id = $kelas_id AND uj_mapel_id = $mapel_id"
  )->row_array();

  return $laporan;
}

function show_harian_count($mapel_id, $kelas_id, $sem)
{
  $ci = &get_instance();
  $laporan = $ci->db->query(
    "SELECT count(*) as jumlah
    FROM tes
    LEFT JOIN d_s ON tes_d_s_id = d_s_id
    LEFT JOIN topik ON tes_topik_id = topik_id
    WHERE d_s_kelas_id = $kelas_id AND topik_mapel_id = $mapel_id AND topik_semester = $sem"
  )->row_array();

  return $laporan;
}

function return_jumlah_siswa($kelas_id)
{
  $ci = &get_instance();
  $laporan = $ci->db->query(
    "SELECT count(*) as jumlah
    FROM d_s
    WHERE d_s_kelas_id = $kelas_id"
  )->row_array();

  return $laporan;
}

function return_topik_mapel($mapel_id, $jenj_id, $sem)
{
  $ci = &get_instance();

  $sql = $ci->db->query(
    "SELECT topik_id, topik_nama, topik_semester, topik_nama_ket
    FROM topik
    WHERE topik_mapel_id = $mapel_id AND topik_jenj_id = $jenj_id AND topik_semester = $sem"
  )->result_array();

  return $sql;
}

function return_siswa_kelas($kelas_id)
{
  $ci = &get_instance();
  $sql = $ci->db->query(
    "SELECT d_s_id, sis_nama_bel, sis_nama_depan, sis_no_induk, kelas_nama, kelas_id
    FROM d_s
    LEFT JOIN sis ON sis_id = d_s_sis_id
    LEFT JOIN kelas ON d_s_kelas_id = kelas_id
    WHERE kelas_id = $kelas_id
    ORDER BY sis_nama_depan, sis_no_induk")->result_array();

  return $sql;
}

function return_tes_by_d_s_id_topik($d_s_id, $topik_id)
{
  $ci = &get_instance();
  $sql = $ci->db->query(
    "SELECT *
    FROM tes
    WHERE tes_d_s_id = $d_s_id AND tes_topik_id = $topik_id"
  )->row_array();

  return $sql;
}

function return_uj_by_d_s_id($d_s_id, $mapel_id)
{
  $ci = &get_instance();
  $sql = $ci->db->query(
    "SELECT *
    FROM uj
    WHERE uj_d_s_id = $d_s_id AND uj_mapel_id = $mapel_id"
  )->row_array();

  return $sql;
}

function returnNHPengMapel($d_s_id, $semester, $mapel_id){
    $ci =& get_instance();

    $raport_semester2 = $ci->db->query(
      "SELECT SUM((tes_ph1+tes_ph2+tes_ph3+tes_ph4+tes_ph5)/tes_jum_ph)/COUNT(mapel_id) as NH
      FROM tes
      LEFT JOIN topik
      ON tes_topik_id = topik_id
      LEFT JOIN mapel
      ON topik_mapel_id = mapel_id
      LEFT JOIN mapel_kel
      ON mapel_kel = mapel_kel_id
      LEFT JOIN d_s
      ON tes_d_s_id = d_s_id
      LEFT JOIN sis
      ON d_s_sis_id = sis_id
      WHERE tes_d_s_id = $d_s_id AND topik_semester = $semester AND mapel_id = $mapel_id
      GROUP BY mapel_id ")->row_array();

    return $raport_semester2;
}

function returnNHKetMapel($d_s_id, $semester, $mapel_id){
  $ci =& get_instance();

  $raport_semester3 = $ci->db->query(
    "SELECT SUM(total_max/calJumKet(max_prak,max_produk,max_proyek,max_porto))/COUNT(ket.mapel_id) as NA_ket
    FROM(
      SELECT mapel_id, mapel_kel_id, mapel_urutan, tes_d_s_id, mapel_nama, mapel_kel_nama, topik_id,
      tes_prak1, tes_prak2, tes_prak3,
      GREATEST(tes_prak1, tes_prak2, tes_prak3) as max_prak,
      tes_produk1, tes_produk2, tes_produk3,
      GREATEST(tes_produk1, tes_produk2, tes_produk3) as max_produk,
      tes_proyek1, tes_proyek2, tes_proyek3,
      GREATEST(tes_proyek1, tes_proyek2, tes_proyek3) as max_proyek,
      tes_porto1, tes_porto2, tes_porto3,
      GREATEST(tes_porto1, tes_porto2, tes_porto3) as max_porto,
      GREATEST(tes_prak1, tes_prak2, tes_prak3)+
      GREATEST(tes_produk1, tes_produk2, tes_produk3)+
      GREATEST(tes_proyek1, tes_proyek2, tes_proyek3)+
      GREATEST(tes_porto1, tes_porto2, tes_porto3) as total_max
      FROM tes
      LEFT JOIN topik
      ON tes_topik_id = topik_id
      LEFT JOIN mapel
      ON topik_mapel_id = mapel_id
      LEFT JOIN mapel_kel
      ON mapel_kel = mapel_kel_id
      WHERE tes_d_s_id = $d_s_id AND topik_semester = $semester AND mapel_id = $mapel_id
    )as ket")->row_array();

  return $raport_semester3;
}

function returnSosafBySiswa($d_s_id, $semester, $mapel_id){
  $ci =& get_instance();

  $a = $ci->db->query(
    "SELECT sosaf_1, sosaf_2, sosaf_3, sosaf_4, sosaf_5, sosaf_6, sosaf_7, sosaf_8, sosaf_9, sosaf_10, sosaf_11, sosaf_12, sosaf_13, sosaf_14, sosaf_15, sosaf_16
      FROM sosaf
      WHERE sosaf_d_s_id = $d_s_id AND sosaf_semester = $semester AND sosaf_mapel_id = $mapel_id")->row_array();

  return $a;
}

function returnSprafBySiswa($d_s_id, $semester, $mapel_id){
  $ci =& get_instance();

  $a = $ci->db->query(
    "SELECT spraf_1,spraf_2,spraf_3,spraf_4,spraf_5,spraf_6,spraf_7,spraf_8,spraf_9,spraf_10,spraf_11
      FROM spraf
      WHERE spraf_d_s_id = $d_s_id AND spraf_semester = $semester AND spraf_mapel_id = $mapel_id")->row_array();

  return $a;
}

function returnNamaMapel($mapel_id){
  $ci =& get_instance();

  $a = $ci->db->query(
    "SELECT mapel_sing
      FROM mapel
      WHERE mapel_id = $mapel_id")->row_array();

  return $a;
}

function returnKelasXsiswa($sis_id){
  $ci =& get_instance();

  $a = $ci->db->query(
    "SELECT d_s_id
      FROM d_s
      LEFT JOIN sis ON sis_id = d_s_sis_id
      LEFT JOIN kelas ON kelas_id = d_s_kelas_id
      LEFT JOIN jenj ON kelas_jenj_id = jenj_id
      WHERE jenj_id = 1 AND sis_id = $sis_id")->result_array();

  return $a;
}

function returnKelasXisiswa($sis_id){
  $ci =& get_instance();

  $a = $ci->db->query(
    "SELECT d_s_id
      FROM d_s
      LEFT JOIN sis ON sis_id = d_s_sis_id
      LEFT JOIN kelas ON kelas_id = d_s_kelas_id
      LEFT JOIN jenj ON kelas_jenj_id = jenj_id
      WHERE jenj_id = 2 AND sis_id = $sis_id")->result_array();

  return $a;
}

function returnKelasXiisiswa($sis_id){
  $ci =& get_instance();

  $a = $ci->db->query(
    "SELECT d_s_id
      FROM d_s
      LEFT JOIN sis ON sis_id = d_s_sis_id
      LEFT JOIN kelas ON kelas_id = d_s_kelas_id
      LEFT JOIN jenj ON kelas_jenj_id = jenj_id
      WHERE jenj_id = 3 AND sis_id = $sis_id")->result_array();

  return $a;
}
