<div class="modal fade" id="farmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="farmForm">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Farm Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="farm_id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Farm Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter farm name"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="owner" class="form-label">Owner</label>
                        <input type="text" id="owner" class="form-control" placeholder="Enter owner name"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea id="address" class="form-control" placeholder="Enter farm address" rows="2" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
