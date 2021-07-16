<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    <!-- css style -->
    @stack('prepend-style')
    @include('includes.style');
    @stack('addon-style')
    
  </head>

  <body>
    <!-- Navbar -->
    @include('includes.navbar')

    <!-- Page Content -->
    @yield('content')
    <div class="container"> 
                
                <!-- section intro row starts -->
                <div class="row dtr-mb-30">
                    <div class="col-12 text-center">
                        <p class="text-grad-orange font-weight-700">Basic protective measures</p>
                        <h2>How to protect yourself</h2>
                    </div>
                </div>
                <!-- section intro row ends --> 
                
                <!-- row 1 starts -->
                <div class="row"  data-aos="fade-up"
                        data-aos-delay="100">
                    <div class="col-12 col-md-2 offset-md-1 text-center dtr-pt-100 dtr-mt-120 dtr-md-mt-0 dtr-md-pt-0"> <img src="images\admin.png" alt="image" class="dtr-mb-30 w-25">
                        <h6>If you feel unwell get medical care early</h6>
                    </div>
                    <div class="col-12 col-md-2 text-center dtr-mt-120 dtr-md-mt-30 dtr-md-pt-0"> <img src="images\admin.png" alt="image" class="dtr-mb-30 w-25">
                        <h6>Avoid traveling if unnecessary</h6>
                    </div>
                    <div class="col-12 col-md-2 text-center dtr-pt-20 dtr-md-mt-0"> <img src="images\admin.png" alt="image" class="dtr-mb-30 w-25">
                        <h6>Wash your hands frequently</h6>
                    </div>
                    <div class="col-12 col-md-2 text-center dtr-mt-120 dtr-md-mt-30 dtr-md-pt-0"> <img src="images\admin.png" alt="image" class="dtr-mb-30 w-25">
                        <h6>Maintain social distancing</h6>
                    </div>
                    <div class="col-12 col-md-2 text-center dtr-pt-100 dtr-mt-120 dtr-md-mt-30 dtr-md-pt-0"> <img src="images\admin.png" alt="image" class="dtr-mb-30 w-25">
                        <h6>Avoid touching eyes, nose and mouth</h6>
                    </div>
                </div>
{{-- <div class="container " data-aos="zoom-in"
                        data-aos-delay="200">
       <div class="my-jumbotron jumbotron jumbotron-fluid">
          <div class="container text-center">
            <h1 class="display-4">Farm Marketplace</h1>
              <p class="lead">The Soul of Indoensia</p>
              
          </div> 
      </div>
     </div> --}}

    <!-- Footer -->
    @include('includes.footer')

  
   <!-- script -->
    @stack('prepend-script')
    @include('includes.script');
    @stack('addon-script')
    
  </body>
</html>
