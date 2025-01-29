import './bootstrap';


// Chart.js configuration
import Chart from 'chart.js/auto';
window.Chart = Chart;
import '../../node_modules/chart.js';


// Configuration for alert and confirm boxes
import Swal from "sweetalert2";

// Sweetalert global functions
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

window.showConfirmBox = function(form, message){
    Swal.fire({
        title: message,

        showCancelButton: true,
        confirmButtonText: "Yes",

    }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
}

// Loading feature for login,register,forgot/reset password
window.isLoading = function(event, button){
    let targetBtn = document.getElementById(button)
    let spinner = document.getElementById('spinner')
    targetBtn.disabled = true
    spinner.style.display = "inline-block"
};
