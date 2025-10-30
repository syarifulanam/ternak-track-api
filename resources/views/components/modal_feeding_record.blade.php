<div class="modal fade" id="feedingRecordModal" tabindex="-1" role="dialog" aria-labelledby="feedingRecordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded">
            <form id="feedingRecordForm">
                @csrf
                <input type="hidden" id="feeding_record_id" name="feeding_record_id">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="feedingRecordModalLabel">
                        <i class="fas fa-seedling mr-2"></i><span id="modalTitle">Add Feeding Record</span>
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
                            <label for="feed_date" class="font-weight-semibold">Feed Date</label>
                            <input type="date" id="feed_date" name="feed_date" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="feed_type" class="font-weight-semibold">Feed Type</label>
                            <input type="text" id="feed_type" name="feed_type" class="form-control"
                                placeholder="Enter feed type" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="volume" class="font-weight-semibold">Volume</label>
                            <input type="text" id="volume" name="volume" class="form-control"
                                placeholder="Enter volume" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="notes" class="font-weight-semibold">Notes</label>
                            <textarea id="notes" name="notes" class="form-control" rows="2" placeholder="Enter notes (optional)"></textarea>
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
