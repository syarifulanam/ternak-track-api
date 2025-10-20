@extends('layouts.app')

@section('content')
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ url('/farms') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Search by Name</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Enter farms name...">
                </div>
                <div class="col-md-4">
                    <label for="search_owner" class="form-label">Search by Owner</label>
                    <input type="text" class="form-control form-sm" id="search_owner" name="search_owner"
                        value="{{ request('search_owner') }}" placeholder="Enter farms owner...">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <div class="d-flex gap-2 w-100">
                        <!-- Hidden inputs to maintain other parameters -->
                        <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">

                        <button type="submit" class="btn btn-primary">
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
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm" id="perPageSelect" style="width: auto;">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 per page</option>
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                </select>
                <button class="btn btn-sm btn-primary" id="addFarmBtn">+ Add</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Address</th>
                        <th width="15%">Action</th>
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
                                <button class="btn btn-sm btn-warning editFarm">Edit</button>
                                <button class="btn btn-sm btn-danger deleteFarm">Delete</button>
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
    @include('components.toast_message')
    @include('components.modal_delete')
    @include('components.modal_farm')
@endsection

@section('scripts')
    <script>
        $(function() {
            const modal = new bootstrap.Modal('#farmModal');

            $('#addFarmBtn').click(function() {
                $('#farmForm')[0].reset();
                $('#farm_id').val('');
                modal.show();
            });

            $('#farmForm').submit(function(e) {
                e.preventDefault();

                const id = $('#farm_id').val();
                const url = id ? `/farms/${id}` : '/farms';
                const method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        name: $('#name').val(),
                        owner: $('#owner').val(),
                        address: $('#address').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON?.message ||
                            'Something went wrong'));
                    }
                });
            });

            $('.editFarm').click(function() {
                const id = $(this).closest('tr').data('id');
                const $btn = $(this);

                $btn.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: `/farms/${id}`,
                    method: 'GET',
                    success: function(response) {
                        const farm = response.farm;
                        $('#farm_id').val(farm.id);
                        $('#name').val(farm.name);
                        $('#owner').val(farm.owner);
                        $('#address').val(farm.address || '');

                        modal.show();
                    },
                    error: function() {
                        showToast('Failed to load farm data.', 'danger');
                    },
                    complete: function() {
                        $btn.prop('disabled', false).text('Edit');
                    }
                });
            });

            let deleteId = null;
            $('.deleteFarm').click(function() {
                deleteId = $(this).closest('tr').data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#btnConfirmDelete').click(function() {
                if (!deleteId) return;

                $.ajax({
                    url: `/farms/${deleteId}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#confirmDeleteModal').modal('hide');
                        location.reload();
                        showToast('Data berhasil dihapus.', 'success');
                    },
                    error: function() {
                        $('#confirmDeleteModal').modal('hide');
                        showToast('Gagal menghapus data.', 'danger');
                    }
                });
            });
        });
    </script>
@endsection
