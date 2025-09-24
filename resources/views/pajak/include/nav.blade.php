<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        @if(route('pajak.index') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">PAJAK</li>
        @elseif(route('pajak.create') == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pajak.index') }}">PAJAK</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('pajak.show', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pajak.index') }}">PAJAK</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @elseif(route('pajak.edit', $nav_id) == url()->current())
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pajak.index') }}">PAJAK</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @else
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        @endif
    </ol>
</nav>