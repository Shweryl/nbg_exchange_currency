import './bootstrap';

import Swal from "sweetalert2";
window.showWarning = function(icon, message){
    Swal.fire({
        icon: icon,
        title: "Oops...",
        text: message,
    });
};

window.showToast = function (message){
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "success",
        title: message
      });
};

window.isLoading = function(event, button){
    let targetBtn = document.getElementById(button)
    let spinner = document.getElementById('spinner')
    targetBtn.disabled = true
    spinner.style.display = "inline-block"
}
