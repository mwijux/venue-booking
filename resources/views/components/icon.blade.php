@props(['name', 'class' => 'icon'])

@php
    $icons = [
        'home' => 'M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6',
        'building' => 'M4 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16M2 21h20M8 7h1M8 11h1M8 15h1M13 7h1M13 11h1M13 15h1M18 21v-8h2',
        'calendar' => 'M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v15H3V6a2 2 0 0 1 2-2z',
        'clipboard' => 'M9 4h6M9 4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2M9 4H7a2 2 0 0 0-2 2v16h14V6a2 2 0 0 0-2-2h-2M9 12h6M9 16h6',
        'users' => 'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75',
        'user' => 'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8',
        'plus' => 'M12 5v14M5 12h14',
        'download' => 'M12 3v12M7 10l5 5 5-5M5 21h14',
        'file' => 'M14 2H6a2 2 0 0 0-2 2v18h16V8zM14 2v6h6M8 13h8M8 17h8',
        'eye' => 'M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7zM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z',
        'edit' => 'M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4z',
        'trash' => 'M3 6h18M8 6V4h8v2M6 6l1 16h10l1-16M10 11v6M14 11v6',
        'x' => 'M18 6 6 18M6 6l12 12',
        'check' => 'M20 6 9 17l-5-5',
        'search' => 'M21 21l-4.35-4.35M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16z',
        'menu' => 'M4 6h16M4 12h16M4 18h16',
        'logout' => 'M17 16l4-4-4-4M21 12H9M13 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8',
        'chevron-down' => 'M6 9l6 6 6-6',
        'info' => 'M12 16v-4M12 8h.01M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20z',
        'alert' => 'M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0zM12 9v4M12 17h.01',
        'mail' => 'M4 4h16v16H4zM4 7l8 6 8-6',
        'phone' => 'M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7l.4 2.7a2 2 0 0 1-.6 1.8L7.7 9.4a16 16 0 0 0 6.9 6.9l1.2-1.2a2 2 0 0 1 1.8-.6l2.7.4a2 2 0 0 1 1.7 2z',
        'map-pin' => 'M12 21s7-4.4 7-11a7 7 0 1 0-14 0c0 6.6 7 11 7 11zM12 12a2 2 0 1 0 0-4 2 2 0 0 0 0 4z',
        'clock' => 'M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20zM12 6v6l4 2',
        'arrow-right' => 'M5 12h14M13 5l7 7-7 7',
        'arrow-left' => 'M19 12H5M11 5l-7 7 7 7',
        'lock' => 'M7 11V7a5 5 0 0 1 10 0v4M5 11h14v11H5z',
        'shield' => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
        'zap' => 'M13 2 3 14h9l-1 8 10-12h-9z',
        'device' => 'M7 2h10a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zM11 18h4',
        'chart' => 'M3 3v18h18M8 17V9M13 17V5M18 17v-7',
    ];
@endphp

<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    <path d="{{ $icons[$name] ?? $icons['info'] }}" />
</svg>
