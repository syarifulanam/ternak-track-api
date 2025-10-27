<div class="modal fade" id="animalModal" tabindex="-1" role="dialog" aria-labelledby="animalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded">
            <form id="animalForm">
                @csrf
                <input type="hidden" id="animal_id" name="animal_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="animalModalLabel">
                        <i class="fas fa-paw mr-2"></i> Animal Form
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-4 py-3">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="qr_code" class="font-weight-semibold">QR Code</label>
                            <input type="text" id="qr_code" name="qr_code" class="form-control"
                                placeholder="Enter QR code" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="species" class="font-weight-semibold">Species</label>
                            <input type="text" id="species" name="species" class="form-control" maxlength="255"
                                placeholder="Enter species" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="birth_date" class="font-weight-semibold">Birth Date</label>
                            <input type="date" id="birth_date" name="birth_date" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="gender" class="font-weight-semibold">Gender</label>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="">-- Select Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status" class="font-weight-semibold">Status</label>
                            <input type="text" id="status" name="status" class="form-control" maxlength="100"
                                placeholder="Enter status (e.g. Healthy)">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cage_id" class="font-weight-semibold">Cage</label>
                            <select id="cage_id" name="cage_id" class="form-control">
                                <option value="">-- Select Cage --</option>
                                @foreach ($cages as $cage)
                                    <option value="{{ $cage->id }}">{{ $cage->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
