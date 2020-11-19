<div class="modal fade" id="editRoleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-gradient-warning">
          <h4 class="modal-title">Edit Role</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" class="container" id="editRoleForm">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group row">
                    <label for="editTitle" class="col-sm-2 col-form-label">Title:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="editTitle" name="editTitle" readonly>
                        @error('editTitle')
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
                                placeholder="About the Role ..." name="editDescription" id="editDescription"></textarea>
                            @error('editDescription')
                                <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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