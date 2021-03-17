<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                            <img alt="image" class="img-circle" src="{!! asset('images/fivecode1.jpg') !!}" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{Auth::guard('admin')->user()->nama}}</strong>
                            </span>
                            <span class="text-muted text-xs block">Administrator<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{!! route('logout') !!}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    ED
                </div>
            </li>
            
            <li class="{{ isActiveRoute('main') }}">
                <a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Beranda</span></a>
            </li>

            <li class="{{ isActiveRoute('inventaris') }}">
                <a href="{{ url('/inventaris') }}"><i class="fa fa-book"></i> <span class="nav-label">Inventaris</span> </a>
            </li>

            <li class="{{ isActiveRoute('users') }}">
                <a href="{{ url('/users') }}"><i class="fa fa-book"></i> <span class="nav-label">Petugas</span> </a>
            </li>
             
        
            <!-- <li class="{{ isActiveRoute('jenis') }}">
                <a href="{{ url('/jenis') }}"><i class="fa fa-book"></i> <span class="nav-label">Jenis</span> </a>
            </li>

            <li class="{{ isActiveRoute('ruang') }}">
                <a href="{{ url('/ruang') }}"><i class="fa fa-book"></i> <span class="nav-label">Ruang</span> </a>
            </li>

            <li class="{{ isActiveRoute('peminjaman') }}">
                <a href="{{ url('/peminjaman') }}"><i class="fa fa-book"></i> <span class="nav-label">Peminjaman</span> </a>
            </li>

            <li class="{{ isActiveRoute('detailpinjam') }}">
                <a href="{{ url('/detailpinjam') }}"><i class="fa fa-book"></i> <span class="nav-label">Detail Pinjam</span> </a>
            </li>

            <li class="{{ isActiveRoute('level') }}">
                <a href="{{ url('/level') }}"><i class="fa fa-book"></i> <span class="nav-label">Level</span> </a>
            </li>

             <li class="{{ isActiveRoute('pegawai') }}">
                <a href="{{ url('/pegawai') }}"><i class="fa fa-book"></i> <span class="nav-label">Pegawai</span> </a>
            </li> -->

             

        </ul>

    </div>
</nav>
