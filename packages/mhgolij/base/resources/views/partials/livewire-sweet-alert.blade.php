
    <script>
        function sweetAlertInit(type,title, message) {
            Swal.fire({
                title: title,
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText:"@lang('mhgolijBase::admin.yes!')",
                cancelButtonText: "@lang('mhgolijBase::admin.leave')",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.emit('sweetAlertRemovedConfirmed')
                }
            })
        }
        window.addEventListener('sweetAlertDone',function(mes){
            Swal.fire({
                title: mes.detail.title,
                text: mes.detail.text,
                icon:'success',
                showConfirmButton: false,
                timer: 1500
            })
            document.getElementById('checkbox-all').checked = false
        })
    </script>
