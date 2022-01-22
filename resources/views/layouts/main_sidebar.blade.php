
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
   
                  <li class="header">MAIN NAVIGATION</li>
                  <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

                {{-- @if(Gate::check('class-list') || Gate::check('section-list') || Gate::check('student-list')) --}}
                        <li class="header">Student Information</li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-edit"></i> <span>Student Info</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                          
                            <x-sidebar-menu data="class" class="fa-circle-o" value="Manage Classes"/>
                         
                            <x-sidebar-menu data="sections" class="fa-circle-o" value="Manage Sections"/>
                           
                            <x-sidebar-menu data="students" class="fa-circle-o" value="Manage Students"/>
                       
                          </ul>
                        </li>
                {{-- @endif --}}

                {{-- @if(Gate::check('vachicle-list') || Gate::check('route-list') || Gate::check('stop-list')|| Gate::check('schedule-list')|| Gate::check('schedule-search')) --}}
                        <li class="header">Student Transportation</li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-edit"></i> <span>Transportation</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                         
                            <x-sidebar-menu data="vachicles" class="fa-circle-o" value="Manage Vachicles"/>
                        
                            <x-sidebar-menu data="routes" class="fa-circle-o" value="Manage Routes"/>
                          
                            <x-sidebar-menu data="stops" class="fa-circle-o" value="Manage Stops"/>
                           
                            <x-sidebar-menu data="schedules" class="fa-circle-o" value="Manage Schedules"/>
                           
                            <li><a href="{{ url('/routesearch') }}"><i class="fa fa-circle-o"></i>Search Route Students</a></li>
                           
                          </ul>
                        </li>

                {{-- @endif       --}}
                {{-- @if(Gate::check('permission-list') || Gate::check('role-list') || Gate::check('user-list')) --}}
                  
                  <li class="header">Systems</li>
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-edit"></i> <span>Systems</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <x-sidebar-menu data="permissions" class="fa-circle-o" value="Manage Permissions"/>
                      <x-sidebar-menu data="roles" class="fa-circle-o" value="Manage Roles"/>
                      <x-sidebar-menu data="users" class="fa-circle-o" value="Manage Users"/>

                    </ul>
                  </li>
              {{-- @endif   --}}
   
      </ul>  
    </section>
    <!-- /.sidebar -->
  </aside>