@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('web.vaccinations.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search_animal" class="form-label">Search by Animal Code</label>
                        <input type="text" class="form-control form-control-sm" id="search_animal" name="search_animal"
                            value="{{ request('search_animal') }}" placeholder="Enter Animal Code...">
                    </div>

                    <div class="col-md-4">
                        <label for="search_date" class="form-label">Search by Vaccination Date</label>
                        <input type="date" class="form-control form-control-sm" id="search_date" name="search_date"
                            value="{{ request('search_date') }}">
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="d-flex w-100">
                            <button type="submit" class="btn btn-primary btn-sm mr-2 px-3 py-2">Search</button>
                            @if (request('search_animal') || request('search_date'))
                                <a href="{{ route('web.vaccinations.index', ['per_page' => request('per_page', 10)]) }}"
                                    class="btn btn-outline-secondary">Clear</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Vaccinations</h6>

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

                    <button type="button" class="btn btn-primary btn-sm px-3 py-2" id="addVaccinationBtn">
                        <i class="fa fa-plus mr-1"></i> Vaccination
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Animal</th>
                            <th>Vaccination Date</th>
                            <th>Vaccine Type</th>
                            <th>Dosage</th>
                            <th>Staff</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vaccinations as $v)
                            <tr data-id="{{ $v->id }}">
                                <td>{{ ($vaccinations->currentPage() - 1) * $vaccinations->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $v->animal ? $v->animal->code_animal . ' - ' . $v->animal->species : '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($v->vaccination_date)->format('Y-m-d') }}</td>
                                <td>{{ $v->vaccine_type }}</td>
                                <td>{{ $v->dosage }}</td>
                                <td>{{ $v->staff }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-warning btn-md editVaccination"
                                            title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-md deleteVaccination"
                                            title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No vaccination records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($vaccinations->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $vaccinations->firstItem() }} to {{ $vaccinations->lastItem() }} of
                            {{ $vaccinations->total() }}
                        </div>
                        <div>
                            {{ $vaccinations->links('pagination.custom') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('components.toast_message')
    @include('components.modal_delete')
    @include('components.modal_vaccination')
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#addVaccinationBtn').click(function() {
                $('#vaccinationForm').trigger('reset');
                $('#vaccination_id').val('');
                $('#modalTitle').text('Add Vaccination');
                $('#vaccinationModal').modal('show');
            });

            $(document).on('click', '.editVaccination', function() {
                var id = $(this).closest('tr').data('id');
                $.get('/vaccinations/' + id, function(response) {
                    var v = response.vaccination;
                    $('#vaccination_id').val(v.id);
                    $('#animal_id').val(v.animal_id);
                    $('#vaccination_date').val(v.vaccination_date);
                    $('#vaccine_type').val(v.vaccine_type);
                    $('#dosage').val(v.dosage);
                    $('#staff').val(v.staff);
                    $('#modalTitle').text('Edit Vaccination');
                    $('#vaccinationModal').modal('show');
                });
            });

            $('#vaccinationForm').submit(function(e) {
                e.preventDefault();
                var id = $('#vaccination_id').val();
                var formData = $(this).serialize();

                if (id) {
                    $.ajax({
                        url: '/vaccinations/' + id,
                        type: 'PUT',
                        data: formData
                    }).done(function() {
                        $('#vaccinationModal').modal('hide');
                        location.reload();
                    });
                } else {
                    $.post('/vaccinations', formData).done(function() {
                        $('#vaccinationModal').modal('hide');
                        location.reload();
                    });
                }
            });

            var deleteId = null;
            $(document).on('click', '.deleteVaccination', function() {
                deleteId = $(this).closest('tr').data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#btnConfirmDelete').click(function() {
                if (!deleteId) return;
                $.ajax({
                    url: '/vaccinations/' + deleteId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                }).done(function() {
                    $('#confirmDeleteModal').modal('hide');
                    location.reload();
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
