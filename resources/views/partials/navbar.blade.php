<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src='{{asset("dist/img/user2-160x160.jpg")}}' class="img-circle" alt="User Image">
                {{-- <img src="{{}}" alt="" srcset=""> --}}
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="javascript:;"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="treeview">
                {{-- Teams --}}
                <a href="javascript:;"><i class="fa fa-link"></i> <span>Team</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('teams.create') }}">Create</a></li>
                    <li><a href="{{ route('teams.index') }}">List</a></li>
                </ul>
                {{-- //PLayers --}}
                <a href="javascript:;"><i class="fa fa-link"></i> <span>Player</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('players.create') }}">Create</a></li>
                    <li><a href="{{ route('players.index') }}">List</a></li>
                </ul>

                <a href="javascript:;"><i class="fa fa-link"></i> <span>Matches</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('matches.create') }}">Create</a></li>
                    <li><a href="{{ route('matches.index') }}">List</a></li>
                </ul>

                <a href="javascript:;"><i class="fa fa-link"></i> <span>Premier League Fixture</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('premier.index') }}">List</a></li>
                </ul>

            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>