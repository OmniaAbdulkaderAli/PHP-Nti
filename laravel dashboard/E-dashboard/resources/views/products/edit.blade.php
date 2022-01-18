@extends('layouts.layout');
@section('title', 'Edit Product');
@section('color-page', 'warning');
@section('content')
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-row">
            <div class="form-group col-6">
                <label>Name EN</label>
                <input type="text" name="name_en" class="form-control" value="{{ $product->name_en }}">

                @error('name_en')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="form-group col-6">
                <label>Name AR</label>
                <input type="text" name="name_ar" class="form-control" value="{{ $product->name_ar }}">

                @error('name_ar')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}">

                @error('price')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-3">
                <label for="exampleInputPassword1">quantity</label>
                <input type="number" name="quantity" class="form-control" id="exampleInputPassword1"
                    value="{{ $product->quantity }}">

                @error('quantity ')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-3">
                <label>Code</label>
                <input type="text" name="code" class="form-control" value="{{ $product->code }}">

                @error('code')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-3">
                <label>Status</label>
                <select name="status" class="form-control" id="">
                    <option {{ $product->status == 1 ? 'selected' : ' ' }} value="1">Active</option>
                    <option {{ $product->status == 0 ? 'selected' : ' ' }} value="0">Not Active</option>
                </select>

                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label>Brand</label>
                <select name="brand_id" class="form-control" id="">
                    <option value="">No Brand</option>
                    @forelse ($brands as $brand)
                        <option {{ $product->brand_id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">
                            {{ $brand->name_en }}</option>
                    @empty
                        <option disabled>No Brands</option>
                    @endforelse

                </select>
                @error('brand_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-6">
                <label>Sub-Categories</label>
                <select name="subcategory_id" class="form-control" id="">
                    @forelse ($subCategories as $subcategory)
                        <option {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}
                            value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                    @empty
                        <option disabled>No Brands</option>
                    @endforelse
                </select>
                @error('subcategory_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="exampleInputEmail1">Details EN</label>
                <textarea class="form-control" name="details_en" id="" rows="3">{{ $product->details_en }}</textarea>
                @error('details_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-6">
                <label for="exampleInputPassword1">Details AR</label>
                <textarea class="form-control" name="details_ar" rows="3">{{ $product->details_ar }}</textarea>
                @error('details_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>File input</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input">
                    <label class="custom-file-label">Choose file</label>
                </div>

            </div>

        </div>
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="row">
            <div class="col-3">
                <img class="w-100" src="{{ url('/images/products/' . $product->image) }}"
                    alt="{{ $product->name_en }}">
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">update Product</button>
        </div>
    </form>


@endsection
