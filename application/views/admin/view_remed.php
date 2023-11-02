<?php
$a = $data_table[0];
?>


<div class="modal-body form text-left">
    <div class="card-body">
        <div class="form-group row">
            <label for="nik" class="col-sm-4 col-form-label">NIK</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="nik" id="" value="<?= $a["nik"] ?>" readonly>
            </div>

        </div>
        <div class="form-group row ">
            <label for="no_remed" class="col-sm-4 col-form-label">Nomor Rekam Medis/label>
            <div class="col-sm-8 kosong ">
                <input type="text" name="no_remed" class="form-control" id="no_remed" cols="30" rows="5" style="resize: none;"><?= $a["no_remed"] ?></input>
            </div>
        </div>

        <div class="form-group row ">
            <label for="diagnosa" class="col-sm-4 col-form-label">Diagnosa</label>
            <div class="col-sm-8 kosong ">
                <textarea name="diagnosa" class="form-control" id="diagnosa" cols="30" rows="5" style="resize: none;"><?= $a["diagnosa"] ?></textarea>
            </div>
        </div>

        <div class="form-group row ">
            <label for="tgl_awal" class="col-sm-4 col-form-label">Tanggal Awal</label>
            <div class="col-sm-8 kosong">
                <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" value="<?= $a["tgl_awal"] ?>">
            </div>
        </div>

        <div class="form-group row ">
            <label for="tgl_akhir" class="col-sm-4 col-form-label">Tanggal Akhir</label>
            <div class="col-sm-8 kosong">
                <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?= $a["tgl_akhir"] ?>">
            </div>
        </div>

        <div class="form-group row ">
            <label for="imagefile" class="col-sm-4 col-form-label">dokumen</label>
            <div class="col-sm-8 kosong ">
                <img id="v_image" width="100px" height="100px" src="<?= base_url('assets/dokumen/') . $a['dokumen'] ?>">
            </div>
        </div>

    </div>


</div>
</div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>