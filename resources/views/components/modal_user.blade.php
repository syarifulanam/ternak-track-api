{{-- Add / Edit User Modal --}}
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded">
            <form id="userForm">
                @csrf
                <input type="hidden" id="user_id" name="user_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="userModalLabel">
                        <i class="fas fa-user mr-2"></i><span id="modalTitle">Add User</span>
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-4 py-3">
                    <div id="alertBox"></div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name" class="font-weight-semibold">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter full name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="font-weight-semibold">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter email address" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password" class="font-weight-semibold">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="At least 6 characters">
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
