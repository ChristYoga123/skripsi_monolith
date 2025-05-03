@php
    $sessionTypes = ['success', 'error', 'warning', 'info'];
    $currentSession = session()->only($sessionTypes);
@endphp

@push('scripts')
    {{-- @dd($currentSession) --}}
    @if (!empty($currentSession))
        @foreach ($currentSession as $type => $message)
            <script>
                toastr.{{ $type }}('{{ $message }}', '{{ ucfirst($type) }}');
            </script>
        @endforeach
    @endif
@endpush
