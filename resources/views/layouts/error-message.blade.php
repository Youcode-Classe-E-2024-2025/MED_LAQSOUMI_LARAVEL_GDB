@if (session('error'))
<span class="text-red-500 text-sm mt-1" role="alert">
    <strong>{{session('error') }}</strong>
</span>
@endif