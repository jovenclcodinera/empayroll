<div class="modal fade" id="editBulkEmployeeModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-gradient-warning">
          <h4 class="modal-title">Edit Employees</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" class="container" id="editBulkForm">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="my-3">Update Employees by:</div>
                        <div class="form-group">
                            <label for="editBulkPosition">Position:</label>
                            <input type="text" class="form-control" id="editBulkPosition"
                                placeholder="Enter position">
                        </div>
                        <div class="form-group">
                            <label for="editBulkDepartment">Department:</label>
                            <select name="editBulkDepartment" id="editBulkDepartment" class="form-control select2">
                                <option value="" disabled selected>Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->name}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick="onSubmitEditBulk()">
                    Submit
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>