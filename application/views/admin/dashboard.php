<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Bizorm Reviews | Admin Dashboard</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script id="tailwind-config">
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: "#1d3f58",
                "primary-light": "#2a5472",
                secondary: "#4cbfa6",
                "on-primary": "#ffffff",
                surface: "#f0f2f5",
                "surface-container": "#ffffff",
                "text-primary": "#334155",
                "text-secondary": "#64748b",
            },
            fontFamily: {
                sans: ["Inter", "sans-serif"],
                display: ["Plus Jakarta Sans", "sans-serif"],
            }
        }
    }
}
</script>
<style>
body { background-color: #f0f2f5; color: #334155; font-family: 'Inter', sans-serif; }
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
.sidebar-link { display: flex; align-items: center; gap: 12px; padding: 10px 16px; color: #e2e8f0; border-radius: 4px; transition: all 0.2s; }
.sidebar-link:hover, .sidebar-link.active { background: #ffffff; color: #1d3f58; font-weight: 600; }
.sidebar-link.active .material-symbols-outlined { font-variation-settings: 'FILL' 1; }
.sidebar-link:hover .material-symbols-outlined { font-variation-settings: 'FILL' 1; }
::-webkit-scrollbar { width: 6px; height: 6px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>
</head>
<body class="flex min-h-screen overflow-x-hidden">
<?php $url = $this->session->userdata('url'); ?>

<!-- Sidebar -->
<aside class="h-screen w-64 fixed left-0 top-0 bg-primary flex flex-col z-40 transition-transform duration-300 md:translate-x-0 -translate-x-full" id="sidebar">
    <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between">
        <h1 class="text-xl font-display font-bold text-white tracking-wide">Bizorm Reviews</h1>
        <button class="md:hidden text-white" id="mobile-menu-close">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <a class="sidebar-link active" href="<?php echo base_url('dashboard') ?>">
            <span class="material-symbols-outlined">home</span>
            <span class="text-sm">Dashboard</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('platforms') ?>">
            <span class="material-symbols-outlined">language</span>
            <span class="text-sm">Platforms</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('share') ?>">
            <span class="material-symbols-outlined">send</span>
            <span class="text-sm">Send Link</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('users') ?>">
            <span class="material-symbols-outlined">group</span>
            <span class="text-sm">Manage Users</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('branch') ?>">
            <span class="material-symbols-outlined">domain</span>
            <span class="text-sm">Branch Management</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('account') ?>">
            <span class="material-symbols-outlined">person</span>
            <span class="text-sm">My Account</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('report') ?>">
            <span class="material-symbols-outlined">bar_chart</span>
            <span class="text-sm">Report</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('plans') ?>">
            <span class="material-symbols-outlined">description</span>
            <span class="text-sm">Plans</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('pricing') ?>">
            <span class="material-symbols-outlined">payments</span>
            <span class="text-sm">Pricing Management</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('logs') ?>">
            <span class="material-symbols-outlined">receipt_long</span>
            <span class="text-sm">Logs</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('support') ?>">
            <span class="material-symbols-outlined">help_center</span>
            <span class="text-sm">Support</span>
        </a>
        <a class="sidebar-link" href="<?php echo base_url('settings') ?>">
            <span class="material-symbols-outlined">settings</span>
            <span class="text-sm">Settings</span>
        </a>
    </nav>
    <div class="px-4 py-4 border-t border-white/10">
        <a class="sidebar-link text-red-300 hover:text-red-600 hover:bg-red-50" href="<?php echo base_url('logout') ?>">
            <span class="material-symbols-outlined">logout</span>
            <span class="text-sm">Logout</span>
        </a>
    </div>
</aside>

<!-- Main Content -->
<main class="flex-1 ml-0 md:ml-64 min-h-screen flex flex-col bg-surface">
    <!-- Top Header -->
    <header class="w-full h-14 bg-primary text-white flex justify-between items-center px-6 sticky top-0 z-30">
        <div class="flex items-center">
            <button class="md:hidden p-2 text-white mr-2" id="mobile-menu-toggle">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
        <div class="text-sm font-semibold uppercase tracking-widest text-white/90">
            <?php echo ($this->session->userdata('mr_uname') ? $this->session->userdata('mr_uname') : 'ADMIN') ?>
        </div>
    </header>

    <div class="p-6 max-w-7xl mx-auto w-full space-y-6">
        
        <!-- Welcome Banner -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-2xl font-display font-bold text-primary mb-1">Welcome back, <?php echo $this->session->userdata('mr_uname'); ?></h2>
                <p class="text-text-secondary text-sm">Manage your review platforms and monitor overall customer feedback.</p>
            </div>
            <div class="flex items-center gap-2 px-3 py-1.5 bg-green-50 text-secondary border border-secondary/30 rounded-full text-xs font-semibold">
                <span class="material-symbols-outlined text-sm">check_circle</span>
                Active Subscription
            </div>
        </div>

        <!-- Branch Summaries -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <h3 class="font-bold text-text-primary">Branch Summaries</h3>
                <span class="text-text-secondary text-xs">(2 active branches)</span>
            </div>
            
            <div class="flex overflow-x-auto pb-4 gap-6 snap-x">
                <!-- Branch Card 1 -->
                <div class="min-w-[320px] bg-white p-5 rounded-xl shadow-sm border border-slate-200 snap-start flex-shrink-0 relative group">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-bold text-primary">Mumbai RestroPark</h4>
                        <span class="text-xs font-mono bg-blue-50 text-blue-600 px-2 py-1 rounded">RESTROM</span>
                    </div>
                    <div class="grid grid-cols-2 gap-y-4 gap-x-2">
                        <div>
                            <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Reviews</p>
                            <p class="font-bold text-lg">0</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Avg Rating</p>
                            <p class="font-bold text-lg text-yellow-500 flex items-center gap-1">0 <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span></p>
                        </div>
                        <div>
                            <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Platforms</p>
                            <p class="font-bold text-sm">0 active</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Users</p>
                            <p class="font-bold text-sm">1</p>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-between items-center border-t border-slate-100 pt-3">
                        <span class="text-xs font-semibold text-secondary bg-green-50 px-2 py-1 rounded">Active</span>
                        <a href="#" class="text-xs text-text-secondary group-hover:text-primary flex items-center gap-1 transition-colors">Drill down <span class="material-symbols-outlined text-xs">arrow_forward</span></a>
                    </div>
                </div>

                <!-- Branch Card 2 -->
                <div class="min-w-[320px] bg-white p-5 rounded-xl shadow-sm border border-slate-200 snap-start flex-shrink-0 relative group">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-bold text-primary">Gaziabad</h4>
                        <span class="text-xs font-mono bg-blue-50 text-blue-600 px-2 py-1 rounded">GAZ11</span>
                    </div>
                    <div class="grid grid-cols-2 gap-y-4 gap-x-2">
                        <div>
                            <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Reviews</p>
                            <p class="font-bold text-lg">0</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Avg Rating</p>
                            <p class="font-bold text-lg text-yellow-500 flex items-center gap-1">0 <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span></p>
                        </div>
                        <div>
                            <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Platforms</p>
                            <p class="font-bold text-sm">0 active</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Users</p>
                            <p class="font-bold text-sm">0</p>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-between items-center border-t border-slate-100 pt-3">
                        <span class="text-xs font-semibold text-secondary bg-green-50 px-2 py-1 rounded">Active</span>
                        <a href="#" class="text-xs text-text-secondary group-hover:text-primary flex items-center gap-1 transition-colors">Drill down <span class="material-symbols-outlined text-xs">arrow_forward</span></a>
                    </div>
                </div>
                
                <!-- Scroll Indicator Right -->
                <div class="flex items-center justify-center pl-2">
                    <button class="w-8 h-8 rounded-full bg-white shadow flex items-center justify-center text-text-secondary hover:text-primary hover:shadow-md transition-all">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
                <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-2">Subscribed Plan</p>
                <p class="font-bold text-base text-primary mb-1">Trial / Default Plan</p>
                <p class="text-[10px] text-text-secondary">Active billing plan</p>
            </div>
            
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
                <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-2">Active User Seats</p>
                <p class="font-bold text-base text-primary mb-1">1 <span class="text-sm font-normal text-text-secondary">/ 0 seats</span></p>
            </div>
            
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
                <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-2">Trial / Account Status</p>
                <p class="inline-block px-2 py-0.5 bg-green-50 text-secondary border border-secondary/30 rounded text-xs font-semibold mb-2">Active Subscriber</p>
                <p class="text-[10px] text-text-secondary">Billing lifecycle status</p>
            </div>
            
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
                <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-2">Combined Quota Credits</p>
                <p class="font-bold text-lg text-primary mb-1">
                    <?php echo isset($quotaInfo->balance) ? $quotaInfo->balance : '30099'; ?>
                </p>
                <p class="text-[10px] text-text-secondary">Remaining messages balance</p>
            </div>
        </div>

        <!-- Aggregate Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-10">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <span class="material-symbols-outlined">chat_bubble</span>
                </div>
                <div>
                    <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Total Reviews</p>
                    <p class="font-bold text-xl text-primary">3</p>
                </div>
            </div>
            
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-yellow-50 text-yellow-500 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
                <div>
                    <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Average Rating</p>
                    <p class="font-bold text-xl text-primary flex items-center gap-2">
                        5 
                        <span class="flex text-yellow-500 text-sm">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                    <span class="material-symbols-outlined">language</span>
                </div>
                <div>
                    <p class="text-[10px] text-text-secondary uppercase tracking-wider font-semibold mb-1">Active Platforms</p>
                    <p class="font-bold text-xl text-primary">1</p>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
$(document).ready(function() {
    $('#mobile-menu-toggle, #mobile-menu-close').click(function(e) {
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
