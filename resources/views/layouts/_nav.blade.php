@php use Illuminate\Support\Facades\Auth; @endphp
<?php
function active($selectedMenu){
    $menu = strtok(Route::current()->getName(),".");
//    echo $menu."*";
//    echo $selectedMenu."#";
//    exit;
    if($menu==$selectedMenu){
        echo "active";
    }
}
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ Request::is('index.html') ? 'active' : '' }}" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="true" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    SETUP
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse show collapsed" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link mt-2 {{ active('housing') }}" href="{{ asset('housing') }}">Housing</a>
                        <a class="nav-link {{ active('facility') }}" href="{{ asset('facility') }}">Facility</a>
                        <a class="nav-link mt-2 {{ active('faq') }}" href="{{ asset('faq') }}">FAQ</a>
                        <a class="nav-link mt-2 {{ active('contact') }}" href="{{ asset('contact') }}">Contact</a>
                        <a class="nav-link {{ active('category') }}" href="{{ asset('category') }}">Category</a>
                        <a class="nav-link {{ active('amenity') }}" href="{{ asset('amenity') }}">Amenity</a>
                        <a class="nav-link {{ active('division') }}" href="{{ asset('division') }}">DIVISION</a>
                        <a class="nav-link {{ active('district') }}" href="{{ asset('district') }}">DISTRICT</a>
                        <a class="nav-link {{ active('upazila') }}" href="{{ asset('upazila') }}">UPAZILLA</a>
                        <a class="nav-link {{ active('users') }}" href="{{ asset('users') }}">Manage Users</a>
                        <a class="nav-link {{ active('roles') }}" href="{{ asset('roles') }}">Roles</a>
                        <a class="nav-link {{ active('permissions') }}" href="{{ asset('permissions') }}">Permission</a>
                    </nav>
                </div>



                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProject" aria-expanded="false" aria-controls="collapseProject">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Projects
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProject" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ asset('project/create') }}">Add New</a>
                        <a class="nav-link" href="{{ asset('project') }}">Project List</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProfile" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Profile
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProfile" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ asset('profiles') }}">Profile Edit</a>
                        <a class="nav-link" href="{{ asset('profile_list') }}">Profile List</a>
                    </nav>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php
                $user = Auth::user();
//                echo $user->name;
                ?>
            </div>
        </div>
    </nav>
</div>