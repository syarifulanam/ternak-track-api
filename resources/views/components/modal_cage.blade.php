<div class="modal fade" id="cageModal" tabindex="-1" role="dialog" aria-labelledby="cageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded">
            <form id="cageForm">
                @csrf
                <input type="hidden" id="cage_id" name="cage_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="cageModalLabel">
                        <i class="fas fa-home mr-2"></i> Cage Form
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-4 py-3">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="farm_id" class="font-weight-semibold">Farm</label>
                            <select id="farm_id" name="farm_id" class="form-control" required>
                                <option value="">-- Select Farm --</option>
                                @foreach ($farms as $farm)
                                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name" class="font-weight-semibold">Cage Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Cage Name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="capacity" class="font-weight-semibold">Capacity</label>
                            <input type="number" id="capacity" name="capacity" class="form-control"
                                placeholder="Enter Capacity" required>
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
