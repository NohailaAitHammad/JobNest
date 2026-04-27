<nav class="flex justify-between items-center px-8 py-6 max-w-7xl mx-auto">
    <div class="flex items-center gap-2">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-10 h-10 bg-purple-700 rounded-lg flex items-center justify-center text-white font-bold text-2xl">J</div>
        </a>
    </div>

    <div class="flex items-center gap-6">
        @auth
            <div class="hidden md:flex gap-6 text-sm font-medium">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="text-purple-700">Admin Panel</a>
                    <a href="#" class="text-gray-600 hover:text-purple-700 transition-colors">Manage Users</a>
                @elseif(auth()->user()->isRecruteur())
                    <a href="{{ route('recruteur.dashboard') }}" class="text-purple-700">Recruiter Dashboard</a>
                    <a href="{{ route('recruteur.search-candidats') }}" class="text-gray-600 hover:text-purple-700 transition-colors">Search Talents</a>
                @else
                    <a href="{{ route('candidat.dashboard') }}" class="text-purple-700">Dashboard</a>
                    <a href="{{ route('candidat.propositions') }}" class="text-gray-600 hover:text-purple-700 transition-colors">My Propositions</a>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 border border-purple-200 rounded-lg w-80 focus:outline-none focus:border-purple-600">
                    <i class="fas fa-search absolute left-3 top-3 text-purple-600"></i>
                </div>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <i class="fas fa-cog text-xl"></i>
                    </a>
                @elseif(auth()->user()->isRecruteur())
                    <a href="{{ route('recruteur.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <i class="fas fa-cog text-xl"></i>
                    </a>
                @elseif(auth()->user()->isCandidat())
                    <a href="{{ route('candidat.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <i class="fas fa-cog text-xl"></i>
                    </a>
                @else
                    <a href="#" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <i class="fas fa-cog text-xl"></i>
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors text-sm">
                        Log out
                    </button>
                </form>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <i class="fas fa-cog text-xl"></i>
                    </a>
                @elseif(auth()->user()->isRecruteur())
                    <a href="{{ route('recruteur.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <img src="{{ (auth()->user()->profileRecruteur && auth()->user()->profileRecruteur->imageURL)
                        ? asset('storage/' . auth()->user()->profileCandidat->imageURL)
                        : 'https://ui-avatars.com/api/?name='.auth()->user()->firstName }}"
                             class="w-10 h-10 rounded-full border-2 border-purple-200 cursor-pointer object-cover" alt="User Profile">
                    </a>
                @elseif(auth()->user()->isCandidat())
                    <a href="{{ route('candidat.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <img src="{{ (auth()->user()->profileCandidat && auth()->user()->profileCandidat->imageURL)
                        ? asset('storage/' . auth()->user()->profileCandidat->imageURL)
                        : 'https://ui-avatars.com/api/?name='.auth()->user()->firstName }}"
                             class="w-10 h-10 rounded-full border-2 border-purple-200 cursor-pointer object-cover" alt="User Profile">
                    </a>
                @else
                    <a href="{{ route('admin.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <img src="{{'https://ui-avatars.com/api/?name='.auth()->user()->firstName }}"
                             class="w-10 h-10 rounded-full border-2 border-purple-200 cursor-pointer object-cover" alt="User Profile">
                    </a>
                @endif
            </div>
        @endauth

        @guest
            <a href="{{ route('show.login') }}" class="px-6 py-2 border border-purple-700 text-purple-700 rounded-lg hover:bg-purple-50 transition-colors">Login</a>
            <a href="{{ route('register.show.candidat') }}" class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors">Sign Up Candidat</a>
            <a href="{{ route('register.show.recruteur') }}" class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors">Sign Up Recruteur</a>
        @endguest
    </div>
</nav>
