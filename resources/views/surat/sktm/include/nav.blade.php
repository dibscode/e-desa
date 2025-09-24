<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        @if(route('surat_keterangan_miskin.index') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">SKTM</li>
        @elseif(route('surat_keterangan_miskin.create') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_keterangan_miskin.index') }}">SKTM</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('surat_keterangan_miskin.show', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_keterangan_miskin.index') }}">SKTM</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('surat_keterangan_miskin.edit', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_keterangan_miskin.index') }}">SKTM</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @else
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @endif
    </ol>
</nav>