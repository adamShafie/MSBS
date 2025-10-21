    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <ul class="list-unstyled">
                <li @if(Request::is('home')) class="active" @endif><a href="{{url('home')}}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-calendar"></i>Services Booking </a>
                  <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                    <li><a href="{{url('#')}}">View Bookings</a></li>
                    <li><a href="{{url('#')}}">Make Booking</a></li>
                  </ul>
                </li>
                <li @if(Request::is('view_inspection_tips')) class="active" @endif><a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-list"></i>Inspection Tips </a>
                  <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
                    <li><a href="{{url('view_inspection_tips')}}">View Inspection Tips</a></li>
                  </ul>
                </li>
                <li @if(Request::is('view_history')) class="active" @endif><a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-history"></i>Services History </a>
                  <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                    <li><a href="{{url('#')}}">View History</a></li>
                    <li><a href="{{url('#')}}">-</a></li>
                  </ul>
                </li>
                <li @if(Request::is('user_details')) class="active" @endif><a href="#exampledropdownDropdown4" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-user"></i>Profile Management </a>
                  <ul id="exampledropdownDropdown4" class="collapse list-unstyled ">
                    <li><a href="{{url('user_details')}}">User Details</a></li>
                    <li><a href="{{url('motorcycle_details')}}">Motorcycle Details</a></li>
                  </ul>
                </li>
        </ul>
      </nav>
