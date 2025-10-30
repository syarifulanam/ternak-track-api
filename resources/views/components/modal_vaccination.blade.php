<div class="modal fade" id="vaccinationModal" tabindex="-1" role="dialog" aria-labelledby="vaccinationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded">
            <form id="vaccinationForm">
                @csrf
                <input type="hidden" id="vaccination_id" name="vaccination_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="vaccinationModalLabel">
                        <i class="fas fa-syringe mr-2"></i><span id="modalTitle"></span>
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
                            <label for="vaccination_date" class="font-weight-semibold">Vaccination Date</label>
                            <input type="date" id="vaccination_date" name="vaccination_date" class="form-control"
                                required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="vaccine_type" class="font-weight-semibold">Vaccine Type</label>
                            <input type="text" id="vaccine_type" name="vaccine_type" class="form-control"
                                placeholder="Enter vaccine type" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="dosage" class="font-weight-semibold">Dosage</label>
                            <input type="text" id="dosage" name="dosage" class="form-control"
                                placeholder="Enter dosage" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="staff" class="font-weight-semibold">Staff</label>
                            <input type="text" id="staff" name="staff" class="form-control"
                                placeholder="Enter staff name" required>
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
