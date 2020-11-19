<div class="modal fade" id="editDepartmentModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-gradient-warning">
          <h4 class="modal-title">Edit Department</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" class="container" id="editDepartmentForm">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group row">
                    <label for="editName" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="editName" name="editName" readonly>
                        @error('editName')
                            <span class="text-danger small" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Description (Optional):</label>
                            <textarea class="form-control" rows="4"
                                placeholder="About the Department ..." name="editDescription" id="editDescription"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">
                    Submit
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>