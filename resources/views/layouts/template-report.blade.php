<!DOCTYPE html>
<html>
    @includeIf('layouts._head')	
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
                
                <!-- Navbar top -->
                @includeIf('layouts._navbar-report')
                <!-- /Navbar top -->
            
                <!-- Content -->
                <div class="content">

                    <div class="pb-5">
                    @yield('content')
                    </div>
                    
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