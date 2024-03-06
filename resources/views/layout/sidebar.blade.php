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
                    <?php if (forModule('DASHBOARD') || forModule('PERUSAHAAN') || forModule('CLIENT') || forModule('JENIS_PROJECT') || forModule('PROJECT') || forModule('USER_MANAGEMENT')) : ?>
                    
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
                                            <a href="/dashboard" class="menu-link ">
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
                                <a href="/client" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-building-user fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Client</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('PERUSAHAAN')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/perusahaan" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-building fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Perusahaan</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('PROJECT')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/project" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-file-shield fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Project</div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if (forModule('JENIS_PROJECT')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/jenis_project" class="menu-link">
                                    <div class="menu-icon">
                                    <i class="fas fa-list fa-fw"></i>
                                    </div>
                                    <div class="menu-text">Jenis Project</div>
                                </a>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (forModuleGroup('SETTING')) : ?>
                            <div class="menu-header">Settings</div>
                            <?php if (forModule('USER_MANAGEMENT')) : ?>
                            <div class="menu-item <?php echo (Session::get('module') == $data['role'] ? 'active' : '') ?>">
                                <a href="/user" class="menu-link">
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