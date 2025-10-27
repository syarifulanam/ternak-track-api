<div class="modal fade" id="cageModal" tabindex="-1" role="dialog" aria-labelledby="cageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-sm rounded">
            <form id="cageForm">
                @csrf
                <input type="hidden" id="cage_id" name="cage_id">

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-semibold" id="cageModalLabel">Cages</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="farm_id" class="font-weight-medium">Farm</label>
                        <select id="farm_id" name="farm_id" class="form-control" required>
                            <option value="">Choose Farm ...</option>
                            @foreach ($farms as $farm)
                                <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name" class="font-weight-medium">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Cage's name" required>
                    </div>

                    <div class="form-group mb-0">
                        <label for="capacity" class="font-weight-medium">Capacity</label>
                        <input type="number" class="form-control" id="capacity" name="capacity"
                            placeholder="Enter capacity" required>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light border" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
