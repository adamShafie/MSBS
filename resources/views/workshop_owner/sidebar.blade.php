    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <ul class="list-unstyled">
                <li @if(Request::is('home')) class="active" @endif><a href="{{url('home')}}"> <i class="icon-home"></i>Home </a></li>

                <li @if(Request::is('view_bookings')) class="active" @endif><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-calendar"></i>Services Booking </a>
                  <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                    <li><a href="{{url('view_bookings')}}">Manage Bookings</a></li>
                  </ul>
                </li>
                <li @if(Request::is('service_history')) class="active" @endif><a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-history"></i>Services History </a>
                  <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                    <li><a href="{{url('service_history')}}">View History</a></li>
                  </ul>
                </li>
                <li @if(Request::is('user_details')) class="active" @endif><a href="#exampledropdownDropdown4" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-user"></i>User Profile </a>
                  <ul id="exampledropdownDropdown4" class="collapse list-unstyled ">
                    <li><a href="{{url('user_details')}}">User Details</a></li>
                  </ul>
                </li>
        </ul>
      </nav>
