
























{{--<script>--}}
{{--    var target_date = {{ strtotime($auction->end_date) }}; // set the countdown date--}}
{{--    var days, hours, minutes, seconds; // variables for time units--}}

{{--    var countdown = document.getElementById("tiles"); // get tag element--}}

{{--    getCountdown();--}}

{{--    setInterval(() => getCountdown(), 1000);--}}

{{--    function getCountdown(){--}}

{{--        // find the amount of "seconds" between now and target--}}
{{--        var current_date = new Date().getTime();--}}
{{--        var seconds_left = (target_date - current_date) / 1000;--}}

{{--        days = pad(parseInt(seconds_left / 86400));--}}
{{--        seconds_left = seconds_left % 86400;--}}

{{--        hours = pad( parseInt(seconds_left / 3600) );--}}
{{--        seconds_left = seconds_left % 3600;--}}

{{--        minutes = pad( parseInt(seconds_left / 60) );--}}
{{--        seconds = pad( parseInt( seconds_left % 60 ) );--}}

{{--        // format countdown string + set tag value--}}
{{--        countdown.innerHTML = "<span>" + days + "</span><span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>";--}}
{{--    }--}}

{{--    function pad(n) {--}}
{{--        return (n < 10 ? '0' : '') + n;--}}
{{--    }--}}
{{--</script>--}}














{{--@dd()--}}
{{--<script>--}}
{{--    var target_date = new Date().getTime() + (1000*3600*48); // set the countdown date--}}
{{--    var days, hours, minutes, seconds; // variables for time units--}}

{{--    var countdown = document.getElementById("tiles"); // get tag element--}}

{{--    getCountdown();--}}

{{--    setInterval(function () { getCountdown(); }, 1000);--}}

{{--    function getCountdown(){--}}

{{--        // find the amount of "seconds" between now and target--}}
{{--        var current_date = new Date().getTime();--}}
{{--        var seconds_left = (target_date - current_date) / 1000;--}}

{{--        days = pad( parseInt(seconds_left / 86400) );--}}
{{--        seconds_left = seconds_left % 86400;--}}

{{--        hours = pad( parseInt(seconds_left / 3600) );--}}
{{--        seconds_left = seconds_left % 3600;--}}

{{--        minutes = pad( parseInt(seconds_left / 60) );--}}
{{--        seconds = pad( parseInt( seconds_left % 60 ) );--}}

{{--        // format countdown string + set tag value--}}
{{--        countdown.innerHTML = "<span>" + days + "</span><span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>";--}}
{{--    }--}}

{{--    function pad(n) {--}}
{{--        return (n < 10 ? '0' : '') + n;--}}
{{--    }--}}


{{--</script>--}}


<script>
    var countDownDate = new Date("{{ ($auction->end_date) }}").getTime();

    console.log('{{ ($auction->end_date) }}')
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();


        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("Timerapp").innerHTML = days+"d "+hours + "h " +
            minutes + "m " + seconds + "s ";

        document.getElementById("days").innerHTML = days+"d "
            ;
        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("Timerapp").innerHTML = "EXPIRED";
        }
    }, 1000);

</script>
