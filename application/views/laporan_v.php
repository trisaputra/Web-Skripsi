<!DOCTYPE html>
<html lang="en">
    {setMeta}
    <link href="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        {setHeader}
        <div class="clearfix"> </div>
        <div class="page-container">
            {setMenu}
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="<?= site_url() ?>welcome" style="text-decoration: none">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Laporan</span>
                            </li>
                        </ul>
                    </div>
                    <div class="row" style="background-color: white; padding: 20px">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend><label style="font-weight: bold;">Kriteria</label> </legend>                                                                
                                        <div class="radio-list">
                                            <label><input type="radio" name="kriteria" id="kriteria" value="by_tanggal" checked> By Tanggal </label>
                                            <label class="control-label col-md-3">Tanggal</label>
                                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                                                <input type="text" id="tgl_sekarang" name="tgl_sekarang" class="form-control" value="<?php echo date('d-m-Y'); ?>" readonly >
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                            <label><input type="radio" name="kriteria" id="kriteria" value="by_bulan" > By Periode</label>
                                            <label class="control-label col-md-3">Tanggal</label>    
                                            <div class="input-group input-large date-picker input-daterange" data-date-format="dd-mm-yyyy">
                                                <input type="text" id="tgl_awal" name="tgl_awal" class="form-control" value="<?php echo date('d-m-Y'); ?>" readonly >
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                                <span class="input-group-addon">
                                                    s/d
                                                </span>
                                                <input type="text" id="tgl_akhir" name="tgl_akhir" class="form-control" value="<?php echo date('d-m-Y'); ?>" readonly >
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                            <label><input type="radio" name="kriteria" id="kriteria" value="by_tahun" > By Tahun</label>                                                                     
                                            <label class="control-label col-md-3">Tahun</label>  
                                            <div class="input-group input-medium" data-date-format="yyyy"> 
                                                <input type="text" id="id_tahun" name="id_tahun" class="form-control" value="<?php echo date('Y'); ?>" readonly >
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <hr>
                                    <button class="btn btn-danger btn-sm btn-circle" id="cetak"><i class="fa fa-print"></i> Cetak Laporan</button>
                                    <button class="btn btn-primary btn-sm btn-circle" style="display: none" id="download"><i class="fa fa-download"></i> Download Laporan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="background-color: white; padding: 20px; display: none" id="showTable">
                        <div class="col-md-12">
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-table"></i>Tabel Data
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="tabelku">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle"> # </th>
                                                    <th style="text-align: center; vertical-align: middle"> Tanggal </th>
                                                    <th style="text-align: center; vertical-align: middle"> Nama Pelapor </th>
                                                    <th style="text-align: center; vertical-align: middle"> Jenis Korban </th>
                                                    <th style="text-align: center; vertical-align: middle"> Jenis Kekerasan </th>
                                                    <th style="text-align: center; vertical-align: middle"> Alamat </th>
                                                    <th style="text-align: center; vertical-align: middle"> Narasi </th>
                                                    <th style="text-align: center; vertical-align: middle"> Penyelesaian </th>
                                                    <th style="text-align: center; vertical-align: middle"> Jenis </th>
                                                    <th style="text-align: center; vertical-align: middle"> Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {setFooter}
        {setJS}
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function () {
                App.init();
                $('#mn_laporan').addClass('active');

                $("#id_tahun").datepicker({
                    format: "yyyy",
                    weekStart: 1,
                    orientation: "top",
                    keyboardNavigation: false,
                    viewMode: "years",
                    minViewMode: "years"
                });
                $("#tgl_sekarang").datepicker({
                    format: "dd-mm-yyyy",
                    todayHighlight: !0,
                    orientation: "top left"
                });
                $("#tgl_awal").datepicker({
                    format: "dd-mm-yyyy",
                    todayHighlight: !0,
                    orientation: "top left"
                });
                $("#tgl_akhir").datepicker({
                    format: "dd-mm-yyyy",
                    todayHighlight: !0,
                    orientation: "top left"
                });
            });

            $('#cetak').on('click', function () {
                var id_tahun = $('#id_tahun').val();
                var tgl_sekarang = $('#tgl_sekarang').val();
                var tgl_awal = $('#tgl_awal').val();
                var tgl_akhir = $('#tgl_akhir').val();
                var kriteria = document.getElementsByName('kriteria');

                var hasil = "";
                for (var i = 0, length = kriteria.length; i < length; i++) {
                    if (kriteria[i].checked) {
                        hasil = kriteria[i].value;
                        break;
                    }
                }
                $('#tabelku tbody').html('');
                $('#showTable').hide();
                $('#download').hide();
                $.blockUI();
                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: '<?= site_url() ?>laporan/do_Kejadian',
                    data: {'kriteria': hasil, 'tgl_sekarang': tgl_sekarang, 'tgl_awal': tgl_awal, 'tgl_akhir': tgl_akhir, 'id_tahun': id_tahun},
                    success: function (data) {
                        if (data.success === true) {
                            $.unblockUI();
                            if (data.hasil.length > 0) {
                                for (var i = 0; i < data.hasil.length; i++) {
                                    var j = i + 1;
                                    var jenis;
                                    var color;
                                    if (data.hasil[i]['cb_privasi'] == 't') {
                                        jenis = "Privasi";
                                    } else {
                                        jenis = "Public";
                                    }
                                    var status;
                                    if (data.hasil[i]['st_kejadian'] == 't') {
                                        color = "#a6ffb3";
                                        status = "Selesai";
                                    } else {
                                        color = "#fff2a6";
                                        status = "Proses";
                                    }
                                    $("#tabelku tbody")
                                            .append(
                                                    '<tr style="background: ' + color + '">' +
                                                    '   <td style="text-align: center">' + j + '</td>' +
                                                    '   <td>' + rep_text(data.hasil[i]['tgl_kejadian']) + '</td>' +
                                                    '   <td>' + rep_text(data.hasil[i]['nama_penduduk']) + '</td>' +
                                                    '   <td>' + rep_text(data.hasil[i]['nama_jenis_user']) + '</td>' +
                                                    '   <td>' + rep_text(data.hasil[i]['nama_kekerasan']) + '</td>' +
                                                    '   <td>' + rep_text(data.hasil[i]['alamat']) + " Kel./Desa : " + data.hasil[i]['nama_kelurahan_user'] + " Kec. :" + data.hasil[i]['nama_kecamatan_user'] + '</td>' +
                                                    '   <td>' + rep_text(data.hasil[i]['narasi']) + '</td>' +
                                                    '   <td>' + rep_text(data.hasil[i]['penyelesaian']) + '</td>' +
                                                    '   <td>' + jenis + '</td>' +
                                                    '   <td>' + status + '</td>' +
                                                    '</tr>'
                                                    );
                                }
                                $('#showTable').show();
                                $('#download').show();
                            } else {
                                $("#tabelku tbody")
                                        .append(
                                                '<tr>' +
                                                '   <td colspan="10" style="text-align: center">Tidak Ada Data</td>' +
                                                '</tr>'
                                                );
                                $('#showTable').show();
                                $('#download').hide();
                            }
                        } else {
                            $.unblockUI();
                            aler(data.msgServer);
                        }
                    },
                    fail: function (e) {
                        $.unblockUI();
                    }
                });
            });
            $('#download').on('click', function () {
                var id_tahun = $('#id_tahun').val();
                var tgl_sekarang = $('#tgl_sekarang').val();
                var tgl_awal = $('#tgl_awal').val();
                var tgl_akhir = $('#tgl_akhir').val();
                var kriteria = document.getElementsByName('kriteria');

                var hasil = "";
                for (var i = 0, length = kriteria.length; i < length; i++) {
                    if (kriteria[i].checked) {
                        hasil = kriteria[i].value;
                        break;
                    }
                }
                window.open('<?= site_url() ?>laporan/doCetak/' + hasil + '/' + tgl_sekarang + '/' + tgl_awal + '/' + tgl_akhir + '/' + id_tahun, '_blank');
            });

            function rep_text(text) {
                var nilai;
                if (text == null) {
                    nilai = "";
                } else {
                    nilai = text;
                }
                return nilai;
            }
        </script>
    </body>
</html>
