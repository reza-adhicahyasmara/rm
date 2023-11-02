<?php
    $a = $data_table[0];
    

?>

<div class="modal-body form text-left">
    <div class="card-body">
        <div class="form-group row ">
            <label for="nik" class="col-sm-4 col-form-label">NIK</label>
            <div class="col-sm-8 kosong">
                <input maxlength="16" minlength="14" type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= $a['nik'] ?>" readonly>
            </div>
        </div>
        <div class="form-group row ">
            <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap</label>
            <div class="col-sm-8 kosong">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" value="<?= $a['nama'] ?>" readonly>
            </div>
        </div>

        <div class="form-group row ">
            <label for="tgl" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8 kosong">
                <input type="text" class="form-control" name="tgl" id="tgl" value="<?= ($a['tgl_lahir'] == 'L') ? 'Laki - Laki' : 'Perempuan'  ?>" readonly>
            </div>
        </div>

        <div class="form-group row ">
            <label for="tgl" class="col-sm-4 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8 kosong">
                <input type="date" class="form-control" name="tgl" id="tgl" value="<?= $a['tgl_lahir'] ?>" readonly>
            </div>
        </div>


        <div class="form-group row ">
            <label for="pekerjaan" class="col-sm-4 col-form-label">Pekerjaan</label>
            <div class="col-sm-8 kosong">
                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?= $a['pekerjaan'] ?>" readonly>
            </div>
        </div>

        <div class="form-group row ">
            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
            <div class="col-sm-8 kosong ">
                <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="5" style="resize: none;" readonly><?= $a['alamat'] ?></textarea>
            </div>
        </div>
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>