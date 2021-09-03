@extends('backend.layout.app')
@section('title', 'Create Product')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Product Data</h3>
                </div>
                <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control" id="price" placeholder="Price"
                                    value="{{ old('price') }}">
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="quantity"
                                    placeholder="Quantity" value="{{ old('quantity') }}">
                                @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Not Active</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label>Brand</label>
                                <select name="brand_id" class="form-control">
                                    @foreach ($brands as $brand)
                                        <option {{ old('brand_id') == $brand->id ? 'selected' : '' }}
                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label>Subcategory</label>
                                <select name="subcategory_id" class="form-control">
                                    @foreach ($subcategories as $sub)
                                        <option {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}
                                            value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label>Supplier</label>
                                <select name="supplier_id" class="form-control">
                                    @foreach ($suppliers as $supplier)
                                        <option {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}
                                            value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <label>Details</label>
                                <textarea name="details" class="form-control" cols="30"
                                    rows="5">{{ old('details') }}</textarea>
                                @error('details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
