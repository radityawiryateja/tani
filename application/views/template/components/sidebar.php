<aside class="sidebar d-flex flex-column">
    <header class="d-flex justify-content-between justify-content-lg-center">
        <h1 class="logo fw-bold text-break mb-0">SIKASEP UCIL</h1>
        <i class="ph ph-x sidebar-icons p-0 sidebar-close d-lg-none"></i>
    </header>

    <ul class="sidebar-item-wrapper flex-grow-1">
        <!-- <?php if ($_SESSION['akses']->m_data_customer == 1) : ?>
            <li class="sidebar-item <?= $active === 'customer' ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('customer') ?>">
                    <div class="text-break">
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                            <path d="M240,104,128,168,16,104,128,40Z" opacity="0.2"></path>
                            <path d="M12,111l112,64a8,8,0,0,0,7.94,0l112-64a8,8,0,0,0,0-13.9l-112-64a8,8,0,0,0-7.94,0l-112,64A8,8,0,0,0,12,111ZM128,49.21,223.87,104,128,158.79,32.13,104ZM247,140A8,8,0,0,1,244,151L132,215a8,8,0,0,1-7.94,0L12,151A8,8,0,1,1,20,137.05l108,61.74,108-61.74A8,8,0,0,1,247,140Z">
                            </path>
                        </svg><span class="align-middle">Customer</span>
                    </div>
                </a>
            </li>
        <?php endif ?>

        <?php if ($_SESSION['akses']->m_master_data == 1) : ?>
            <li class="sidebar-item <?= $active == 'master_data' ? 'active' : '' ?> ">
                <a class="sidebar-link collapsible collapsed" href="#">
                    <div class="text-break">
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                            <path d="M216,96v96a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V96Z" opacity="0.2"></path>
                            <path d="M224,48H32A16,16,0,0,0,16,64V88a16,16,0,0,0,16,16v88a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V104a16,16,0,0,0,16-16V64A16,16,0,0,0,224,48ZM208,192H48V104H208ZM224,88H32V64H224V88ZM96,136a8,8,0,0,1,8-8h48a8,8,0,0,1,0,16H104A8,8,0,0,1,96,136Z">
                            </path>
                        </svg><span class="align-middle">Master Data</span>
                    </div>
                </a>
                <div class="second-side-item-wrapper">
                    <ul>
                        <?php if ($_SESSION['akses']->m_data_user == 1) : ?>
                            <li class="second-side-item <?= isset($sub) && $sub == 'users' ? 'active no-transition' : '' ?>">
                                <a class="second-side-link" href="<?= base_url('master_data/users') ?>">
                                    <div class="text-break">
                                        <svg class="sub-menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                                            <path d="M156,128a28,28,0,1,1-28-28A28,28,0,0,1,156,128Z"></path>
                                        </svg><span class="align-middle">Users</span>
                                    </div>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </li>
        <?php endif ?>

        <?php if ($_SESSION['akses']->m_laporan == 1) : ?>
            <li class="sidebar-item <?= $active == 'laporan' ? 'active' : '' ?> ">
                <a class="sidebar-link collapsible collapsed" href="#">
                    <div class="text-break">
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 256 256">
                            <path d="M232,208a8,8,0,0,1-8,8H32a8,8,0,0,1-8-8V48a8,8,0,0,1,16,0V156.69l50.34-50.35a8,8,0,0,1,11.32,0L128,132.69,180.69,80H160a8,8,0,0,1,0-16h40a8,8,0,0,1,8,8v40a8,8,0,0,1-16,0V91.31l-58.34,58.35a8,8,0,0,1-11.32,0L96,123.31l-56,56V200H224A8,8,0,0,1,232,208Z"></path>
                        </svg><span class="align-middle">Laporan</span>
                    </div>
                </a>
                <div class="second-side-item-wrapper">
                    <ul>
                        <?php if ($_SESSION['akses']->m_laporan_piutang == 1) : ?>
                            <li class="second-side-item <?= isset($sub) && $sub == 'piutang' ? 'active no-transition' : '' ?>">
                                <a class="second-side-link" href="<?= base_url() . 'laporan/piutang' ?>">
                                    <div class="text-break">
                                        <svg class="sub-menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                                            <path d="M156,128a28,28,0,1,1-28-28A28,28,0,0,1,156,128Z"></path>
                                        </svg><span class="align-middle">Piutang</span>
                                    </div>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </li>
        <?php endif ?> -->

		<?php if ($_SESSION['akses']->m_kel_tani == 1) : ?>
            <li class="sidebar-item <?= $active == 'kelompok_tani' ? 'active' : '' ?> ">
                <a class="sidebar-link collapsible collapsed" href="#">
                    <div class="text-break">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path opacity="0.2" d="M20.25 9V18C20.25 18.1989 20.171 18.3897 20.0303 18.5303C19.8897 18.671 19.6989 18.75 19.5 18.75H4.5C4.30109 18.75 4.11032 18.671 3.96967 18.5303C3.82902 18.3897 3.75 18.1989 3.75 18V9H20.25Z" fill="white"/>
							<path d="M21 4.5H3C2.60218 4.5 2.22064 4.65804 1.93934 4.93934C1.65804 5.22064 1.5 5.60218 1.5 6V8.25C1.5 8.64782 1.65804 9.02936 1.93934 9.31066C2.22064 9.59196 2.60218 9.75 3 9.75V18C3 18.3978 3.15804 18.7794 3.43934 19.0607C3.72064 19.342 4.10218 19.5 4.5 19.5H19.5C19.8978 19.5 20.2794 19.342 20.5607 19.0607C20.842 18.7794 21 18.3978 21 18V9.75C21.3978 9.75 21.7794 9.59196 22.0607 9.31066C22.342 9.02936 22.5 8.64782 22.5 8.25V6C22.5 5.60218 22.342 5.22064 22.0607 4.93934C21.7794 4.65804 21.3978 4.5 21 4.5ZM19.5 18H4.5V9.75H19.5V18ZM21 8.25H3V6H21V8.25ZM9 12.75C9 12.5511 9.07902 12.3603 9.21967 12.2197C9.36032 12.079 9.55109 12 9.75 12H14.25C14.4489 12 14.6397 12.079 14.7803 12.2197C14.921 12.3603 15 12.5511 15 12.75C15 12.9489 14.921 13.1397 14.7803 13.2803C14.6397 13.421 14.4489 13.5 14.25 13.5H9.75C9.55109 13.5 9.36032 13.421 9.21967 13.2803C9.07902 13.1397 9 12.9489 9 12.75Z" fill="white"/>
						</svg>
						<span class="align-middle">Kelompok Tani</span>
                    </div>
                </a>
                <div class="second-side-item-wrapper">
                    <ul>
                        <?php if ($_SESSION['akses']->m_kel_tani == 1) : ?>
                            <li class="second-side-item <?= isset($sub) && $sub == 'data_kelompok_tani' ? 'active no-transition' : '' ?>">
                                <a class="second-side-link" href="<?= base_url() . 'kelompok_tani/data_kelompok_tani' ?>">
                                    <div class="text-break">
                                        <svg class="sub-menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                                            <path d="M156,128a28,28,0,1,1-28-28A28,28,0,0,1,156,128Z"></path>
                                        </svg><span class="align-middle">Data Kelompok Tani</span>
                                    </div>
                                </a>
                            </li>
                        <?php endif ?>
						<?php if ($_SESSION['akses']->m_kel_tani == 1) : ?>
                            <li class="second-side-item <?= isset($sub) && $sub == 'data_tanam_panen' ? 'active no-transition' : '' ?>">
                                <a class="second-side-link" href="<?= base_url() . 'kelompok_tani/input_tanam_panen' ?>">
                                    <div class="text-break">
                                        <svg class="sub-menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                                            <path d="M156,128a28,28,0,1,1-28-28A28,28,0,0,1,156,128Z"></path>
                                        </svg><span class="align-middle">Data Tanam Panen</span>
                                    </div>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </li>
        <?php endif ?>
		
		<?php if ($_SESSION['akses']->m_pelaku_usaha_ubi == 1) : ?>
            <li class="sidebar-item <?= $active == 'pelaku_usaha_ubi' ? 'active' : '' ?> ">
                <a class="sidebar-link collapsible collapsed" href="#">
                    <div class="text-break">
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 256 256">
                            <path d="M232,208a8,8,0,0,1-8,8H32a8,8,0,0,1-8-8V48a8,8,0,0,1,16,0V156.69l50.34-50.35a8,8,0,0,1,11.32,0L128,132.69,180.69,80H160a8,8,0,0,1,0-16h40a8,8,0,0,1,8,8v40a8,8,0,0,1-16,0V91.31l-58.34,58.35a8,8,0,0,1-11.32,0L96,123.31l-56,56V200H224A8,8,0,0,1,232,208Z"></path>
                        </svg><span class="align-middle">Pelaku Usaha Ubi</span>
                    </div>
                </a>
                <div class="second-side-item-wrapper">
                    <ul>
                        <?php if ($_SESSION['akses']->m_pelaku_ubi_olahan == 1) : ?>
                            <li class="second-side-item <?= isset($sub) && $sub == 'pelaku_ubi_olahan' ? 'active no-transition' : '' ?>">
                                <a class="second-side-link" href="<?= base_url() . 'pelaku_usaha_ubi/ubi_olahan' ?>">
                                    <div class="text-break">
                                        <svg class="sub-menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                                            <path d="M156,128a28,28,0,1,1-28-28A28,28,0,0,1,156,128Z"></path>
                                        </svg><span class="align-middle">Ubi Olahan</span>
                                    </div>
                                </a>
                            </li>
                        <?php endif ?>
						<?php if ($_SESSION['akses']->m_pelaku_ubi_mentah == 1) : ?>
                            <li class="second-side-item <?= isset($sub) && $sub == 'pelaku_ubi_mentah' ? 'active no-transition' : '' ?>">
                                <a class="second-side-link" href="<?= base_url() . 'pelaku_usaha_ubi/ubi_mentah' ?>">
                                    <div class="text-break">
                                        <svg class="sub-menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                                            <path d="M156,128a28,28,0,1,1-28-28A28,28,0,0,1,156,128Z"></path>
                                        </svg><span class="align-middle">Ubi Mentah</span>
                                    </div>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </li>
        <?php endif ?>

		<?php if ($_SESSION['akses']->m_korporasi_ubi_jalar == 1) : ?>
            <li class="sidebar-item <?= $active == 'korporasi_ubi_jalar' ? 'active' : '' ?> ">
                <a class="sidebar-link collapsible collapsed" href="#">
                    <div class="text-break">
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 256 256">
                            <path d="M232,208a8,8,0,0,1-8,8H32a8,8,0,0,1-8-8V48a8,8,0,0,1,16,0V156.69l50.34-50.35a8,8,0,0,1,11.32,0L128,132.69,180.69,80H160a8,8,0,0,1,0-16h40a8,8,0,0,1,8,8v40a8,8,0,0,1-16,0V91.31l-58.34,58.35a8,8,0,0,1-11.32,0L96,123.31l-56,56V200H224A8,8,0,0,1,232,208Z"></path>
                        </svg><span class="align-middle">Korporasi Ubi Jalar</span>
                    </div>
                </a>
                <div class="second-side-item-wrapper">
                    <ul>
                        <?php if ($_SESSION['akses']->m_korporasi_ubi_olahan == 1) : ?>
                            <li class="second-side-item <?= isset($sub) && $sub == 'korporasi_ubi_olahan' ? 'active no-transition' : '' ?>">
                                <a class="second-side-link" href="<?= base_url() . 'korporasi_ubi_jalar/ubi_olahan' ?>">
                                    <div class="text-break">
                                        <svg class="sub-menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                                            <path d="M156,128a28,28,0,1,1-28-28A28,28,0,0,1,156,128Z"></path>
                                        </svg><span class="align-middle">Ubi Olahan</span>
                                    </div>
                                </a>
                            </li>
                        <?php endif ?>
						<?php if ($_SESSION['akses']->m_korporasi_ubi_mentah == 1) : ?>
                            <li class="second-side-item <?= isset($sub) && $sub == 'korporasi_ubi_mentah' ? 'active no-transition' : '' ?>">
                                <a class="second-side-link" href="<?= base_url() . 'korporasi_ubi_jalar/ubi_mentah' ?>">
                                    <div class="text-break">
                                        <svg class="sub-menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                                            <path d="M156,128a28,28,0,1,1-28-28A28,28,0,0,1,156,128Z"></path>
                                        </svg><span class="align-middle">Ubi Mentah</span>
                                    </div>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </li>
        <?php endif ?>
    </ul>
</aside>
