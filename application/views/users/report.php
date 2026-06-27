<?php $this->load->view('templates/tw_header'); ?>


    <div class="p-6 md:p-8 max-w-[1200px] mx-auto w-full">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Reports & Analytics</h2>
                <p class="text-sm text-gray-500 mt-1">Detailed breakdown of your reviews, sent links, and platform performance.</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Top Level Tabs (My Reports vs All Users) -->
            <div class="flex border-b border-gray-100 bg-gray-50/50">
                <button class="main-tab-btn active px-6 py-4 text-sm font-semibold text-primary border-b-2 border-primary outline-none" data-target="#myReports">My Reports</button>
                <?php if ($this->session->userdata('mr_sadmin') === '1' || $this->session->userdata('mr_admin') === '1') : ?>
                <button class="main-tab-btn px-6 py-4 text-sm font-semibold text-gray-500 hover:text-gray-700 border-b-2 border-transparent outline-none" data-target="#userReports">
                    <?php echo ($this->session->userdata('mr_sadmin') === '1') ? 'All Users' : 'Users' ?>
                </button>
                <?php endif; ?>
            </div>

            <!-- My Reports Section -->
            <div id="myReports" class="tab-content active">
                <div class="flex border-b border-gray-100">
                    <button class="sub-tab-btn my-sub-btn active px-6 py-3 text-sm font-medium text-blue-600 border-b-2 border-blue-600 outline-none" data-target="#my-reviews">Reviews</button>
                    <button class="sub-tab-btn my-sub-btn px-6 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent outline-none" data-target="#my-links">Links Sent</button>
                    <button class="sub-tab-btn my-sub-btn px-6 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent outline-none" data-target="#my-platforms">Platforms</button>
                </div>

                <div class="p-6">
                    <div id="my-reviews" class="inner-tab-content">
                        <?php include("report/ratings-received.php"); ?>
                    </div>
                    <div id="my-links" class="inner-tab-content" style="display:none;">
                        <?php include("report/links-sent.php"); ?>
                    </div>
                    <div id="my-platforms" class="inner-tab-content" style="display:none;">
                        <?php include("report/website.php"); ?>
                    </div>
                </div>
            </div>

            <!-- User Reports Section -->
            <?php if ($this->session->userdata('mr_sadmin') === '1' || $this->session->userdata('mr_admin') === '1') : ?>
            <div id="userReports" class="tab-content" style="display:none;">
                <div class="flex border-b border-gray-100">
                    <button class="sub-tab-btn user-sub-btn active px-6 py-3 text-sm font-medium text-blue-600 border-b-2 border-blue-600 outline-none" data-target="#user-reviews">Reviews</button>
                    <button class="sub-tab-btn user-sub-btn px-6 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent outline-none" data-target="#user-links">Links Sent</button>
                    <button class="sub-tab-btn user-sub-btn px-6 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent outline-none" data-target="#user-platforms">Platforms</button>
                </div>

                <div class="p-6">
                    <div id="user-reviews" class="inner-tab-content">
                        <?php include("report/users-ratings-received.php"); ?>
                    </div>
                    <div id="user-links" class="inner-tab-content" style="display:none;">
                        <?php include("report/users-links-sent.php"); ?>
                    </div>
                    <div id="user-platforms" class="inner-tab-content" style="display:none;">
                        <?php include("report/users-website.php"); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<script>
$(document).ready(function() {
    // Main Tabs (My Reports vs All Users)
    $('.main-tab-btn').click(function() {
        $('.main-tab-btn').removeClass('active text-primary border-primary').addClass('text-gray-500 border-transparent hover:text-gray-700');
        $(this).addClass('active text-primary border-primary').removeClass('text-gray-500 border-transparent hover:text-gray-700');
        
        $('.tab-content').hide();
        $($(this).data('target')).fadeIn();
    });

    // Sub Tabs (Reviews, Links Sent, Platforms)
    $('.sub-tab-btn').click(function() {
        var isUserTab = $(this).hasClass('user-sub-btn');
        var selector = isUserTab ? '.user-sub-btn' : '.my-sub-btn';
        
        $(selector).removeClass('active text-blue-600 border-blue-600').addClass('text-gray-500 border-transparent hover:text-gray-700');
        $(this).addClass('active text-blue-600 border-blue-600').removeClass('text-gray-500 border-transparent hover:text-gray-700');
        
        $(this).closest('.tab-content').find('.inner-tab-content').hide();
        $($(this).data('target')).fadeIn();
    });
});
</script>

<style>
/* Provide base styling for Bootstrap Table so it doesn't squish */
.bootstrap-table .fixed-table-container {
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    overflow: hidden;
}
table.table {
    width: 100% !important;
    text-align: left;
    border-collapse: collapse;
}
table.table th, table.table td {
    padding: 12px 16px;
    border-bottom: 1px solid #e2e8f0;
    white-space: nowrap;
}
table.table thead th {
    background-color: #f8fafc;
    color: #475569;
    font-weight: 600;
    font-size: 13px;
}
table.table tbody tr:hover {
    background-color: #f1f5f9;
}
.fixed-table-toolbar .search input {
    border: 1px solid #cbd5e1;
    border-radius: 0.375rem;
    padding: 0.5rem 1rem;
    outline: none;
}
.fixed-table-toolbar .search input:focus {
    border-color: #004ac6;
    box-shadow: 0 0 0 2px rgba(0, 74, 198, 0.2);
}

/* Pagination styles */
.fixed-table-pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    font-size: 0.875rem;
    color: #475569;
}
.fixed-table-pagination .pull-left, 
.fixed-table-pagination .pull-right {
    float: none !important;
}
.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    gap: 0.25rem;
}
.page-item .page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    background-color: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    color: #475569;
    text-decoration: none;
    transition: all 0.2s;
}
.page-item .page-link:hover {
    background-color: #f8fafc;
    border-color: #cbd5e1;
}
.page-item.active .page-link {
    background-color: #004ac6;
    border-color: #004ac6;
    color: #fff;
}
.page-item.disabled .page-link {
    color: #94a3b8;
    pointer-events: none;
    background-color: #f8fafc;
}
.pagination-detail .btn-group {
    display: inline-block;
    margin-left: 0.5rem;
}
.pagination-detail .dropdown-menu {
    display: none; /* simple fallback */
}
</style>

<?php $this->load->view('templates/tw_footer'); ?>
