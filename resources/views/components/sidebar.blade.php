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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Log Out
            </a>
        </form>
    </li>
</ul>
    </div>
</div>
