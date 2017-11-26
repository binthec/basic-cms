<script src="/vendor/slick/slick.min.js"></script>
<script>
    //Top Slider
    $('.top-slider').slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 1000,
    });

    /**
     * カレンダー
     *
     * @type {jQuery}
     */
    var calendar = $('#calendar').fullCalendar({
        locale: 'ja',
        events: [
                @foreach($events as $id => $event)
            {
                id: "{{ $id }}",
                title: "{{ $event['title'] }}",
                start: "{{ $event['start'] }}",
            },
            @endforeach
        ],
    });
</script>