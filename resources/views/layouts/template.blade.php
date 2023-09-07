<!DOCTYPE html>
<html>
    @includeIf('layouts._head')	
    <body>
        @includeIf('utils.flash-message')
        
        <main class="main" id="top">
            <div class="container-fluid px-0">
                
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