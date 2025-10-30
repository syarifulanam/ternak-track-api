<div class="modal fade" id="healthModal" tabindex="-1" role="dialog" aria-labelledby="healthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded">
            <form id="healthForm">
                @csrf
                <input type="hidden" id="health_id" name="health_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="healthModalLabel">
                        <i class="fas fa-notes-medical mr-2"></i><span id="modalTitle"></span>
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-4 py-3">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="animal_id" class="font-weight-semibold">Animal</label>
                            <select name="animal_id" id="animal_id" class="form-control" required>
                                <option value="">-- Select Animal --</option>
                                @foreach ($animals as $animal)
                                    <option value="{{ $animal->id }}">
                                        {{ $animal->code_animal }} - {{ $animal->species }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="check_date" class="font-weight-semibold">Check Date</label>
                            <input type="date" id="check_date" name="check_date" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="diagnosis" class="font-weight-semibold">Diagnosis</label>
                            <input type="text" id="diagnosis" name="diagnosis" class="form-control"
                                placeholder="Enter diagnosis" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="treatment" class="font-weight-semibold">Treatment</label>
                            <input type="text" id="treatment" name="treatment" class="form-control"
                                placeholder="Enter treatment (optional)">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="veterinarian" class="font-weight-semibold">Veterinarian</label>
                            <input type="text" id="veterinarian" name="veterinarian" class="form-control"
                                placeholder="Enter veterinarian name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="notes" class="font-weight-semibold">Notes</label>
                            <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Enter any notes (optional)"></textarea>
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
