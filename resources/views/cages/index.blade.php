@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ url('/cages') }}" class="row">
                    <div class="col-md-4">
                        <label for="search_name" class="form-label">Search by Name</label>
                        <input type="text" class="form-control form-control-sm" id="search_name" name="search_name"
                            value="{{ request('search_name') }}" placeholder="Enter cage name...">
                    </div>

                    <div class="col-md-4">
                        <label for="search_cage" class="form-label">Search by Cages</label>
                        <input type="text" class="form-control form-control-sm" id="search_cage" name="search_cage"
                            value="{{ request('search_cage') }}" placeholder="Enter cage name...">
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="d-flex w-100">
                            <button type="submit" class="btn btn-primary btn-sm mr-2 px-3 py-2">
                                Search
                            </button>
                            @if (request('search_name') || request('search_cage'))
                                <a href="{{ route('web.cages.index') }}" class="btn btn-outline-secondary btn-sm px-3 py-2">
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
                <h6 class="mb-0">List Cages</h6>

                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center mr-3">
                        <label for="perPageSelect" class="mb-0 small text-muted mr-1">Show</label>
                        <select name="per_page" id="perPageSelect" class="custom-select custom-select-sm">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <span class="small text-muted ml-1">entries</span>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm px-3 py-2" id="addCageBtn">
                        <i class="fa fa-plus mr-1"></i> Add Cage
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="8%">#</th>
                            <th>Farm</th>
                            <th>Name</th>
                            <th>Capacity</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="cageTableBody">
                        @forelse ($cages as $i => $c)
                            <tr data-id="{{ $c->id }}">
                                <td>{{ ($cages->currentPage() - 1) * $cages->perPage() + $loop->iteration }}</td>
                                <td data-farm="{{ $c->farm_id }}">{{ $c->farm->name ?? '-' }}</td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->capacity }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Cage Actions">
                                        <button type="button" class="btn btn-outline-warning btn-md editCage"
                                            title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-md deleteCage"
                                            title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    @if (request('search_name') || request('search_farm'))
                                        <i class="fas fa-search fa-2x mb-2"></i><br>
                                        No cages found matching your search criteria.<br>
                                        <small>Try different keywords or
                                            <a href="{{ route('web.cages.index') }}">clear filters</a>.
                                        </small>
                                    @else
                                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                        No cages found.<br>
                                        <small>Start by adding your first cage.</small>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($cages->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $cages->firstItem() }} to {{ $cages->lastItem() }} of {{ $cages->total() }}
                            results
                        </div>
                        <div>
                            {{ $cages->links('pagination.custom') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('components.modal_cage', ['cages' => $cages])
@endsection

@section('scripts')
    <script>
        $(function() {
            const modal = new bootstrap.Modal('#cageModal');
            $('#addCageBtn').click(function() {
                $('#cageForm')[0].reset();
                $('#cage_id').val('');
                modal.show();
            });

            $('#cageForm').submit(function(e) {
                e.preventDefault();

                const id = $('#cage_id').val();
                const url = id ? `/cages/${id}` : '/cages';
                const method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        farm_id: $('#farm_id').val(),
                        name: $('#name').val(),
                        capacity: $('#capacity').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        modal.hide();
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan.'));
                    }
                });
            });

            $('.editCage').click(function() {
                const id = $(this).closest('tr').data('id');
                const $btn = $(this);
                $btn.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: `/cages/${id}`,
                    method: 'GET',
                    success: function(response) {
                        const cage = response.cage;

                        $('#cage_id').val(cage.id);
                        $('#farm_id').val(cage.farm_id);
                        $('#name').val(cage.name);
                        $('#capacity').val(cage.capacity);

                        modal.show();
                    },
                    error: function() {
                        alert('Gagal memuat data cage.');
                    },
                    complete: function() {
                        $btn.prop('disabled', false).text('Edit');
                    }
                });
            });

            let deleteId = null;
            $('.deleteCage').click(function() {
                deleteId = $(this).closest('tr').data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#btnConfirmDelete').click(function() {
                if (!deleteId) return;

                $.ajax({
                    url: `/cages/${deleteId}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#confirmDeleteModal').modal('hide');
                        location.reload();
                    },
                    error: function() {
                        $('#confirmDeleteModal').modal('hide');
                        alert('Gagal menghapus data.');
                    }
                });
            });
        });
    </script>
@endsection
