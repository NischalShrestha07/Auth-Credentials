@extends('layouts.mainLayouts',['page'=>'Sub Category'])


@section('cssLinks')
    <link rel="stylesheet" href="{{ asset('assets/main/css/formStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/main/css/style.css') }}">
@endsection

@section('body')
    <div class="container mt-5 bg-light p-3 rounded-3 shadow-sm">
        <div class="heading d-flex flex-row align-items-center justify-content-between">
            <h3>Add Item Sub Category</h3>
            <div class="">
                <a href="{{ route('subcategory') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <hr>
        <form method="POST" action="{{ route('subcategory.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="categoryName" class="form-label">Sub Category Name <span class="text-danger fw-bold">*</span></label>
                    <input value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" id="categoryName" name="name" placeholder="Enter sub category name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="category" class="form-label">Category <span class="text-danger fw-bold">*</span></label>
                    <select class="form-select @error('category') is-invalid @enderror" required id="category" name="category">
                        <option selected disabled>Select a category</option>
                        @foreach ($categories as $category)
                            <option @if (old('category') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="col-md-4">
                    <label for="categoryCode" class="form-label">Item Code</label>
                    <input value="{{ old('code') }}" type="text" class="form-control @error('code') is-invalid @enderror" id="categoryCode" name="code" placeholder="Enter category code">
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="col-md-6">
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

                <div class="col-md-12">
                    <label for="note" class="form-label">Note</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3" placeholder="Write your note here!">{{ old('note') }}</textarea>
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
