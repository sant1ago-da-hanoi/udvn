@extends('layouts.app')
@section('title', 'Categories management')

@section('style')
    <!-- page css -->
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="content">
        <div class="main">
            <div class="page-header">
                <h4 class="page-title">
                    {{ __('admin/categories.title') }}
                </h4>
                <div class="breadcrumb">
                    <span class="me-1 text-gray"><i class="feather icon-home"></i></span>
                    <div class="breadcrumb-item"><a href="/"> Home </a></div>
                    <div class="breadcrumb-item"><a href="/admin/dashboard"> Dashboard </a></div>
                    <div class="breadcrumb-item"><a href="/admin/categories"> Categories </a></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4>
                        {{ __('admin/categories.total') }}
                    </h4>
                    <div class="mt-4">
                        <table id="data-table" class="table data-table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('admin/categories.id') }}
                                    </th>
                                    <th>
                                        {{ __('admin/categories.name') }}
                                    </th>
                                    <th>
                                        {{ __('admin/categories.created-at') }}
                                    </th>
                                    <th>
                                        {{ __('admin/categories.updated-at') }}
                                    </th>
                                    <th>
                                        {{ __('admin/categories.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            <a href="{{ route('category.detail', ['slug' => $category->path]) }}">
                                                {{ $category->name }}
                                            </a>
                                        </td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td style="display: flex">
                                            <a href="#" class="btn btn-primary me-2">
                                                {{ __('admin/categories.button-edit') }}
                                            </a>
                                            <button class="btn btn-danger" data-bs-toggle="modal" type="button"
                                                data-bs-target="#deleteModal"
                                                onclick="delete_category({{ $category->id }});">
                                                {{ __('admin/categories.button-delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="5">
                                            {{ __('admin/categories.no-data') }}
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>
                                        {{ __('admin/categories.id') }}
                                    </th>
                                    <th>
                                        {{ __('admin/categories.name') }}
                                    </th>
                                    <th>
                                        {{ __('admin/categories.created-at') }}
                                    </th>
                                    <th>
                                        {{ __('admin/categories.updated-at') }}
                                    </th>
                                    <th>
                                        {{ __('admin/categories.actions') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">You sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    This can be undone!
                </div>
                <div class="modal-footer">
                    <form action="{{ route('category.delete') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="category_id" id="category_id" value="0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        let category_id;

        function delete_category(id) {
            category_id = document.getElementById('category_id');
            category_id.value = id;
        }
    </script>

    <!-- page js -->
    <script src="{{ asset(__('admin/categories.script-dataTables-vi')) }}"></script>
    <script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('.data-table').DataTable({
            'columnDefs': [{
                'orderable': false,
                'targets': 0
            }]
        });
    </script>
@stop
