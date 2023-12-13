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
    
                    <div class="card-body">
    
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Thanks for signing up!</h5>
                        <p class="text-center small">Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
                      </div>

                      @if (session('status') == 'verification-link-sent')
                        <div class="pt-4 pb-2">
                            <p class="text-center small">A new verification link has been sent to the email address you provided during registration.</p>
                        </div>
                      @endif
    
                      <form class="row g-3 needs-validation" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Resend Verification Email</button>
                        </div>
                      </form>
                        </br>
                      <form class="row g-3 needs-validation" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="col-12">
                          <button class="btn btn-dark w-100" type="submit">Logout</button>
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
