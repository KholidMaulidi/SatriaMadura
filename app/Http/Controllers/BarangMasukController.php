<?php

namespace App\Http\Controllers;

use App\Models\Barang_Masuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang_masuk = Barang_Masuk::all();

        return view('perbarangan.barang_masuk', ['Barang_Masuk' => $barang_masuk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perbarangan.createBarangMasuk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'jumlah' => 'required',
            'tanggal_masuk' => 'required',
            ]);
        
        $barang_masuk = new Barang_Masuk;
        $supplier_id = $request->get('supplier_id');
        $barang_masuk->supplier_id= $supplier_id;
        $barang_masuk->barang_id=$supplier_id;
        $barang_masuk->jumlah=$request->get('jumlah');
        
        $jumlah = $request->input('jumlah');
        $harga = $barang_masuk->harga=$supplier_id;
        
        $barang=Barang::findOrFail($supplier_id);
        $barang = $barang_masuk->barang ?? new Barang();
        $barang_masuk->harga=$barang->harga;
        $harga = $barang->harga;
        $total = $jumlah *$harga;
        $barang->stok = $barang->stok + $request->jumlah;
        $barang->save();
        $barang_masuk->total = $total;
        $barang_masuk->tanggal_masuk=$request->get('tanggal_masuk');
        $barang_masuk->save();


        return redirect()->route('barangmasuk.index')
            ->with('success', 'Barang Masuk Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang_masuk = Barang_Masuk::find($id);
        return view('perbarangan.detailBarangMasuk', compact('barang_masuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
