import Swal from 'sweetalert2';

export function sweetAlert() {
  const showAlert = (icon, position = 'normal', { title, text = '', confirmType = 'normal' }) => {
    const validIcons = ['success', 'error', 'warning', 'info', 'question'];
    if (!validIcons.includes(icon)) {
      console.error('El tipo de icono no es válido');
      return;
    }

    const swalOptions = {
      icon,
      title,
      text,
    };

    // Manejar la posición
    switch (position) {
      case 'right':
        swalOptions.position = 'top-end';
        swalOptions.toast = true;
        break;
      case 'left':
        swalOptions.position = 'top-start';
        swalOptions.toast = true;
        break;
      case 'normal':
      default:
        swalOptions.position = 'center';
        break;
    }

    // Manejar el tipo de confirmación
    switch (confirmType) {
      case 'confirm':
        swalOptions.showCancelButton = true;
        swalOptions.confirmButtonText = 'Si';
        swalOptions.cancelButtonText = 'No';
        return Swal.fire(swalOptions).then((result) => {
          return result.isConfirmed ? true : false;
        });
      case 'timer':
        swalOptions.timer = 2500;
        swalOptions.timerProgressBar = true;
        swalOptions.showConfirmButton = false;
        break;
      case 'normal':
      default:
        swalOptions.showConfirmButton = true;
        break;
    }
    return Swal.fire(swalOptions);
  };
  const showLoadingToast = (title, text = '') => {
    Swal.fire({
      title,
      text,
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      showCancelButton: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });
  };

  const closeLoadingToast = () => {
    Swal.close();
  };
  

  return {
    showAlert,
    showLoadingToast,
    closeLoadingToast,
  };
}
