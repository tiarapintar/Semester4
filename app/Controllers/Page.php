<?php namespace App\Controllers;
class Page extends BaseController{
    public function about(){
        echo "about page";
    }

    public function contact(){
        echo "contact page";
    }

    public function faqs(){
        echo "Faqs page";
    }
     public function tos(){
        echo "Halaman Term of Service";
     }

     public function biodata(){
        $data = [
            'nama' => 'Tiara Rohmaniyah',
            'umur' => 20,
            'alamat' => 'Jombang, Jawa Timur',
            'status' => 'Mahasiswa Unipdu'
        ];

        return view('biodata', $data);
     }
}