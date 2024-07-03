<?php
include("..assets/css/istl-styles.css");
?>
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 highlight-first-letter" id="addUserModalLabel">Add New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserform">
                        <div class="mb-3">
                            <label class="form-label" for="userName">Name</label>
                            <input type="text" class="form-control" id="userName" placeholder="Enter Name...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="userid">User_ID</label>
                            <input type="text" class="form-control" id="userid" placeholder="Enter User_ID...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="UserRole">User_Role</label>
                            <select class="form-select" id="UserRole">
                                <option value="Global Admin">Global Admin</option>
                                <option value="Admin1">Admin_Level 1</option>
                                <option value="Admin2">Admin_Level 2</option>
                                <option value="Admin2">Admin_Level 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="userEmail">Email</label>
                            <input type="text" class="form-control" id="userEmail" placeholder="Enter Email...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="userMobile">Mobile</label>
                            <input type="text" class="form-control" id="userMobile" placeholder="Enter Mobile..." maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="text" class="form-control" id="password" placeholder="Enter Password...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="confirmpassword">Confirm Password</label>
                            <input type="text" class="form-control" id="confirmpassword" placeholder="Enter Confirm Password...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="addNewUser()">Add New User</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<!-- Alret Message -->
<div class="custom-alert " id="customAlert">
    <div class="custom-alert-content">
        <p id="customAlertMessage" class="alert alert-warning"></p>
        <button class="btn btn-primary alertbutton" onclick="hideCustomAlert()">OK</button>
    </div>
</div>