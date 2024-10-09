<!DOCTYPE html>
<html lang="en">
    {setMeta}
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
                                <span>Dashboard</span>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-houzz"></i>
                                </div>
                                <div class="details">
                                    <div class="number" style="padding-top: 3px">
                                        <span>{jmlKejadian}</span>
                                    </div>
                                    <div class="desc"> Jumlah Kejadian<br>Tahun <?= date('Y') ?> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="details">
                                    <div class="number" style="padding-top: 3px">
                                        <span>{jmlSelesai}</span>
                                    </div>
                                    <div class="desc"> Kejadian tahun <?= date('Y') ?><br>yang sudah selesai </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number" style="padding-top: 3px">
                                        <span>{jmlPetugas}</span>
                                    </div>
                                    <div class="desc"> Jumlah Petugas </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat yellow">
                                <div class="visual">
                                    <i class="fa fa-user-secret"></i>
                                </div>
                                <div class="details">
                                    <div class="number" style="padding-top: 3px">
                                        <span>{jmlPenduduk}</span>
                                    </div>
                                    <div class="desc"> Jumlah Penduduk </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3>Opsi Penanganan</h3>
                    <div class="row">
                        <?php
                        $color = array("dark", "blue", "purple", "red", "yellow");
                        $no = 0;
                        foreach ($mstPenanganan as $Fields) {
                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat <?= $color[$no] ?>">
                                    <div class="visual">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number" style="padding-top: 3px">
                                            <span><?= $this->Layout_m->getDataPenanganan($Fields->id_penanganan) ?></span>
                                        </div>
                                        <div class="desc"> Penanganan <?= $Fields->nama_penanganan ?><br>Tahun <?= date('Y') ?> </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($no == 4) {
                                $no = 0;
                            } else {
                                $no++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        {setFooter}
        {setJS}
        <script>
            jQuery(document).ready(function () {
                App.init();
                $('#mn_home').addClass('active');
            });
        </script>
    </body>
</html>
