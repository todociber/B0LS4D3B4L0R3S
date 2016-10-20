@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

        {{ Session::get('flash_notification.message') }}
    </div>
    {{ Session::forget('flash_notification.message') }}
@endif