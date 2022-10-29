<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html" target="_blank">
      <img src="/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold" style="font-size: 20px;">SIS - Admin</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'dashbaord') active @endif" href="{{ route('dashbaord') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-home fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1"> Dashboard</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">SETTINGS</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'acadamic_years.index') active @endif " href="{{ route('acadamic_years.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Acadamic Years</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'departments.index') active @endif " href="{{ route('departments.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Departments</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'exam_types.index') active @endif " href="{{ route('exam_types.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Exam Types</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'semesters.index') active @endif " href="{{ route('semesters.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Semesters</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'scholarships.index' or \Route::current()->getName() === 'scholarships.students') active @endif " href="{{ route('scholarships.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Scholarships</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'courses.index') active @endif " href="{{ route('courses.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Courses</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">USERS</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'students.index' or \Route::current()->getName() === 'students.add' or \Route::current()->getName() === 'students.edit') active @endif " href="{{ route('students.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Students</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'lecturers.index' or \Route::current()->getName() === 'lecturers.add' or \Route::current()->getName() === 'lecturers.edit') active @endif " href="{{ route('lecturers.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Lecturers</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'staffMembers.index' or \Route::current()->getName() === 'staffMembers.add' or \Route::current()->getName() === 'staffMembers.edit') active @endif " href="{{ route('staffMembers.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Staff Members</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'deans.index' or \Route::current()->getName() === 'deans.add' or \Route::current()->getName() === 'deans.edit') active @endif " href="{{ route('deans.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Dean Office</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'admins.index' or \Route::current()->getName() === 'admins.add' or \Route::current()->getName() === 'admins.edit') active @endif " href="{{ route('admins.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Admins</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'mentors.index' or \Route::current()->getName() === 'mentors.students') active @endif " href="{{ route('mentors.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Mentors</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Exam Management</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link  @if (\Route::current()->getName() === 'exams') active @endif " href="{{ route('exams') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-edit fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Exams</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (\Route::current()->getName() === 'exam_results') active @endif " href="{{ route('exam_results') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bullhorn fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Exam Results</span>
        </a>
      </li>


      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">User Management</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="../pages/virtual-reality.html">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa fa-user-circle-o fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">User Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="../pages/virtual-reality.html">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-sign-out fa-2x text-muted" style="font-size: 13px;"></i>
          </div>
          <span class="nav-link-text ms-1">Logout</span>
        </a>
      </li>
    </ul>
  </div>

  <!-- <div class="sidenav-footer mx-3 ">
    <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
      <div class="full-background" style="background-image: url('../assets/img/curved-images/white-curved.jpeg')"></div>
      <div class="card-body text-start p-3 w-100">
        <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
          <i class="ni ni-diamond text-dark text-gradient text-lg top-0" aria-hidden="true" id="sidenavCardIcon"></i>
        </div>
        <div class="docs-info">
          <h6 class="text-white up mb-0">Need help?</h6>
          <p class="text-xs font-weight-bold">Please check our docs</p>
          <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard" target="_blank" class="btn btn-white btn-sm w-100 mb-0">Documentation</a>
        </div>
      </div>
    </div>
    <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
  </div> -->
</aside>