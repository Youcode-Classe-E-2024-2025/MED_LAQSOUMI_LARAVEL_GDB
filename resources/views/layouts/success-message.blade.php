@if (session('success'))
<span class="text-green-500 text-sm mt-1" role="alert">
    <strong>{{ session('success') }}</strong>
</span>
@endif