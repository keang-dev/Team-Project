// save
function saveForm(evt) {
    evt.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    let form = $('#formSave')[0];

    let data = new FormData(form);
    $.ajax({
        url: "/base-action/save",
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status == 200) {
                $('#createModal').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: response.sms
                })
                $('#example1').DataTable().ajax.reload();

            }else{
                Toast.fire({
                    icon: 'error',
                    title: response.sms
                })
            }
        
        }
    });
}

 

// update 
function updateForm(e){
    e.preventDefault();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    // let data = $('#formUpdate').serialize();
    let form = $('#formUpdate')[0];
    let data = new FormData(form);
    $.ajax({
        url: "/base-action/update",
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false, 
        success: function (response) {
            if (response.status == 200) {
                $('#editModal').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: 'តំណែទំរង់ជោគជ័យ.',
                })
                $('#example1').DataTable().ajax.reload();

            }
            else if(response.status == 500){
                Swal.fire({
                        icon: 'error',
                        title: 'សូមពិនិត្យម្ដងទៀត !!!',
                        text: 'តំណែទំរង់មិនបានជោគជ័យ.',
                        cancelButtonText: 'ចាកចេញ',
                        confirmButtonText: 'យល់ព្រម'
                        });
                return
              }
        }
    });
}

// delete 
function deleteRecord(id, e) {
    // console.log(id, $(e).attr('tbl'), $(e).attr('key'));


    Swal.fire({
        title: 'តើអ្នកចង់លុបមែនទេ ?<br/>'+name,
        text: "សូមធ្វើការពិនិត្យអោយច្បាស់មុននឹងលុប !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#A52A2A',
        cancelButtonColor: '#C0C0C0',
        cancelButtonText: 'មិនលុបទេ',
        confirmButtonText: 'បាទ/ចា លុប​'
    }).then((result) => {

        // if user confirmed to delete 
        if (result.isConfirmed) {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $.ajax({
                url: "/base-action/delete",
                data: {
                    entity: $(e).attr('tbl'),
                    id: id,
                    key: $(e).attr('key'),
                },
                type: 'get',
                success: function (response) {
                    if (response.status == 200) {
                        // $('#createModal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: "Deleted successfully."
                        })
                        $('#example1').DataTable().ajax.reload();

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: "Unable to delete this record!"
                        })
                    }
                }
            });
        }
    });

}
