<div class="modal fade" id="breedingModal" tabindex="-1" role="dialog" aria-labelledby="breedingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded">
            <form id="breedingForm">
                @csrf
                <input type="hidden" id="breeding_id" name="breeding_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="breedingModalLabel">
                        <i class="fas fa-venus-mars mr-2"></i><span id="modalTitle"></span>
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-4 py-3">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dam_id" class="font-weight-semibold">Dam (Female)</label>
                            <select name="dam_id" id="dam_id" class="form-control" required>
                                <option value="">-- Select Dam --</option>
                                @foreach ($animals as $animal)
                                    <option value="{{ $animal->id }}">
                                        {{ $animal->code_animal }} - {{ $animal->species }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="sire_id" class="font-weight-semibold">Sire (Male)</label>
                            <select name="sire_id" id="sire_id" class="form-control" required>
                                <option value="">-- Select Sire --</option>
                                @foreach ($animals as $animal)
                                    <option value="{{ $animal->id }}">
                                        {{ $animal->code_animal }} - {{ $animal->species }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="mating_date" class="font-weight-semibold">Mating Date</label>
                            <input type="date" id="mating_date" name="mating_date" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status" class="font-weight-semibold">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="">-- Select Status --</option>
                                <option value="Success">Success</option>
                                <option value="Failed">Failed</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="expected_birth_date" class="font-weight-semibold">Expected Birth Date</label>
                            <input type="date" id="expected_birth_date" name="expected_birth_date"
                                class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="notes" class="font-weight-semibold">Notes</label>
                            <textarea id="notes" name="notes" class="form-control" rows="2" placeholder="Enter any additional notes..."></textarea>
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
