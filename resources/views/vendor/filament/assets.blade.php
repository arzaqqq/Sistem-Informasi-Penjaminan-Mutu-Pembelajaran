<head>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo1.png') }}" type="image/x-icon">

    <!-- Skrip dan aset lainnya -->
    @if (isset($data))
        <script>
            window.filamentData = @js($data)
        </script>
    @endif

    @foreach ($assets as $asset)
        @if (! $asset->isLoadedOnRequest())
            {{ $asset->getHtml() }}W
        @endif
    @endforeach

    <style>
        :root {
            @foreach ($cssVariables ?? [] as $cssVariableName => $cssVariableValue)
                --{{ $cssVariableName }}:{{ $cssVariableValue }};
            @endforeach
        }
    </style>
</head>
