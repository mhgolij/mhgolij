    <script type="text/javascript">
        try {
            jalaliDatepicker.startWatch({
                time:{{$time ?? 'false'}},
                separatorChars:{
                    date: "-",
                    between: " ",
                    time: ":"
                },
                autoHide: true,
                hideAfterChange: true,
                persianDigits:true
            });
        }catch (e){}
    </script>
