<x-guest-layout>
<main id="main">
    @if($aboutpage->active ==1)
    <section class="single-post-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12 post-content" data-aos="fade-up">

            <!-- ======= Single Post Content ======= -->
            <div class="single-post">
              <img src="/storage/{{$aboutpage->image}}" alt="" class="img-fluid shadow p-3 mb-5 bg-body rounded">
              <h1 class="mb-5">{{$aboutpage->title}}</h1>
              <p>{!!$aboutpage->content!!}</p>
          </div><!-- End Single Post Content -->
        </div>
      </div>
    </section>
    @else
      
    <section class="single-post-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12 post-content" data-aos="fade-up">

            <!-- ======= Single Post Content ======= -->
          <div class="single-post">
            <h1 class="mb-5">This page is Empty</h1>
          </div><!-- End Single Post Content -->
        </div>
      </div>
    </section>
    @endif
  </main><!-- End #main -->
</x-guest-layout>  