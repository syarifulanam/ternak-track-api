@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('web.breedings.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="search_dam" class="form-label">Search by Dam Code</label>
                        <input type="text" class="form-control form-control-sm" id="search_dam" name="search_dam"
                            value="{{ request('search_dam') }}" placeholder="Enter Dam Code...">
                    </div>

                    <div class="col-md-3">
                        <label for="search_sire" class="form-label">Search by Sire Code</label>
                        <input type="text" class="form-control form-control-sm" id="search_sire" name="search_sire"
                            value="{{ request('search_sire') }}" placeholder="Enter Sire Code...">
                    </div>

                    <div class="col-md-3">
                        <label for="search_status" class="form-label">Search by Status</label>
                        <select name="search_status" id="search_status" class="form-control form-control-sm">
                            <option value="">-- Select Status --</option>
                            <option value="Success" {{ request('search_status') == 'Success' ? 'selected' : '' }}>Success
                            </option>
                            <option value="Failed" {{ request('search_status') == 'Failed' ? 'selected' : '' }}>
                                Failed</option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary btn-sm mr-2 px-3 py-2">Search</button>
                        @if (request('search_dam') || request('search_sire') || request('search_status'))
                            <a href="{{ route('web.breedings.index', ['per_page' => request('per_page', 10)]) }}"
                                class="btn btn-outline-secondary btn-sm px-3 py-2">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Breeding Records</h6>

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

                    <button type="button" class="btn btn-primary btn-sm px-3 py-2" id="addBreedingBtn">
                        <i class="fa fa-plus mr-1"></i> Breeding
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Dam</th>
                            <th>Sire</th>
                            <th>Mating Date</th>
                            <th>Status</th>
                            <th>Expected Birth</th>
                            <th>Notes</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($breedings as $b)
                            <tr data-id="{{ $b->id }}">
                                <td>{{ ($breedings->currentPage() - 1) * $breedings->perPage() + $loop->iteration }}</td>
                                <td>{{ $b->dam ? $b->dam->code_animal . ' - ' . $b->dam->species : '-' }}</td>
                                <td>{{ $b->sire ? $b->sire->code_animal . ' - ' . $b->sire->species : '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->mating_date)->format('Y-m-d') }}</td>
                                <td>{{ $b->status }}</td>
                                <td>{{ $b->expected_birth_date ? \Carbon\Carbon::parse($b->expected_birth_date)->format('Y-m-d') : '-' }}
                                </td>
                                <td>{{ $b->notes ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-warning btn-md editBreeding"
                                            title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-md deleteBreeding"
                                            title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No breeding records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($breedings->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $breedings->firstItem() }} to {{ $breedings->lastItem() }} of
                            {{ $breedings->total() }}
                        </div>
                        <div>
                            {{ $breedings->links('pagination.custom') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('components.toast_message')
    @include('components.modal_delete')
    @include('components.modal_breeding')
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#addBreedingBtn').click(function() {
                $('#breedingForm').trigger('reset');
                $('#breeding_id').val('');
                $('#modalTitle').text('Add Breeding Record');
                $('#breedingModal').modal('show');
            });

            $(document).on('click', '.editBreeding', function() {
                var id = $(this).closest('tr').data('id');
                $.get('/breedings/' + id, function(response) {
                    var b = response.breeding;
                    $('#breeding_id').val(b.id);
                    $('#dam_id').val(b.dam_id);
                    $('#sire_id').val(b.sire_id);
                    $('#mating_date').val(b.mating_date);
                    $('#status').val(b.status);
                    $('#expected_birth_date').val(b.expected_birth_date);
                    $('#notes').val(b.notes);
                    $('#modalTitle').text('Edit Breeding Record');
                    $('#breedingModal').modal('show');
                });
            });

            $('#breedingForm').submit(function(e) {
                e.preventDefault();
                var id = $('#breeding_id').val();
                var formData = $(this).serialize();

                if (id) {
                    $.ajax({
                        url: '/breedings/' + id,
                        type: 'PUT',
                        data: formData
                    }).done(function() {
                        $('#breedingModal').modal('hide');
                        location.reload();
                    }).fail(function(xhr) {
                        console.log('Update Error:', xhr.responseJSON);
                    });
                } else {
                    $.post('/breedings', formData)
                        .done(function() {
                            $('#breedingModal').modal('hide');
                            location.reload();
                        })
                        .fail(function(xhr) {
                            console.log('Create Error:', xhr.responseJSON);
                        });
                }
            });

            var deleteId = null;
            $(document).on('click', '.deleteBreeding', function() {
                deleteId = $(this).closest('tr').data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#btnConfirmDelete').click(function() {
                if (!deleteId) return;
                $.ajax({
                    url: '/breedings/' + deleteId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                }).done(function() {
                    $('#confirmDeleteModal').modal('hide');
                    location.reload();
                }).fail(function(xhr) {
                    console.log('Delete Error:', xhr.responseJSON);
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
