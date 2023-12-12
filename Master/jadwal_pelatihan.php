<?php

namespace Master;

use Config\Query_builder;

class Jadwal_Pelatihan
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('jadwal_pelatihan')->get()->resultArray();
        $res = ' <a href="?target=jadwal_pelatihan&act=tambah_jadwal_pelatihan" class="btn btn-info btn-sm">Tambah Jadwal Pelatihan</a><br><br>
            <div class="table-responsive">
            <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th></th>
                    <th>Kegiatan</th>
                    <th>Tempat</th>
                    <th>Tanggal</th>
                    <th>Narasumber</th>
                    <th>Hari</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                    <td width="10">' . $no . '</td>
                    <td width="250">' . $r['Kegiatan'] . '</td>
                    <td width="50">' . $r['Tempat'] . '</td>
                    <td width="100">' . $r['Tanggal'] . '</td>
                    <td width="150">' . $r['Narasumber'] . '</td>
                    <td width="10">' . $r['Hari'] . '</td>
        <td width="150">
        <a href="?target=jadwal_pelatihan&act=edit_jadwal_pelatihan&id=' . $r['Kegiatan'] . '" class="btn btn-primary btn-sm">Edit</a>
        <a href="?target=jadwal_pelatihan&act=delete_jadwal_pelatihan&id=' . $r['Kegiatan'] . '" class="btn btn-danger btn-sm">Hapus</a>
        </td>
                </tr>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }

    public function tambah()
    {
        $res = '<a href="?target=jadwal_pelatihan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=jadwal_pelatihan&act=simpan_jadwal_pelatihan" method="post">
                <div class="mb-3">
                    <label for="Kegiatan" class="form-label">Kegiatan</label>
                    <input type="text" class="form-control" id="Kegiatan" name"Kegiatan">
                </div>
                <div class="mb-3">
                    <label for="Tempat" class="form-label">Tempat</label>
                    <input type="text" class="form-control" id="Tempat" name"Tempat">
                </div>
                <div class="mb-3">
                    <label for="Tanggal" class="form-label">Tanggal</label>
                    <input type="text" class="form-control" id="Tanggal" name"Tanggal">
                </div>
                <div class="mb-3">
                    <label for="Narasumber" class="form-label">Narasumber</label>
                    <input type="text" class="form-control" id="Narasumber" name"Narasumber">
                </div>
                <div class="mb-3">
                    <label for="Hari" class="form-label">Hari</label>
                    <input type="text" class="form-control" id="Hari" name"Hari">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>';
        return $res;
    }

    public function simpan()
    {
        $Kegiatan = $_POST['Kegiatan'];
        $Tempat = $_POST['Tempat'];
        $Tanggal = $_POST['Tanggal'];
        $Narasumber = $_POST['Narasumber'];
        $Hari = $_POST['Hari'];

        $data = array(
            'Kegiatan' => $Kegiatan,
            'Tempat' => $Tempat,
            'Tanggal' => $Tanggal,
            'Narasumber' => $Narasumber,
            'Hari' => $Hari,
        );
        return $this->db->table('jadwal_pelatihan')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('jadwal_pelatihan')->where("Kegiatan='$id'")->get()->rowArray();
        
        $res = '<a href="?target=jadwal_pelatihan" class="btn btn-danger btn-sm">kembali</a><br><br>';
        $res .= '<from action="?target=jadwal_pelatihan&act=update_jadwal_pelatihan" method="post">
                <input type="hidden" class"form-control" id="param" name="param" value="' . $r['Kegiatan'] . '">
                <div class="mb-3">
                    <label for="" class="form-label">Kegiatan</label>
                    <input type="text" class"form-control" id="Kegiatan" name="Kegiatan" value="' . $r['Kegiatan'] . '">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal</label>
                    <input type="text" class"form-control" id="Tanggal" name="Tanggal" value="' . $r['Tanggal'] . '">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Tempat</label>
                    <input type="text" class"form-control" id="Tempat" name="Tempat" value="' . $r['Tempat'] . '">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Narasumber</label>
                    <input type="text" class"form-control" id="Narasumber" name="Narasumber" value="' . $r['Narasumber'] . '">
                    </label>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Hari</label>
                    <input type="text" class"form-control" id="Hari" name="Hari" value="' . $r['Hari'] . '">
                    </label>
                </div>
            <button type="submit" class"btn btn-primary">Ubah</button>
            </form>';
        return $res;
    }

    public function cekRadio($val1, $val2)
    {
        if ($val1 == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $Kegiatan = $_POST['Kegiatan'];
        $Tempat = $_POST['Tempat'];
        $Tanggal = $_POST['Tanggal'];
        $Narasumber = $_POST['Narasumber'];
        $Hari = $_POST['Hari'];


        $data = array(
            'Kegiatan' => $Kegiatan,
            'Tempat' => $Tempat,
            'Tanggal' => $Tanggal,
            'Narasumber' => $Narasumber,
            'Hari' => $Hari,
        );

        return $this->db->table('jadwal_pelatihan')->where("Kegiatan='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('jadwal_pelatihan')->where("Kegiatan='$id'")->delete();
    }
}
