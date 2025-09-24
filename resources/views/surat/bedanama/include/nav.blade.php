<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        @if(route('surat_bedanama.index') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">BEDA NAMA</li>
        @elseif(route('surat_bedanama.create') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_bedanama.index') }}">BEDA NAMA</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('surat_bedanama.show', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_bedanama.index') }}">BEDA NAMA</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('surat_bedanama.edit', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('surat_bedanama.index') }}">BEDA NAMA</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @else
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @endif
    </ol>
</nav>