<div style="text-align: center">
    <img src="<?php echo base_url('assets/foto/bg/logo.png');?>" style="width: 100px; height: 100px">
    <h3><strong> RS Permata Kuningan</strong></h3>
    <span>Cijoho, Kec. Kuningan, Kab. Kuningan, Jawa Barat 45513</span>
    </br>
    <span>(0232) 8905556</span>
    <hr>
    <h5><strong>Laporan Riwayat Rekam Medis</strong></h5>     
    </br>
</div>
</br>
<h5>Data Pasien</h5>
<table style="width:100%" id="" class="table table-borderless">
    <caption></caption>
    <thead>
        <tr>
            <td id="" style="text-align: left; vertical-align: middle;">NIK</td>
            <td id="" style="text-align: center; vertical-align: middle; width:3%">:</td>
            <td id="" style="text-align: left; vertical-align: middle; "><?php echo $pasien['nik'];?></td>
        </tr>
        <tr>
            <td id="" style="text-align: left; vertical-align: middle; ">Mama</td>
            <td id="" style="text-align: center; vertical-align: middle; width:3%">:</td>
            <td id="" style="text-align: left; vertical-align: middle; "><?php echo $pasien['nama'];?></td>
        </tr>
        <tr>
            <td id="" style="text-align: left; vertical-align: middle; ">Jenis Kelamin</td>
            <td id="" style="text-align: center; vertical-align: middle; width:3%">:</td>
            <td id="" style="text-align: left; vertical-align: middle; "><?php echo $pasien['JK'];?></td>
        </tr>
        <tr>
            <td id="" style="text-align: left; vertical-align: middle; ">Tanggal Lahir</td>
            <td id="" style="text-align: center; vertical-align: middle; width:3%">:</td>
            <td id="" style="text-align: left; vertical-align: middle; "><?php echo $pasien['tgl_lahir'];?></td>
        </tr>
        <tr>
            <td id="" style="text-align: left; vertical-align: middle; ">Alamat</td>
            <td id="" style="text-align: center; vertical-align: middle; width:3%">:</td>
            <td id="" style="text-align: left; vertical-align: middle; "><?php echo $pasien['alamat'];?></td>
        </tr>
        <tr>
            <td id="" style="text-align: left; vertical-align: middle; ">Pekerjaan</td>
            <td id="" style="text-align: center; vertical-align: middle; width:3%">:</td>
            <td id="" style="text-align: left; vertical-align: middle; "><?php echo $pasien['pekerjaan'];?></td>
        </tr>
        <tr>
            <td id="" style="text-align: left; vertical-align: middle; ">No. Rekam Medis</td>
            <td id="" style="text-align: center; vertical-align: middle; width:3%">:</td>
            <td id="" style="text-align: left; vertical-align: middle; "><?php echo $pasien['no_remed'];?></td>
        </tr>
        <tr>
            <td id="" style="text-align: left; vertical-align: middle; ">Status</td>
            <td id="" style="text-align: center; vertical-align: middle; width:3%">:</td>
            <td id="" style="text-align: left; vertical-align: middle; ">
                <?php
                    $currentDate = date('Y-m-d');
                    $fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
                    $tanggalTerakhir = $pasien['tgl_akhir'];

                    if ($tanggalTerakhir >= $fiveYearsAgo && $tanggalTerakhir <= $currentDate) {
                        echo '<span class="text-success">Aktif</span>';
                    } else {
                        echo '<span class="text-danger">Tidak Aktif</span>';
                    }
                ?>
            </td>
        </tr>
    </thead>
</table>
</br>
<hr>
<br>
<h5>Data Riwayat RM</h5>
<table style="width:100%" id="" class="table table-bordered">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal Pemeriksaan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Dokter</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Poli</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal Masuk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal Keluar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Diagnosis</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($riwayat as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemeriksaan;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->full_name;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_poli;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_masuk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_keluar;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->diagnosis;?></td>
        </tr>
        <?php
                $no++;
            } 
        ?>
    </tbody>
</table>    