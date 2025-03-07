<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PayRoute India Pvt Ltd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  </head>
<body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
        <div class="row">
            <div class="col-md-11">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="https://img1.wsimg.com/isteam/ip/d5a9d8bc-eaf5-49c5-8d69-a60e35bd1c6f/GNA%20logo-75596a2.png" alt="BootstrapBrain Logo" width="300">
                </a>          
            </div>
            <div class="col-md-1">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
      
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">

        <!-- @session('success')
            <div class="alert alert-success" role="alert"> 
              SID  {{ session('unid_src') }}
            </div>
        @endsession -->

        <h1 class="display-5 fw-bold">Hi, {{ auth()->user()->name }}</h1>
        <!-- <h6>{{ session('unid_src') }}</h6> -->
        <p class="col-md-8 fs-4">Welcome to dashboard.<br/>Implementation of *ROUTECODE Authentication
        Various technologies to realize unID authentication services have been patented in Japan and abroad.</p>
        <p></p>

        <iframe scrolling="no" frameborder="0" allowtransparency="true" src="{{ session('unid_src') }}" style="width:500px;height:48px;padding:0px 0px 0px 20px;"></iframe>

        <!-- Button to redirect to Accounts page -->
        <a href="{{ url('/accounts') }}" class="btn btn-primary btn-lg">
        Accounts
        </a>

        <!-- <button class="btn btn-primary btn-lg" type="submit">Accounts</button> -->

        <!-- <form id="account-form" action="{{ route('accounts') }}" method="POST" class="d-none">
            @csrf
            <button class="btn btn-primary btn-lg" type="submit">Accounts</button>
        </form> -->

      </div>
    </div>

  </div>
</main>

<script type="text/javascript" src="//auth.unid.net/js/callback.js"></script>

</body>
</html>
