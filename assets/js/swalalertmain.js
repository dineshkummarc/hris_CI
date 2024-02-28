function swalalertSuccess(data)
{
    Swal.fire({
        title: 'Success',
        text: data,
        icon: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK!',
        allowOutsideClick: false
    }).then((hsl) => {
        if(hsl.isConfirmed) {
            window.location.reload();
        }
    })
}

function swalalertError(data)
{
    Swal.fire({
        title: 'Error',
        text: data,
        icon: 'error',
        showCancelButton: false,
        confirmButtonText: 'OK!',
        allowOutsideClick: false
    }).then((hsl) => {
        if(hsl.isConfirmed) {
            window.location.reload();
        }
    })
}