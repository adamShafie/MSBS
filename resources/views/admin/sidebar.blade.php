<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <ul class="list-unstyled">
                <li @if(Request::is('home')) class="active" @endif><a href="{{url('home')}}"> <i class="icon-home"></i>Home </a></li>
                <li @if(Request::is('manage_inspection_tips')) class="active" @endif><a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-list"></i>Inspection Tips </a>
                  <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
                    <li><a href="{{url('manage_inspection_tips')}}">Manage Inspection Tips</a></li>
                    <li><a href="{{url('add_inspection_tips')}}">Add Inspection Tips</a></li>
                  </ul>
                </li>
                <li @if(Request::is('user_details')) class="active" @endif><a href="#exampledropdownDropdown4" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-user"></i>Profile Management </a>
                  <ul id="exampledropdownDropdown4" class="collapse list-unstyled ">
                    <li><a href="{{url('user_details')}}">User Details</a></li>
                  </ul>
                </li>
        </ul>
      </nav>
