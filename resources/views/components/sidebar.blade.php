<div id="side-menu" class="bg-[#292f4c] text-white h-screen w-64 fixed flex flex-col">
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4 text-indigo-300">Menu</h2>
        <ul class="space-y-4">
    <li>
        <a href="/dashboard" class="flex items-center gap-2 hover:text-indigo-300">
            <x-heroicon-o-home class="w-5 h-5" />
            Dashboard
        </a>
    </li>
    <li>
        <a href="/tasks" class="flex items-center gap-2 hover:text-indigo-300">
            <x-heroicon-o-check-circle class="w-5 h-5" />
            Tasks
        </a>
    </li>
    <li>
    <a href="{{ route('settings') }}" class="flex items-center gap-2 hover:text-indigo-300">
            <x-heroicon-o-cog class="w-5 h-5" />
            Settings
        </a>
    </li>
    <li>
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();" class="flex items-center gap-2 hover:text-red-400">
                <span class="material-symbols-outlined text-xl">logout</span>
                Log Out
            </a>
        </form>
    </li>
</ul>
    </div>
</div>
