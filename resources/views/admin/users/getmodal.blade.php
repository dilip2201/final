<form  autocorrect="off" action="{{ route('admin.users.store') }}" autocomplete="off" method="post" class="form-horizontal form-bordered formsubmit">
    {{ csrf_field() }}

    @if(isset($user) && !empty($user->id) )
        <input type="hidden" name="userid" value="{{ encrypt($user->id) }}">
    @endif
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control " name="name"
                       placeholder="Name"
                       value="@if(!empty($user)){{ $user->name }}@endif" required="" maxlength="30">
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="lastname"
                       placeholder="Last Name"
                       value="@if(!empty($user)){{ $user->lastname }}@endif" required="" maxlength="30">
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>User Name</label>
                <input type="text" class="form-control " name="username"
                       placeholder="User Name" minlength="4"
                       value="@if(!empty($user)){{ $user->username }}@endif" required="">
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="role" id= "role" required="">
                  <option value=""> Please Select Role </option>
                  <option value="super_admin" @if(!empty($user) && $user->role == 'super_admin') selected @endif>Super Admin</option>
                   <option value="user" @if(!empty($user) && $user->role == 'user') selected @endif>User</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control " minlength="6" name="password"
                       placeholder="password"
                       value="" @if(empty($user)) required @endif>
            </div>
        </div>
        <input id="password-confirm" type="password" placeholder="Confirm Password"
                    name="asaspassword_confirmation" autocomplete="new-password" style="display: none;">
  
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary  submitbutton pull-right"> Submit <span class="spinner"></span></button>
            </div>
        </div>
    </div>
</form>