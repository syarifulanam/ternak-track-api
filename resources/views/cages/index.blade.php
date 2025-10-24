@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cage List</h5>
            <button class="btn btn-sm btn-primary" id="addCageBtn">+ Add Cage</button>
        </div>

        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Farm</th>
                        <th>Name</th>
                        <th>Capacity</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody id="cageTableBody">
                    @foreach ($cages as $i => $c)
                        <tr data-id="{{ $c->id }}">
                            <td>{{ $i + 1 }}</td>
                            <td class="farm_id" data-farm="{{ $c->farm_id }}">{{ $c->farm->name ?? '-' }}</td>
                            <td class="name">{{ $c->name }}</td>
                            <td class="capacity">{{ $c->capacity }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editCage">Edit</button>
                                <button class="btn btn-sm btn-danger deleteCage">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('components.modal_cage', ['cages' => $cages])
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            const modal = new bootstrap.Modal('#cageModal');

            $('#addCageBtn').click(function() {
                $('#cageForm')[0].reset();
                $('#cage_id').val('');
                modal.show();
            });

            // Submit form (Create / Update)
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
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON?.message ?? 'Unknown error'));
                    }
                });
            });

            // Edit data
            $('.editCage').click(function() {
                const tr = $(this).closest('tr');
                $('#cage_id').val(tr.data('id'));
                $('#farm_id').val(tr.find('.farm_id').data('farm'));
                $('#name').val(tr.find('.name').text());
                $('#capacity').val(tr.find('.capacity').text());
                modal.show();
            });

            // Hapus data
            $('.deleteCage').click(function() {
                if (!confirm('Are you sure want to delete this cage?')) return;
                const id = $(this).closest('tr').data('id');

                $.ajax({
                    url: `/cages/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function() {
                        alert('Failed to delete');
                    }
                });
            });
        });
    </script>
@endsection
