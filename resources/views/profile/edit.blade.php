<div class="modal fade" id="editProfileModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-gradient-warning">
          <h4 class="modal-title">Edit Profile</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('profile.update')}}" method="POST" class="container" id="editProfileForm">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group row">
                    <label for="editProfileName" class="col-sm-3 col-form-label">Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="editProfileName" placeholder="Name"
                            name="editProfileName" value="{{$user->name}}">
                        @error('editProfileName')
                            <span class="text-danger small">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editProfilePosition" class="col-sm-3 col-form-label">Position:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="editProfilePosition" placeholder="Position"
                            name="editProfilePosition" value="{{$user->employee->position}}">
                        @error('editProfilePosition')
                            <span class="text-danger small">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editProfileDepartment" class="col-sm-3 col-form-label">Department:</label>
                    <div class="col-sm-9">
                        <select name="editProfileDepartment" id="editProfileDepartment" class="form-control select2">
                            @foreach($departments as $department)
                                <option value="{{$department->name}}"
                                    @if($department->name == $user->employee->department) selected @endif>
                                    {{$department->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('editProfileDepartment')
                            <span class="text-danger small">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>About Me:</label>
                    <textarea class="form-control" rows="3" name="editProfileAboutMe"
                        placeholder="Describe yourself">{{$user->employee->about_me}}</textarea>
                    @error('editProfileAboutMe')
                        <span class="text-danger small">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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