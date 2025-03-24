@extends('layouts.mainLayouts', ['page' => 'Sub Category'])

@section('js')
    <script src="{{ asset('assets/main/js/SubCategoryModals.js') }}"></script>
@endsection
@section('cssLinks')
    <link rel="stylesheet" href="{{ asset('assets/main/css/formStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/main/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('body')
    @session('success')
        <x-alert type="success" message="{{ session('success') }}" />
    @endsession
    @session('error')
        <x-alert type="danger" message="{{ session('error') }}" />
    @endsession
    <main>
        <div class="container mt-5 bg-light p-3 rounded-3 shadow-sm">
            <h3>Sub Categories</h3>
            <div class="heading d-flex flex-row align-items-center justify-content-between">
                <form method="GET" action="{{ url()->current() }}" class="d-flex w-50">
                    <input type="text" id="searchInput" name="search" class="form-control w-100" placeholder="Search..." value="{{ request('search') }}" />
                    <button type="submit" class="btn btn-primary ms-2">Search</button>
                </form>
                <div class="d-flex gap-1">
                    <select id="perPageSelect" class="form-select">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <a href="{{ route('subcategory.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <hr>
            <table id="" class="table table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
                        <th>#</th>
                        <th>Category</th>
                        <th>Sub Category Code</th>
                        <th>Sub Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subCategories as $subCategory)
                        <tr>
                            <td>{{ ($subCategories->currentPage() - 1) * $subCategories->perPage() + $loop->iteration }}</td>
                            {{-- <td>{{ $subCategory->id }}</td> --}}
                            <td>{{ $subCategory->category->name }} [APC-{{ $subCategory->category->id }}]</td>
                            <td>APS-{{ $subCategory->id }}</td>
                            <td>{{ $subCategory->name }}</td>
                            <td>
                                @if ($subCategory->status == 1)
                                    <span class="bg-primary rounded-5 px-2 text-white fs-6">Active</span>
                                @else
                                    <span class="bg-danger rounded-5 px-2 text-white fs-6">Inactive</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-around align-items-center">
                                <a href="{{ route('subcategory.edit', $subCategory->id) }}"><i class="fa-solid fa-pen-to-square text-dark"></i></a>
                                <!-- View Details Icon -->
                                <a href="#" class="text-primary view-category" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="{{ $subCategory->id }}" data-name="{{ $subCategory->name }}" data-slug="{{ $subCategory->slug }}" data-code="{{ $subCategory->code }}"
                                    data-note="{{ $subCategory->note }}" data-status="@if ($subCategory->status == 1) Active @else  Inactive @endif" data-category="{{ $subCategory->category->name }}">
                                    <i class="fa-solid fa-eye text-info"></i>
                                </a>

                                <!-- Delete Icon -->
                                <i style="cursor: pointer;" class="fa-solid fa-trash text-danger delete-category" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="{{ $subCategory->id }}" data-url="{{ route('subcategory.delete', $subCategory->id) }}">
                                </i>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            {{ $subCategories->appends(request()->query())->links() }}
            @include('parts.subcategoryModals')
        </div>

    </main>
@endsection
