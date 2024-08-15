<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Finance Management</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        History
    </div>

    <!-- Nav Item - History Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHistory"
            aria-expanded="true" aria-controls="collapseHistory">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Tracking</span>
        </a>
        <div id="collapseHistory" class="collapse" aria-labelledby="headingHistory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Transactions</a>
                <a class="collapse-item" href="{{ route('budget') }}">Budgets</a>
                <a class="collapse-item" href="">Debt Ledger</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Summary Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSummary"
            aria-expanded="true" aria-controls="collapseSummary">
            <i class="fas fa-fw fa-book"></i>
            <span>Summary</span>
        </a>
        <div id="collapseSummary" class="collapse" aria-labelledby="headingSummary" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Daily Log</a>
                <a class="collapse-item" href="">Monthly Summary</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>

    <!-- Nav Item - Database Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDatabase"
            aria-expanded="true" aria-controls="collapseDatabase">
            <i class="fas fa-fw fa-folder"></i>
            <span>Database</span>
        </a>
        <div id="collapseDatabase" class="collapse" aria-labelledby="headingDatabase" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('category') }}">Category</a>
                <a class="collapse-item" href="{{ route('tag') }}">Tags</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Profile Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile"
            aria-expanded="true" aria-controls="collapseProfile">
            <i class="fas fa-fw fa-user"></i>
            <span>Accounts</span>
        </a>
        <div id="collapseProfile" class="collapse" aria-labelledby="headingProfile"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('user') }}">List User</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->