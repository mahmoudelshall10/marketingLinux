<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="model">
    @if(Request::segment(1) === 'login' )
        Login with Social
    @elseif(Request::segment(1) === 'register' )
        Register with Social
    @endif
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            @if(Request::segment(1) === 'login' )
                Login with Social
            @elseif(Request::segment(1) === 'register' )
                Register with Social
            @endif
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Choose Your Role</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01">
              <option value="">Choose Your Role</option>
              <option value="user">Visitor</option>
              <option value="freelance">Freelance</option>
              <option value="student">Student</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="#" id="facebook-url" class="btn btn-primary"><i class="fa fa-facebook"></i></a>
          <a href="#" id="google-url" class="btn btn-danger"><i class="fa fa-google"></i></a>
        </div>
      </div>
    </div>
  </div>
  @push('jsApp')
  <script>
    $(()=>{
      var sel = document.getElementById('inputGroupSelect01');
      // display value property of select list (from selected option)
      var google_url = document.querySelector('a[id="google-url"]');;
      var facebook_url = document.querySelector('a[id="facebook-url"]');
      
      $(document).on('change', sel,function (e) {
        e.preventDefault;
            var opt = sel.value;
            if (opt !== '') {

              if (opt === 'user'){
                google_url.setAttribute('href',"{{ url('/auth/redirect/google') }}");
                facebook_url.setAttribute('href',"{{ url('/auth/redirect/facebook') }}");
              }
              
              if(opt === 'freelance'){
                google_url.setAttribute('href',"{{ url('/freelance/auth/redirect/google') }}");
                facebook_url.setAttribute('href',"{{ url('/freelance/auth/redirect/facebook') }}");
              }
              
              if(opt === 'student'){
                google_url.setAttribute('href',"{{ url('/student/auth/redirect/google') }}");
                facebook_url.setAttribute('href',"{{ url('/student/auth/redirect/facebook') }}");
              }

            }
      });
    });
  </script>
  @endpush
