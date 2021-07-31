$(document).ready( () => {
    $('form.deleteData').on('submit', (e) => {
        event.preventDefault();
        const form = $(e.currentTarget);

        Swal.fire({
	        title: 'Confirmation',
	        text: "Are you sure you want to delete this item?",
	        icon: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes, delete it!'
	    }).then((result) => {
	    if (result.value) {
	        form.unbind('submit').submit();
	    }
	    });
    });
});
