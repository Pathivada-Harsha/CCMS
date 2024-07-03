
  var editOpen;

function openEditModal() {
  var edit = document.getElementById("editModal");
  editOpen = new bootstrap.Modal(edit);
  editOpen.show();
}

function submitForm() {
  var fname = document.getElementById("Firstname").value;

  var mobile=  document.getElementById("Mobile").value;
  var email=  document.getElementById("Email").value;
  if(fname != "" )
    {
        document.getElementById("name").innerText = fname;
        document.getElementById("empname").innerText = fname;
    }
 
  
 if(mobile != "")
  document.getElementById("mobile").innerText = mobile;
 if(email != "")
  document.getElementById("email").innerText = email;
  editOpen.hide();
}
