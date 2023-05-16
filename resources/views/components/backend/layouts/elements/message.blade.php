@props(['message'])

@if ($message)
<div class="alert alert-success">
    <span class="close" data-dismiss="alert">&times;</span>
    <strong>{{ $message }}.</strong>
</div>
@endif

{{-- @if ($message->any())
    <script>
        Swal.fire({
            icon: 'message',
            title: 'Message',
            html: '@foreach ($message->all() as $error){{ $error }}<br>@endforeach',
        });
    </script>
@endif --}}