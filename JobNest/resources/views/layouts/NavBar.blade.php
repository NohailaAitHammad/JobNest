<nav class="flex justify-between items-center px-8 py-6 max-w-7xl mx-auto">
    <div class="flex items-center gap-2">
        <div class="w-10 h-10 bg-purple-700 rounded-lg flex items-center justify-center text-white font-bold text-2xl">J</div>
    </div>
    <div class="flex items-center gap-6">

        @auth()
            <div class="hidden md:flex gap-6 text-sm font-medium">
                <a href="{{route('candidat.dashboard')}}" class="text-purple-700">Dashboard</a>
                <a href="my-propositions.html" class="text-gray-600 hover:text-purple-700 transition-colors">My Propositions</a>
                <a href="companies.html" class="text-gray-600 hover:text-purple-700 transition-colors">Companies</a>
            </div>
        @endauth
        @guest()
            <a href="{{ route('show.login') }}" class="px-6 py-2 border border-purple-700 text-purple-700 rounded-lg hover:bg-purple-50 transition-colors">Login</a>
            <a href="{{ route('register.show.candidat') }}" class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors">Sign Up Candidat</a>
            <a href="{{route('register.show.recruteur') }}" class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors">Sign Up Recruteur</a>
        @endguest
        @auth
            <div class="flex items-center gap-4">
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 border border-purple-200 rounded-lg w-80 focus:outline-none focus:border-purple-600 form-input">
                    <i class="fas fa-search absolute left-3 top-3 text-purple-600"></i>
                </div>
                <a href="account-settings-talent.html" class="p-2 text-gray-600 hover:text-purple-700 transition-colors"><i class="fas fa-cog text-xl"></i></a>
                <button class="p-2 text-gray-600 hover:text-purple-700 transition-colors"><i class="fas fa-bell text-xl"></i></button>
                <form action="{{ route('logout') }}" method="POST" >
                    @csrf
                    <button  class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors">log out</button>
                </form>
                <a href="#}">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&auto=format&fit=crop" class="w-10 h-10 rounded-full border-2 border-purple-200 cursor-pointer">
                </a>

            </div>
        @endauth
        </div>
</nav>
