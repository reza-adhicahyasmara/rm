    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data User</h3>
                            <div class="text-right">

                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_user()" title="Add Data"><i class="fas fa-plus"></i> Add</button>
                                <a href="<?php echo base_url('user/download') ?>" type="button" class="btn btn-sm btn-outline-info" target="_blank" id="dwn_user" title="Download"><i class="fas fa-download"></i> Download</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabeluser" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="bg-info">
                                        <th>No.</th>
                                        <th>Nik</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Pekerjaan</th>
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
    <!-- /.modal -->


    <script type="text/javascript">
        var save_method; //for save method string
        var table;

        $(document).ready(function() {

            table = $("#tabeluser").DataTable({
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "sEmptyTable": "Data User Belum Ada"
                },
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('pasien/ajax_list') ?>",
                    "type": "POST"
                },
                //Set column definition initialisation properties.
                "columnDefs": [{
                        "targets": [-1], //last column
                        "render": function(data, type, row) {

                            if (row[4] == "N") {
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

        // Button Tabel

        function riset(id) {

            Swal.fire({
                title: 'Reset password?',
                text: "Pass Default: password123",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo site_url('user/reset'); ?>",
                        type: "POST",
                        data: "id=" + id,
                        cache: false,
                        dataType: 'json',
                        success: function(respone) {
                            if (respone.status == true) {
                                reload_table();
                                Swal.fire(
                                    'Reset!',
                                    'Your password has been reset.',
                                    'success'
                                );
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Reset password Error!!.'
                                });
                            }
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }
        //view
        function vuser(id) {
            // console.log(id);/
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('.modal-title').text('View User');
            $("#modal-default").modal('show');
            $.ajax({
                url: '<?php echo base_url('pasien/viewuser'); ?>',
                type: 'post',
                data: 'table=pasien&id=' + id,
                success: function(respon) {
                    $("#md_def").html(respon);
                }
            })
        }

        //delete
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
                    url: "<?php echo site_url('pasien/delete'); ?>",
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



        function add_user() {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Pasien'); // Set Title to Bootstrap modal title
        }

        function edit_user(id) {
            console.log(id);
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('pasien/edituser') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_user"]').val(data.nik);
                    $('[name="nik"]').val(data.nik);
                    $('[name="nama"]').val(data.nama);
                    $('[name="jk"]').val(data.JK);
                    $('[name="tgl"]').val(data.tgl_lahir);
                    $('[name="alamat"]').val(data.alamat);
                    $('[name="pekerjaan"]').val(data.pekerjaan);

                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function save() {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('pasien/insert') ?>";
            } else {
                url = "<?php echo site_url('pasien/update') ?>";
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

        var loadFile = function(event) {
            var image = document.getElementById('v_image');
            image.src = URL.createObjectURL(event.target.files[0]);
        };

        function batal() {
            $('#form')[0].reset();
            reload_table();
            var image = document.getElementById('v_image');
            image.src = "";
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
                        <div class="card-body">
                            <div class="form-group row ">
                                <label for="nik" class="col-sm-4 col-form-label">NIK</label>
                                <div class="col-sm-8 kosong">
                                    <input maxlength="16" minlength="14" type="text" class="form-control" name="nik" id="nik" placeholder="NIK">
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-8 kosong">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label for="jk" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-8 kosong">
                                    <select class="form-control" name="jk" id="jk">
                                        <option value="">-- Jenis Kelamin --</option>
                                        <option value="L">Laki Laki</option>
                                        <option value="P">Perempuan </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label for="tgl" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-8 kosong">
                                    <input type="date" class="form-control" name="tgl" id="tgl">
                                </div>
                            </div>

                            
                            <div class="form-group row ">
                                <label for="pekerjaan" class="col-sm-4 col-form-label">Pekerjaan</label>
                                <div class="col-sm-8 kosong">
                                    <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan">
                                </div>
                            </div>
                            
                            <div class="form-group row ">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8 kosong ">
                                    <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="5" style="resize: none;"></textarea>                                    
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