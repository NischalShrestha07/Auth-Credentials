@extends('layouts.mainLayouts', ['page' => 'Products'])



@section('cssLinks')
    <link rel="stylesheet" href="{{ asset('assets/main/css/formStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/main/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('js')
    <script src="{{ asset('assets/main/js/ProductModals.js') }}"></script>
@endsection
@section('body')
    @session('message')
        <x-alert type="success" message="{{ session('success') }}" />
    @endsession
    @session('success')
        <x-alert type="success" message="{{ session('success') }}" />
    @endsession
    @session('error')
        <x-alert type="danger" message="{{ session('error') }}" />
    @endsession
    <main>
        <div class="container mt-5 bg-light p-3 rounded-3 shadow-sm">
            <h3>Items</h3>
            <div class="heading d-flex flex-row align-items-center justify-content-between mb-3">
                <!-- Search Form -->
                <form method="GET" action="{{ url()->current() }}" class="d-flex w-50">
                    <input type="text" id="searchInput" name="search" class="form-control w-100" placeholder="Search..." value="{{ request('search') }}" />
                    <button type="submit" class="btn btn-primary ms-2">Search</button>
                </form>

                <!-- Pagination & Create Button -->
                <div class="d-flex gap-2">
                    <select id="perPageSelect" class="form-select" onchange="window.location.href = '{{ url()->current() }}?per_page=' + this.value;">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>

            <hr>
            <table id="" class="table table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Code</th>
                        {{-- <th>Item Model</th> --}}
                        {{-- <th>Unit</th> --}}
                        <th>Item Model</th>
                        <th>Unit</th>
                        <th>Selling Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                            {{-- <td>{{ $product->id }}</td> --}}
                            <td>{{ $product->item_name }}</td>
                            <td>
                                @if ($product->image_path)
                                    <img class="rounded" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->item_name }}" width="60">
                                @else
                                    <img class="rounded" src="https://placehold.co/60x60?text={{ $product->slug }}" alt="No Image">
                                @endif
                            </td>
                            <td>{{ $product->subCategory->name }} [APS-{{ $product->subCategory->id }}]</td>
                            <td>AP-{{ $product->item_code }}</td>
                            <td>{{ $product->item_model }}</td>
                            <td>{{ $product->unit }}</td>
                            <td>
                                @if ($product->selling_price !== $product->regular_price)
                                    <s>{{ $product->regular_price }}</s> रु {{ $product->selling_price }} ({{ $product->discount }}%)
                                @else
                                    {{ $product->selling_price }}
                                @endif
                            </td>
                            <td>
                                @if ($product->status == 1)
                                    <span class="bg-primary rounded-5 px-2 text-white fs-6">Active</span>
                                @else
                                    <span class="bg-danger rounded-5 px-2 text-white fs-6">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-around align-items-center gap-2">

                                    <a href="{{ route('product.edit', $product->id) }}"><i class="fa-solid fa-pen-to-square text-dark"></i></a>

                                    <i style="cursor: pointer;" class="fa-solid fa-eye view-details text-info   " data-image="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://placehold.co/60x60?text=' . $product->slug }}"
                                        data-bs-toggle="modal" data-bs-target="#viewModal" data-id="{{ $product->id }}" data-item-name="{{ $product->item_name }}"
                                        data-item-code="{{ $product->item_code }}" data-item-model="{{ $product->item_model }}" data-brand="{{ $product->brand }}" data-slug="{{ $product->slug }}" data-unit="{{ $product->unit }}" data-tax="{{ $product->tax }}"
                                        data-tax-type="{{ $product->tax_type }}" data-status="@if ($product->status == 1) Active @else Inactive @endif" data-regular-price="{{ $product->regular_price }}" data-discount="{{ $product->discount }}" data-selling-price="{{ $product->selling_price }}"
                                        data-note="{{ $product->note }}" data-sub-cat="{{ $product->subCategory->name }}">
                                    </i>
                                    <i style="cursor: pointer;" class="fa-solid fa-trash text-danger delete-category" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-url="{{ route('product.delete', $product->id) }}">
                                    </i>
                                </div>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            {{ $products->appends(request()->query())->links() }}
            @include('parts.productModal')
        </div>

    </main>
@endsection
