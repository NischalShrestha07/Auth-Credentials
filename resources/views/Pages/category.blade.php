@extends('layouts.mainLayouts', ['page' => 'Category'])


@section('cssLinks')
    <link rel="stylesheet" href="{{ asset('assets/main/css/formStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/main/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    <script src="{{ asset('assets/main/js/CategoryModals.js') }}"></script>
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
            <h3>Categories</h3>
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
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>
            <hr>
            <table id="" class="table table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
                        <th>#</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Note</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                            <td>APC-{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->note }}</td>
                            <td>
                                @if ($category->status == 1)
                                    <span class="bg-primary rounded-5 px-2 text-white fs-6">Active</span>
                                @else
                                    <span class="bg-danger rounded-5 px-2 text-white fs-6">Inactive</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-around align-items-center">
                                <a href="{{ route('category.edit', $category->id) }}"><i class="fa-solid fa-pen-to-square text-dark"></i></a>
                                {{-- <a href="{{ route('category.view') }}"><i class="fa-solid fa-eye"></i></a> --}}
                                <!-- Eye Icon (Triggers Modal) -->
                                <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-slug="{{ $category->slug }}" data-code="{{ $category->code }}" data-note="{{ $category->note }}"
                                    data-status="@if ($category->status == 1) Active  @else Inactive @endif">
                                    <i class="fa-solid fa-eye text-info"></i>
                                </a>

                                <!-- Button trigger confirmDelete -->
                                <i style="cursor: pointer;" class="fa-solid fa-trash text-danger delete-category" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-id="{{ $category->id }}" data-url="{{ route('category.delete', $category->id) }} ">
                                </i>
                                {{-- <!-- confirmDelete -->
                                <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="confirmDeleteLabel">Are you sure?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>All products for this category will be deleted!</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <form action="{{ route('category.delete', $category->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger border-0">
                                                        Yes
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->appends(request()->query())->links() }}
            @include('parts.CategoryModals')
        </div>
    </main>
@endsection
