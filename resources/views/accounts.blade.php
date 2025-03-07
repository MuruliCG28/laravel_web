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
       
        <h3>Account Details</h3>
        
        <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-bold">Enter Amount</h2>
            <p class="mb-4">An OTP will be sent only to amount transfer of less than 50,000/- and for above it will be sent for ROUTECODE APP Authentication</p>
            <p>will be sent to your mobile/email. Enter it below to complete the transaction.</p>
            <form method="POST" action="">
                @csrf
                <input type="hidden" name="to_account_id" value="">
                <input type="hidden" name="amount" value="">

                <input type="text" name="otp" class="border p-2 w-full" placeholder="Enter Amount" required>
                <button type="submit" class="btn btn-primary btn-lg">Verify & Transfer</button>
            </form>
        </div>

      </div>
    </div>

  </div>
</main>

<script type="text/javascript" src="//auth.unid.net/js/callback.js"></script>

</body>
</html>
