@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('web.growths.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search_animal" class="form-label">Search by Animal Code</label>
                        <input type="text" class="form-control form-control-sm" id="search_animal" name="search_animal"
                            value="{{ request('search_animal') }}" placeholder="Enter Animal Code...">
                    </div>

                    <div class="col-md-4">
                        <label for="search_date" class="form-label">Search by Date</label>
                        <input type="date" class="form-control form-control-sm" id="search_date" name="search_date"
                            value="{{ request('search_date') }}">
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="d-flex w-100">
                            <button type="submit" class="btn btn-primary btn-sm mr-2 px-3 py-2">
                                Search
                            </button>
                            @if (request('search_animal') || request('search_date'))
                                <a href="{{ route('web.growths.index', ['per_page' => request('per_page', 10)]) }}"
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
                <h6 class="mb-0">Growth List</h6>

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

                    <button type="button" class="btn btn-primary btn-sm px-3 py-2" id="addGrowthBtn">
                        <i class="fa fa-plus mr-1"></i>Growth
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Animal</th>
                            <th>Record Date</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Notes</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="growthTableBody">
                        @forelse ($growths as $g)
                            <tr data-id="{{ $g->id }}">
                                <td>{{ ($growths->currentPage() - 1) * $growths->perPage() + $loop->iteration }}</td>
                                <td>
                                    {{ $g->animal ? $g->animal->code_animal . ' - ' . $g->animal->species : '-' }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($g->record_date)->format('Y-m-d') }}</td>
                                <td>{{ $g->weight_kg }}</td>
                                <td>{{ $g->height_cm }}</td>
                                <td>{{ $g->notes ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-warning btn-md editGrowth"
                                            title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-md deleteGrowth"
                                            title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    @if (request('search_animal') || request('search_date'))
                                        <i class="fas fa-search fa-2x mb-2"></i><br>
                                        No records found matching your search criteria.<br>
                                        <small>Try different keywords or
                                            <a href="{{ route('web.growths.index') }}">clear filters</a>.
                                        </small>
                                    @else
                                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                        No growth records found.<br>
                                        <small>Start by adding your first record.</small>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($growths->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $growths->firstItem() }} to {{ $growths->lastItem() }} of {{ $growths->total() }}
                            results
                        </div>
                        <div>
                            {{ $growths->links('pagination.custom') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('components.toast_message')
    @include('components.modal_delete')
    @include('components.modal_growth')
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#addGrowthBtn').click(function() {
                $('#growthForm').trigger('reset');
                $('#growth_id').val('');
                $('#modalTitle').text('Add Growth');
                $('#growthModal').modal('show');
            });

            // Edit Record
            $(document).on('click', '.editGrowth', function() {
                var id = $(this).closest('tr').data('id');
                $.get('/growths/' + id)
                    .done(function(response) {
                        var g = response.growth;
                        $('#growth_id').val(g.id);
                        $('#animal_id').val(g.animal_id);
                        $('#record_date').val(g.record_date);
                        $('#weight_kg').val(g.weight_kg);
                        $('#height_cm').val(g.height_cm);
                        $('#notes').val(g.notes);
                        $('#modalTitle').text('Edit Growth');
                        $('#growthModal').modal('show');
                    })
                    .fail(function() {
                        alert('Failed to load Growth data.');
                    });
            });

            $('#growthForm').submit(function(e) {
                e.preventDefault();
                var id = $('#growth_id').val();
                var formData = $(this).serialize();

                if (id) {
                    $.ajax({
                            url: '/growths/' + id,
                            type: 'PUT',
                            data: formData
                        })
                        .done(function() {
                            $('#growthModal').modal('hide');
                            location.reload();
                        })
                        .fail(function(xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message || 'Update failed.'));
                        });
                } else {
                    $.post('/growths', formData)
                        .done(function() {
                            $('#growthModal').modal('hide');
                            location.reload();
                        })
                        .fail(function(xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message || 'Create failed.'));
                        });
                }
            });

            var deleteId = null;
            $(document).on('click', '.deleteGrowth', function() {
                deleteId = $(this).closest('tr').data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#btnConfirmDelete').click(function() {
                if (!deleteId) return;
                $.ajax({
                        url: '/growths/' + deleteId,
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
                        alert('Failed to delete record.');
                    });
            });

            $('#perPageSelect').change(function() {
                const perPage = $(this).val();
                const url = new URL(window.location);
                url.searchParams.set('per_page', perPage);
                url.searchParams.delete('page');
                window.location.href = url.toString();
            });
        });
    </script>
@endsection
