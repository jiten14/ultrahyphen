<x-home-layout>
      <!-- Main Page -->
  <div id="main">
    <div class="container">
        <!-- Inner Content -->
        <section id="inner-content">
            <div class="row mt-5">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <form action="{{ route('password.store') }}" method="POST">
                  @csrf
                  <!-- Password Reset Token -->
                  <input type="hidden" name="token" value="{{ $request->route('token') }}">
                  <div class="mb-3">
                      <input type="email" id="prf-email" name="email" class="form-control" placeholder="Enter your Email" required value="{{$request->email}}">
                  </div>
                  <div class="mb-3">
                      <input type="password" name="password" class="form-control" id="prf-password" placeholder="Enter Password" required>
                  </div>
                  <div class="mb-3">
                      <input type="password" name="password_confirmation" class="form-control" id="prf-password_confirmation" placeholder="Re-enter Password" required>
                  </div>
                  <div class="d-grid gap-2">
                      <input type="submit" class="btn btn-success" value="Reset Password">
                  </div>
              </form>
            </div> <!-- End Row Inner Content -->
        </section><!-- End Inner Content -->
    </div><!-- End Container -->
</div><!-- End Main Page -->
</x-home-layout>
