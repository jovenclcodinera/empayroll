<div class="modal fade" id="editPayrollModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-gradient-warning">
          <h4 class="modal-title">Edit Payroll</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" class="container" id="editPayrollForm">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group row col-12">
                    <label class="col-sm-4 col-form-label">Approved:</label>
                    <div class="col-sm-8 d-flex align-items-center">
                        <div class="icheck-success d-inline mx-1">
                            <input type="radio" id="editPayrollYes" name="is_approved" value="1">
                            <label for="editPayrollYes" class="font-weight-normal">Yes</label>
                        </div>
                        <div class="icheck-danger d-inline mx-1">
                            <input type="radio" id="editPayrollNo" name="is_approved" value="0">
                            <label for="editPayrollNo" class="font-weight-normal">No</label>
                        </div>
                    </div>
                    @error('is_approved')
                        <span class="text-danger small">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row col-12">
                    <div class="form-group row m-0">
                        <label for="editPayrollHours" class="col-sm-3 col-form-label">Hours:</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editPayrollHours" min="1" step="1"
                            name="hours">
                            @error('hours')
                                <span class="text-danger small">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row col-12">
                    <div class="form-group row m-0">
                        <label for="editPayrollRate" class="col-sm-3 col-form-label">Rate:</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editPayrollRate" min="1" step="1"
                            name="rate">
                            @error('rate')
                                <span class="text-danger small">
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