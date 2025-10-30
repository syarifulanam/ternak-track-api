<div class="modal fade" id="farmModal" tabindex="-1" role="dialog" aria-labelledby="farmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded">
            <form id="farmForm">
                @csrf
                <input type="hidden" id="farm_id" name="farm_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="farmModalLabel">
                        <i class="fas fa-tractor mr-2"></i><span id="modalTitle"></span>
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-4 py-3">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name" class="font-weight-semibold">Farm Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Farm Name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="owner" class="font-weight-semibold">Owner</label>
                            <input type="text" id="owner" name="owner" class="form-control"
                                placeholder="Enter Owner's Name" required>
                        </div>

                        <div class="form-group col-12 mb-0">
                            <label for="address" class="font-weight-semibold">Address</label>
                            <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter Address" required></textarea>
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
