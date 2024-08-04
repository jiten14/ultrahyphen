<x-home-layout>
    <!-- Main Page -->
    <div id="main">
        <div class="container">
            <!-- Inner Content -->
            <section id="inner-content">
                <div class="row mt-5">
                    <!-- Single Page -->
                    <div class="latest-post col-md-12">
                        @if($aboutpage->active ==1)
                        <h2 class="border-bottom">{{$aboutpage->title}}</h2>
                        <div class="post-img">
                            <img src="/storage/{{$aboutpage->image}}" alt="" class="img-fluid w-100 h-100">
                            <div class="overlay"></div>
                        </div>
                        <p class="post-content">
                            {!!$aboutpage->content!!}
                        </p>
                        @else
                            <h2 class="border-bottom">This page is Empty</h2>
                        @endif 
                    </div>   
                </div> <!-- End Row Inner Content -->
            </section><!-- End Inner Content -->
        </div><!-- End Container -->
    </div><!-- End Main Page -->
</x-home-layout>