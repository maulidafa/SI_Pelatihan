<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/oop/myappupdate/index.php?target=";
        $data = [
            array('text' => 'Home', 'link' => $base . 'home'),
            array('text' => 'Jadwal Pelatihan', 'link' => $base . 'jadwal_pelatihan'),
            array('text' => 'Peserta', 'link' => $base . 'Peserta'),
            array('text' => 'Dokumentasi', 'link' => $base . 'Dokumentasi')
        ];
        return $data;
    }
}
