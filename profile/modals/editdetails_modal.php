<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
        </div>
        <div class="modal-body">
          <form>
            <div class="row">
              <div class="col">
              <label for="FirstName" class="form-label">First Name</label>
              <input type="text" class="form-control" placeholder="Enter Name" id="Firstname" name="Firstname">
              </div>
            </div>
            
            <div class="row">
              <div class="col">
              <label for="Mobile" class="form-label">Mobile</label>
              <input type="text" class="form-control" placeholder="Enter Mobile Number" id="Mobile" name="Mobile" maxlength="10">
              </div>
              <div class="col">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="Enter Email" id="Email" name="Email">
              </div>
            </div>
            
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button>
        </div>
      </div>
    </div>
  </div>