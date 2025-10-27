@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('web.cages.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search by Cage Name</label>
                        <input type="text" class="form-control form-control-sm" id="search" name="search"
                            value="{{ request('search') }}" placeholder="Enter cage name...">
                    </div>

                    <div class="col-md-4">
                        <label for="search_capacity" class="form-label">Search by Cages</label>
                        <input type="number" class="form-control form-control-sm" id="search_capacity"
                            name="search_capacity" value="{{ request('search_capacity') }}" placeholder="Enter capacity...">
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="d-flex w-100">
                            <button type="submit" class="btn btn-primary btn-sm mr-2 px-3 py-2">
                                Search
                            </button>
                            @if (request('search') || request('search_capacity'))
                                <a href="{{ route('web.cages.index', ['per_page' => request('per_page', 10)]) }}"
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
                            <th>Farm Name</th>
                            <th>Cage Name</th>
                            <th>Cage Capacity</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="cageTableBody">
                        @forelse ($cages as $i => $c)
                            <tr data-id="{{ $c->id }}">
                                <td>{{ ($cages->currentPage() - 1) * $cages->perPage() + $loop->iteration }}</td>
                                <td data-farm="{{ $c->farm_id }}">{{ $c->farm->name ?? '-' }}</td>
                                <td>{{ $c->name }} ({{ $c->id }})</td>
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
    @include('components.toast_message')
    @include('components.modal_delete')
    @include('components.modal_cage')
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

            // ketika button ADD di klik
            $('#addCageBtn').click(function() {
                $('#cageForm').trigger('reset'); // reset form data terakhir
                $('#cage_id').val(''); // untuk hapus id terakhir
                $('#cageModal').modal('show'); // ini untuk mebuka / memunculkan modal 
                // $('#cageModal').modal('show'); // ini untuk menutup modal
            });

            // ketika button EDIT di klik
            $(document).on('click', '.editCage', function() {
                var cageId = $(this).closest('tr').data('id');
                console.log("cageId: " + cageId);

                // muncul DATA by API di dalam FORM Modal 
                $.get('/cages/' + cageId)
                    .done(function(response) {
                        var cage = response.cage;
                        $('#cage_id').val(cage.id);
                        $('#farm_id').val(cage.farm_id);
                        $('#name').val(cage.name);
                        $('#capacity').val(cage.capacity);
                        $('#cageModal').modal('show'); // ini untuk mebuka / memunculkan modal 
                    })
                    .fail(function() {
                        alert('Failed to load cage data.');
                    });
            });

            // ketika ada button SUBMIT dari Form yang dikirim dari MODAL
            $('#cageForm').submit(function(e) {
                e.preventDefault(); // mencegah form reload halaman setelah submit

                // untuk ambil data id baik itu ada atau kosong 
                var id = $('#cage_id').val();

                // untuk ambil data dari body modal form by ID cageForm
                var formData = $(this).serialize();

                if (id) {
                    // jika id / cage_id ada isinya maka 'EDIT DATA'
                    // ajax itu untuk lempar data by API bukan by PHPnya
                    $.ajax({
                            url: '/cages/' + id,
                            type: 'PUT',
                            data: formData
                        })
                        .done(function() {
                            $('#cageModal').modal('hide'); // tutup modal
                            location.reload(); // refresh halaman 
                        })
                        .fail(function(xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan.'));
                        });
                } else {
                    // jika id / cage_id Gak Ada isinya maka 'TAMBAH DATA'
                    $.post('/cages', formData)
                        .done(function() {
                            $('#cageModal').modal('hide'); // tutup modal
                            location.reload(); // refresh halaman 
                        })
                        .fail(function(xhr) {
                            alert('Error: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan.'));
                        });
                }
            });

            var deleteId = null;

            $(document).on('click', '.deleteCage', function() {
                //console.log("ngetes hapus");

                deleteId = $(this).closest('tr').data('id');

                //console.log("deleteId: " + deleteId);

                $('#confirmDeleteModal').modal('show');
            });

            $('#btnConfirmDelete').click(function() {
                if (!deleteId) return;

                $.ajax({
                        url: '/cages/' + deleteId,
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
                        alert('Failed to delete cage');
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
