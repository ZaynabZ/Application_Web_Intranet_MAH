<h1>This is the user's</h1>
@auth
                <li>
                    <a href="" class="p-3">{{ auth()->user()->username }}</a>
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="post" class="inline p-3">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                
                </li>
            @endauth
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>