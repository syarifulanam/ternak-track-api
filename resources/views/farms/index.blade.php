@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ url('/farms') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search by Name</label>
                        <input type="text" class="form-control form-control-sm" id="search" name="search"
                            value="{{ request('search') }}" placeholder="Enter farms name...">
                    </div>
                    <div class="col-md-4">
                        <label for="search_owner" class="form-label">Search by Owner</label>
                        <input type="text" class="form-control form-control-sm" id="search_owner" name="search_owner"
                            value="{{ request('search_owner') }}" placeholder="Enter farms owner...">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="d-flex gap-2 w-100">
                            <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">

                            <button type="submit" class="btn btn-primary btn-sm">
                                Search
                            </button>

                            @if (request('search') || request('search_owner'))
                                <a href="{{ route('web.farms.index', ['per_page' => request('per_page', 10)]) }}"
                                    class="btn btn-outline-secondary">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">List Farms</h6>

                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center mr-3">
                        <label for="perPageSelect" class="mb-0 small text-muted mr-1">Show</label>
                        <select name="per_page" id="perPageSelect" class="custom-select custom-select-sm">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10
                            </option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <span class="small text-muted ml-1">entries</span>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm px-3 py-2" id="addFarmBtn">
                        <i class="fa fa-plus mr-1"></i> Add Farm
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="8%">#</th>
                            <th>Name</th>
                            <th>Owner</th>
                            <th>Address</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="farmTableBody">
                        @forelse ($farms as $i => $f)
                            <tr data-id="{{ $f->id }}">
                                <td>{{ ($farms->currentPage() - 1) * $farms->perPage() + $loop->iteration }}</td>
                                <td class="name" style="text-align: left;">{{ $f->name }}</td>
                                <td class="owner" style="text-align: left;">{{ $f->owner }}</td>
                                <td class="address" style="text-align: left;">{{ $f->address }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Farm Actions">
                                        <button type="button" class="btn btn-outline-warning btn-md editFarm"
                                            title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-md deleteFarm"
                                            title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    @if (request('search') || request('search_email'))
                                        <i class="fas fa-search fa-2x mb-2"></i>
                                        <br>No farms found matching your search criteria
                                        <br>
                                        <small>Try different keywords or <a
                                                href="{{ route('farms.index') }}?per_page={{ request('per_page', 10) }}">clear
                                                filters</a></small>
                                    @else
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <br>No farms found
                                        <br>
                                        <small>Start by adding your first farm</small>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($farms->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $farms->firstItem() }} to {{ $farms->lastItem() }} of
                            {{ $farms->total() }} results
                        </div>
                        <div>
                            {{ $farms->links('pagination.custom') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('components.toast_message')
    @include('components.modal_delete')
    @include('components.modal_farm')
@endsection

@section('scripts')
    <script>
        $(function() {
            // $(document).on('keyup', function(e) {
            //     if (e.key === 'Escape') {
            //         $('.modal.show').modal('hide');
            //     }
            // });

            // $('.modal').on('click', function(e) {
            //     if (e.target === this) {
            //         $(this).modal('hide');
            //     }
            // });

            $('#addFarmBtn').click(function() {
                $('#farmForm').trigger('reset');
                $('#farm_id').val('');
                $('#farmModal').modal('show');
                $('#modalTitle').text('Add Farm Form')
            });

            $('#farmForm').submit(function(e) {
                e.preventDefault();

                var $form = $(this);
                var id = $('#farm_id').val();
                var formData = $form.serialize();

                if (id) {
                    $.ajax({
                            url: '/farms/' + id,
                            type: 'PUT',
                            data: formData
                        })
                        .done(function() {
                            $('#farmModal').modal('hide');
                            location.reload();
                        })
                        .fail(function(xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message || 'Failed to update farm'));
                        });
                } else {
                    $.post('/farms', formData)
                        .done(function() {
                            $('#farmModal').modal('hide');
                            location.reload();
                        })
                        .fail(function(xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message || 'Failed to create farm'));
                        });
                }
            });

            $(document).on('click', '.editFarm', function() {
                var id = $(this).closest('tr').data('id');
                var $btn = $(this);

                var originalHtml = $btn.html();

                $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

                $.get('/farms/' + id)
                    .done(function(response) {
                        var farm = response.farm;
                        $('#farm_id').val(farm.id);
                        $('#name').val(farm.name);
                        $('#owner').val(farm.owner);
                        $('#address').val(farm.address || '');
                        $('#modalTitle').text('Edit Farm Form')
                        $('#farmModal').modal('show');
                    })
                    .fail(function() {
                        alert('Failed to load farm data');
                    })
                    .always(function() {
                        $btn.prop('disabled', false).html(originalHtml);
                    });
            });

            var deleteId = null;

            $(document).on('click', '.deleteFarm', function() {
                deleteId = $(this).closest('tr').data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#btnConfirmDelete').click(function() {
                if (!deleteId) return;

                $.ajax({
                        url: '/farms/' + deleteId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    })
                    .done(function() {
                        $('#confirmDeleteModal').modal('hide');
                        location.reload();
                    })
                    .fail(function() {
                        $('#confirmDeleteModal').modal('hide');
                        alert('Failed to delete farm');
                    });
            });

            $('#perPageSelect').change(function() {
                const perPage = $(this).val();
                const $select = $(this);

                $select.prop('disabled', true);

                const url = new URL(window.location);
                url.searchParams.set('per_page', perPage);
                url.searchParams.delete('page');
                window.location.href = url.toString();
            });
        });
    </script>
@endsection
