<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Rekam Medis</h3>
                        <div class="text-right">

                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_user()" title="Add Data"><i class="fas fa-plus"></i> Add</button>
                            <a href="<?php echo base_url('user/download') ?>" type="button" class="btn btn-sm btn-outline-info" target="_blank" id="dwn_user" title="Download"><i class="fas fa-download"></i> Download</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabelRekam" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info">
                                    <th>No.</th>
                                    <th>No Rekam Medis</th>
                                    <th>NIK</th>
                                    <th>Nama Pasien</th>
                                    <th>Tanggal Kunjungan Awal</th>
                                    <th>Tanggal Kunjungan Akhir</th>
                                    <th>Diagnosa</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">View User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" id="md_def">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(function() {
        table = $("#tabelRekam").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data User Belum Ada"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //\Initial no order.
            "ajax": {
                "url": "<?php echo site_url('rekammedis/ajax_list') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                    "targets": [-1], //last column
                    "render": function(data, type, row) {
                        if (row[9] == "N") {
                            return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vuser(" + row[1] + ")\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-primary\"  href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_user(" + row[1] + ")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"deluser(" + row[1] + ")\"><i class=\"fas fa-trash\"></i></a>"
                        } else {
                            return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vuser(" + row[1] + ")\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_user(" + row[1] + ")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"deluser(" + row[1] + ")\"><i class=\"fas fa-trash\"></i></a>";
                        }


                    },
                    "orderable": false, //set not orderable

                },
                {
                    "targets": [0],

                },
            ],
        })
    });

    $("input").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
        $(this).removeClass('is-invalid');
    });
    $("textarea").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
        $(this).removeClass('is-invalid');
    });
    $("select").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
        $(this).removeClass('is-invalid');
    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    function vuser(id) {

        console.log(id);
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('.modal-title').text('View User');
        $("#modal-default").modal('show');
        $.ajax({
            url: '<?php echo base_url('rekammedis/viewuser'); ?>',
            type: 'post',
            data: 'table=rekam_medis&id=' + id,
            success: function(respon) {
                $("#md_def").html(respon);
            }
        })
    }

    function deluser(id) {
            Swal.fire({
                title: 'Apakah kamu yakin ingin menghapus data ini?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {

                $.ajax({
                    url: "<?php echo site_url('rekammedis/delete'); ?>",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    dataType: 'json',
                    success: function(respone) {
                        
                        if (respone.status == true) {
                            reload_table();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Delete Error!!.'
                            });
                        }
                    }
                });

            })
        }

    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;
        if (save_method == 'add') {
            url = "<?php echo site_url('Rekammedis/addRekamMedis') ?>";
        } else {
            url = "<?php echo site_url('rekammedis/update') ?>";
        }
        var formdata = new FormData($('#form')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formdata,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {   
                console.log(data)
                
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                    Toast.fire({
                        icon: 'success',
                        title: 'Success!!.'
                    });
                } else {
                    $('#modal_form').modal('hide');
                    reload_table();
                    Toast.fire({
                        icon: 'failed',
                        title: 'Failed  !!.'
                    });
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

                $('.selectpicker').attr('disabled', false);
                $('.selectpicker').selectpicker('refresh')




            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
                // alert('Error adding / update data');
                Toast.fire({
                    icon: 'error',
                    title: 'Error!!.'
                });
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }

    function edit_user(id) {
        console.log(id);
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('rekammedis/edituser') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_user"]').val(data.nik);

                $('[name="nik"]').val(data.nik);
                $('.selectpicker').attr('disabled', true);
                $('.selectpicker').selectpicker('refresh')
                // $('[name="nik"]').attr('readonly', 'yes');
                $('[name="diagnosa"]').val(data.diagnosa);
                $('[name="tgl_awal"]').val(data.tgl_awal);
                $('[name="tgl_akhir"]').val(data.tgl_akhir);
                $('[name="dokumenLama"]').val(data.dokumen);


                
                if (data.dokumen == null || data.dokumen == "") {
                    var image = "<?php echo base_url('assets/foto/user/default.png') ?>";
                    $("#v_image").attr("src", image);
                } else {
                    var image = "<?php echo base_url('assets/dokumen/') ?>";
                    $("#v_image").attr("src", image + data.dokumen);
                }

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Rekam Medis'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function add_user() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Rekam Medis'); // Set Title to Bootstrap modal title
    }

    function batal() {
        $('#form')[0].reset();
    }
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Pasien Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <!-- <?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'form')) ?> -->
                    <input type="hidden" value="" name="id_user" />
                    <input type="hidden" value="" name="dokumenLama" />
                    <div class="form-group row ">
                            <label for="id_remed" class="col-sm-4 col-form-label">No Rekam Medis</label>
                            <div class="col-sm-8 kosong ">
                                <input type="text" name="id_remed" class="form-control" id="id_remed" cols="30" rows="5" style="resize: none;"></input>
                            </div>
                        </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nik" class="col-sm-4 col-form-label">NIK</label>
                            <div class="col-sm-8">
                                <select name="nik" class="form-control selectpicker" data-live-search="true" title="Silahkan cari Nik Pasien">
                                    <?php foreach ($pasien as $key) : ?>
                                        <option data-tokens="<?= $key->nik ?>" value="<?= $key->nik ?>"><?= $key->nik ?> - <?= $key->nama ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>

                        </div>

                        <div class="form-group row ">
                            <label for="diagnosa" class="col-sm-4 col-form-label">Diagnosa</label>
                            <div class="col-sm-8 kosong ">
                                <textarea name="diagnosa" class="form-control" id="diagnosa" cols="30" rows="5" style="resize: none;"></textarea>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="tgl_awal" class="col-sm-4 col-form-label">Tanggal Awal</label>
                            <div class="col-sm-8 kosong">
                                <input type="date" class="form-control" name="tgl_awal" id="tgl_awal">
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="tgl_akhir" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                            <div class="col-sm-8 kosong">
                                <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir">
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="imagefile" class="col-sm-4 col-form-label">dokumen</label>
                            <div class="col-sm-8 kosong ">
                                <img id="v_image" width="100px" height="100px" src="">
                                <input type="file" class="form-control" name="dokumen" id="dokumen" placeholder="dokumen" accept="application/pdf, image/*">
                            </div>
                        </div>

                    </div>
                    <!-- <?php echo form_close(); ?> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" onclick="batal()" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->