<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container mx-auto px-4 py-6">
        @if(auth()->check())
            @if(auth()->user()->isTimedOut())
                <div class="alert alert-warning bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p class="font-bold">Warning</p>
                    <p>You are timed out. Reason: {{ auth()->user()->reason }}</p>
                </div>
            @elseif(auth()->user()->isBanned())
                <div class="alert alert-danger bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                    <p class="font-bold">Danger</p>
                    <p>You are banned. Reason: {{ auth()->user()->reason }}</p>
                </div>
            @endif
        @endif
    </div>

    <div class="mt-4 text-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
