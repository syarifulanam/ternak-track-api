<div class="modal fade" id="farmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="farmForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Farm Form</h5>
                    <button type="button" class="close" onclick="$('#farmModal').modal('hide')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="farm_id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Farm Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Enter farm name" required>
                    </div>

                    <div class="mb-3">
                        <label for="owner" class="form-label">Owner</label>
                        <input type="text" id="owner" name="owner" class="form-control"
                            placeholder="Enter owner's name" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter address"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="$('#farmModal').modal('hide')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
