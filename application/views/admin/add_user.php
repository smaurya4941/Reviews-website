<?php $this->load->view('templates/tw_header'); ?>

    <div class="p-6 md:p-8 max-w-3xl mx-auto w-full">
        <div class="mb-6 flex items-center gap-4">
            <a href="<?php echo base_url('users') ?>" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition-colors">
                <span class="material-symbols-outlined" style="font-size: 20px">arrow_back</span>
            </a>
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Add New User</h2>
                <p class="text-sm text-gray-500 mt-1">Create a new account on the platform with specific roles and quotas.</p>
            </div>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 shadow-sm">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-6 shadow-sm">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <!-- Inject legacy add user forms directly -->
            <?php if ($this->session->userdata('mr_sadmin') === "1") : ?>
                <?php include("users/adduser_sadmin.php") ?>
            <?php endif; ?>
            <?php if ($this->session->userdata('mr_admin') === "1") : ?>
                <?php include("users/adduser_cmpy.php") ?>
            <?php endif; ?>
        </div>
    </div>
<?php $this->load->view('templates/tw_footer'); ?><script>
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

    // Fix active plan highlighting
    $('.planlist label').click(function() {
        $('.planlist label').css({'border-color': '#cbd5e1', 'background': '#fff'});
        $(this).css({'border-color': '#004ac6', 'background': '#f8fafc'});
    });
});
</script>
</body>
</html>
