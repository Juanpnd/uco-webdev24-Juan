<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = array(
            [
                'id' => 'stik',
                'name' => 'Stik PS',
                'price' => 200000,
                'description' => 'ini stik ps4',
                'image' => 'https://fastly.picsum.photos/id/96/200/200.jpg?hmac=OWdGKA_6EKn7IZEMPRZ-F_wvRBZlDHi-n9QCzIKJV_4'
            ],
            [
                'id' => 'buku',
                'name' => 'Buku Js',
                'price' => 100000,
                'description' => 'ini Tutorial Js',
                'image' => 'https://fastly.picsum.photos/id/24/200/200.jpg?hmac=Tw5b43UPAehS5e4JyB0qMQysvfLBmu_GZ_iafWou3m8'
            ],
            [
                'id' => 'apart',
                'name' => 'Apart',
                'price' => 1000000000,
                'description' => 'ini apart 16 lantai',
                'image' => 'https://fastly.picsum.photos/id/437/200/200.jpg?hmac=F6oc_vcQ5Gq4nCufq-2oFrrhsTwKXZmc8ZCLW3a_TD8'
            ],
        );
        return view('products.index', [
            'data' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
