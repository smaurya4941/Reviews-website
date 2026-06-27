</main>

<script>
// Mobile Sidebar Toggle Logic
$(document).ready(function() {
    $('#mobile-menu-toggle').click(function(e) {
        e.stopPropagation();
        $('#sidebar').toggleClass('-translate-x-full');
    });
    
    $(document).click(function(e) {
        if (!$(e.target).closest('#sidebar, #mobile-menu-toggle').length && $(window).width() < 768) {
            $('#sidebar').addClass('-translate-x-full');
        }
    });
});
</script>
</body>
</html>
