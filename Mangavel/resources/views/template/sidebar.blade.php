<!-- Left Sidebar  -->
<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">utama</li>
                <li> <a href="{{ url('/') }}" aria-expanded="false"><i class="fa fa-dashboard"></i><span class="hide-menu">Beranda</span></a>
                </li>
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Manga</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('manga-index') }}">List Manga </a></li>
                        <li><a href="{{ route('manga-add') }}">Tambah Manga </a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-file-text"></i><span class="hide-menu">Chapter</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('chapter-index') }}">List Chapter </a></li>
                        <li><a href="{{ route('chapter-add') }}">Tambah Chapter </a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
        <!-- End Left Sidebar  -->