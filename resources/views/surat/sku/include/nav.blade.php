<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        @if(route('surat_keterangan_usaha.index') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">SKU</li>
        @elseif(route('surat_keterangan_usaha.create') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_keterangan_usaha.index') }}">SKU</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('surat_keterangan_usaha.show', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_keterangan_usaha.index') }}">SKU</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('surat_keterangan_usaha.edit', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_keterangan_usaha.index') }}">SKU</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @else
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @endif
    </ol>
</nav>