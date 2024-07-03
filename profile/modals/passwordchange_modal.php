 <!-- passwardmodal -->
 <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm">
            
            <div class="mb-3">
              <label for="oldPassword" class="form-label">Old Password</label>
              <input type="password" class="form-control" id="oldPassword" placeholder="Enter Old Password">
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" class="form-control" id="newPassword" placeholder="Enter New Password">
            </div>
            <div class="mb-3">
              <label for="reenterPassword" class="form-label">Re-enter New Password</label>
              <input type="password" class="form-control" id="reenterPassword" placeholder="Re-enter New Password">
              <div id="passwordMismatch" class="text-danger mt-2" style="display: none;">Passwords do not match</div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="submitForm1()">Submit</button>
        </div>
      </div>
    </div>
  </div>