
<script>
    $(function () {
        let incrementVal = {{($auction->value_of_increment)}};
        let current_price = {{($auction->current_price)}};
        $("#minuss").click(function () {
            var $input = $(this).parent().find("#bidInput");
            var count = parseInt($input.val()) - incrementVal;
            count = count < current_price ? current_price : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $("#pluss").click(function () {
            var $input = $(this).parent().find("#bidInput");
            $input.val(parseInt($input.val()) + incrementVal);
            $input.change();
            return false;
        });


// ============= for accept conditions====================
        $('a#change-terms-value').on('click', function (e) {
            e.preventDefault();
            let checkBox = $('#accept-terms');
            $.ajax({
                method: 'GET',
                url: '{{ route('front.accept_auction_terms',$auction->id) }}',
                success: res => {
                    if(res.is_accepted) {
                        checkBox.prop('checked', true);
                    } else {
                        checkBox.prop('checked', false);
                    }
                },
                error: err => console.log(err),
            });
        });


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
                        console.log('kk');
                        icon.hasClass("fa-eye");
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
