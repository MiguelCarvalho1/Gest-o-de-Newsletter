<x-app-layout>
    <header>
        <!-- Cabeçalho do site -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#">Logo</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{ url('/Dasboard') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/news') }}">Notícias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/news/create') }}">Create News</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
</x-app-layout>
