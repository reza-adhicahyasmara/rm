<div class="row">
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Pasien</h3>
            </div>
            <div class="card-body">
                <strong><i class="fas fa-id-card mr-1"></i> NIK</strong>
                <p class="text-muted"><?php echo $pasien['nik'];?></p>
                <hr>
                <strong><i class="fas fa-user mr-1"></i> Nama</strong>
                <p class="text-muted"><?php echo $pasien['nama'];?></p>
                <hr>
                <strong><i class="far fa-user mr-1"></i> Jenis Kelamin</strong>
                <p class="text-muted"><?php echo $pasien['JK'];?></p>
                <hr>
                <strong><i class="far fa-calendar mr-1"></i> Tanggal Lahir</strong>
                <p class="text-muted"><?php echo $pasien['tgl_lahir'];?></p>
                <hr>
                <strong><i class="far fa-map mr-1"></i> Alamat</strong>
                <p class="text-muted"><?php echo $pasien['alamat'];?></p>
                <hr>
                <strong><i class="far fa-building mr-1"></i> Pekerjaan</strong>
                <p class="text-muted"><?php echo $pasien['pekerjaan'];?></p>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Riawayat</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Catat Riwayat</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <table style="width:100%" id="datatable_riwayat" class="table datatable table-striped">
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
                                    <th id="" style="text-align: center; vertical-align: middle; width:15%">...</th>
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
                                    <td style="text-align: center; vertical-align: middle;" >
                                        <button class='btn btn-primary view_pdf_riwayat' id_riwayat_rm="<?php echo $row->id_riwayat_rm; ?>"><i class="fa fa-file-pdf"></i></button>
                                    </td>
                                </tr>
                                <?php
                                        $no++;
                                    } 
                                ?>
                            </tbody>
                        </table>    
                    </div>


                    <div class="tab-pane" id="settings">
                        <form role="form" id="form_rekam_medis" method="post">
                            <input type="hidden" class="form-control" name="no_remed" id="no_remed" value="<?php echo $pasien['no_remed'];?>" placeholder="">
                            <div class="row">
                                <label for="id_user" class="col-sm-2 col-form-label">Dokter</label>
                                <div class="form-group col-sm-10">
                                    <select class="form-control id_user" name="id_user" id="id_user" readonly>
                                        <option value="<?php echo $this->session->userdata['id_user']; ?>"><?php echo $this->session->userdata['full_name']; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_poly" class="col-sm-2 col-form-label">Poli</label>
                                <div class="form-group col-sm-10">
                                    <select class="form-control id_poli" name="id_poli" id="id_poli" readonly>
                                        <option value="<?php echo $this->session->userdata['id_poli']; ?>"><?php echo $this->session->userdata['nama_poli']; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_poly" class="col-sm-2 col-form-label">Tanggal Pemeriksaan</label>
                                <div class="form-group col-sm-10">
                                    <input type="date" class="form-control" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan"  placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_poly" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                                <div class="form-group col-sm-10">
                                    <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk"  placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <label for="id_poly" class="col-sm-2 col-form-label">Tanggal Keluar</label>
                                <div class="form-group col-sm-10">
                                    <input type="date" class="form-control" name="tanggal_keluar" id="tanggal_keluar"  placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosa</label>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" name="diagnosis" id="diagnosis" value="" placeholder="Diagnosa konidisi pasien"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <label for="dokumen" class="col-sm-2 col-form-label">Dokumen</label>
                                <div class="form-group col-sm-10">
                                    <input class="form-control" accept=".pdf" type="file" id="customFile" name="file" />
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" id="btn_simpan_rekam_medis" class="btn bg-info"><span class="bx bx-fw bx-save"></span> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#datatable_riwayat').DataTable( {
            responsive: true
        });
    });

    const dateInput = document.getElementById('tanggal_pemeriksaan');
    const selectedDate = new Date();
    const formattedDate = selectedDate.toISOString().slice(0, 10);
    dateInput.value = formattedDate;
</script>


<!-----------------------EKSEKUSI----------------------->
<script type="text/javascript">
    
    $(document).ready(function() {
        $('#btn_simpan_rekam_medis').on("click",function(){

            var no_remed = $('#no_remed').val();
            $('#form_rekam_medis').validate({
                rules: {
                    tanggal_pemeriksaan: { required: true, },
                    tanggal_masuk: { required: true, },
                    tanggal_keluar: { required: true, },
                    diagnosis: { required: true, },
                },
                messages: {
                    tanggal_pemeriksaan: { required: "Harus diisi", },
                    tanggal_masuk: { required: "Harus diisi", },
                    tanggal_keluar: { required: "Harus diisi", },
                    diagnosis: { required: "Harus diisi", },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function() {
                    $("#form_rekam_medis").load('submit', function(e){
                        $.ajax({
                            url : '<?php echo base_url('dokter/rekam_medis/tambah_rekam_medis'); ?>',
                            method: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false, 
                            success: function(response){
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil Disimpan!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#17a2b8',
                                        timer: 3000
                                    }).then(function(){
                                        load_rekam_medis(no_remed);
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal!',
                                        text: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#17a2b8',
                                        timer: 3000
                                    })
                                }
                            }
                        }); 
                    }); 
                }
            });  
        });
    });

    
    function load_rekam_medis(no_remed){
        $.ajax({
            url : '<?php echo base_url('dokter/rekam_medis/load_data_rekam_medis'); ?>',
            method: 'POST',
            data: {no_remed:no_remed},
            async : false,
            beforeSend : function(){
                $('#content_rekam_medis').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
			success : function(response){
				$('#content_rekam_medis').html(response);
			}
        });     
    };    
</script>


<!-----------------------LIHAT PDF----------------------->
<script type="text/javascript">
    $('.view_pdf_riwayat').on("click",function(){ 
        var id_riwayat_rm = $(this).attr("id_riwayat_rm");
        var url = '<?php echo base_url('dokter/rekam_medis/view_pdf_riwayat'); ?>';

        $('#modal_pdf').modal('show');
        $('.modal-title').text('Berkas');
        $('.modal-load').load(url, {id_riwayat_rm:id_riwayat_rm});

    });
</script>