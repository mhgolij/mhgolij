<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/hc-offcanvas-nav.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/flowbite.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/majidHDatepicker.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/alpine.min.js')}}" defer></script>
<form id="deleteForm" action="" method="POST">
    <input type="hidden" name="_method" value="DELETE"/>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<form id="logoutForm" action="{{route('logout')}}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

<script>
    function logout(){
        document.getElementById("logoutForm").submit();
    }
    function del(e) {
        const link = e.getAttribute('data-link')
        const title = e.getAttribute('data-title');
        const text = e.getAttribute('data-text');
        const deleteForm = document.getElementById('deleteForm')
        deleteForm.action = link
        const customSwal = Swal.mixin({
            customClass: {
                confirmButton: 'text-white bg-red-500 px-5 py-2 mr-3 rounded',
                cancelButton: 'text-white bg-green-500 px-5 py-2 mr-3 rounded'
            },
            buttonsStyling: false
        })
        customSwal.fire({
            title: title,
            text: text,
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonText: '@lang('mhgolijBase::admin.button.yes!')',
            cancelButtonText: '@lang('mhgolijBase::admin.button.leave')',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                deleteForm.submit()
            }
        })
    }

    new hcOffcanvasNav('#main-nav', {
        insertClose: true,
        insertBack: true,
        labelClose: 'بستن',
        labelBack: 'بازگشت',
        levelTitleAsBack: true,
        position: 'right'
    });

</script>
