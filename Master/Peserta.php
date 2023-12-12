<?php

namespace Master;

class peserta
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('peserta')->get()->resultArray();
        $res = ' <a href="?target=peserta&act=tambah_peserta" class="btn btn-info btn-sm">Tambah_peserta</a><br><br>
            <div class="table-responsive">
            <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th></th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                    <td width="10">' . $no . '</td>
                    <td width="250">' . $r['NIK'] . '</td>
                    <td width="50">' . $r['Nama'] . '</td>
                    <td width="100">' . $r['Alamat'] . '</td>
        <td width="150">
        <a href="?target=peserta&act=edit_peserta&id=' . $r['NIK'] . '" class="btn btn-primary btn-sm">Edit</a>
        <a href="?target=peserta&act=delete_peserta&id=' . $r['NIK'] . '" class="btn btn-danger btn-sm">Hapus</a>
        </td>
                </tr>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }

    public function tambah()
    {
        $res = '<a href="?target=peserta" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=peserta&act=simpan_peserta" method="post">
                <div class="mb-3">
                    <label for="NIK" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="NIK" name"NIK">
                </div>
                <div class="mb-3">
                    <label for="Nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="Nama" name"Nama">
                </div>
                <div class="mb-3">
                    <label for="Alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="Alamat" name"Alamat">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>';
        return $res;
    }

    public function simpan()
    {
        $NIK = $_POST['NIK'];
        $Nama = $_POST['Nama'];
        $Alamat = $_POST['Alamat'];

        $data = array(
            'NIK' => $NIK,
            'Nama' => $Nama,
            'Alamat' => $Alamat,
        );
        return $this->db->table('peserta')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('peserta')->where("NIK='$id'")->get()->rowArray();
        
        $res = '<a href="?target=peserta" class="btn btn-danger btn-sm">kembali</a><br><br>';
        $res .= '<from action="?target=peserta&act=update_peserta" method="post">
                <input type="hidden" class"form-control" id="param" name="param" value="' . $r['NIK'] . '">
                <div class="mb-3">
                    <label for="" class="form-label">NIK</label>
                    <input type="text" class"form-control" id="NIK" name="NIK" value="' . $r['NIK'] . '">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class"form-control" id="Nama" name="Nama" value="' . $r['Nama'] . '">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Alamat</label>
                    <input type="text" class"form-control" id="Alamat" name="Alamat" value="' . $r['Alamat'] . '">
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
        $NIK = $_POST['NIK'];
        $Nama = $_POST['Nama'];
        $Alamat = $_POST['Alamat'];


        $data = array(
            'NIK' => $NIK,
            'Nama' => $Nama,
            'Alamat' => $Alamat,
        );

        return $this->db->table('peserta')->where("NIK='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('peserta')->where("NIK='$id'")->delete();
    }
}
