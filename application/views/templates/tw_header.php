<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Bizorm | <?php echo (isset($title) && !empty($title)) ? ucwords($title) : 'Dashboard' ?></title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<!-- Bootstrap Table CSS (Minimal) for specific pages -->
<?php if(isset($load_bs_table)): ?>
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
<?php endif; ?>

<!-- DataTables CSS (Minimal) for specific pages -->
<?php if(isset($load_datatable)): ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
<?php endif; ?>

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Scripts -->
<?php if(isset($load_bs_table)): ?>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<?php endif; ?>
<?php if(isset($load_datatable)): ?>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<?php endif; ?>

<script id="tailwind-config">
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: "#004ac6",
                "on-primary": "#ffffff",
                surface: "#f9f9ff",
                "surface-container-highest": "#d8e3fb",
                "surface-container-high": "#dee8ff",
                "surface-container-lowest": "#ffffff",
                "outline-variant": "#c3c6d7",
                "surface-subtle": "#F8FAFC",
                "surface-dim": "#cfdaf2",
                "success": "#10B981",
                "error": "#EF4444",
                "on-surface": "#111c2d",
                "on-surface-variant": "#434655",
            },
            fontFamily: {
                sans: ["Inter", "sans-serif"],
                display: ["Plus Jakarta Sans", "sans-serif"],
                "headline-md": ["Plus Jakarta Sans"],
                "body-lg": ["Inter"],
                "display-lg": ["Plus Jakarta Sans"],
                "caption": ["Inter"],
                "label-md": ["Inter"],
                "headline-lg": ["Plus Jakarta Sans"],
                "body-md": ["Inter"]
            },
            spacing: {
                "lg": "24px",
                "sm": "8px",
                "xl": "40px",
                "section": "80px",
                "xs": "4px",
                "md": "16px",
                "gutter": "24px",
                "base": "4px"
            },
            fontSize: {
                "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                "caption": ["12px", {"lineHeight": "1.4", "fontWeight": "500"}],
                "label-md": ["14px", {"lineHeight": "1", "letterSpacing": "0.01em", "fontWeight": "600"}],
                "headline-lg": ["32px", {"lineHeight": "1.25", "fontWeight": "700"}],
                "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}]
            }
        }
    }
}
</script>
<style>
body { background-color: #f9f9ff; color: #111c2d; font-family: 'Inter', sans-serif; font-size: 14px; }
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
.btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; transition: background 0.2s; cursor: pointer; }
.form-control { width: 100%; outline: none; transition: border-color 0.2s; }
.form-control:focus { border-color: #004ac6; box-shadow: 0 0 0 2px rgba(0, 74, 198, 0.2); }
</style>
<?php if(isset($custom_css)) echo $custom_css; ?>
</head>
<body class="flex min-h-screen overflow-x-hidden">
<?php $url = $this->session->userdata('url'); ?>

<aside class="h-screen w-56 fixed left-0 top-0 bg-surface-container-lowest shadow-sm shadow-primary/10 flex flex-col py-3 overflow-y-auto z-40 transition-transform duration-300 md:translate-x-0 -translate-x-full" id="sidebar">
    <div class="px-4 mb-6 mt-2">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-on-primary shadow-md">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">insights</span>
            </div>
            <div>
                <h1 class="text-xl font-display font-bold text-primary">Bizorm</h1>
                <p class="text-[11px] text-gray-500 font-medium">Reputation Manager</p>
            </div>
        </div>
    </div>
    <nav class="flex-1 px-3 space-y-1">
        <?php if ($this->session->userdata('mr_logged_in')) : ?>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'dashboard') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('dashboard') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">dashboard</span> <span class="text-[13px]">Dashboard</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'platforms') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('platforms') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">language</span> <span class="text-[13px]">Platforms</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'share') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('share') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">send</span> <span class="text-[13px]">Send Link</span>
        </a>
        <?php endif; ?>
        
        <?php if ($this->session->userdata('mr_logged_in') && ($this->session->userdata('mr_sadmin') == "1" || $this->session->userdata('mr_admin') == "1")) : ?>
        <div class="pt-2 mt-2 border-t border-gray-100">
            <span class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Administration</span>
        </div>
        <a class="flex items-center gap-3 px-3 py-2 mt-1 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'users') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('users') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">group</span> <span class="text-[13px]">Manage Users</span>
        </a>
        <?php if ($this->session->userdata('mr_sadmin') == "1") : ?>
        <a class="flex items-center gap-3 px-3 py-2 mt-1 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'plans') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('admin/plans') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">card_membership</span> <span class="text-[13px]">Manage Plans</span>
        </a>
        <?php endif; ?>
        <?php endif; ?>

        <?php if ($this->session->userdata('mr_logged_in')) : ?>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'report') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('report') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">bar_chart</span> <span class="text-[13px]">Reports</span>
        </a>
        <?php endif; ?>

        <?php if ($this->session->userdata('mr_cmpyid') == null && $this->session->userdata('mr_sadmin') == '0') : ?>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'plans') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('plans') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">shopping_cart</span> <span class="text-[13px]">Buy Subscription</span>
        </a>
        <?php endif; ?>

        <?php if ($this->session->userdata('mr_admin') == '1') : ?>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'company') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('company') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">business</span> <span class="text-[13px]">Company</span>
        </a>
        <?php endif; ?>

        <?php if ($this->session->userdata('mr_sadmin') == '1') : ?>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'logs') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('logs') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">history</span> <span class="text-[13px]">Activity Logs</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'settings') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('settings') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">settings</span> <span class="text-[13px]">Settings</span>
        </a>
        <?php endif; ?>

        <?php if ($this->session->userdata('mr_logged_in')) : ?>
        <div class="pt-2 mt-2 border-t border-gray-100">
            <span class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Account</span>
        </div>
        <a class="flex items-center gap-3 px-3 py-2 mt-1 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'account') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('account') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">person</span> <span class="text-[13px]">My Account</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'support') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-gray-600 hover:bg-surface-container-high' ?>" href="<?php echo base_url('support') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">help</span> <span class="text-[13px]">Support</span>
        </a>
        <?php endif; ?>
    </nav>
    <div class="px-3 mt-auto pt-3 border-t border-gray-100">
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-red-500 font-medium hover:bg-red-50 transition-all duration-200" href="<?php echo base_url('logout') ?>">
            <span class="material-symbols-outlined" style="font-size: 20px;">logout</span> <span class="text-[13px]">Logout</span>
        </a>
    </div>
</aside>

<main class="flex-1 ml-0 md:ml-56 min-h-screen flex flex-col">
    <header class="w-full h-14 sticky top-0 z-30 bg-surface/80 backdrop-blur-md shadow-sm shadow-primary/5 flex justify-between items-center px-6 border-b border-outline-variant/20">
        <button class="md:hidden p-2 text-gray-700" id="mobile-menu-toggle">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <div class="flex items-center gap-2 ml-auto">
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-primary font-bold">
                <?php echo strtoupper(substr($this->session->userdata('mr_uname'), 0, 1)); ?>
            </div>
            <span class="text-[13px] font-semibold hidden md:inline"><?php echo $this->session->userdata('mr_uname'); ?></span>
        </div>
    </header>
