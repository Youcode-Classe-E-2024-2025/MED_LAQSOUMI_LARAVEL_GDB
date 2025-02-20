@if (session('success'))
<span class="text-red-500 text-sm mt-1" role="alert">
    <strong>{{ session('success') }}</strong>
</span>
@endif