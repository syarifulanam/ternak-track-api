<div class="modal fade" id="growthModal" tabindex="-1" role="dialog" aria-labelledby="recordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded">
            <form id="growthForm">
                @csrf
                <input type="hidden" id="growth_id" name="growth_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="GrowthModalLabel">
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
                            <label for="record_date" class="font-weight-semibold">Record Date</label>
                            <input type="date" id="record_date" name="record_date" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="weight_kg" class="font-weight-semibold">Weight (kg)</label>
                            <input type="number" step="0.01" id="weight_kg" name="weight_kg" class="form-control"
                                placeholder="Enter weight in kilograms" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="height_cm" class="font-weight-semibold">Height (cm)</label>
                            <input type="number" step="0.1" id="height_cm" name="height_cm" class="form-control"
                                placeholder="Enter height in centimeters" required>
                        </div>

                        <div class="form-group col-12 mb-0">
                            <label for="notes" class="font-weight-semibold">Notes</label>
                            <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Enter any notes"></textarea>
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
