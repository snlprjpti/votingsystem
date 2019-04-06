<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">

                <img class="img-circle"
                     src="{{url('/uploads/images/dummyUser.gif')}}"
                     alt="User Image" height="160px">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <p style="font-size: 12px; margin-left: 10px;">Programmer</p>
            </div>
        </div>



        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"></li>
            <li>
                <a href="{{url('/dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{url('/admin/organizer')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Organizer</span>
                </a>
            </li>
            <li>
                <a href="{{url('/organizer/events')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Events</span>
                </a>
            </li> <li>
                <a href="{{url('/organizer/voters')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Voters</span>
                </a>
            </li> <li>
                <a href="{{url('voter/events')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Events</span>
                </a>
            </li>

        </ul>
    </section>
</aside>