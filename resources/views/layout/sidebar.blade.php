<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-profile">
                <a href="/profile" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
                <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image menu-profile-image-icon bg-gray-900 text-gray-600">
                        <?php if(Auth::user()->foto != null) {
								$foto = asset(Auth::user()->foto);
                        } else {
                            $foto = asset('assets/images/users.png');
                        }?>
                        <img src="{{$foto}}" alt="" />
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                            {{ Auth::user()->name }}
                            </div>
                        </div>
                        <small></small>
                    </div>
                </a>
            </div>
                <?php if( isLoggedIn()) : ?>
                    <?php if (forModule('DASHBOARD') || forModule('PERUSAHAAN') || forModule('CLIENT') || forModule('JENIS_PROJECT') || forModule('PROJECT') || forModule('TRANSAKSI') 
                    || forModule('PROFILE') || forModule('MITRA') || forModule('TEAM') || forModule('TESTIMONI') || forModule('PORTOFOLIO') || forModule('SERVICE') || forModule('FOTO_KEGIATAN') 
                    || forModule('KENAPA_HARUS_KAMI') || forModule('PAKET') || forModule('USER_MANAGEMENT')) : ?>
                    
                        <div class="menu-header">Navigation</div>
                        <?php if (forModuleGroup('DASHBOARD')) : ?>
                            <?php if (forModule('DASHBOARD')) :  ?>
                                <div class="menu-item has-sub <?php echo (Session::get('group') == $data['group'] ? 'active' : '') ?>">
                                    <a href="javascript:;" class="menu-link">
                                        <div class="menu-icon">
                                        <i class="fas fa-chart-pie fa-fw"></i>
                                        </div>
                                        <div class="menu-text">Dashboard</div>
                                        <div class="menu-caret"></div>
                                    </a>
                                    <div class="menu-submenu">
                                    
                                        <?php if (forModule('DASHBOARD')) : ?>
                                        <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                            <a href="/adm/dashboard" class="menu-link ">
                                                <div class="menu-text">Dashboard</div>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    
                                    </div>
                                </div>
                            <?php endif; ?> 
                        <?php endif; ?>

                        <?php if (forModuleGroup('MASTER_DATA')) : ?>
                            <div class="menu-header">Master Data</div>
                            <?php if (forModule('CLIENT')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/client" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-building-user fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Client</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('PERUSAHAAN')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/perusahaan" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-building fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Perusahaan</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('PROJECT')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/project" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-file-shield fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Project</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('JENIS_PROJECT')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/jenis_project" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-list fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Jenis Project</div>
                                </a>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (forModuleGroup('KEUANGAN')) : ?>
                        <div class="menu-header">Keuangan</div>
                            <?php if (forModule('TRANSAKSI')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/transaksi" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-handshake fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Transaksi</div>
                                </a>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (forModuleGroup('CMS')) : ?>
                        <div class="menu-header">CMS</div>
                            <?php if (forModule('PROFILE')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/profile" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-book fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Profile</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('MITRA')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/mitra" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-book fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Mitra</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('TEAM')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/team" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-book fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Team</div>
                                </a>
                            </div>
                            <?php endif; ?>
                             <?php if (forModule('FOTO_KEGIATAN')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/foto_kegiatan" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-book fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Foto Kegiatan</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('TESTIMONI')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/testimoni" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-book fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Testimoni</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('KENAPA_HARUS_KAMI')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/kenapa_harus_kami" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-book fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Kenapa Harus Kami</div>
                                </a>
                            </div>
                            <?php endif; ?>
                             <?php if (forModule('PAKET')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/paket" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-book fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Paket</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('SERVICE')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/service" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-book fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Service</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('PORTOFOLIO')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/portofolio" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-book fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Portofolio</div>
                                </a>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (forModuleGroup('SETTING')) : ?>
                            <div class="menu-header">Settings</div>
                            <?php if (forModule('USER_MANAGEMENT')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/adm/user" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-user-group fa-fw"></i>
                                    </div>
                                    <div class="menu-text">User Management</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            
                        <?php endif; ?>

                        
                    <?php endif; ?>
                <?php endif; ?>
                    
                <!-- BEGIN minify-button -->
                <div class="menu-item d-flex">
                        <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
                </div>
                <!-- END minify-button -->
                
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
<!-- END #sidebar -->