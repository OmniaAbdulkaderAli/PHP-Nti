@extends('layouts.layout')

@section('title', 'Create Product')
@section('color-page', 'success')
@section('content')
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <div class="form-row">
            <div class="form-group col-6">
                <label for="exampleInputEmail1">Name EN</label>
                <input type="text" name="name_en" class="form-control" id="exampleInputEmail1" value="{{old('name_en')}}">
                @error('name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-6">
                <label for="exampleInputPassword1">Name AR</label>
                <input type="text" name="name_ar" class="form-control" id="exampleInputPassword1" value="{{old('name_ar')}}">
                @error('name_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-3">
                <label for="exampleInputEmail1">Price</label>
                <input type="number" name="price" class="form-control" id="exampleInputEmail1" value="{{old('price')}}">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-3">
                <label for="exampleInputPassword1">Quantity</label>
                <input type="number" name="quantity" class="form-control" id="exampleInputPassword1" value="{{old('amount')}}">
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-3">
                <label for="exampleInputEmail1">Code</label>
                <input type="text" name="code" class="form-control" id="exampleInputEmail1" value="{{old('code')}}">
                @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-3">
                <label for="exampleInputPassword1">Status</label>
                <select name="status" class="form-control" id="">
                    <option {{old('status') == 1 ? 'selected' : ''}} value="1">Active</option>
                    <option {{old('status') == 0 ? 'selected' : ''}} value="0">Not Active</option>
                </select>
                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="exampleInputPassword1">Brand</label>
                <select name="brand_id" class="form-control" id="">
                    <option value="">No Brand</option>
                    @forelse ($brands as $brand)
                        <option {{old('brand_id') == $brand->id ? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                    @empty
                        <option disabled>No Brands</option>
                    @endforelse
                </select>
                @error('brand_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-6">
                <label for="exampleInputPassword1">Sub-Categories</label>
                <select name="subcategory_id" class="form-control" id="">
                    @forelse ($subCategories as $subcategory)
                        <option {{old('subcategory_id') == $subcategory->id ? 'selected' : ''}}  value="{{ $subcategory->id }}">{{ $subcategory->name_en }}</option>
                    @empty
                        <option disabled>No Sub Category</option>
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
                <textarea class="form-control" name="details_en" id="" rows="3">{{old('details_en')}}</textarea>
                @error('details_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-6">
                <label for="exampleInputPassword1">Details AR</label>
                <textarea class="form-control" name="details_ar" id="" rows="3">{{old('details_ar')}}</textarea>
                @error('details_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
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
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Create Product</button>
        </div>
    </form>
@endsection
