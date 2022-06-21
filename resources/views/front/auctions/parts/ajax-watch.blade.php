
<script>
    $(function () {
// ============= for make watch ==================================
        $('a#change-icon-{{$auction->id}}').on('click', function (e) {
            e.preventDefault();
            let icon = $('#eye-{{$auction->id}}');
{{--            @if(checkIsUserWatch($auction)->count())--}}
{{--                icon.removeClass("fas fa-eye");--}}
{{--            @else--}}
{{--                icon.removeClass("fas fa-eye-slash");--}}
{{--            @endif--}}
            $.ajax({
                method: 'GET',
                url: '{{route('front.watch_auction',$auction->id)}}',
                success: res => {
                    if(res.is_watched === true) {
                        icon.removeClass("fas fa-eye");
                        icon.addClass("fas fa-eye-slash");
                    } else {
                        icon.removeClass("fas fa-eye-slash");
                        icon.addClass("fas fa-eye");
                    }
                },
                error: err => console.log(err),
            });
        });
// ===============================================================
 });
</script>
