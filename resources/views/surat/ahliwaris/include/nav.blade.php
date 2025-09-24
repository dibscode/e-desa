<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        @if(route('surat_ahliwaris.index') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">AHLI WARIS</li>
        @elseif(route('surat_ahliwaris.create') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_ahliwaris.index') }}">AHLI WARIS</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('surat_ahliwaris.show', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_ahliwaris.index') }}">AHLI WARIS</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('surat_ahliwaris.edit', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_ahliwaris.index') }}">AHLI WARIS</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @else
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @endif
    </ol>
</nav>