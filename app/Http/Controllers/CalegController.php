<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CalegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('caleg/caleg_input', [
            'title' => 'Input',
            'partai' => Party::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:50|string',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required|max:1|min:1',
            'gambar' => 'image|file|max:1024',
            'visi' => 'required|max:500',
            'misi' => 'required|max:500',
            'party_id' => 'required|gt:0',
            'dapil_id' => 'required|gt:0|lte:3',
            'pendidikan' => 'required|gt:0|lte:5',
            'penghasilan' => 'required|gt:0|lte:5',
            'pengalaman' => 'required|gt:0|lte:5',
            'keanggotaan' => 'required|gt:0|lte:4',
            'kekayaan' => 'required|gt:0|lte:4',
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('foto-caleg');
        }

        $validatedData['uri'] = Str::random(40);
        Caleg::create($validatedData);
        return redirect('/caleg')->with('caleg_success', 'Calon legislatif berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function show(Caleg $caleg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function edit(Caleg $caleg)
    {
        return view('caleg/caleg_edit', [
            'title' => 'Ubah',
            'caleg' => $caleg,
            'partai' => Party::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caleg $caleg)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:50|string',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required|max:1|min:1',
            'gambar' => 'image|file|max:1024',
            'visi' => 'required|max:255',
            'misi' => 'required|max:255',
            'party_id' => 'required|gt:0',
            'dapil_id' => 'required|gt:0|lte:3',
            'pendidikan' => 'required|gt:0|lte:5',
            'penghasilan' => 'required|gt:0|lte:5',
            'pengalaman' => 'required|gt:0|lte:5',
            'keanggotaan' => 'required|gt:0|lte:4',
            'kekayaan' => 'required|gt:0|lte:4',
        ]);

        if ($request->hasFile('gambar')) {
            if($caleg->gambar != null){
                Storage::delete($caleg->gambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('foto-caleg');
        }
        
        Caleg::where('id', $caleg->id)->update($validatedData);
        return redirect('/caleg')->with('update_success', 'Calon legislatif berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caleg $caleg)
    {
        Storage::delete($caleg->gambar);
        Caleg::destroy($caleg->id);
        return redirect('/caleg')->with('delete_success', 'Calon legislatif berhasil dihapus');
    }
}
