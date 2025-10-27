@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('web.animals.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search_qr" class="form-label">Search by QR Code</label>
                        <input type="text" class="form-control form-control-sm" id="search_qr" name="search_qr"
                            value="{{ request('search_qr') }}" placeholder="Enter QR Code...">
                    </div>

                    <div class="col-md-4">
                        <label for="search_species" class="form-label">Search by Species</label>
                        <input type="text" class="form-control form-control-sm" id="search_species" name="search_species"
                            value="{{ request('search_species') }}" placeholder="Enter species...">
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="d-flex w-100">
                            <button type="submit" class="btn btn-primary btn-sm mr-2 px-3 py-2">
                                Search
                            </button>
                            @if (request('search_qr') || request('search_species'))
                                <a href="{{ route('web.animals.index', ['per_page' => request('per_page', 10)]) }}"
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
                <h6 class="mb-0">List Animals</h6>

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

                    <button type="button" class="btn btn-primary btn-sm px-3 py-2" id="addAnimalBtn">
                        <i class="fa fa-plus mr-1"></i> Add Animal
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>QR Code</th>
                            <th>Animal Code</th>
                            <th>Species</th>
                            <th>Birth Date</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Cage</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="animalTableBody">
                        @forelse ($animals as $a)
                            <tr data-id="{{ $a->id }}">
                                <td>{{ ($animals->currentPage() - 1) * $animals->perPage() + $loop->iteration }}</td>
                                <td>{{ $a->qr_code }}</td>
                                <td>{{ $a->code_animal }}</td>
                                <td class="text-capitalize">{{ $a->species }}</td>
                                <td>{{ $a->birth_date ? \Carbon\Carbon::parse($a->birth_date)->format('Y-m-d') : '-' }}
                                </td>
                                <td class="text-capitalize">{{ $a->gender }}</td>
                                <td class="text-capitalize">{{ $a->status }}</td>
                                <td>{{ $a->cage->name ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Animal Actions">
                                        <button type="button" class="btn btn-outline-warning btn-md editAnimal"
                                            title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-md deleteAnimal"
                                            title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    @if (request('search_qr') || request('search_species'))
                                        <i class="fas fa-search fa-2x mb-2"></i><br>
                                        No animals found matching your search criteria.<br>
                                        <small>Try different keywords or
                                            <a href="{{ route('web.animals.index') }}">clear filters</a>.
                                        </small>
                                    @else
                                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                        No animals found.<br>
                                        <small>Start by adding your first animal.</small>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($animals->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $animals->firstItem() }} to {{ $animals->lastItem() }} of {{ $animals->total() }}
                            results
                        </div>
                        <div>
                            {{ $animals->links('pagination.custom') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('components.toast_message')
    @include('components.modal_delete')
    @include('components.modal_animal')
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#addAnimalBtn').click(function() {
                $('#animalForm').trigger('reset');
                $('#animal_id').val('');
                $('#animalModal').modal('show');
            });

            $(document).on('click', '.editAnimal', function() {
                var animalId = $(this).closest('tr').data('id');
                $.get('/animals/' + animalId)
                    .done(function(response) {
                        var animal = response.animal;
                        $('#animal_id').val(animal.id);
                        $('#qr_code').val(animal.qr_code);
                        $('#code_animal').val(animal.code_animal);
                        $('#species').val(animal.species);
                        $('#birth_date').val(animal.birth_date);
                        $('#gender').val(animal.gender);
                        $('#animalModal').modal('show');
                    })
                    .fail(function() {
                        alert('Failed to load animal data.');
                    });
            });

            $('#animalForm').submit(function(e) {
                e.preventDefault();
                var id = $('#animal_id').val();
                var formData = $(this).serialize();

                if (id) {
                    $.ajax({
                            url: '/animals/' + id,
                            type: 'PUT',
                            data: formData
                        })
                        .done(function() {
                            $('#animalModal').modal('hide');
                            location.reload();
                        })
                        .fail(function(xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message || 'Update failed.'));
                        });
                } else {
                    $.post('/animals', formData)
                        .done(function() {
                            $('#animalModal').modal('hide');
                            location.reload();
                        })
                        .fail(function(xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message || 'Create failed.'));
                        });
                }
            });

            var deleteId = null;
            $(document).on('click', '.deleteAnimal', function() {
                deleteId = $(this).closest('tr').data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#btnConfirmDelete').click(function() {
                if (!deleteId) return;
                $.ajax({
                        url: '/animals/' + deleteId,
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
                        alert('Failed to delete animal.');
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
