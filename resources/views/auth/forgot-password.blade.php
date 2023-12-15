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

                    <!-- Session Status -->
                    <x-auth-session-status class="alert alert-success" :status="session('status')" />
    
                    <div class="card-body">
    
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Forgot your password?</h5>
                        <p class="text-center small">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                      </div>
    
                      <form class="row g-3 needs-validation" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="col-12">
                          <label for="email" class="form-label">Email</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" name="email" class="form-control" id="email" required :value="old('email')">
                          </div>
                        </div>
                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Email Password Reset Link</button>
                        </div>
                      </form>
    
                    </div>
                  </div>
    
                  <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                  </div>
    
                </div>
              </div>
            </div>
    
          </section>
    
        </div>
      </main><!-- End #main -->
</x-gal-layout>
