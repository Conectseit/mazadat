
<script>
    $(function () {
// ============= for make watch ==================================
        $('a#change-icon').on('click', function (e) {
            e.preventDefault();
            let icon = $('#eye');
            console.log(1);
            $.ajax({
                method: 'GET',
                url: '{{route('front.watch_auction',$auction->id)}}',
                success: res => {
                    if(res.is_watched) {
                        // console.log('kk');
                        icon.addclass("fa-eye");
                    } else {
                        icon.hasClass("fa-eye-slash");
                    }
                },
                error: err => console.log(err),
            });
        });
// ===============================================================

 });
</script>
