<nav class="navbar navbar-expand-md navbar-light bg-yellow shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/shops') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <form action="{{ route('shops.index') }}" method="GET" class="row g-1">
                        <div class="col-auto">
                            <input class="form-control" name="keyword">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">検索</button>
                        </div>
                    </form>
 
                    <div class="navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                        <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('mypage') }}">
             <i class="fas fa-user mr-1"></i><label>マイページ</label>
           </a>
         </li>
                        </ul>
                    </div>
                </div>
            </nav>