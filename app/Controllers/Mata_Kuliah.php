<?php namespace App\Controllers;

class Mata_Kuliah extends BaseController {
    public function pemweb() {
        return view('matkul/pemweb');  // Pastikan ini sesuai dengan view yang benar
    }

    public function rpl() {
        return view('matkul/RPL');
    }

    public function sim() {
        return view('matkul/SIM');
    }

    public function mbd() {
        return view('matkul/MBD');
    }
}
