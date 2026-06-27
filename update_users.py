import os
import re

file_path = 'application/views/admin/users.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

new_content = """<?php $this->load->view('templates/tw_header'); ?>
    <div class="p-6 md:p-8 max-w-[1200px] mx-auto w-full">
        
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

        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Manage Users</h2>
                <p class="text-sm text-gray-500 mt-1">View and manage all registered accounts on the platform.</p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex gap-6" aria-label="Tabs">
                <button onclick="switchTab('list')" id="tab-list" class="tab-btn active-tab border-primary text-primary whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">group</span> List Users
                </button>
                <button onclick="switchTab('add')" id="tab-add" class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">person_add</span> Add User
                </button>
            </nav>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <!-- List Users Tab -->
            <div id="content-list" class="tab-content">
                <?php if ($this->session->userdata('mr_sadmin') === "1") : ?>
                    <?php include("users/sadminusers.php") ?>
                <?php endif; ?>

                <?php if ($this->session->userdata('mr_admin') === "1") : ?>
                    <?php include("users/adminusers.php") ?>
                <?php endif; ?>
            </div>

            <!-- Add User Tab -->
            <div id="content-add" class="tab-content hidden">
                <?php if ($this->session->userdata('mr_sadmin') === "1") : ?>
                    <?php include("users/adduser_sadmin.php") ?>
                <?php endif; ?>
                <?php if ($this->session->userdata('mr_admin') === "1") : ?>
                    <?php include("users/adduser_cmpy.php") ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $this->load->view('templates/tw_footer'); ?>
<script>
function switchTab(tabId) {
    // Update tabs
    $('.tab-btn').removeClass('active-tab border-primary text-primary').addClass('border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300');
    $('#tab-' + tabId).removeClass('border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300').addClass('active-tab border-primary text-primary');
    
    // Update content
    $('.tab-content').addClass('hidden');
    $('#content-' + tabId).removeClass('hidden');

    // Update URL without reload
    const url = new URL(window.location);
    url.searchParams.set('tab', tabId);
    window.history.pushState({}, '', url);
}

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

    // Check URL params for tab
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab');
    if (activeTab === 'add') {
        switchTab('add');
    }
});
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/users.js'); ?>"></script>
</body>
</html>
"""

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(new_content)

print("Updated users.php")
