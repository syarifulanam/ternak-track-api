@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('web.users.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search_name" class="form-label">Search by Name</label>
                        <input type="text" class="form-control form-control-sm" id="search_name" name="search_name"
                            value="{{ request('search_name') }}" placeholder="Enter user name...">
                    </div>

                    <div class="col-md-4">
                        <label for="search_email" class="form-label">Search by Email</label>
                        <input type="text" class="form-control form-control-sm" id="search_email" name="search_email"
                            value="{{ request('search_email') }}" placeholder="Enter email...">
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="d-flex w-100">
                            <button type="submit" class="btn btn-primary btn-sm mr-2 px-3 py-2">Search</button>
                            @if (request('search_email') || request('search_name'))
                                <a href="{{ route('web.users.index', ['per_page' => request('per_page', 10)]) }}"
                                    class="btn btn-outline-secondary">Clear</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 font-weight-bold">Users</h6>

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

                    <button type="button" class="btn btn-primary btn-sm px-3 py-2" id="addUserBtn">
                        <i class="fa fa-plus mr-1"></i> Add User
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $u)
                            <tr data-id="{{ $u->id }}">
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-info btn-sm passwordUser"
                                            title="Update Password">
                                            <i class="fa fa-lock"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-warning btn-sm editUser"
                                            title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm deleteUser"
                                            title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No user records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($users->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }}
                        </div>
                        <div>
                            {{ $users->links('pagination.custom') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('components.toast_message')
    @include('components.modal_delete')
    @include('components.modal_user')
    @include('components.modal_password')
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#addUserBtn').click(function() {
                $('#userForm').trigger('reset');
                $('#user_id').val('');
                $('#modalTitle').text('Add User');
                $('#userModal').modal('show');
            });

            $(document).on('click', '.editUser', function() {
                var id = $(this).closest('tr').data('id');
                $.get('/users/' + id, function(response) {
                    var u = response.user;
                    $('#user_id').val(u.id);
                    $('#name').val(u.name);
                    $('#email').val(u.email);
                    $('#password').val('');
                    $('#modalTitle').text('Edit User');
                    $('#userModal').modal('show');
                });
            });

            $('#userForm').submit(function(e) {
                e.preventDefault();
                var id = $('#user_id').val();
                var formData = $(this).serialize();

                if (id) {
                    $.ajax({
                        url: '/users/' + id,
                        type: 'PUT',
                        data: formData
                    }).done(function() {
                        $('#userModal').modal('hide');
                        location.reload();
                    });
                } else {
                    $.post('/users', formData).done(function() {
                        $('#userModal').modal('hide');
                        location.reload();
                    });
                }
            });

            $(document).on('click', '.passwordUser', function() {
                var id = $(this).closest('tr').data('id');
                $('#password_user_id').val(id);
                $('#passwordForm')[0].reset();
                $('#passwordModal').modal('show');
            });

            $('#passwordForm').submit(function(e) {
                e.preventDefault();
                var id = $('#password_user_id').val();
                var formData = $(this).serialize();

                $.ajax({
                    url: '/users/' + id + '/password',
                    type: 'PUT',
                    data: formData,
                }).done(function() {
                    $('#passwordModal').modal('hide');
                    location.reload();
                }).fail(function(xhr) {
                    alert('Error: ' + xhr.responseJSON.message);
                });
            });

            var deleteId = null;
            $(document).on('click', '.deleteUser', function() {
                deleteId = $(this).closest('tr').data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#btnConfirmDelete').click(function() {
                if (!deleteId) return;
                $.ajax({
                    url: '/users/' + deleteId,
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
