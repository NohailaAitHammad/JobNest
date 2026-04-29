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
                    <a href="{{ route('admin.dashboard') }}" class="text-purple-600 hover:text-purple-700 transition-colors">Admin Panel</a>
                    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-purple-700 transition-colors">Manage Users</a>
                    <a href="{{ route('admin.competences.index') }}" class="text-gray-600 hover:text-purple-700 transition-colors">Manage Skills</a>
                    <a href="{{ route('admin.domaines.index') }}" class="text-gray-600 hover:text-purple-700 transition-colors">Manage Libraries</a>
                @elseif(auth()->user()->isRecruteur())
                    <a href="{{ route('recruteur.dashboard') }}" class="text-purple-600 hover:text-purple-700 transition-colors">Recruiter Dashboard</a>
                    <a href="{{ route('recruteurs.propositions') }}" class="text-gray-600 hover:text-purple-700 transition-colors">Sent Proposals</a>
                    <a href="{{ route('recruteur.search-candidats') }}" class="text-gray-600 hover:text-purple-700 transition-colors">Search Talents</a>
                @else
                    <a href="{{ route('candidat.dashboard') }}" class="text-purple-600 hover:text-purple-700 transition-colors">Dashboard</a>
                    <a href="{{ route('candidats.propositions.index') }}" class="text-gray-600 hover:text-purple-700 transition-colors">My Propositions</a>
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
                    <a href="{{ route('recruteurs.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <i class="fas fa-cog text-xl"></i>
                    </a>
                @elseif(auth()->user()->isCandidat())
                    <a href="{{ route('candidat.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <i class="fas fa-cog text-xl"></i>
                    </a>
                @endif

                <div class="relative">
                    <!-- Bouton Cloche : On ajoute un onclick pour appeler la fonction JS -->
                    <button onclick="toggleNotifications()" class="p-2 text-gray-600 hover:text-purple-700 transition-colors relative">
                        <i class="fas fa-bell text-xl"></i>
                        @if(isset($notifications) && $notifications->count() > 0)
                            <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-[10px] flex items-center justify-center rounded-full border-2 border-white">
                {{ $notifications->count() }}
            </span>
                        @endif
                    </button>

                    <!-- Menu Déroulant : On ajoute l'id 'notifications-dropdown' et la classe 'hidden' -->
                    <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-purple-100 z-50 overflow-hidden transition-all">

                        <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-purple-50">
                            <h3 class="font-bold text-purple-800">Notifications</h3>
                            <a href="{{ route('notifications.markAllRead') }}" class="text-xs text-purple-600 hover:underline">Mark all as read</a>
                        </div>

                        <div class="max-h-80 overflow-y-auto">
                            @forelse($notifications ?? [] as $notification)
                                <a href="{{ route('notifications.markRead', $notification->id) }}"
                                   class="flex items-start gap-3 p-4 hover:bg-purple-50 transition-colors border-b border-gray-50">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xs">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-800 leading-tight">
                                            {{ $notification->data['message'] }}
                                        </p>
                                        <span class="text-[10px] text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="p-8 text-center">
                                    <i class="fas fa-envelope-open text-gray-300 text-3xl mb-2"></i>
                                    <p class="text-sm text-gray-500">No new notifications</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="p-3 border-t border-gray-100 text-center">
                            <a href="{{ route('notifications.index') }}" class="text-sm font-bold text-purple-700 hover:text-purple-900 transition-colors">
                                View All Notifications <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors text-sm">
                        Log out
                    </button>
                </form>


                @if(auth()->user()->isRecruteur())
                    <a href="{{ route('recruteurs.show')}}" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
                        <img src="{{ (auth()->user()->profileRecruteur && auth()->user()->profileRecruteur->imageURL)
                        ? asset('storage/' . auth()->user()->profileRecruteur->imageURL)
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
