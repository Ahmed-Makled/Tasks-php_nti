@extends('backend.layout.app')
@section('title', 'edite Products')


@section('content')
    @include('backend.message.message')

    <div class="row">
        <div class="col-12">
            <!-- general form elements -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Product Data</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-row">

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder=" Name"
                                        value="{{ $product->name }}">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="Price"
                                        value="{{ $product->price }}">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" class="form-control" placeholder="quantity"
                                        value="{{ $product->quantity }}">
                                    @error('quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option {{ $product->status == 1 ? 'selected' : '' }} value="">Active</option>
                                        <option {{ $product->status == 0 ? 'selected' : '' }} value="">Not Active
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="brands">Brands</label>
                                    <select name="brand_id" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>

                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>subCatagory</label>
                                    <select name="subCatagory_id" class="form-control">
                                        @foreach ($subcategories as $sub)
                                            <option {{ $product->subcategory_id == $sub->id ? 'selected' : '' }}
                                                value="{{ $sub->id }}">{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subCatagory_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <select name="supplier_id" class="form-control">
                                        @foreach ($suppliers as $supplier)
                                            <option {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}
                                                value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">


                            <div class="col-12">
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea name="details" class="form-control" cols="25"
                                        rows="5">{{ $product->details }}</textarea>
                                    @error('details')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-4">
                                <img src="{{ url('/images/products/' . $product->image) }}" class="w-100">
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">File Input</label>
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


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Updaet</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
