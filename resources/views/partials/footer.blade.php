
        <footer class="footer fixed-bottom bg-white text-center py-2 shadow">
            {{ config('app.name') }} | Copyright @ {{ date('Y') }}
            @auth 
                 -- Usuario identificado: <strong>{{Auth::user()->nombre }}</strong>
            @endauth 
        </footer>