<div style="text-align: center">
    <img src="<?php echo base_url('assets/foto/bg/logo.png');?>" style="width: 100px; height: 100px">
    <h3><strong> RS Permata Kuningan</strong></h3>
    <span>Cijoho, Kec. Kuningan, Kab. Kuningan, Jawa Barat 45513</span>
    </br>
    <span>(0232) 8905556</span>
    <hr>
    <h5><strong>Laporan Rekam Medis - Status : <?php echo $status; ?></strong></h5>     
    </br>
</div>
</br>
<h5>Data Rekam Medis</h5>
<table style="width:100%" id="" class="table table-bordered">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">RM</th>
            <th id="" style="text-align: center; vertical-align: middle; ">NIK</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Jenis Kelamin</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Pekerjaan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Pendaftaran</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Terkahir Pemeriksaan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($rekam_medis as $row) {
                $currentDate = date('Y-m-d');
                $fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
                $tanggalTerakhir = $row->tgl_akhir;
            
                if ($tanggalTerakhir >= $fiveYearsAgo && $tanggalTerakhir <= $currentDate) {
                    $statusnya = "Aktif";
                } else {
                    $statusnya = "Tidak Aktif";
                }
            
                if (($status == 'Aktif' && $statusnya == 'Aktif') ||
                    ($status == 'Tidak Aktif' && $statusnya == 'Tidak Aktif') ||
                    $status == 'Semua Status') {
                    
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_remed;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nik;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->JK;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->pekerjaan;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tgl_awal;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tgl_akhir;?></td>
            <td style="text-align: left; vertical-align: middle;">
                <?php
                    $currentDate = date('Y-m-d');
                    $fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
                    $tanggalTerakhir = $row->tgl_akhir;

                    if ($tanggalTerakhir >= $fiveYearsAgo && $tanggalTerakhir <= $currentDate) {
                        echo '<span class="text-success">Aktif</span>';
                    } else {
                        echo '<span class="text-danger">Tidak Aktif</span>';
                    }
                ?>
            </td>
        </tr>
        <?php
                    $no++;
                }
            } 
        ?>
    </tbody>
</table>    