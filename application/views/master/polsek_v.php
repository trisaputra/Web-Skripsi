<!DOCTYPE html>
<html lang="en">
    {setMeta}
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/plugins/data-tables/DT_bootstrap.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/plugins/bootstrap-toastr/toastr.min.css"/>
    <link href="<?= base_url() ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
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
                                <a style="text-decoration: none" href="<?= site_url() ?>welcome">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>{nama_menu}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-table"></i>Tabel Data Polsek
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="tabelku">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%; text-align: center; vertical-align: middle"> # </th>
                                                    <th style="text-align: center; vertical-align: middle"> Nama Polsek </th>
                                                    <th style="width: 15%; text-align: center; vertical-align: middle"> No Telp </th>
                                                    <th style="width: 25%; text-align: center; vertical-align: middle"> Alamat </th>
                                                    <th style="width: 20%; text-align: center; vertical-align: middle">
                                                        <button id="tambah" data-target="#tambah_polsek" data-toggle="modal" class="btn btn-sm btn-circle btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="tambah_polsek" class="modal fade" aria-hidden="true">
                                        <div class="modal-dialog modal-detail">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="widget-box widget-color-red2">
                                                        <div class="widget-header">
                                                            <h4 class="widget-title lighter smaller">Tambah Polsek</h4>
                                                        </div>
                                                        <hr>
                                                        <div class="widget-body">
                                                            <form class="form-horizontal" action="#" id="formku" name="formku" style="margin-top: 15px">
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Polsek</label>
                                                                                <div class="col-md-8">
                                                                                    <input type="hidden" id="mode_form" name="mode_form" value="Tambah"/>
                                                                                    <input type="hidden" id="id_polsek" name="id_polsek"/>
                                                                                    <input type="text" id="nama_polsek" name="nama_polsek" class="form-control" autocomplete="off" placeholder="Masukkan Nama Polsek"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">No Telp</label>
                                                                                <div class="col-md-8">
                                                                                    <input type="number" id="no_telp" name="no_telp" class="form-control" autocomplete="off" placeholder="Masukkan No Telp"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Kecamatan</label>
                                                                                <div class="col-md-8">
                                                                                    <?= $this->Kecamatan_m->getDataComboBox('id_kecamatan') ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Kelurahan</label>
                                                                                <div class="col-md-8">
                                                                                    <select id ="id_kelurahan" name ="id_kelurahan" Class="select2me form-control"></select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Longitude</label>
                                                                                <div class="col-md-8">
                                                                                    <input type="text" id="lng" name="lng" class="form-control" autocomplete="off" placeholder="Masukkan Longitude"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Latitude</label>
                                                                                <div class="col-md-8">
                                                                                    <input type="text" id="lat" name="lat" class="form-control" autocomplete="off" placeholder="Masukkan Latitude"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Alamat</label>
                                                                                <div class="col-md-8">
                                                                                    <textarea rows="5" id="alamat_polsek" name="alamat_polsek" class="form-control" autocomplete="off" placeholder="Masukkan Alamat"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="form-actions fluid">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-offset-3 col-md-12">
                                                                                <button type="submit" class="btn btn-circle btn-sm btn-primary" id="simpan"><i class="fa fa-save"></i> Simpan</button>
                                                                                <button type="button" class="btn btn-circle btn-sm btn-danger" id="clear"><i class="fa fa-times"></i> Batal</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        <script type="text/javascript" src="<?= base_url() ?>assets/global/plugins/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/global/plugins/data-tables/DT_bootstrap.js"></script>
        <script src="<?= base_url() ?>assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap-toastr/toastr.min.js"></script> 
        <script src="<?= base_url() ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function () {
                App.init();
                $('#mn_master_kordinat').addClass('active');
                $('#mnm_polsek').addClass('active');

                var InitController = function () {
                    $('#id_kecamatan').on("change", function (e) {
                        var id_kecamatan = $('#id_kecamatan').val();
                        $.ajax({
                            method: 'POST',
                            dataType: 'json',
                            url: '<?= site_url() ?>master/do_cari_kelurahan',
                            data: {'id_kecamatan': id_kecamatan},
                            success: function (data) {
                                if (data.success === true) {
                                    $("#id_kelurahan").select2('val', "");
                                    $("#id_kelurahan").empty();

                                    $("#id_kelurahan").append('<option value=""></option>');
                                    for (i = 0; i < data.results.length; i++) {
                                        $("#id_kelurahan").append('<option value="' + data.results[i].id_kelurahan + '">' + data.results[i].nama_kelurahan + '</option>');
                                    }
                                } else {
                                    $("#id_kelurahan").select2('val', "");
                                    $("#id_kelurahan").empty();
                                }
                            },
                            fail: function (e) {
                                toastr.error(e);
                            }
                        });
                    });

                    var handleValidation = function () {
                        $('#formku').validate({
                            errorElement: 'span', //default input error message container
                            errorClass: 'help-block', // default input error message class
                            focusInvalid: true, // do not focus the last invalid input
                            ignore: "",
                            rules: {
                                nama_polsek: {
                                    required: true
                                },
                                alamat_polsek: {
                                    required: true
                                },
                                no_telp: {
                                    required: true
                                },
                                lng: {
                                    required: true
                                },
                                lat: {
                                    required: true
                                },
                                id_kecamatan: {
                                    required: true
                                },
                                id_kelurahan: {
                                    required: true
                                }
                            },
                            invalidHandler: function (event, validator) { //display error alert on form submit              
                                toastr.error("Maaf, Inputkan data dengan lengkap");
                            },
                            errorPlacement: function (error, element) { // render error placement for each input type
                                var icon = $(element).parent('.input-icon').children('i');
                                icon.removeClass('fa-check').addClass("fa-warning");
                                icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                            },
                            highlight: function (element) { // hightlight error inputs
                                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group   
                            },
                            unhighlight: function (element) { // revert the change done by hightlight
                            },
                            success: function (label, element) {
                                var icon = $(element).parent('.input-icon').children('i');
                                $(element).closest('.form-group').removeClass('has-error');
                                icon.removeClass("fa-warning");
                            },
                            submitHandler: function (form) {
                                $.blockUI();
                                $('#tambah_polsek').modal('hide');
                                $.ajax({
                                    method: 'POST',
                                    dataType: 'json',
                                    url: '<?= site_url() ?>master/do_Simpan_Polsek',
                                    data: $('#formku').serializeArray(),
                                    success: function (data) {
                                        if (data.success === true) {
                                            $.unblockUI();
                                            handleClearForm();
                                            toastr.success(data.msgServer);
                                            $('#tabelku').dataTable().fnClearTable();
                                        } else {
                                            $.unblockUI();
                                            toastr.warning(data.msgServer);
                                        }
                                    },
                                    fail: function (e) {
                                        $.unblockUI();
                                        toastr.error(e);
                                    }
                                });
                            }
                        });
                    };
                    var handleTable = function () {
                        if (!jQuery().dataTable) {
                            return;
                        }
                        // begin first table
                        $('#tabelku').dataTable({
                            "sDom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
                            "aLengthMenu": [
                                [5, 10, 15, 25, -1],
                                [5, 10, 15, 25, "All"] // change per page values here
                            ],
                            "bProcessing": true,
                            "bServerSide": true,
                            "sServerMethod": "POST",
                            "bRetrieve": true,
                            "sAjaxSource": "<?= site_url() ?>master/do_Tabel_Polsek",
                            // set the initial value
                            "iDisplayLength": 5,
                            "sPaginationType": "bootstrap_full_number",
                            "oLanguage": {
                                "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Please wait...',
                                "sLengthMenu": "_MENU_ records",
                                "oPaginate": {
                                    "sPrevious": "Prev",
                                    "sNext": "Next"
                                }
                            },
                            "aoColumnDefs": [{
                                    'bSortable': false,
                                    'aTargets': [0, 4]
                                }
                            ]
                        });
                        jQuery('#tabelku_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
                        jQuery('#tabelku_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown

                        // handle record edit/remove
                        $('body').on('click', '#tabelku_wrapper .btn-editable', function () {
                            $.blockUI();
                            $.ajax({
                                method: 'POST',
                                dataType: 'json',
                                url: '<?= site_url() ?>master/do_Ubah_Polsek',
                                data: {'id_polsek': $(this).attr("data-id")},
                                success: function (data) {
                                    if (data.success === true) {
                                        $.unblockUI();
                                        $('#mode_form').val(data.results.mode_form);
                                        $('#id_polsek').val(data.results.id_polsek);
                                        $('#nama_polsek').val(data.results.nama_polsek);
                                        $('#alamat_polsek').val(data.results.alamat_polsek);
                                        $('#no_telp').val(data.results.no_telp);
                                        $('#lng').val(data.results.lng);
                                        $('#lat').val(data.results.lat);
                                        $('#id_kecamatan').select2('val', data.results.id_kecamatan);

                                        $.ajax({
                                            method: 'POST',
                                            dataType: 'json',
                                            url: '<?= site_url() ?>master/do_cari_kelurahan',
                                            data: {'id_kecamatan': data.results.id_kecamatan},
                                            success: function (data2) {
                                                if (data2.success === true) {
                                                    $("#id_kelurahan").select2('val', "");
                                                    $("#id_kelurahan").empty();

                                                    $("#id_kelurahan").append('<option value=""></option>');
                                                    for (i = 0; i < data2.results.length; i++) {
                                                        $("#id_kelurahan").append('<option value="' + data2.results[i].id_kelurahan + '">' + data2.results[i].nama_kelurahan + '</option>');
                                                    }
                                                    $('#id_kelurahan').select2("val", data.results.id_kelurahan);
                                                } else {
                                                    $("#id_kelurahan").select2('val', "");
                                                    $("#id_kelurahan").empty();
                                                }
                                            },
                                            fail: function (e) {
                                                toastr.error(e);
                                            }
                                        });
                                        $('#tambah_polsek').modal('show');
                                    } else {
                                        $.unblockUI();
                                        toastr.warning(data.msgServer);
                                    }
                                },
                                fail: function (e) {
                                    $.unblockUI();
                                    toastr.error(e);
                                }
                            });
                        });

                        $('body').on('click', '#tabelku_wrapper .btn-removable', function () {
                            var id = $(this).attr("data-id");
                            var name = $(this).attr("data-name");
                            bootbox.dialog({
                                message: "Apakah anda yakin menghapus </br>Polsek : <b>" + name + "</b> ?",
                                title: "Konfirmasi Hapus",
                                buttons: {
                                    success: {
                                        label: "<i class='fa fa-check'></i> Ya",
                                        className: "green btn-circle",
                                        callback: function () {
                                            $.ajax({
                                                method: 'POST',
                                                dataType: 'json',
                                                url: '<?= site_url() ?>master/do_Hapus_Polsek',
                                                data: {'id_polsek': id},
                                                success: function (data) {
                                                    if (data.success === true) {
                                                        toastr.success(data.msgServer);
                                                        $('#tabelku').dataTable().fnClearTable();
                                                    } else {
                                                        toastr.warning(data.msgServer);
                                                    }
                                                },
                                                fail: function (e) {
                                                    toastr.error(e);
                                                }
                                            });
                                        }
                                    },
                                    danger: {
                                        label: "<i class='fa fa-times'></i> Tidak",
                                        className: "red btn-circle"
                                    }
                                }
                            });
                        });
                    };
                    return {
                        //main function to initiate the module
                        init: function () {
                            handleValidation();
                            handleTable();
                        }
                    };
                }();

                InitController.init();
            });

            $('#clear').on('click', function () {
                handleClearForm();
                $('#tambah_polsek').modal('hide');
            });

            $('#tambah').on('click', function () {
                handleClearForm();
            });

            function handleClearForm() {
                $('#formku').each(function () {
                    this.reset();
                });
                $('#mode_form').val('Tambah');
            }
        </script>
    </body>
</html>
