 <!-- <footer>
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <p class="pt-4 pb-2">
              2020 Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Minus perspiciatis dignissimos totam illum aliquam iusto nobis et
              a iure exercitationem veniam eius, aliquid cum debitis sapiente
              molestias quas, natus necessitatibus.
            </p>
          </div>
        </div>
      </div>
    </footer> -->
<footer class="page-footer bg-light mt-10 mb-2">
        <div class="bg-success">
          <div class="container">
            <div class="row py-4 d-flex align-items-center">
              <div class="col-md-12 text-center">
                <a href="#"><i class="fab fa-facebook-f text-white mr-4"></i></a>
                <a href="#"><i class="fab fa-twitter text-white mr-4"></i></a>
                <a href="#"><i class="fab fa-google text-white mr-4"></i></a>
                <a href="#"><i class="fab fa-instagram text-white mr-4"></i></a>
                <a href="#"> <i class="fab fa-linkedin-in text-white"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="container text-center text-md-left mt-2">
          <div class="row">
            <div class="col-md-3 mx-auto mb-2">
                <h6 class="text-uppercase font-weight-bold">Farmers Marketplace</h6>
                  <hr class="bg-success mb-2 mt-0 d-inline-block mx-auto" style="width: 125px; height: 2px;">
                  <p class="mt-2 text-justify">
                    Farmers markeplace merupakan salah satu solusi belanja kebutuhan peoduk dan peralatan pertanian di tengah pandemi COVID-19. Diharapkan dengan adanya aplikasi ini, para petani dan masyarakat dapat memnuhi kebutuhan tumbuhannuya dengan baik.
                  </p>
              </div>

            <div class="col-md-3 mx-auto mb-2">
                <h6 class="text-uppercase font-weight-bold"> Kerja Sama</h6>
                  <hr class="bg-success mb-2 mt-0 d-inline-block mx-auto" style="width: 125px; height: 2px;">
                  <ul class="list-unstyled">
                    <li class="my-2">Politeknik Negeri Medan</li>
                    <li class="my-2">Manajemen Informatika</li>
                    <li class="my-2">Kementrian Pertanian</li>
                    <li class="my-2">Kios Pupuk Indonesia</li>
                    <li class="my-2">UMKM I</li>
                    <li class="my-2">Midtrans Payment</li>
                  </ul>
              </div>

              <!-- <div class="col-md-3 mx-auto mb-2">
                <h6 class="text-uppercase font-weight-bold"></h6>
                  <hr class="bg-success mb-2 mt-0 d-inline-block mx-auto" style="width: 125px; height: 2px;">
                  <ul class="list-unstyled">
                    <li class="my-2"></li>
                    <li class="my-2"></li>
                    <li class="my-2"></li>
                    <li class="my-2"></li>
                    <li class="my-2"></li>
                  </ul>
              </div> -->
              

               @php
                    // use App\Models\User;
                    // $admin = User::where('roles','ADMIN')->get();
                    use App\Models\User;
                    use App\Models\User_roles;
                    $admin = User_roles::with([ 'user'])->whereHas('role', function($q){
                          $q->where('name', 'ADMIN');
                      })->get();

              @endphp

            


              <div class="col-md-3 mx-auto mb-2">
                <h6 class="text-uppercase font-weight-bold">Contact Us</h6>
                  <hr class="bg-success mb-2 mt-0 d-inline-block mx-auto" style="width: 125px; height: 2px;">
                  <ul class="list-unstyled">
                    <li class="my-2"><i class="fas fa-home mr-2"></i>Kota Medan</li>
                    <li class="my-2"><i class="fas fa-envelope mr-2"></i>farmersmarketplace@gmail.com</li>
                    <li class="my-2"><i class="fas fa-fax mr-2"></i>+(623) 87535</li>
                    @forelse ($admin as $item)
                    <li class="my-2"><i class="fas fa-phone mr-2"></i>Admin(<a href="https://wa.me/{{ $item->phone_number }}?text=Halo%2C%20Admin!%0ASaya%20mau%20bertanya%20mengenai%20farmers%20Marketplace%20Indonesia" style="text-decorations:none; color:inherit;" target="_blank"> Hubungi Via <i class="fab fa-whatsapp"></i></a> )</li>
                    @empty
                    <li class="my-2"><i class="fas fa-phone mr-2"></i>Hubungi Admin</li>
                    <li class="my-2"><i class="fab fa-whatsapp mr-2"></i> Call Center</li>
                         
                    @endforelse
                    
                  </ul>
              </div>
          </div>
        </div>

        <div class="footer-copyright text-center py-3">
          <p>&copy; Copyright
          <a href="#">Farmers Marketplace Indonesia</a> </p>
          <p> Designed By <i>Stemo_Trg</i> </p>
        </div>


      </footer>