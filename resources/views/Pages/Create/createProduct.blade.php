@extends('layouts.mainLayouts',['page'=>'Product'])


@section('cssLinks')
    <link rel="stylesheet" href="{{ asset('assets/main/css/formStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/main/css/style.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/main/js/priceCalculator.js') }}"></script>
@endsection

@section('body')
    @session('message')
        <div id="loginSuccessAlert" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession
    <div class="container mt-5 bg-light p-3 rounded-3 shadow-sm">
        <div class="heading d-flex flex-row align-items-center justify-content-between">
            <h3>Add Product</h3>
            <div class="">
                <a href="{{ route('product') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <hr>
        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="itemName" class="form-label">Item Name <span class="text-danger fw-bold">*</span></label>
                    <input value="{{ old('item_name') }}" type="text" class="form-control @error('item_name') is-invalid @enderror" id="itemName" name="item_name" placeholder="Enter item name" required>
                    @error('item_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="itemModel" class="form-label">Item Model</label>
                    <input value="{{ old('item_model') }}" type="text" class="form-control @error('item_model') is-invalid @enderror" id="itemModel" name="item_model" placeholder="Enter item model">
                    @error('item_model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="itemCode" class="form-label">Item Code <span class="text-danger fw-bold">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">AP</span>
                        <input value="{{ old('item_code', $newCode) }}" type="text"
                               class="form-control @error('item_code') is-invalid @enderror"
                               id="itemCode" required name="item_code" placeholder="Enter item code">
                        @error('item_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="subCategory" class="form-label">SubCategory <span class="text-danger fw-bold">*</span></label>
                    <select class="form-select @error('sub_category') is-invalid @enderror" id="subCategory" required name="sub_category">
                        <option selected disabled>Select a subcategory</option>
                        @foreach ($subCategories as $subCategory)
                            <option @if (old('sub_category') == $subCategory->id) selected @endif value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                        @endforeach
                    </select>
                    @error('sub_category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" value="{{ old('brand') }}" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" placeholder="Enter brand name">
                    @error('brand')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="unit" class="form-label">Unit <span class="text-danger fw-bold">*</span></label>
                    <select class="form-select @error('unit') is-invalid @enderror" required id="unit" name="unit">
                        <option selected disabled>Select a unit</option>
                        @foreach ($units as $short => $unit)
                            <option @if (old('unit') == $short) selected @endif value="{{ $short }}">{{ $unit }}</option>
                        @endforeach
                        {{-- <option @if (old('unit') == 'Pcs') selected @endif value="Pcs">Piece</option>
                        <option @if (old('unit') == 'Kg') selected @endif  value="Kg">Kilogram</option>
                        <option @if (old('unit') == 'Bundel') selected @endif  value="Bundel">Bundel</option>
                        <option @if (old('unit') == 'Pack') selected @endif  value="Pack">Packet</option>
                        <option @if (old('unit') == 'Gm') selected @endif  value="Gm">Gram</option>
                        <option @if (old('unit') == 'Ltr') selected @endif  value="Ltr">Liter</option>
                        <option @if (old('unit') == 'Doz') selected @endif  value="Doz">Dozen</option> --}}
                    </select>
                    @error('unit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="tax" class="form-label">Product Tax (%) <span class="text-danger fw-bold">*</span></label>
                    <select class="form-select @error('tax') is-invalid @enderror" id="tax" required name="tax">
                        <option selected disabled>Select tax rate</option>
                        @foreach ($taxes as $taxValue => $tax)
                            <option @if (old('tax') == $taxValue) selected @endif value="{{ $taxValue }}">{{ $tax }}</option>
                        @endforeach
                        {{-- <option  value="Vat@13">Vat@13</option>
                        <option value="Vat@20">Vat@20</option>
                        <option value="Vat@10">Vat@10</option>
                        <option value="Vat@0">Vat@0</option> --}}
                    </select>
                    @error('tax')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="taxType" class="form-label">Tax Type <span class="text-danger fw-bold">*</span></label>
                    <select class="form-select @error('tax_type') is-invalid @enderror" id="taxType" required name="tax_type">
                        <option selected disabled>Select tax type</option>
                        <option @if (old('tax_type') == 'exclusive') selected @endif value="exclusive">Exclusive</option>
                        <option @if (old('tax_type') == 'inclusive') selected @endif value="inclusive">Inclusive</option>
                    </select>
                    @error('tax_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="regularPrice" class="form-label">Regular Price <span class="text-danger fw-bold">*</span></label>
                    <input value="{{ old('regular_price') }}" type="number" class="form-control @error('regular_price') is-invalid @enderror" id="regularPrice" required name="regular_price" step="0.01" placeholder="Enter regular price">
                    @error('regular_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="discount" class="form-label">Discount (%)</label>
                    <input value="{{ old('discount') }}" type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" step="0.01" placeholder="Enter discount percentage">
                    @error('discount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="sellingPrice" class="form-label">Selling Price <span class="text-danger fw-bold">*</span></label>
                    <input readonly value="{{ old('selling_price') }}" type="number" class="form-control @error('selling_price') is-invalid @enderror" id="sellingPrice" name="selling_price" required step="0.01" placeholder="Selling price">
                    @error('selling_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status <span class="text-danger fw-bold">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" required name="status">
                        <option selected disabled>Select status</option>
                        <option @if (old('status') == 'active') selected @endif value="active">Active</option>
                        <option @if (old('status') == 'inactive') selected @endif value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="voiceTags" class="form-label">Voice Tags</label>
                    <textarea class="form-control @error('voice_tags') is-invalid @enderror" id="voiceTags" name="voice_tags" rows="3" placeholder="Enter voice tags">{{ old('voice_tags') }}</textarea>
                    @error('voice_tags')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="note" class="form-label">Note</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3" placeholder="Enter any additional details">{{ old('note') }}</textarea>
                    @error('note')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
