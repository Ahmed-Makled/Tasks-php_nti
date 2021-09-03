<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\traits\generalTrait;


class   productsApiController extends Controller
{
    use generalTrait;

    /*------------------------------------ All Products------------------------------------*/
    public function index()
    {
        $products = Product::all();
        return $this->returnData('product', $products);
        // return Product::all();
    }
    /*------------------------------------ create Products------------------------------------*/

    public function create()
    {
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        $subcategories = SubCategory::select('id', 'name')->orderBy('name')->get();
        $suppliers = Supplier::select('id', 'name')->orderBy('name')->get();

        return response()->json(['brnads' => $brands, 'subcategories' => $subcategories, 'suppliers' => $suppliers]);
    }
    /*------------------------------------ edit Product------------------------------------*/

    public function edit($id)
    {

        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        $subcategories =  Subcategory::select('id', 'name')->orderBy('name')->get();
        $suppliers = Supplier::select('id', 'name')->orderBy('name')->get();
        $product = Product::find($id);
        $product = $product ? $product : (object)[];
        return $this->returnData('data', ['product' => $product, 'brands' => $brands, 'suppliers' => $suppliers, 'subcategories' => $subcategories]);
    }
    /*------------------------------------ store Product------------------------------------*/

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'max:1000', 'string'],
            'price' => ['required', 'numeric', 'min:1', 'max:10000000'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'status' => ['nullable', 'integer', 'min:0', 'max:1'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'details' => ['nullable', 'string'],
            'image' => ['required', 'mimes:png,jpg,jpeg', 'max:1000']
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }
        $photoName = $this->uploadPhoto($request->image, 'products');
        $data = $request->except('image');
        $data['image'] = $photoName;
        Product::create($data);
        return $this->returnSuccessMessage("Product Created Successfully");
    }

    /*------------------------------------ update Product------------------------------------*/

    public function update(Request $request)
    {

        $rules = [
            'id' => ['required', 'integer', 'exists:products'],
            'name' => ['required', 'max:1000', 'string'],
            'price' => ['required', 'numeric', 'min:1', 'max:10000000'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'status' => ['nullable', 'integer', 'min:0', 'max:1'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'details' => ['nullable', 'string'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1000']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }

        $data = $request->except('image');
        if ($request->has('image')) {
            $photoName = $this->uploadPhoto($request->image, 'products');
            $data['image'] = $photoName;
            $this->deletePhoto('products', $request->id);
        }
        Product::where('id', $request->id)->update($data);
        return $this->returnSuccessMessage("Product updated Successfully");
    }

    /*------------------------------------ destroy   Product------------------------------------*/

    public function destroy($id)
    {
        $data = ['id' => $id];
        $rules = [
            'id' => ['required', 'integer', 'exists:products'],
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }
        $this->deletePhoto('products', $id);
        $check = Product::where('id', $id)->delete();
        if ($check) {
            return $this->returnSuccessMessage("Product Deleted Successfully");
        } else {
            return $this->returnErrorMessage(null, 'Something went wrong', 500);
        }
    }
}