    <nav class="pc-sidebar animate-fadeInUp">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="#" class="b-brand d-flex align-items-center text-decoration-none">
                    <!-- Logo -->
                    <img src="/../assets/images/logo-ptpn-no-font.png" style="width: 60px;" class="img-fluid logo-lg me-2"
                        alt="logo">

                    <!-- Teks PTPN 5 -->
                    <span
                        style="font-family: 'Poppins', sans-serif; color: #30B2EB; font-size: 25px; margin-top: 15px;margin-left: -10px; font-weight: 600;">
                        RSPO
                    </span>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="index" class="pc-link py-3">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('kebun') }}" class="pc-link py-3">
                            <span class="pc-micon"><i class="ti ti-leaf"></i></span>
                            <span class="pc-mtext">Rekap Kebun</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('pks') }}" class="pc-link py-3">
                            <span class="pc-micon"><i class="ti ti-settings"></i></span>
                            <span class="pc-mtext">Rekap PKS</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('dataList') }}" class="pc-link py-3">
                            <span class="pc-micon"><i class="ti ti-clipboard"></i></span>
                            <span class="pc-mtext">Data List</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>