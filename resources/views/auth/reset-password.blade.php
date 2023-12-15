<x-gal-layout>
    <main>
        <div class="container">
    
          <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
    
                  <div class="d-flex justify-content-center py-4">
                    <a href="{{ url('') }}" class="logo d-flex align-items-cente text-decoration-none">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <!-- <img src="assets/img/logo.png" alt=""> -->
                        <h1>{{ config('app.name', 'Laravel') }}</h1>
                    </a>
                  </div><!-- End Logo -->
    
                  <div class="card mb-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="card-body">
    
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                        <p class="text-center small"></p>
                      </div>
    
                      <form class="row g-3 needs-validation" method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
    
                        <div class="col-12">
                          <label for="email" class="form-label">Your Email</label>
                          <input type="email" name="email" class="form-control" id="email" required value="{{$request->email}}" autocomplete="username">
                        </div>
    
                        <div class="col-12">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="password" required autocomplete="new-password">
                        </div>

                        <div class="col-12">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required autocomplete="new-password">
                        </div>
    
                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                        </div>
                      </form>
    
                    </div>
                  </div>
    
                </div>
              </div>
            </div>
    
          </section>
    
        </div>
      </main><!-- End #main -->
</x-gal-layout>
