<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Rekam Medis Pasien</h3>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <select class="form-control no_remed" name="no_remed" id="no_remed">
                                    <option value="">No. RM</option>
                                    <?php foreach($data_rm as $row){ ?>
                                        <option value="<?php echo $row->no_remed; ?>"><?php echo $row->no_remed; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        
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


<div id="modal_pdf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-load">
                <!-- FORM -->
            </div>
        </div>
    </div>
</div>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_rekam_medis =  "<?php echo base_url('dokter/rekam_medis'); ?>";
    var url = url_rekam_medis ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<!-----------------------LOAD HALAMAAN----------------------->
<script type="text/javascript">
    $('.no_remed').select2({
        theme: 'bootstrap4',
    });

    $("#no_remed").change(function() {
        var no_remed = $(this).val();

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
    });    


</script>

</body>
</html>
