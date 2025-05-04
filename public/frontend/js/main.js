// Business Topbar Search Function
document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('black_overlay');

    // Topbar Search Click Function
    document.getElementById('business_topbar_search_icon')?.addEventListener('click', function () {
        document.getElementById('business_layout_body_topbar_right_search')?.classList.add('active');
        overlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
    })

    // Universal Close Function
    overlay?.addEventListener('click', function () {
        document.getElementById('business_layout_body_topbar_right_search')?.classList.remove('active');
        document.getElementById('business_sidebar').classList.remove('visible');
        document.querySelector('.business-current-menu-sidebar-all-tab')?.classList.remove('active');
        overlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    })

    // Sidebar Open Function
    document.getElementById('business_layout_body_topbar_right_icon')?.addEventListener('click', function () {
        document.getElementById('business_sidebar')?.classList.add('visible');
        overlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
    })

    // Floating Menu Open Function
    document.getElementById('business-current-floating-menu-filter')?.addEventListener('click', function () {
        document.querySelector('.business-current-menu-sidebar-all-tab').classList.toggle('active');
        overlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
    })

    // Floating Menu Close Function
    document.querySelectorAll('.business-current-menu-sidebar-all-tab .nav-link').forEach(function (element) {
        element.addEventListener('click', function () {
            document.querySelector('.business-current-menu-sidebar-all-tab')?.classList.remove('active');
            overlay.style.display = 'none';
            document.body.style.overflow = 'auto';
        })
    })

    // Account Details Edit Button Function
    document.getElementById('account--details--profile--edit')?.addEventListener('click', function () {
        document.getElementById('account--details--profile--edit--submit').classList.add('visible');
        document.getElementById('account--details--profile--edit').style.display = 'none';
        document.querySelectorAll('.account--details--profile--edit--input').forEach(function (element) {
            element.removeAttribute('readonly');
        })
    })

    // Account Details Edit Cancle Button Function
    document.getElementById('account--details--profile--edit--cancle')?.addEventListener('click', function () {
        document.getElementById('account--details--profile--edit--submit').classList.remove('visible');
        document.getElementById('account--details--profile--edit').style.display = 'flex';
        document.querySelectorAll('.account--details--profile--edit--input').forEach(function (element) {
            element.setAttribute('readonly', true);
        })
    })
    
    // Business Details Edit Button Function
    document.getElementById('business--details--profile--edit')?.addEventListener('click', function () {
        document.getElementById('business--details--profile--edit--submit').classList.add('visible');
        document.getElementById('business--details--profile--edit').style.display = 'none';
        document.querySelectorAll('.business--details--profile--edit--input').forEach(function (element) {
            element.removeAttribute('readonly');
        })
    })
    
    // Business Details Edit Cancle Button Function
    document.getElementById('business--details--profile--edit--cancle')?.addEventListener('click', function () {
        document.getElementById('business--details--profile--edit--submit').classList.remove('visible');
        document.getElementById('business--details--profile--edit').style.display = 'flex';
        document.querySelectorAll('.business--details--profile--edit--input').forEach(function (element) {
            element.setAttribute('readonly', true);
        })
    })
      
});