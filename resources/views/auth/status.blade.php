<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container">
        @if(auth()->check())
            @if(auth()->user()->isTimedOut())
                <div class="alert alert-warning" role="alert">
                    You are timed out. Reason: {{ auth()->user()->reason }}
                </div>
            @elseif(auth()->user()->isBanned())
                <div class="alert alert-danger" role="alert">
                    You are banned. Reason: {{ auth()->user()->reason }}
                </div>
            @endif
        @else
            <div class="alert alert-danger" role="alert">
                You are not authenticated.
            </div>
        @endif
    </div>
        </div>
    </form>
</x-guest-layout>
