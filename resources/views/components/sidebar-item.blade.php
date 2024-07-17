    <!-- resources/views/components/sidebar-item.blade.php -->
@props(['icon', 'text', 'link'])

<li class="mb-2">
    <a href="{{ $link }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
        <i class="fas {{ $icon }} mr-2"></i>
        {{ $text }}
    </a>
</li>