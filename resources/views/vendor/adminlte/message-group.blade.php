        {{-- Content Wrapper --}}
        @if (Session::has('success'))
            <div class="alert alert-success message-alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
        <div class="alert alert-danger message-alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ Session::get('error') }}
        </div>
    @endif