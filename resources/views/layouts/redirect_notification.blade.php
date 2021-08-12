<script>
    $(document).on('click', '.readNotif', function (e) {
        e.preventDefault();
        var notification_id = $(this).data('id');
        var user_id = $(this).data('user_id');
        var url = "{{ config('app.url_api') . '/updateNotificationRead' }}";
        $.ajax({
            type: 'post',
            url: url,
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: ({
                "notif_id": notification_id,
                "user_id": user_id,
                "is_agent": "{{ Session::get('is_agent') }}"
            }),
            success: function (data) {
                window.location = window.location.href;
            }
        });
    });
    
    $(document).on('click', '.readAllNotif', function (e) {
        e.preventDefault();
        var user_id = $(this).data('user_id');
        var url = "{{ config('app.url_api') . '/updateAllNotification' }}";
        $.ajax({
            type: 'post',
            url: url,
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: ({
                "user_id": user_id,
                "is_agent": "{{ Session::get('is_agent') }}"
            }),
            success: function (data) {
                window.location = window.location.href;
            }
        });
    });
</script>