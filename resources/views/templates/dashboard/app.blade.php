@include('templates.includes.headadmin')

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
        @include('templates.includes.sidebar')
        @yield('content')
    </div>
</body>

</html>
