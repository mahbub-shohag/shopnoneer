@php use Illuminate\Support\Facades\Auth; @endphp
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ Request::is('index.html') ? 'active' : '' }}" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    SETUP
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{asset('division')}}">DIVISION</a>
                        <a class="nav-link" href="{{asset('district')}}">DISTRICT</a>
                        <a class="nav-link" href="{{asset('upazila')}}">UPAZILLA</a>
                        <a class="nav-link" href="{{asset('housing')}}">Housing</a>
                        <a class="nav-link" href="{{asset('users')}}">Manage Users</a>
                        <a class="nav-link" href="{{asset('roles')}}">Roles</a>
                        <a class="nav-link" href="{{asset('permissions')}}">Permission</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProfile" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Profile
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProfile" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{asset('profiles')}}">Profile Edit</a>
                        <a class="nav-link" href="{{asset('profile_list')}}">Profile List</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProject" aria-expanded="false" aria-controls="collapseProject">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Projects
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProject" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{asset('project/create')}}">Add New</a>
                        <a class="nav-link" href="{{asset('project')}}">Project List</a>
                    </nav>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php
                $user = Auth::user();
                ?>
            </div>
    </nav>
</div>

<style>
    /* Sidebar link icons (including collapse arrows) */
    .sb-nav-link-icon i, .sb-sidenav-collapse-arrow i {
        color: darkcyan; /* Dark teal for icons */
        transition: transform 0.3s ease, color 0.3s ease; /* Smooth transitions */
    }

    /* Hover effect for sidebar link icons */
    .sb-nav-link-icon i:hover, .sb-sidenav-collapse-arrow i:hover {
        transform: scale(1.1);
        color: #004c4c !important; /* Darker teal on hover */
    }

    /* Sidebar links hover effect */
    .nav-link:hover {
        background-color: #004c4c !important; /* Dark teal background on hover */
        color: white !important;
    }

    /* Sidenav menu heading text */
    .sb-sidenav-menu-heading {
        font-weight: bold; /* Make headings bold */
        color: teal !important; /* Teal color for headings */
    }

    /* Sidebar collapse button */
    .nav-link.collapsed:hover {
        color: white !important; /* Ensure text is visible on hover */
    }

    /* Sidenav footer - Logged in user text */
    .sb-sidenav-footer .small {
        color: teal !important;
        font-weight: bold; /* Bold for the logged in label */
    }
</style>
