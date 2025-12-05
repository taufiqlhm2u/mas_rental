@props(['active' => false])

<a {{ $attributes }} class="nav-link {{ $active ? 'text-white active' : '' }}" style="{{ $active ? 'background: rgba(255,255,255,0.2); border-radius: 4px;' : 'color:#DEDED1;' }}">{{ $slot }}</a>