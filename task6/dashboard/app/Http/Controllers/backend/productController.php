<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\traits\generalTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;


class  productController extends Controller
{
    use generalTrait;
    /*-----------------------------------------ALl Products-----------------------------------------*/

    public function index()
    {
        $products = DB::table('products')->select('id', 'name', 'price', 'quantity', 'status')->get();
        return view('backend.products.index', compact('products'));
    }
    /*-----------------------------------------create-----------------------------------------*/

    public function create()
    {
        $brands = DB::table('brands')->select('name', 'id')->orderBy('name')->get();
        $subcategories =  DB::table('subcategories')->select('name', 'id')->orderBy('name')->get();
        $suppliers = DB::table('suppliers')->select('name', 'id')->orderBy('name')->get();
        return view('backend.products.create', compact('brands', 'subcategories', 'suppliers'));
    }
    /*-----------------------------------------edit-----------------------------------------*/

    public function edit($id)
    {

        $product = DB::table('products')->where('id', $id)->first();
        $brands = DB::table('brands')->select('id', 'name')->orderBy('name')->get();
        $subcategories =  DB::table('subcategories')->select('id', 'name')->orderBy('name')->get();
        $suppliers = DB::table('suppliers')->select('id', 'name')->orderBy('name')->get();
        return view('backend.products.edit', compact('product', 'brands', 'subcategories', 'suppliers'));
    }
    /*-----------------------------------------store-----------------------------------------*/

    public function store(StoreProductRequest $request)
    {
        $photoName = $this->uploadPhoto($request->image, 'products');
        $data = $request->except('_token', 'image');
        $data['image'] = $photoName;

        DB::table('products')->insert($data);
        return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }


    /*-----------------------------------------update-----------------------------------------*/

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->except('_token', '_method', 'image');
        if ($request->has('image')) {
            $photoName = $this->uploadPhoto($request->image, 'products');
            $data['image'] = $photoName;
            $this->deletePhoto('products', $id);
        }
        DB::table('products')->where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Product Updated Successfully');
    }

    /*-----------------------------------------destroy-----------------------------------------*/

    public function destroy($id)
    {
        $this->deletePhoto('products', $id);

        DB::table('products')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}