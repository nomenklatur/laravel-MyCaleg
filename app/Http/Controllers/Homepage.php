<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dapil;
use App\Models\Caleg;
use App\Models\Party;

class Homepage extends Controller
{
    public function index(){
        return view('home', [
            'title' => 'Beranda',
        ]);
    }

    public function show_dapil(Dapil $dapil){
        return view('caleg/caleg_by_dapil', [
            'title' => 'Dapil',
            'party' => Party::all(),
            'dapil' => $dapil->caleg->load('party','dapil'),
        ]);
    }

    public function show_caleg(){

        $caleg = Caleg::orderBy('dapil_id', 'asc')->orderBy('party_id', 'asc');
        return view('caleg/caleg', [
            'title' => 'Caleg',
            'caleg' => $caleg->filter(request(['cari']))->paginate(7)->withQueryString(),
        ]);
    }
}

