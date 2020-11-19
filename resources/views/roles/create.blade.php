<div class="modal fade" id="createRoleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: var(--secondary) !important">
          <h4 class="modal-title">New Role</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('roles.store')}}" method="POST" class="container">
            @csrf
            <div class="modal-body">
                <div class="form-group row">
                    <label for="createTitle" class="col-sm-2 col-form-label">Title:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="createTitle" name="createTitle" value="{{old('createTitle')}}">
                      @error('createTitle')
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
                              placeholder="About the Role ..." name="createDescription">{{old('createDescription')}}</textarea>
                          @error('createDescription')
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
                <button type="submit" class="btn button">
                    Submit
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>