  <!-- JS here -->

  <script src="{{asset('frontend/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('frontend/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{asset('frontend/libs/node-waves/waves.min.js')}}"></script>
  <script src="{{asset('frontend/libs/feather-icons/feather.min.js')}}"></script>
  <script src="{{asset('frontend/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
  <script src="{{asset('frontend/js/plugins.js')}}"></script>

  <!--Swiper slider js-->
  <script src="{{asset('frontend/libs/swiper/swiper-bundle.min.js')}}"></script>

  <script src="{{asset('frontend/js/pages/nft-landing.init.js')}}"></script>
  <!--job landing init -->
  <script src="{{asset('frontend/js/pages/job-lading.init.js')}}"></script>
  <!-- Circle Progress JavaScript -->
  <script>
      document.addEventListener("DOMContentLoaded", function () {
          const progressBars = document.querySelectorAll('.progress-bar');

          window.addEventListener('scroll', function () {
              progressBars.forEach(function (bar) {
                  const rect = bar.getBoundingClientRect();
                  if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
                      const progress = bar.dataset.progress;
                      const fill = bar.querySelector('.progress-fill');
                      fill.style.width = progress + '%';
                  }
              });
          });
      });
  </script>
