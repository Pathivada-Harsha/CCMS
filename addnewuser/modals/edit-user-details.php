<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">User Details Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="Usereditform">
                    <div class="mb-3">
                        <label class="form-label" for="edituserName">Name</label>
                        <input type="text" class="form-control" id="edituserName" placeholder="Enter Name...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edituserid">User_ID</label>
                        <input type="text" class="form-control" id="edituserid" placeholder="Enter User_ID...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editUserRole">User_Role</label>
                        <select class="form-select" id="editUserRole">
                            <option value="Global Admin">Global Admin</option>
                            <option value="Admin1">Admin_Level 1</option>
                            <option value="Admin2">Admin_Level 2</option>
                            <option value="Admin3">Admin_Level 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edituserEmail">Email</label>
                        <input type="text" class="form-control" id="edituserEmail" placeholder="Enter Email...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edituserMobile">Mobile</label>
                        <input type="text" class="form-control" id="edituserMobile" placeholder="Enter Mobile..." maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="editpassword">Password</label>
                        <input type="text" class="form-control" id="editpassword" placeholder="Enter Password...">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveUserDetails()">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>