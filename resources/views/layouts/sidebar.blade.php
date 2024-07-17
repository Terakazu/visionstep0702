<aside class="sidebar">
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="VisionStep Logo">
    </div>
    <ul>
        <x-sidebar-item icon="fa-home" text="TOP" link="{{ route('home') }}" />
        <x-sidebar-item icon="fa-heart" text="価値観の発掘" link="{{ route('categories.select') }}" />
        <x-sidebar-item icon="fa-tasks" text="ビジョンボード" link="{{ route('visionboards.index') }}" />
        <x-sidebar-item icon="fa-cogs" text="目標設定" link="{{ route('goals.index') }}" />
        <x-sidebar-item icon="fa-calendar-alt" text="日記" link="{{ route('diaries.index') }}" />
        
    </ul>
</aside>
