<section class="content-header">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <select class="form-control status" name="status" id="status">
                                    <option value="">Pilih Status</option>
                                    <option value="Semua Status">Semua Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                    
                                </select>
                                <button type="button" target="_blank" class="btn btn-warning" onclick="window.print()">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="content_rekam_medis">
                            <!--LOAD DATA-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_laporan_rekam_medis =  "<?php echo base_url('admin/laporan/rekam_medis'); ?>";
    var url = url_laporan_rekam_medis ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<!-----------------------LOAD HALAMAAN----------------------->
<script type="text/javascript">
    $('.status').select2({
        theme: 'bootstrap4',
    });

    $("#status").change(function() {
        var status = $(this).val();

        $.ajax({
            url : '<?php echo base_url('admin/laporan/load_data_laporan_rekam_medis'); ?>',
            method: 'POST',
            data: {status:status},
            async : false,
            beforeSend : function(){
                $('#content_rekam_medis').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
			success : function(response){
				$('#content_rekam_medis').html(response);
			}
        });     
    });    


</script>

</body>
</html>
