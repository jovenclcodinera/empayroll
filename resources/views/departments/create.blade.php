<div class="modal fade" id="createDepartmentModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: var(--secondary) !important">
          <h4 class="modal-title">New Department</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('departments.store')}}" method="POST" class="container">
            @csrf
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                      @error('name')
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
                                placeholder="About the Department ..." name="description">{{old('description')}}</textarea>
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