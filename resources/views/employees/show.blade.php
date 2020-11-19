<div class="modal fade" id="showEmployeeModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">View Employee</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <h4 class="text-center">Details</h4>
            <hr style="background-color: var(--secondary)">
            <div class="row justify-content-center mx-5">
              <div class="col-12 col-sm-4">
                <img src="" alt="avatar" id="userPhoto" class="img-fluid img-thumbnail">
              </div>
              <div class="col-12 col-sm-8 pl-4">
                <dl class="row" id="showEmployeeInfo">
                  <dt class="col-sm-3">Name:</dt>
                  <dd class="col-sm-9" style="color: var(--quaternary)"></dd>
                  <dt class="col-sm-3">Email:</dt>
                  <dd class="col-sm-9" style="color: var(--quaternary)"></dd>
                  <dt class="col-sm-3">Position:</dt>
                  <dd class="col-sm-9" style="color: var(--quaternary)"></dd>
                  <dt class="col-sm-3">Department:</dt>
                  <dd class="col-sm-9" style="color: var(--quaternary)"></dd>
                  <dt class="col-sm-3">Role:</dt>
                  <dd class="col-sm-9" style="color: var(--quaternary)"></dd>
                  <dt class="col-sm-3">About Me:</dt>
                  <dd class="col-sm-9" style="color: var(--quaternary)"></dd>
                </dl>
              </div>
            </div>
            <h4 class="text-center">Payrolls</h4>
            <hr style="background-color: var(--secondary)">
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-hover bg-white" id="showEmployeeTable">
                    <thead class="text-center">
                        <tr>
                            <th>Date Issued</th>
                            <th>Overtime</th>  
                            <th>Hours</th>
                            <th>Rate</th>
                            <th>Gross</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>