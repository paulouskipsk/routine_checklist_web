<!DOCTYPE html>
<html>
    <head>
        @includeIf('layouts._head')	
        @yield('poststyle')
    </head>
    <body>
        @includeIf('utils.flash-message')
        
        <main class="main" id="top">
            <div class="container-fluid px-0">

                <!--PreLoader-->
            <div id="preloader">
                    
                <div id="status">&nbsp;</div>
                <div class="loader">
                        <span id="text-preloader">Carregando</span>
                        <div class="dot-carousel"></div>
                </div>
            </div>
            <!--PreLoader-->
                
                <!-- Sidebar -->
                @includeIf('layouts._sidebar')
                <!-- /Sidebar -->
                
                <!-- Navbar top -->
                @includeIf('layouts._navbar')
                <!-- /Navbar top -->
            
                <!-- Content -->
                <div class="content">

                    <!-- Breadcrumbs -->
                    @includeIf('layouts._breadcrumbs')
                    <!-- /Breadcrumbs -->
                    
                    <div class="pb-5">
                    @yield('content')
                    </div>
                    
                    @includeIf('layouts._footer')
                </div>
                <!-- /Content -->    
            </div>
        </main>
        
        <!-- Scripts -->	
        @includeIf('layouts._js')
        @yield('postscript')
        <!-- /Scripts -->
    </body>
</html>