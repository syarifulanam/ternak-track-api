<div class="modal fade" id="cageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="cageForm">
                <div class="modal-header">
                    <h5 class="modal-title">Cage Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="cage_id">

                    <div class="mb-3">
                        <label for="farm_id" class="form-label">Farm</label>
                        <select id="farm_id" class="form-select" required>
                            <option value="">-- Select Farm --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Cage Name</label>
                        <input type="text" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="number" id="capacity" class="form-control" required min="1">
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