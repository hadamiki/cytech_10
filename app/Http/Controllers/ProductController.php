<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $companies = Company::all();
        $products = Product::select([
            'p.id',
            'p.img_path',
            'p.product_name',
            'p.price',
            'p.stock',
            'c.company_name as company_id',
        ])
        ->from('products as p')
        ->join('companies as c', function($join) {
            $join->on('p.company_id', '=', 'c.id');
        })
        ->orderBy('p.id', 'DESC')
        ->paginate(5);

        return view('index', compact('products', 'companies'))
                ->with('page_id', request()->page)
                ->with('i', (request()->input('page', 1) -1) *5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $companies = Company::all();
        $products = Product::with('company')->get();
        return view('create', compact('products', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'product_name'=>'required|max:20',
            'company_id'=>'required',
            'price'=>'required|integer',
            'stock'=>'required|integer',
    
        ]);

        $product = new Product;
        $product->product_name = $request->input(["product_name"]);
        $product->company_id = $request->input(["company_id"]);
        $product->price = $request->input(["price"]);
        $product->stock = $request->input(["stock"]);
        $product->comment = $request->input(["comment"]);
        $product->img_path = $request->file(["img_path"]);
        $product->save();

        return redirect()->route('products.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        $companies = Company::all();
        return view('show', compact('product'))
                ->with('page_id', request()->page_id)
                ->with('companies', $companies);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $companies = Company::all();
        return view('edit', compact('product'))
                ->with('companies', $companies);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'product_name'=>'required|max:20',
            'company_id'=>'required',
            'price'=>'required|integer',
            'stock'=>'required|integer',
    
        ]);

        $product->product_name = $request->input(["product_name"]);
        $product->company_id = $request->input(["company_id"]);
        $product->price = $request->input(["price"]);
        $product->stock = $request->input(["stock"]);
        $product->comment = $request->input(["comment"]);
        $product->img_path = $request->input(["img_path"]);
        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return redirect()->route('products.index')
                        ->with('success', $product->product_name.'を削除しました');
    }

    public function searchInput(Request $request)
    {
    
        return redirect()->route('products.index');
    }
}
