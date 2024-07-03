var editpasswordOpen;
    var editusernameOpen;

    function openPasswordModal() {
      var edit = document.getElementById("passwordModal");
      editpasswordOpen = new bootstrap.Modal(edit);
      editpasswordOpen.show();
    }

    function submitForm1() {
      var oldPassword = document.getElementById("oldPassword").value;
      var newPassword = document.getElementById("newPassword").value;
      var reenterPassword = document.getElementById("reenterPassword").value;
      if (newPassword != reenterPassword) {
        document.getElementById("passwordMismatch").style.display = 'block';
        return;
      } 
      else {
        document.getElementById("passwordMismatch").style.display = 'none';
      }

      
      if (newPassword != "") 
        document.getElementById("password").innerText = newPassword;
      

      editpasswordOpen.hide();
    }
    function openUsernameModal() {
      var edit = document.getElementById("usernameModal");
      editusernameOpen = new bootstrap.Modal(edit);
      editusernameOpen.show();
    }
    function submitForm2() {
      var oldusername = document.getElementById("oldusername").value;
      var newusername = document.getElementById("Newusername").value;
      
      if (newusername!= "") 
        document.getElementById("username").innerText = newusername;
        editusernameOpen.hide();
    }