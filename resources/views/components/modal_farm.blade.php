<div class="modal fade" id="farmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-sm">
            <form id="farmForm">
                @csrf
                <input type="hidden" id="farm_id" name="farm_id">

                <div class="modal-header bg-primary text-white py-2">
                    <h6 class="modal-title fw-semibold">Farm Form</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold small mb-1">Farm Name</label>
                                <input type="text" id="name" name="name" class="form-control form-control-sm"
                                    placeholder="Enter farm name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="owner" class="form-label fw-semibold small mb-1">Owner</label>
                                <input type="text" id="owner" name="owner" class="form-control form-control-sm"
                                    placeholder="Enter owner's name" required>
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label fw-semibold small mb-1">Address</label>
                                <textarea id="address" name="address" class="form-control form-control-sm" rows="3" placeholder="Enter address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
