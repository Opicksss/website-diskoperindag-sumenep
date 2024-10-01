          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme sticky-navbar"
              id="layout-navbar">
              <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                      <i class="bx bx-menu bx-sm"></i>
                  </a>
              </div>

              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                  <!-- Search -->
                  <form method="GET" action="">
                      <div class="navbar-nav align-items-center">
                          <div class="nav-item d-flex align-items-center">
                              <i class="bx bx-search fs-4 lh-0"></i>
                              <input type="text" class="form-control border-0 shadow-none " placeholder="Search"
                                  name="Search">
                          </div>
                      </div>
                  </form>
                  <!-- /Search -->

                  <ul class="navbar-nav flex-row align-items-center ms-auto">

                      <!-- User -->
                      <li class="nav-item navbar-dropdown dropdown-user dropdown">
                          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                              data-bs-toggle="dropdown">
                              <div class="avatar avatar-online">
                                  @if (Auth::user()->pp)
                                      <img class="w-px-40 h-auto rounded-circle" src="/storage/{{ Auth::user()->pp }}"
                                          alt>
                                  @else
                                      <img class="w-px-40 h-auto rounded-circle"
                                          src="{{ asset('img/profilDefault.jpg') }}" alt>
                                  @endif
                              </div>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end">
                              <li>
                                  <div class="d-flex dropdown-item">
                                      <div class="flex-shrink-0 me-3">
                                          <div class="avatar avatar-online">
                                              @if (Auth::user()->pp)
                                                  <img class="w-px-40 h-auto rounded-circle"
                                                      src="/storage/{{ Auth::user()->pp }}" alt>
                                              @else
                                                  <img class="w-px-40 h-auto rounded-circle"
                                                      src="{{ asset('img/profilDefault.jpg') }}" alt>
                                              @endif
                                          </div>
                                      </div>
                                      <div class="flex-grow-1">
                                          <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                          <small class="text-muted">{{ Auth::user()->email }}</small>
                                      </div>
                                  </div>
                              </li>
                              <li>
                                  <div class="dropdown-divider"></div>
                              </li>
                              {{-- <li>
                                  <a class="dropdown-item" href="{{ route('profile.index') }}">
                                      <i class="bx bx-user text-primary me-2"></i>
                                      <span class="align-middle">My Profile</span>
                                  </a>
                              </li> --}}
                              <li>
                                  <a class="dropdown-item" href='{{ route('logout') }}'>
                                      <i class="bx bx-power-off text-danger me-2"></i>
                                      <span class="align-middle">Log Out</span>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <!--/ User -->
                  </ul>
              </div>
          </nav>
