<div id="layoutSidenav_nav">
  <nav class="sidenav shadow-right sidenav-dark">
    <div class="sidenav-menu">
      <div class="nav accordion" id="accordionSidenav">
        <br>
        <br>
        <a class="nav-link" href={{route('home')}}><i class="fas fa-home"></i>&nbsp Anasayfa</a>
        <a class="nav-link" href={{route('edit.index')}}><i class="fas fa-user-circle"></i>&nbsp Profilim</a>
        <a class="nav-link" href={{route('form.index')}}><i class="fas fa-align-left"></i>&nbsp Öğrenci Formu</a>
          <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseAdminPanel" aria-expanded="false" aria-controls="collapseAdminPanel">
            <div class="nav-link"><i class="fas fa-users-cog"></i></div>
              Kullanıcı
            <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
          </a>
          <div class="collapse" id="collapseAdminPanel" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
              <a class="nav-link" href={{route('user-list.index')}}><i class="fas fa-clipboard-list"></i>&nbsp Kullanıcı Listesi</a>
              <a class="nav-link" href={{route('user-create')}}><i class="fas fa-plus-circle"></i>&nbsp Yeni Kullanıcı Oluştur</a>
            </nav>
          </div>
          <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseTeacherPanel" aria-expanded="false" aria-controls="collapseTeacherPanel">
            <div class="nav-link"><i class="fas fa-chalkboard-teacher"></i></div>
              Öğretmen
            <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
          </a>
          <div class="collapse" id="collapseTeacherPanel" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
              <a class="nav-link" href={{route('teacher-list')}}><i class="fas fa-clipboard-list"></i>&nbsp Öğretmen Listesi</a>
              <a class="nav-link" href={{route('teacher-import-show')}}><i class="fas fa-upload"></i>&nbsp Liste Yükle</a>
              <a class="nav-link" href={{route('teacher-export')}}><i class="fas fa-download"></i>&nbsp Listeyi İndir</a>
            </nav>
          </div>
          <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseStudentPanel" aria-expanded="false" aria-controls="collapseStudentPanel">
            <div class="nav-link"><i class="fas fa-user-graduate"></i></div>
              Öğrenci
            <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
          </a>
          <div class="collapse" id="collapseStudentPanel" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
              <a class="nav-link" href={{route('student-list')}}><i class="fas fa-clipboard-list"></i>&nbsp Öğrenci Listesi</a>
              <a class="nav-link" href={{route('student-import-show')}}><i class="fas fa-upload"></i>&nbsp Liste Yükle</a>
              <a class="nav-link" href={{route('student-export')}}><i class="fas fa-download"></i>&nbsp Listeyi İndir</a>
            </nav>
          </div>
          <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDepartmentPanel" aria-expanded="false" aria-controls="collapseDepartmentPanel">
            <div class="nav-link"><i class="fas fa-building"></i></div>
              Bölümler
            <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
          </a>
          <div class="collapse" id="collapseDepartmentPanel" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
              <a class="nav-link" href={{route('department-list.index')}}><i class="fas fa-clipboard-list"></i>&nbsp Bölüm Listesi</a>
              <a class="nav-link" href={{route('department-list.create')}}><i class="fas fa-plus-circle"></i>&nbsp Yeni Bölüm Oluştur</a>
            </nav>
          </div>
          <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseLecturePanel" aria-expanded="false" aria-controls="collapseLecturePanel">
            <div class="nav-link"><i class="fas fa-book-open"></i></div>
              Dersler
            <div class="sidenav-collapse-arrow"><svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down"></i> Font Awesome fontawesome.com --></div>
          </a>
          <div class="collapse" id="collapseLecturePanel" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
              <a class="nav-link" href={{route('lecture-list')}}><i class="fas fa-clipboard-list"></i>&nbsp Ders Listesi</a>
              <a class="nav-link" href={{route('user-lecture.index')}}><i class="fas fa-book"></i>&nbsp Seçtğim Dersler</a>
            </nav>
          </div>
        <!-- Sidenav Link (Charts)-->
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <div class="nav-link-icon" ><i class="fas fa-sign-out-alt"></i></div>
          Çıkış Yap
        </a>
      </div>
    </div>

    <div class="sidenav-footer">
      <div class="sidenav-footer-content">
        <div class="sidenav-footer-subtitle">Logged in as:</div>
        <div class="sidenav-footer-title">{{auth()->user()->name}}</div>
      </div>
    </div>
  </nav>
</div>
