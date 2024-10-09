<!DOCTYPE html>
<html>
    <head>
        <title>Download Data</title>
    </head>
    <body>
        <style type="text/css">
            body{
                font-family: sans-serif;
            }
            table{
                margin: 20px auto;
                border-collapse: collapse;
            }
            table th,
            table td{
                border: 1px solid #3c3c3c;
                padding: 3px 8px;

            }
            a{
                background: blue;
                color: #fff;
                padding: 8px 10px;
                text-decoration: none;
                border-radius: 2px;
            }
        </style>

        <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Kekerasan " . $periode . ".xls");
        ?>

        <h1>Data Kekerasan {periode}</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Kejadian</th>
                    <th>Nama Korban</th>
                    <th>Jenis Korban</th>
                    <th>Jenis Kekerasan</th>
                    <th>Alamat Kejadian</th>
                    <th>Nama Kecamatan</th>
                    <th>Nama Kelurahan</th>
                    <th>Narasi Kejadian</th>
                    <th>Penyelesaian Kejadian</th>
                    <th>Jenis</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($getData) > 0) {
                    $j = 1;
                    for ($i = 0; $i < count($getData); $i++) {
                        if ($getData[$i]->cb_privasi == 't') {
                            $jenis = "Privasi";
                        } else {
                            $jenis = "Public";
                        }
                        if ($getData[$i]->st_kejadian == 't') {
                            $status = "Selesai";
                        } else {
                            $status = "Proses";
                        }
                        ?>
                        <tr>
                            <td><?= $j ?></td>
                            <td style="text-align: center"><?= date_format(date_create($getData[$i]->tgl_int), 'd M Y') ?></td>
                            <td><?= $getData[$i]->nama_penduduk ?></td>
                            <td><?= $getData[$i]->nama_jenis_user ?></td>
                            <td><?= $getData[$i]->nama_kekerasan ?></td>
                            <td><?= $getData[$i]->alamat ?></td>
                            <td><?= $getData[$i]->nama_kecamatan_user ?></td>
                            <td><?= $getData[$i]->nama_kelurahan_user ?></td>
                            <td><?= $getData[$i]->narasi ?></td>
                            <td><?= $getData[$i]->penyelesaian ?></td>
                            <td><?= $jenis ?></td>
                            <td><?= $status ?></td>
                        </tr>
                        <?php
                        $j++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="12" style="text-align: center">Data Tidak Ada</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>