@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Farm List</h5>
            <button class="btn btn-sm btn-primary" id="addFarmBtn">+ Add Farm</button>
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
                    @foreach ($farms as $i => $f)
                        <tr data-id="{{ $f->id }}">
                            <td>{{ $i + 1 }}</td>
                            <td class="name">{{ $f->name }}</td>
                            <td class="owner">{{ $f->owner }}</td>
                            <td class="address">{{ $f->address }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editFarm">Edit</button>
                                <button class="btn btn-sm btn-danger deleteFarm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
