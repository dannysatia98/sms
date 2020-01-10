$(document).ready(function () {

  function hitungsikap(){
    var sum = 0;
    $(".d_mpl_persen_sos").each(function(){
        sum += +$(this).val();
    });
    $(".total").html("Total Persentase Sikap Sosial: "+sum+"%");

    var sum2 = 0;
    $(".d_mpl_persen_spr").each(function(){
        sum2 += +$(this).val();
    });
    $(".total2").html("Total Persentase Sikap Spiritual: "+sum2+"%");

    //alert(sum);
  }
  hitungsikap();

  $(document).on("change", ".d_mpl_persen_sos", function() {
      var sum = 0;
      $(".d_mpl_persen_sos").each(function(){
          sum += +$(this).val();
      });
      $(".total").html("Total Persentase Sikap Sosial: "+sum+"%");
  }).change();

  $(document).on("change", ".d_mpl_persen_spr", function() {
      var sum2 = 0;
      $(".d_mpl_persen_spr").each(function(){
          sum2 += +$(this).val();
      });
      $(".total2").html("Total Persentase Sikap Spirit: "+sum2+"%");
  }).change();



  $('.custom-file-input').on('change', function () {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });

  $('.dt').DataTable({
    "ordering": false,
    "pageLength": 50
  });

  $(window).keydown(function (event) {
    if ((event.keyCode == 13) && ($(event.target)[0] != $("number")[0])) {
      event.preventDefault();
      return false;
    }
  });

  $('input[type=number]').each(function () {
    $(this).keydown(function (e) {
      var key = e.charCode || e.keyCode || 0;
      // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
      // home, end, period, and numpad decimal
      return (
        // numbers
        key >= 48 && key <= 57 ||
        // Numeric keypad
        key >= 96 && key <= 105 ||
        // Backspace and Tab and Enter
        key == 8 || key == 9 || key == 13 ||
        // Home and End
        key == 35 || key == 36 ||
        // left and right arrows
        key == 37 || key == 39 ||
        // Del and Ins
        key == 46 || key == 45);
    });

    $(this).change(function () {
      var max = parseInt($(this).attr('max'));
      var min = parseInt($(this).attr('min'));
      if ($(this).val() > max) {
        $(this).val(max);
      }
      else if ($(this).val() < min) {
        $(this).val(min);
      }

      if (!$(this).val()) {
        $(this).val(0);
      }
    });
  });


  ////////////////////////////////////
  //////UJIAN - INPUT/UPDATE//////////
  ////////////////////////////////////

  $('.kin').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin').index(this) + 1;
      $('.kin').eq(index).focus();
    }
  });

  $('.kin2').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin2').index(this) + 1;
      $('.kin2').eq(index).focus();
    }
  });

  $('.kin3').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin3').index(this) + 1;
      $('.kin3').eq(index).focus();
    }
  });

  $('.kin4').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin4').index(this) + 1;
      $('.kin4').eq(index).focus();
    }
  });

  $('.kin5').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin5').index(this) + 1;
      $('.kin5').eq(index).focus();
    }
  });

  $('.kin6').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin6').index(this) + 1;
      $('.kin6').eq(index).focus();
    }
  });

  $('.kin7').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin7').index(this) + 1;
      $('.kin7').eq(index).focus();
    }
  });

  $('.kin8').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin8').index(this) + 1;
      $('.kin8').eq(index).focus();
    }
  });

  /////////////////////////////
  //////END////////////////////
  /////////////////////////////

  ////////////////////////////////////
  //////COGNITIVE - PSYSCHOMOTOR//////
  //////////////INDEX/////////////////
  $('.kin9').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin9').index(this) + 1;
      $('.kin9').eq(index).focus();
    }
  });
  $('.kin10').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin10').index(this) + 1;
      $('.kin10').eq(index).focus();
    }
  });
  $('.kin11').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin11').index(this) + 1;
      $('.kin11').eq(index).focus();
    }
  });
  $('.kin12').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin12').index(this) + 1;
      $('.kin12').eq(index).focus();
    }
  });
  $('.kin13').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin13').index(this) + 1;
      $('.kin13').eq(index).focus();
    }
  });
  $('.kin14').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin14').index(this) + 1;
      $('.kin14').eq(index).focus();
    }
  });
  $('.kin15').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin15').index(this) + 1;
      $('.kin15').eq(index).focus();
    }
  });
  $('.kin16').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin16').index(this) + 1;
      $('.kin16').eq(index).focus();
    }
  });
  $('.kin17').keydown(function (e) {
    if (e.which === 13) {
      var index = $('.kin17').index(this) + 1;
      $('.kin17').eq(index).focus();
    }
  });

  function refresh_colspan_ket(){
    var total = parseInt($('.opt_prak').val()) + parseInt($('.opt_prod').val()) + parseInt($('.opt_proy').val()) + parseInt($('.opt_porto').val());
    $('.th_ket').attr('colspan',total);
    //alert(total);
  }

  function hideCustom(nama, awal, jum){
    for(var i=awal;i<=jum;i++){
      $('.'+nama+i).hide();
    }
  }

  function setNol(nama, awal, akhir){
    for(var i=awal;i<=akhir;i++){
      $('.'+nama+i).val(0);

    }
  }
  //nilai harian
  $('.opt_peng').on('change', function () {
    var total = $(this).val();
    hideCustom('nh',parseInt(total)+1,5);
    $('.th_peng').attr('colspan',total);
    for(var i=1;i<=total;i++){
      $('.nh'+i).show();
    }
    setNol('_nh',parseInt(total)+1,5);

  }).change();

  //praktek
  $('.opt_prak').on('change', function () {
    var total = $(this).val();
    hideCustom('pr',parseInt(total)+1,3);
    $('.th_pr').attr('colspan',total);
    for(var i=1;i<=total;i++){
      $('.pr'+i).show();
    }
    setNol('_pr',parseInt(total)+1,3);
    refresh_colspan_ket();

  }).change();

  //Produk
  $('.opt_prod').on('change', function () {
    var total = $(this).val();
    hideCustom('prod',parseInt(total)+1,3);
    $('.th_prod').attr('colspan',total);
    for(var i=1;i<=total;i++){
      $('.prod'+i).show();
    }
    setNol('_prod',parseInt(total)+1,3);
    refresh_colspan_ket();

  }).change();

  //Proyek
  $('.opt_proy').on('change', function () {
    var total = $(this).val();
    hideCustom('proy',parseInt(total)+1,3);
    $('.th_proy').attr('colspan',total);
    for(var i=1;i<=total;i++){
      $('.proy'+i).show();
    }
    setNol('_proy',parseInt(total)+1,3);
    refresh_colspan_ket();

  }).change();

  //porto
  $('.opt_porto').on('change', function () {
    var total = $(this).val();
    hideCustom('porto',parseInt(total)+1,3);
    $('.th_porto').attr('colspan',total);
    for(var i=1;i<=total;i++){
      $('.porto'+i).show();
    }
    setNol('_porto',parseInt(total)+1,3);
    refresh_colspan_ket();

  }).change();

  $('#t_all_tes').change(function () {
    var id = $(this).val();

    $('#mapel_tes').html("");
    $('#kelas_tes').html("");
    $('#topik_ajax').html("");

    $.ajax(
      {
        type: "post",
        url: base_url + "Tes_CRUD/get_kelas",
        data: {
          'id': id,
        },
        async: true,
        dataType: 'json',
        success: function (data) {
          //console.log(data);
          if (data.length == 0) {
            var html = '<div class="text-center mt-3 mb-3 text-danger"><b>--Kelas tidak ada, silahkan hubungi kurikulum--</b></div>';
          } else {
            var html = '<select name="kelas_id" id="kelas_tes_id" class="form-control mt-3 mb-3">';
            var i;
            html += '<option value= 0>Pilih Kelas</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value=' + data[i].kelas_id + '>' + data[i].kelas_nama + '</option>';
            }
            html += '</select>';
          }

          $('#kelas_tes').html(html);
          refKelasTes();
        }
      });
  });

  function refKelasTes(){
    $('#kelas_tes_id').change(function () {
      var id = $(this).val();
      var flag = $('#uj_flag').val();

      $('#topik_ajax').html("");
      $('#mapel_tes').html("");

      $.ajax(
        {
          type: "post",
          url: base_url + "Tes_CRUD/get_mapel",
          data: {
            'id': id,
          },
          async: true,
          dataType: 'json',
          success: function (data) {
            console.log(data);
            if (data.length == 0) {
              var html = '<div class="text-center mt-3 mb-3 text-danger"><b>--Mapel tidak ada, silahkan hubungi kurikulum--</b></div>';
            } else {
              var html = '<select name="mapel_id" id="mapel_tes_id" class="form-control mt-3 mb-3">';
              var i;
              if(flag!=0){
                html += '<option value=0>Pilih Mapel</option>';
              }
              for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].mapel_id + '>' + data[i].mapel_nama + ' ('+ data[i].mapel_sing + ')' + '</option>';
              }
              html += '</select>';
            }

            if(flag==0){
              html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
              html += 'Input';
              html += '</button>';
            }

            //alert(flag);
            $('#mapel_tes').html(html);
            if(!flag){
              refMapelTes();
            }
          }
        });
    });
  }

  function refMapelTes(){
    $('#mapel_tes_id').change(function () {
      var id = $(this).val();
      var kelas_id = $('#kelas_tes_id').val();
      var flag = $('#uj_flag').val();

      if (id == 0) {
        $('#topik_ajax').html("");
      }

      $.ajax(
        {
          type: "post",
          url: base_url + "Tes_CRUD/get_topik",
          data: {
            'id': id,
            'kelas_id': kelas_id,
          },
          async: true,
          dataType: 'json',
          success: function (data) {

            //console.log(data);
            if (data.length == 0) {
              var html = '<div class="text-center mb-3 text-danger"><b>--KD tidak ada, silahkan hubungi kurikulum--</b></div>';
            } else {
              var html = '<select name="topik_id" id="topik_id" class="form-control mb-3">';
              var i;
              for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].topik_id + '>' + data[i].topik_nama.substring(0, 50) +' / '+ data[i].topik_nama_ket.substring(0, 50) + ' (Semester: ' + data[i].topik_semester + ')</option>';
              }
              html += '</select>';

              html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
              html += 'Input Nilai Harian';
              html += '</button>';
            }

            $('#topik_ajax').html(html);

          }
        });
    });
  }

  /////////////////////////////
  //////END////////////////////
  /////////////////////////////

  /////////////////////////////
  //////////sosial////////////
  ///////////////////////////
  function refMapelSos(){
    $('#mapel_tes_id').change(function () {
      var id = $(this).val();
      var kelas_id = $('#kelas_tes_id').val();

      if (id == 0) {
        $('#topik_ajax').html("");
      }

      $.ajax(
        {
          type: "post",
          url: base_url + "sosaf_CRUD/get_topik",
          data: {
            'id': id,
            'kelas_id': kelas_id,
          },
          async: true,
          dataType: 'json',
          success: function (data) {
            //console.log(data);
            if (data.length == 0) {
              var html = '<div class="text-center mb-3 text-danger"><b>--KD Sosial tidak ada, silahkan hubungi kurikulum--</b></div>';
            } else {
              var html = '<select name="sosial_id" id="sosial_id" class="form-control mb-3">';
              var i;
              for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].sosial_id + '>' + data[i].sosial_nama.substring(0, 50) + ' (Semester: ' + data[i].sosial_semester + ')</option>';
              }
              html += '</select>';

              html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
              html += 'Input Nilai Sosial';
              html += '</button>';
            }

            $('#topik_ajax').html(html);

          }
        });
    });
  }

  /////////////////////////////
  /////////////////////////////
  //////////spirit////////////
  ///////////////////////////
  function refMapelSpr(){
    $('#mapel_tes_id').change(function () {
      var id = $(this).val();
      var kelas_id = $('#kelas_tes_id').val();

      if (id == 0) {
        $('#topik_ajax').html("");
      }

      $.ajax(
        {
          type: "post",
          url: base_url + "spraf_CRUD/get_topik",
          data: {
            'id': id,
            'kelas_id': kelas_id,
          },
          async: true,
          dataType: 'json',
          success: function (data) {
            //console.log(data);
            if (data.length == 0) {
              var html = '<div class="text-center mb-3 text-danger"><b>--KD Spiritual tidak ada, silahkan hubungi kurikulum--</b></div>';
            } else {
              var html = '<select name="spirit_id" id="spirit_id" class="form-control mb-3">';
              var i;
              for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].spirit_id + '>' + data[i].spirit_nama.substring(0, 50) + ' (Semester: ' + data[i].spirit_semester + ')</option>';
              }
              html += '</select>';

              html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
              html += 'Input Nilai Spiritual';
              html += '</button>';
            }

            $('#topik_ajax').html(html);

          }
        });
    });
  }

  /////////////////////////////

  ////////////////////////////////////
  //////////////KOMEN////////////////
  //////////////INDEX/////////////////

  $('#kelas_komen').change(function () {
    var id = $(this).val();

    if (id == 0) {
      $('#siswa_ajax').html("");
      $('#komen_ajax').html("");
    }

    $.ajax(
      {
        type: "post",
        url: base_url + "Komen_CRUD/get_siswa",
        data: {
          'id': id,
        },
        async: true,
        dataType: 'json',
        success: function (data) {
          //console.log(data);
          if (data.length == 0) {
            var html = '<div class="text-center mb-3 text-danger"><b>--No Student, Contact School Administrative Officer--</b></div>';
          } else {
            var html = '<select name="d_s_id" id="komen_sis_id" class="form-control mb-3 komen_sis_id">';
            html += '<option value="0">Select Student</option>';
            var i;
            for (i = 0; i < data.length; i++) {
              html += '<option value=' + data[i].d_s_id + '>' + data[i].sis_nama_depan + '</option>';
            }
            html += '</select>';
          }

          $('#siswa_ajax').html(html);
          refreshEvent();
        }
      });
  });
  function refreshEvent() {
    $('.komen_sis_id').change(function () {
      var id = $(this).val();
      //alert(id);
      if (id == 0) {
        $('#komen_ajax').html("");
      }

      $.ajax(
        {
          type: "post",
          url: base_url + "Komen_CRUD/get_komen",
          data: {
            'id': id,
          },
          async: true,
          dataType: 'json',
          success: function (data) {
            if (data.length == 0) {
              var html = '<div class="text-center mb-3 text-danger"><b>--Something went wrong, contact admin/developer--</b></div>';
            } else {
              //console.log(data);
              var html = "";
              var d_s_sick = "";
              var d_s_absenin = "";
              var d_s_absenex = "";
              var d_s_sick2 = "";
              var d_s_absenin2 = "";
              var d_s_absenex2 = "";
              if (data[0].d_s_sick) {
                d_s_sick = data[0].d_s_sick;
              }
              if (data[0].d_s_absenin) {
                d_s_absenin = data[0].d_s_absenin;
              }
              if (data[0].d_s_absenex) {
                d_s_absenex = data[0].d_s_absenex;
              }
              if (data[0].d_s_sick2) {
                d_s_sick2 = data[0].d_s_sick2;
              }
              if (data[0].d_s_absenin2) {
                d_s_absenin2 = data[0].d_s_absenin2;
              }
              if (data[0].d_s_absenex2) {
                d_s_absenex2 = data[0].d_s_absenex2;
              }
              //SEM 1
              html += '<h5 class="ml-2 mt-3"><u>Semester 1</u></h5>';
              html += '<textarea rows="4" name="d_s_komen_sis" class="form-control mb-2" placeholder="Saran Pada Sisipan" maxlength="300">';
              if (data[0].d_s_komen_sis) {
                html += data[0].d_s_komen_sis;
              }
              html += '</textarea>';

              html += '<textarea rows="4" name="d_s_komen_sem" class="form-control mb-2" placeholder="Saran Pada Semester" maxlength="300">';
              if (data[0].d_s_komen_sem) {
                html += data[0].d_s_komen_sem;
              }
              html += '</textarea>';

              //SEM 2
              html += '<h5 class="ml-2 mt-3"><u>Semester 2</u></h5>';
              html += '<textarea rows="4" name="d_s_komen_sis2" class="form-control mb-2" placeholder="Saran Pada Sisipan" maxlength="300">';
              if (data[0].d_s_komen_sis2) {
                html += data[0].d_s_komen_sis2;
              }
              html += '</textarea>';

              html += '<textarea rows="4" name="d_s_komen_sem2" class="form-control mb-2" placeholder="Saran Pada Semester" maxlength="300">';
              if (data[0].d_s_komen_sem2) {
                html += data[0].d_s_komen_sem2;
              }
              html += '</textarea>';

              html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
              html += 'Insert Comment';
              html += '</button>';

            }

            $('#komen_ajax').html(html);

          }
        });
    });
  }


  /////////////////////////////
  //////END////////////////////
  /////////////////////////////

  /////////////////////////////
  /////////LAPORAN/////////////
  ////////////////////////////
  $('#t_all_laporan').change(function () {
    var id = $(this).val();

    // $('#mapel_tes').html("");
    $('#kelas_laporan').html("");
    // $('#topik_ajax').html("");

    $.ajax(
      {
        type: "post",
        url: base_url + "Tes_CRUD/get_kelas",
        data: {
          'id': id,
        },
        async: true,
        dataType: 'json',
        success: function (data) {
          //console.log(data);
          if (data.length == 0) {
            var html = '<div class="text-center mt-3 mb-3 text-danger"><b>--Kelas tidak ada, silahkan hubungi kurikulum--</b></div>';
          } else {
            var html = '<select name="kelas_id" id="kelas_laporan_id" class="form-control mt-3 mb-3">';
            var i;
            html += '<option value= 0>Pilih Kelas</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value=' + data[i].kelas_id + '>' + data[i].kelas_nama + '</option>';
            }
            html += '</select>';
          }

          $('#kelas_laporan').html(html);
          refKelasLaporan();
        }
      });
  });

  function refKelasLaporan(){
    $('#kelas_laporan_id').change(function () {
      var id = $(this).val();
      //alert(id);
      $('#mapel_laporan').html("");

      $.ajax(
        {
          type: "post",
          url: base_url + "Tes_CRUD/get_mapel",
          data: {
            'id': id,
          },
          async: true,
          dataType: 'json',
          success: function (data) {
            console.log(data);
            if (data.length == 0) {
              var html = '<div class="text-center mt-3 mb-3 text-danger"><b>--Mapel tidak ada, silahkan hubungi kurikulum--</b></div>';
            } else {
              var html = '<select name="mapel_id" id="mapel_tes_id" class="form-control mt-3 mb-3">';
              var i;

              for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].mapel_id + '>' + data[i].mapel_nama + '</option>';
              }
              html += '</select>';
            }

            html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
            html += 'Lihat Laporan';
            html += '</button>';
            //alert(flag);
            $('#mapel_laporan').html(html);
          }
        });
    });
  }
  ///////print area////////////
  $("#export_excel").click(function (e) {
    //alert("hai");
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#print_area').html()));
    e.preventDefault();
  });

  /////////////////////////////
  ///////Report Print//////////
  /////////////////////////////
  $('#t').change(function () {
    var id = $(this).val();

    $('#kelas_ajax').html("");
    $('#siswa_ajax').html("");

    $.ajax(
      {
        type: "post",
        url: base_url + "Report_CRUD/get_kelas",
        data: {
          'id': id,
        },
        async: true,
        dataType: 'json',
        success: function (data) {
          //console.log(data);
          if (data.length == 0) {
            var html = '<div class="text-center mb-3 text-danger"><b>--Kelas tidak ada silahkan tambah kelas--</b></div>';
          } else {
            var html = '<select name="kelas_id" id="kelas_id" class="form-control mb-3 kelas_id">';
            html += '<option value="0">Pilih Kelas</option>';
            var i;
            for (i = 0; i < data.length; i++) {
              html += '<option value=' + data[i].kelas_id + '>' + data[i].kelas_nama + '</option>';
            }
            html += '</select>';
          }

          $('#kelas_ajax').html(html);
          refreshEventKelas();
        }
      });
  });

  function refreshEventKelas() {
    $('.kelas_id').change(function () {
      var id = $(this).val();
      //alert(id);
      if (id == 0) {
        $('#siswa_ajax').html("");
      }

      $.ajax(
        {
          type: "post",
          url: base_url + "Report_CRUD/get_siswa",
          data: {
            'id': id,
          },
          async: true,
          dataType: 'json',
          success: function (data) {
            if (data.length == 0) {
              var html = '<div class="text-center mb-3 text-danger"><b>--Siswa tidak ada, silahkan tambahkan siswa--</b></div>';
            } else {
              var i;
              html = "";

              html += '<hr><div class="form-group d-flex justify-content-center"><label class="checkbox-inline mr-2"><input class="checkAll" type="checkbox"> <b><u>CHECK ALL</u></b></label></div><hr>';


              for (i = 0; i < data.length; i++) {
                html += '<div class="checkbox ml-2">';
                html += '<label><input type="checkbox" name="siswa_check[]" class="sisC" value="' + data[i].d_s_id + '"> ' + data[i].sis_nama_depan + ' ' + data[i].sis_nama_bel + '</label>';
                html += '</div>';
              }

              html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
              html += 'Proses';
              html += '</button>';

            }

            $('#siswa_ajax').html(html);
            refreshCheck();

          }
        });
    });
  }

  function refreshCheck() {
    $(".checkAll").click(function () {
      $('input.sisC:checkbox').not(this).prop('checked', this.checked);
    });
  }

  $('#pJenis').change(function () {
    var id = $(this).val();
    if(id > 1){
      $('#pilihan_sisipan').hide();
    }else{
      $('#pilihan_sisipan').show();
    }
  }).change();

  /////////////////////////////
  /////////////////////////////
  ////////SSP EDIT STUDENT//////

  var sspId = $("#sspInputId").val();
  if (sspId) {
    setInterval(function () {
      refreshSspList();
    }, 3000);
  }

  function refreshSspList() {
    var sspId = $("#sspInputId").val();


    $.ajax({
      url: base_url + 'SSP_grade_CRUD/get_siswaSSP',
      data: {
        'sspId': sspId,
      },
      type: 'POST',
      async: true,
      dataType: 'json',
      success: function (data) {
        //console.log(data);
        if (data.length == 0) {
          var html = '<div class="text-center mb-3 text-danger"><b>--No Data--</b></div>';
        } else {
          var i;
          //alert(data.length);
          html = "";
          html += '<table class="table table-sm">';
          html += '<thead>';
          html += '<tr>';
          html += '<th class="w-50">Student Name</th>';
          html += '<th>Class</th>';
          html += '<th>Action</th>';
          html += '</tr>';
          html += '</thead>';
          html += '<tbody>';
          for (i = 0; i < data.length; i++) {
            html += '<tr>';
            html += '<td>' + data[i].sis_nama_depan + ' ' + data[i].sis_nama_bel + '</td>';
            html += '<td>' + data[i].kelas_nama + '</td>';
            html += '<td>';
            html += '<form method="post" action="' + base_url + 'SSP_CRUD/deleteSiswaSSP">';
            html += '<input type="hidden" name="d_s_id" value= ' + data[i].d_s_id + '>';
            html += '<input type="hidden" name="ssp_id" value= ' + sspId + '>';
            html += '<button type="submit" class="ml-2 btn btn-danger">';
            html += '<i class="fa fa-trash-alt"></i>';
            html += '</button>';
            html += '</form>';
            html += '</td>';
            html += '</tr>';
          }
          html += '</tbody>';
          html += '</table><hr>';

        }

        $('#siswaSSPAjax').html(html);
      }
    });
  }

  $('#kelas_ssp').change(function () {
    var id = $(this).val();
    var id2 = $("#sspInputId").val();
    //alert(id);
    if (id == 0) {
      $('#siswaKelasAjax').html("");
    }

    $.ajax(
      {
        type: "post",
        url: base_url + "SSP_grade_CRUD/get_siswaKelas",
        data: {
          'id': id,
          'id2': id2,
        },
        async: true,
        dataType: 'json',
        success: function (data) {
          console.log(data);
          html = "";
          if (data.length == 0) {
            var html = '<div class="text-center mb-3 text-danger"><b>--No Student(s) available--</b></div>';
          } else {
            var i;
            html += '<form method="post" class="sspEditStudentForm" id="sspEditStudentForm" action="' + base_url + 'SSP_grade_CRUD/addStudent">';
            html += '<div><input type="hidden" name="sspId" value="' + sspId + '"</div>';
            for (i = 0; i < data.length; i++) {
              html += '<div class="checkbox ml-2">';
              html += '<label><input type="checkbox" name="siswa_check[]" class="sisC" value="' + data[i].d_s_id + '"> ' + data[i].sis_nama_depan + ' ' + data[i].sis_nama_bel + '</label>';
              html += '</div>';
            }

            html += '<button type="submit" class="btn btn-primary btn-user btn-block">';
            html += 'Daftarkan ke Ekskul';
            html += '</button>';
            html += '</form>';
          }

          $('#siswaKelasAjax').html(html);
          refreshsspEditStudentForm();
        }
      });
  });

  function refreshsspEditStudentForm() {
    $(".sspEditStudentForm").submit(function (evt) {
      evt.preventDefault();

      if ($('.sspEditStudentForm :checkbox:checked').length > 0) {
        // one or more checkboxes are checked
        var form = $(this);
        $.ajax({
          url: base_url + "SSP_grade_CRUD/addStudent",
          data: form.serialize(),
          type: "POST",
          dataType: "html",
          success: function (data) {
            //alert(data);
            $(".sspMsg").html(data);
            $("#sspEditStudentForm")[0].reset();
            $('#kelas_ssp').change();
          }
        });
      }
      else {
        $(".sspMsg").html("<div class='alert alert-danger' role='alert'>Please select one or more students</div>");
      }

    });
  }

  /////////////////////
  /////PRINT//////////
  ////////////////////
  $("#print_rekap").click(function () {
    //alert(base_url);
    $('#print_area').printThis({
      importCSS: false,
      importStyle: true,//thrown in for extra measure
      loadCSS: base_url + "css/rapot.css"
    });
  });

  //////////////////////////////
  /////////////////////////////
  ////////TOPIK INDEX//////////
  /////////////////////////////
  $('#sub_topik_crud').hide();
  $('#topik_mapel').change(function () {
    var id = $(this).val();

    if (id == 0) {
      $('#topik_mapel_ajax').html("");
      $('#topik_sosial_mapel_ajax').html("");
      $('#sub_topik_crud').hide();
    } else {
      $('#sub_topik_crud').show();
    }

    $('#mapel_id_sos').val(id);
    $('#mapel_id_spirit').val(id);
    $('#mapel_id').val(id);

    $.ajax(
      {
        type: "post",
        url: base_url + "Topik_CRUD/get_topik_detail",
        data: {
          'id': id,
        },
        async: true,
        dataType: 'json',
        success: function (data) {
          //console.log(data);

          var html = '<h5 class="text-center"><u><b>Pengetahuan dan Keterampilan</b></u></h5><br><table class="table table-bordered table-sm">';
          html += '<thead class="thead-dark">';
          html += '<tr>';
          html += '<th>Jenjang</th>';
          html += '<th>Semester</th>';
          html += '<th>KD Pengetahuan</th>';
          html += '<th>KD Keterampilan</th>';
          html += '<th>Urutan KD</th>';
          html += '<th>Action</th>';
          html += '</tr>';
          html += '</thead>';

          html += '<tbody>';
          if (data.length != 0) {
            for (var i = 0; i < data.length; i++) {
              html += '<tr>';
              html += '<td>' + data[i].jenj_nama + '</td>';
              html += '<td>' + data[i].topik_semester + '</td>';
              html += '<td>' + data[i].topik_nama + '</td>';
              html += '<td>' + data[i].topik_nama_ket + '</td>';
              html += '<td>' + data[i].topik_urutan + '</td>';
              html += '<td>';
              html += '<form method="post" action="' + base_url + 'topik_CRUD/edit">';

              html += '<input type="hidden" value="' + data[i].topik_id + '" name="topik_id">';
              html += '<input type="hidden" value="' + data[i].topik_mapel_id + '" name="mapel_id">';
              html += '<button type="submit" class="badge badge-warning">';
              html += 'Edit';
              html += '</button>';

              html += '</form>';

              html += '<form method="post" action="' + base_url + 'topik_CRUD/delete">';

              html += '<input type="hidden" value="' + data[i].topik_id + '" name="topik_id">';
              html += '<input type="hidden" value="' + data[i].topik_mapel_id + '" name="mapel_id">';
              html += '<button type="submit" class="badge badge-danger">';
              html += 'Delete';
              html += '</button>';

              html += '</form>';
              html += '</td>';
              html += '</tr>';
            }
          } else {
            html += '<td colspan="6" class="text-center table-danger"><b>--Tidak ada KD, silahkan tambahkan KD--</b></td>';
          }
          html += '</tbody>';
          html += '</table> <hr>';


          //alert(html);

          $('#topik_mapel_ajax').html(html);

        }
      });
  });


});
