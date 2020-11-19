<div class="modal fade" id="showDepartmentModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">View Department</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <h4 class="text-center">Details</h4>
            <hr style="background-color: var(--secondary)">
            <dl class="row mx-5" id="showDepartmentInfo">
              <dt class="col-sm-2">Name:</dt>
              <dd class="col-sm-10" style="color: var(--quaternary)"></dd>
              <dt class="col-sm-2">Description:</dt>
              <dd class="col-sm-10" style="color: var(--quaternary)"></dd>
            </dl>
            <h4 class="text-center">Employees</h4>
            <hr style="background-color: var(--secondary)">
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-hover bg-white" id="showDepartmentTable">
                    <thead class="text-center">
                        <tr>
                            <th>Date Added</th>
                            <th>Name</th>
                            <th>Email</th>  
                            <th>Position</th>
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