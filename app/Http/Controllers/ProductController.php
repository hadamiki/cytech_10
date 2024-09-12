<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;



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
        $object = new Product();

        $products = $object->product();

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
        if($request->hasFile('img_path')) {
            $filename = $request->file('img_path')->getClientOriginalName();
            $path = $request->file('img_path')->storeAs('/public', $filename);
           }else{
            $path = null;
           }

        DB::beginTransaction();

        try{
            $product = new Product;
            $product->product_name = $request->input('product_name');

            $product->company_id = $request->input('company_id');
            $product->price = $request->input('price');

            $product->stock = $request->input('stock');

            $product->comment = $request->input('comment');
            
            if(isset($path)) {
                $product->img_path = $path;

            }
            $product->save();
        
           DB::commit();

        } catch(\Exception $e) {
            DB::rollBack();
            \Log::error('Product creation failed: ' . $e->getMessage());
            return back()->withErrors('保存に失敗しました。');

        }

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

        DB::beginTransaction();

        try {
            $product->product_name = $request->input(["product_name"]);
            $product->company_id = $request->input(["company_id"]);
            $product->price = $request->input(["price"]);
            $product->stock = $request->input(["stock"]);
            $product->comment = $request->input(["comment"]);
            $product->img_path = $request->input(["img_path"]);
            $product->save();

           DB::commit(); 

        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }
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
        DB::beginTransaction();

        try {
            $product->delete();
            DB::commit();
           
            return redirect()->route('products.index')
            ->with('success', $product->product_name.'を削除しました');
             
        } catch (\Exception $e){
            DB::rollBack();
            \Log::error('Product deletion failed: '.$e->getMessage());
            return back()->withErrors('削除に失敗しました。');

        }   
                   
    }

    public function searchInput(Request $request)
    {
    
        return redirect()->route('products.index');
    }
}
