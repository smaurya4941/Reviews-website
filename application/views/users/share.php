<!DOCTYPE html>
<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Bizorm | Dashboard</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script id="tailwind-config">
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            "colors": {
                "on-primary": "#ffffff",
                "on-secondary-fixed-variant": "#5c4300",
                "tertiary-container": "#bc4800",
                "tertiary-fixed-dim": "#ffb596",
                "surface-variant": "#d8e3fb",
                "secondary-container": "#ffc329",
                "error": "#EF4444",
                "primary-fixed-dim": "#b4c5ff",
                "secondary": "#795900",
                "primary": "#004ac6",
                "surface-container-highest": "#d8e3fb",
                "primary-fixed": "#dbe1ff",
                "on-primary-fixed-variant": "#003ea8",
                "outline": "#737686",
                "on-secondary-fixed": "#261a00",
                "surface-bright": "#f9f9ff",
                "on-tertiary": "#ffffff",
                "on-surface": "#111c2d",
                "surface-dim": "#cfdaf2",
                "success": "#10B981",
                "tertiary-fixed": "#ffdbcd",
                "secondary-fixed": "#ffdf9f",
                "on-background": "#111c2d",
                "info": "#3B82F6",
                "surface-container-high": "#dee8ff",
                "inverse-primary": "#b4c5ff",
                "on-tertiary-fixed": "#360f00",
                "on-error-container": "#93000a",
                "surface-container-lowest": "#ffffff",
                "on-secondary": "#ffffff",
                "on-surface-variant": "#434655",
                "surface-container": "#e7eeff",
                "on-tertiary-fixed-variant": "#7d2d00",
                "on-secondary-container": "#6f5100",
                "error-container": "#ffdad6",
                "on-primary-fixed": "#00174b",
                "inverse-surface": "#263143",
                "tertiary": "#943700",
                "surface": "#f9f9ff",
                "background": "#f9f9ff",
                "surface-container-low": "#f0f3ff",
                "on-tertiary-container": "#ffede6",
                "secondary-fixed-dim": "#f9bd22",
                "on-primary-container": "#eeefff",
                "inverse-on-surface": "#ecf1ff",
                "primary-container": "#2563eb",
                "surface-subtle": "#F8FAFC",
                "on-error": "#ffffff",
                "surface-tint": "#0053db",
                "outline-variant": "#c3c6d7"
            },
            "borderRadius": {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "spacing": {
                "lg": "16px",
                "sm": "6px",
                "xl": "24px",
                "section": "64px",
                "xs": "4px",
                "md": "12px",
                "gutter": "16px",
                "base": "4px"
            },
            "fontFamily": {
                "headline-md": ["Plus Jakarta Sans"],
                "body-lg": ["Inter"],
                "display-lg": ["Plus Jakarta Sans"],
                "caption": ["Inter"],
                "label-md": ["Inter"],
                "headline-lg": ["Plus Jakarta Sans"],
                "body-md": ["Inter"]
            },
            "fontSize": {
                "headline-md": ["20px", {"lineHeight": "1.3", "fontWeight": "600"}],
                "body-lg": ["15px", {"lineHeight": "1.6", "fontWeight": "400"}],
                "display-lg": ["36px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                "caption": ["11px", {"lineHeight": "1.4", "fontWeight": "500"}],
                "label-md": ["13px", {"lineHeight": "1", "letterSpacing": "0.01em", "fontWeight": "600"}],
                "headline-lg": ["24px", {"lineHeight": "1.25", "fontWeight": "700"}],
                "body-md": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}]
            }
        },
    },
}
</script>
<style>
body { background-color: #f9f9ff; color: #111c2d; font-family: 'Inter', sans-serif; }
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: #d8e3fb; border-radius: 10px; }
::-webkit-scrollbar-thumb:hover { background: #004ac6; }
.glass-card { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.5); }
.chart-container { position: relative; height: 220px; width: 100%; }
.modal-overlay { display: none; background: rgba(0,0,0,0.5); position: fixed; top:0; left:0; width:100%; height:100%; z-index: 100; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
.modal-active { display: flex !important; }
</style>
</head>
<body class="flex min-h-screen overflow-x-hidden">
<?php $url = $this->session->userdata('url'); ?>

<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash csrf_token">

<aside class="h-screen w-56 fixed left-0 top-0 bg-surface-container-lowest shadow-sm shadow-primary/10 flex flex-col py-md overflow-y-auto z-40 transition-transform duration-300 md:translate-x-0 -translate-x-full" id="sidebar">
<div class="px-lg mb-xl mt-sm">
<div class="flex items-center gap-sm">
<div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-on-primary shadow-md">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">insights</span>
</div>
<div>
<h1 class="font-headline-md text-headline-md font-bold text-primary">Bizorm</h1>
<p class="font-caption text-caption text-outline">Reputation Manager</p>
</div>
</div>
</div>
<nav class="flex-1 px-md space-y-xs">
<a class="flex items-center gap-md px-md py-sm rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'dashboard') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-on-surface-variant hover:bg-surface-container-high' ?>" href="<?php echo base_url('dashboard') ?>">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="flex items-center gap-md px-md py-sm rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'share') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-on-surface-variant hover:bg-surface-container-high' ?>" href="<?php echo base_url('share') ?>">
<span class="material-symbols-outlined">send</span>
<span class="font-label-md text-label-md">Send Link</span>
</a>
<?php if ($this->session->userdata('mr_logged_in') && ($this->session->userdata('mr_sadmin') == "1" || $this->session->userdata('mr_admin') == "1")) : ?>
<a class="flex items-center gap-md px-md py-sm rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'users') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-on-surface-variant hover:bg-surface-container-high' ?>" href="<?php echo base_url('users') ?>">
<span class="material-symbols-outlined">group</span>
<span class="font-label-md text-label-md">Manage Users</span>
</a>
<?php endif; ?>
<a class="flex items-center gap-md px-md py-sm rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'account' || $url == 'account-edit') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-on-surface-variant hover:bg-surface-container-high' ?>" href="<?php echo base_url('account') ?>">
<span class="material-symbols-outlined">person</span>
<span class="font-label-md text-label-md">My Account</span>
</a>
<a class="flex items-center gap-md px-md py-sm rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'report') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-on-surface-variant hover:bg-surface-container-high' ?>" href="<?php echo base_url('report') ?>">
<span class="material-symbols-outlined">bar_chart</span>
<span class="font-label-md text-label-md">Report</span>
</a>
<a class="flex items-center gap-md px-md py-sm rounded-lg font-medium transition-all duration-200 <?php echo ($url == 'support') ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' : 'text-on-surface-variant hover:bg-surface-container-high' ?>" href="<?php echo base_url('support') ?>">
<span class="material-symbols-outlined">help_center</span>
<span class="font-label-md text-label-md">Support</span>
</a>
</nav>
<div class="px-md mt-auto pt-md">
<a class="flex items-center gap-md px-md py-sm rounded-lg text-error font-medium hover:bg-error-container transition-all duration-200" href="<?php echo base_url('logout') ?>">
<span class="material-symbols-outlined">logout</span>
<span class="font-label-md text-label-md">Logout</span>
</a>
</div>
</aside>

<main class="flex-1 ml-0 md:ml-56 min-h-screen flex flex-col">
<header class="w-full h-14 sticky top-0 z-30 bg-surface/80 backdrop-blur-md shadow-sm shadow-primary/5 flex justify-between items-center px-lg border-b border-outline-variant/20">
<div class="flex items-center gap-md">
<button class="md:hidden p-sm text-on-surface" id="mobile-menu-toggle">
<span class="material-symbols-outlined">menu</span>
</button>
</div>
<div class="flex items-center gap-md">
<div class="flex items-center gap-sm">
<div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold">
<?php echo strtoupper(substr($this->session->userdata('mr_uname'), 0, 1)); ?>
</div>
<span class="font-label-md text-label-md hidden lg:inline"><?php echo ($this->session->userdata('mr_uname') ? $this->session->userdata('mr_uname') : 'My Account') ?></span>
</div>
</div>
</header>

<div class="p-lg lg:p-xl space-y-xl max-w-5xl mx-auto w-full">
<!-- Alerts -->
<div class="ajax_succ_div bg-success/10 border border-success text-success px-4 py-3 rounded-lg relative hidden" role="alert">
  <span class="block sm:inline ajax_res_succ"></span>
</div>
<div class="ajax_err_div bg-error/10 border border-error text-error px-4 py-3 rounded-lg relative hidden" role="alert">
  <span class="block sm:inline ajax_res_err"></span>
</div>

<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Send Link</h2>
<p class="text-on-surface-variant font-body-md">Share your feedback link with customers via Email, SMS, or WhatsApp.</p>
</div>

<div class="bg-surface-container-lowest p-0 rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
    <!-- Tabs -->
    <div class="flex border-b border-outline-variant/30 bg-surface-subtle">
        <button class="flex-1 py-3 font-label-md text-primary border-b-2 border-primary tab-btn" onclick="openTab('emailForm', this)">Email</button>
        <button class="flex-1 py-3 font-label-md text-on-surface-variant border-b-2 border-transparent hover:text-primary tab-btn" onclick="openTab('smsForm', this)">SMS</button>
        <button class="flex-1 py-3 font-label-md text-on-surface-variant border-b-2 border-transparent hover:text-primary tab-btn" onclick="openTab('whatsappForm', this)">WhatsApp</button>
    </div>

    <div class="p-lg">
        <!-- Email Form -->
        <form action="<?php echo base_url('share-email'); ?>" method="post" id="emailForm" class="tab-content block genform">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
			<input type="hidden" name="userid" value="<?php echo $this->session->userdata('mr_id'); ?>" class="userid">

            <div class="flex flex-wrap gap-2 mb-md justify-end">
				<button class="px-4 py-2 bg-surface-container-high hover:bg-primary hover:text-on-primary rounded-lg text-sm font-medium transition-colors email_SendSingleBtn" type="button" style="display:none">Send single</button>
				<button class="px-4 py-2 bg-surface-container-high hover:bg-primary hover:text-on-primary rounded-lg text-sm font-medium transition-colors email_ImportMultipleBtn" type="button">Import multiple</button>
				<a href="<?php echo base_url('email-sample-csv'); ?>" class="px-4 py-2 bg-error text-on-error rounded-lg text-sm font-medium hover:bg-error/90 transition-colors flex items-center gap-1">
					<span class="material-symbols-outlined text-sm" style="font-size: 16px;">download</span> Sample
                </a>
			</div>

            <div class="space-y-md">
                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Platform</label>
                    <div class="flex gap-2">
                        <select name="foremailplatform" id="platforms" platformTab="email" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" required>
                            <?php if ($platforms->num_rows() > 0) : ?>
                                <option value="">Select</option>
                                <?php foreach ($platforms->result_array() as $p) : ?>
                                    <?php if ($p['active'] === '1') : ?>
                                        <option value="<?php echo $p['id'] ?>"><?php echo $p['web_name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">No platform created</option>
                            <?php endif; ?>
                        </select>
                        <button type="button" class="w-10 h-10 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center addwebmodal_btn hover:bg-primary hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs labelemail">E-mail</label>
                    <input type="email" name="email" class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary email" placeholder="example@domain.com" id="email" required>
                    <select class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md email_select" name="email_select" id="email_select" style="display: none;" readonly conn="false"></select>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Subject</label>
                    <input type="text" name="subj" class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary subj" required>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Body</label>
                    <textarea class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary emailbdy" rows="6" name="emailbdy" required></textarea>
                </div>
            </div>

            <div class="mt-lg flex justify-end">
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all email_sendBtn" type="submit">Share</button>
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all email_sendBtn_m hidden" type="submit" style="display:none">Share Multiple</button>
            </div>
        </form>

        <!-- SMS Form -->
        <form action="<?php echo base_url('share-sms'); ?>" method="post" id="smsForm" class="tab-content hidden genform" style="display:none">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
			<input type="hidden" name="userid" value="<?php echo $this->session->userdata('mr_id'); ?>" class="userid">

            <div class="flex flex-wrap gap-2 mb-md justify-end">
				<button class="px-4 py-2 bg-surface-container-high hover:bg-primary hover:text-on-primary rounded-lg text-sm font-medium transition-colors sms_SendSingleBtn" type="button" style="display:none">Send single</button>
				<button class="px-4 py-2 bg-surface-container-high hover:bg-primary hover:text-on-primary rounded-lg text-sm font-medium transition-colors sms_ImportMultipleBtn" type="button">Import multiple</button>
				<a href="<?php echo base_url('sms-sample-csv'); ?>" class="px-4 py-2 bg-error text-on-error rounded-lg text-sm font-medium hover:bg-error/90 transition-colors flex items-center gap-1">
					<span class="material-symbols-outlined text-sm" style="font-size: 16px;">download</span> Sample
                </a>
			</div>

            <div class="space-y-md">
                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Platform</label>
                    <div class="flex gap-2">
                        <select name="forsmsplatform" id="platforms" platformTab="sms" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" required>
                            <?php if ($platforms->num_rows() > 0) : ?>
                                <option value="">Select</option>
                                <?php foreach ($platforms->result_array() as $p) : ?>
                                    <?php if ($p['active'] === '1') : ?>
                                        <option value="<?php echo $p['id'] ?>"><?php echo $p['web_name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">No platform created</option>
                            <?php endif; ?>
                        </select>
                        <button type="button" class="w-10 h-10 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center addwebmodal_btn hover:bg-primary hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs phonelabel">Phonenumber</label>
                    <div class="flex gap-2">
                        <div class="w-12 bg-surface-container-high rounded-lg flex items-center justify-center font-medium border border-outline-variant/30">+91</div>
                        <input type="number" name="mobile" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary mobile" placeholder="Your mobile number" id="mobile" required>
                        <select class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md sms_select" name="sms_select" id="sms_select" style="display: none;" readonly conn="false"></select>
                    </div>
                    <span class="e_mobile text-error text-sm mt-1" style="display:none">Invalid mobile length</span>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Body</label>
                    <textarea class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary smsbdy" rows="6" name="smsbdy" required></textarea>
                </div>
            </div>

            <div class="mt-lg flex justify-end">
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all sms_sendBtn" type="submit">Share</button>
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all sms_sendBtn_m hidden" type="submit" style="display:none">Share Multiple</button>
            </div>
        </form>

        <!-- WhatsApp Form -->
        <form action="<?php echo base_url('share-whatsapp'); ?>" method="post" id="whatsappForm" class="tab-content hidden genform" style="display:none">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
			<input type="hidden" name="userid" value="<?php echo $this->session->userdata('mr_id'); ?>" class="userid">

            <div class="space-y-md mt-4">
                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Platform</label>
                    <div class="flex gap-2">
                        <select name="forwhpplatform" id="platforms" platformTab="whp" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" required>
                            <?php if ($platforms->num_rows() > 0) : ?>
                                <option value="">Select</option>
                                <?php foreach ($platforms->result_array() as $p) : ?>
                                    <?php if ($p['active'] === '1') : ?>
                                        <option value="<?php echo $p['id'] ?>"><?php echo $p['web_name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">No platform created</option>
                            <?php endif; ?>
                        </select>
                        <button type="button" class="w-10 h-10 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center addwebmodal_btn hover:bg-primary hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs phonelabel">Whatsapp Number</label>
                    <div class="flex gap-2">
                        <div class="w-12 bg-surface-container-high rounded-lg flex items-center justify-center font-medium border border-outline-variant/30">+91</div>
                        <input type="number" name="whpMobile" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary whpMobile" placeholder="Whatsapp number" required>
                    </div>
                    <span class="e_whpMobile text-error text-sm mt-1" style="display:none">Invalid mobile length</span>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Body</label>
                    <textarea class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary whpbdy" rows="6" name="whpbdy" required></textarea>
                </div>
            </div>

            <div class="mt-lg flex justify-end">
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all whp_sendBtn" type="button">Share</button>
            </div>
        </form>
    </div>
</div>
</div>
</main>

<!-- Modals -->
<div class="emailmodal modal-overlay">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-sm mx-4 transform transition-all relative">
        <button class="absolute top-4 right-4 text-outline hover:text-error transition-colors" onclick="$('.emailmodal').removeClass('modal-active')">
            <span class="material-symbols-outlined">close</span>
        </button>
        <h3 class="font-headline-md text-body-lg font-bold mb-2">Import Emails</h3>
        <p class="font-caption text-outline mb-4">CSV must have header of only "Email"</p>
        
        <form enctype="multipart/form-data" method="post" id="emailForm_csvUpload">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
            <input type="file" name="email_csv_file" id="email_csv_file" accept=".csv" class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-container file:text-primary hover:file:bg-primary/20 mb-6 border border-outline-variant/30">
            <div class="flex justify-end">
                <button class="px-4 py-2 bg-primary text-on-primary rounded-lg font-medium email_SendMultipleBtn" type="submit">Import CSV</button>
            </div>
        </form>
    </div>
</div>

<div class="smsmodal modal-overlay">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-sm mx-4 transform transition-all relative">
        <button class="absolute top-4 right-4 text-outline hover:text-error transition-colors" onclick="$('.smsmodal').removeClass('modal-active')">
            <span class="material-symbols-outlined">close</span>
        </button>
        <h3 class="font-headline-md text-body-lg font-bold mb-2">Import SMS</h3>
        <p class="font-caption text-outline mb-4">CSV must have header of only "Phonenumber"</p>
        
        <form enctype="multipart/form-data" method="post" id="smsForm_csvUpload">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
            <input type="file" name="sms_csv_file" id="sms_csv_file" accept=".csv" class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-container file:text-primary hover:file:bg-primary/20 mb-6 border border-outline-variant/30">
            <div class="flex justify-end">
                <button class="px-4 py-2 bg-primary text-on-primary rounded-lg font-medium sms_SendMultipleBtn" type="submit">Import CSV</button>
            </div>
        </form>
    </div>
</div>

<div class="add_web_modal modal-overlay">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-md mx-4 transform transition-all relative">
        <button class="absolute top-4 right-4 text-outline hover:text-error transition-colors closewebmodal_btn">
            <span class="material-symbols-outlined">close</span>
        </button>
        <h3 class="font-headline-md text-body-lg font-bold mb-4">Add Platform</h3>
        
        <form method="post" action="<?php echo base_url("user/user_new_website") ?>" class="add_web_modal_form space-y-4">
            <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            
            <div>
                <label class="block font-label-md text-on-surface-variant mb-1">Platform Name</label>
                <input type="text" name="web_name_new" class="web_name_new w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" placeholder="Platform Name" required>
                <div class="text-error text-sm mt-1 web_name_err" style="display:none"></div>
            </div>
            
            <div>
                <label class="block font-label-md text-on-surface-variant mb-1">Platform Link</label>
                <input type="url" name="web_link_new" class="web_link_new w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" placeholder="e.g https://domainname.com" required>
                <div class="text-error text-sm mt-1 web_link_err" style="display:none"></div>
            </div>
            
            <div>
                <label class="block font-label-md text-on-surface-variant mb-1">Subject</label>
                <input type="text" name="web_subject_new" class="web_subject_new w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" placeholder="Subject">
            </div>
            
            <div>
                <label class="block font-label-md text-on-surface-variant mb-1">Description</label>
                <textarea name="web_desc_new" class="web_desc_new w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" rows="3"></textarea>
            </div>
            
            <div class="flex justify-end pt-2">
                <button type="submit" class="px-6 py-2 bg-primary text-on-primary rounded-lg font-medium add_web_modal_btn">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTab(tabId, btn) {
        $('.tab-content').hide();
        $('#' + tabId).fadeIn();
        $('.tab-btn').removeClass('text-primary border-primary').addClass('text-on-surface-variant border-transparent');
        $(btn).removeClass('text-on-surface-variant border-transparent').addClass('text-primary border-primary');
    }

    $.fn.modal = function(action) {
        if (action === 'show') {
            this.addClass('modal-active');
        } else if (action === 'hide') {
            this.removeClass('modal-active');
        }
    };
    
    $(document).ready(function() {
        $('#mobile-menu-toggle').click(function(e){
            e.stopPropagation();
            $('#sidebar').toggleClass('-translate-x-full');
        });
        $(document).click(function(e){
            if (!$(e.target).closest('#sidebar, #mobile-menu-toggle').length) {
                $('#sidebar').addClass('-translate-x-full');
            }
        });
    });
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/share.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var id = $('.userid').val();
		var csrfName = $('.csrf_hash').attr('name');
		var csrfHash = $('.csrf_hash').val();

		//load message body/file.txt
		// $.ajax({
		// 	url: "<?php echo base_url('getlink'); ?>",
		// 	method: "post",
		// 	data: {
		// 		id: id,
		// 		[csrfName]: csrfHash
		// 	},
		// 	dataType: "json",
		// 	beforeSend: function() {
		// 		// clearAlert();
		// 	},
		// 	success: function(data) {
		// 		$('.csrf_hash').val(data.token);

		// 		if (data.status === true) {
		// 			$('.subj').val("Rating");

		// 			$(".emailbdy,.smsbdy,.whpbdy").load("<?php echo base_url("body.txt"); ?>");

		// 		} else if (data.status == false) {
		// 			$(".ajax_succ_div,.ajax_err_div").fadeOut();
		// 			$('.ajax_res_err').html(data.msg);
		// 			$('.ajax_err_div').fadeIn();
		// 		} else if (data.status == "error") {
		// 			window.location.assign(data.redirect);
		// 		}
		// 	},
		// 	error: function(data) {
		// 		window.location.assign(data.redirect);
		// 	}
		// });

		//n change of platform
		$(document).on('change', '#platforms', function(e) {
			e.preventDefault();

			var csrfName = $('.csrf_hash').attr('name');
			var csrfHash = $('.csrf_hash').val();
			var platformid = $(this).val();
			var platformTab = $(this).attr('platformTab');

			if (platformid && platformid !== "" && platformid !== null && platformid !== undefined) {
				$.ajax({
					url: "<?php echo base_url('get-platform-link'); ?>",
					method: "post",
					data: {
						[csrfName]: csrfHash,
						platformid: platformid
					},
					dataType: "json",
					beforeSend: function(data) {
						clearAlert();
					},
					success: function(data) {
						if (data.status === false) {
							$(".ajax_res_err").append(data.msg);
							$(".ajax_err_div").fadeIn();

						} else if (data.status === true) {
							//subject
							if (data.res.subject) {
								$('.subj').val(data.res.subject);
							} else {
								$('.subj').val('Reviews');
							}
							//message-body
							$("." + platformTab + "bdy").val(data.body);
						} else if (data.status === 'error') {
							window.location.assign(data.redirect);
						}

						$('.csrf_hash').val(data.token);
					},
					error: function() {
						alert('Error');
						window.location.reload();
					}
				});
			}
		});

		//show email import modal
		//send single email
		$('button.email_ImportMultipleBtn,button.email_SendSingleBtn').click(function(e) {
			e.preventDefault();

			var sel_conn = $('#email_select').attr('conn');

			if (sel_conn == "true") {
				var ans = confirm("Your imported data will be cleared. Do you want to continue?");
				if (ans == true) {
					$('.email_options').remove();
					$('#email_select').attr('conn', 'false').removeAttr('required').hide();

					$('.labelemail').html('E-mail');
					$('#email').val('').attr('required', true).show();

					$(".email_SendSingleBtn,.email_sendBtn_m").hide();
					$(".email_ImportMultipleBtn,.email_sendBtn").show();

					$('.emailmodal').modal('show');
				} else {
					return false;
				}
			} else {
				$('.emailmodal').modal('show');
			}
		});

		//show sms import modal
		//send single sms
		$('button.sms_ImportMultipleBtn,button.sms_SendSingleBtn').click(function(e) {
			e.preventDefault();

			var sel_conn = $('#sms_select').attr('conn');

			if (sel_conn == "true") {
				var ans = confirm("Your imported data will be cleared. Do you want to continue?");
				if (ans == true) {
					$('.sms_options').remove();
					$('#sms_select').attr('conn', 'false').removeAttr('required').hide();

					$('.phonelabel').html('Phonenumber');
					$('#mobile').val('').attr('required', true).show();

					$(".sms_SendSingleBtn,.sms_sendBtn_m").hide();
					$(".sms_ImportMultipleBtn,.sms_sendBtn").show();

					$('.smsmodal').modal('show');
				} else {
					return false;
				}
			} else {
				$('.smsmodal').modal('show');
			}
		});

		//upload email file
		$('#emailForm_csvUpload').on('submit', function(e) {
			e.preventDefault();

			var file = $('#email_csv_file').val();
			var csrfName = $('.csrf_hash').attr('name');
			var csrfHash = $('.csrf_hash').val();

			if (file == "" || file == null) {
				$('#email_csv_file').css('border-bottom', '2px solid #dc3545');
				return false;
			} else {
				$('#email_csv_file').css('border', '2px solid #ced4da');
			}

			$.ajax({
				url: "<?php echo base_url('import-csv-email'); ?>",
				method: "post",
				data: new FormData(this),
				[csrfName]: csrfHash,
				dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				beforeSend: function(data) {
					$('.email_SendMultipleBtn').attr('disabled', 'disabled').html('Importing...').css('cursor', 'not-allowed');

					clearAlert();
				},
				success: function(data) {
					if (data.status === false) {
						$(".ajax_res_err").append(data.msg);
						$(".ajax_err_div").fadeIn();

					} else if (data.status === true) {
						if (parseInt(data.EmailArray.length) > 0) {
							$('.emailmodal').modal('hide');

							$('#email_csv_file').val("");
							for (i = 0; i < data.EmailArray.length; i++) {
								$('#email_select').append('<option disabled class="email_options">' + data.EmailArray[i].Email + '</option>');
							}

							$('#email').hide().removeAttr('required');
							$('.labelemail').html('Emails');

							$('#email_select').attr({
								conn: 'true',
								required: true
							}).show();

							$('.email_SendSingleBtn,.email_sendBtn_m').show();
							$('.email_ImportMultipleBtn,.email_sendBtn').hide();
						} else {
							$(".ajax_res_err").append('Empty file uploaded');
							$(".ajax_err_div").fadeIn();
						}
					}

					$('.csrf_hash').val(data.token);
					$('.email_SendMultipleBtn').removeAttr('disabled').html('Import CSV').css('cursor', 'pointer');
				},
				error: function(data) {
					alert('Error importing data');
					window.location.reload();
				}
			});
		});

		//upload sms file
		$('#smsForm_csvUpload').on('submit', function(e) {
			e.preventDefault();

			var sms_file = $('#sms_csv_file').val();
			var csrfName = $('.csrf_hash').attr('name');
			var csrfHash = $('.csrf_hash').val();

			if (sms_file == "" || sms_file == null) {
				$('#sms_csv_file').css('border', '2px solid #dc3545');
				return false;
			} else {
				$('#sms_csv_file').css('border', '2px solid #ced4da');
			}

			$.ajax({
				url: "<?php echo base_url('import-csv-sms'); ?>",
				method: "post",
				data: new FormData(this),
				[csrfName]: csrfHash,
				dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				beforeSend: function(data) {
					$('.sms_SendMultipleBtn').attr('disabled', 'disabled').html('Importing...').css('cursor', 'not-allowed');

					clearAlert();
				},
				success: function(data) {
					if (data.status === false) {
						$(".ajax_res_err").append(data.msg);
						$(".ajax_err_div").fadeIn();

					} else if (data.status === true) {
						if (parseInt(data.MobileArray.length) > 0) {
							$('.smsmodal').modal('hide');

							$('#sms_csv_file').val("");
							for (i = 0; i < data.MobileArray.length; i++) {
								$('#sms_select').append('<option disabled class="sms_options">' + data.MobileArray[i].Phonenumber + '</option>');
							}

							$('#mobile').hide().removeAttr('required');
							$('.phonelabel').html('Phonenumbers');

							$('#sms_select').attr({
								conn: 'true',
								required: true
							}).show();

							$('.sms_SendSingleBtn,.sms_sendBtn_m').show();
							$('.sms_ImportMultipleBtn,.sms_sendBtn').hide();
						} else {
							$(".ajax_res_err").append('Empty file uploaded');
							$(".ajax_err_div").fadeIn();
						}
					}

					$('.csrf_hash').val(data.token);
					$('.sms_SendMultipleBtn').removeAttr('disabled').html('Import CSV').css('cursor', 'pointer');
				},
				error: function(data) {
					alert('Error importing data');
					window.location.reload();
				}
			});
		});

		//send single email
		$('#emailForm').submit(function(e) {
			// e.preventDefault();

			var platform = $('select[name="foremailplatform"]').val();
			var email = $('.email').val();
			var sbj = $('.subj').val();
			var body = $('.emailbdy').val();

			if (platform == "" || platform == null) {
				return false;
			}

			if (email == "" || email == null) {
				return false;
			}

			if (sbj == "" || sbj == null) {
				return false;
			}

			if (body == "" || body == null) {
				return false;
			}


			$.ajax({
				success: function() {
					$('.email_sendBtn').addClass('bg-danger').html('Sharing...').attr('disabled', 'disabled').css('cursor', 'not-allowed');
				}
			});

		});

		//send single sms
		$('form#smsForm').submit(function(e) {
			// e.preventDefault();

			var platform = $('select[name="forsmsplatform"]').val();
			var mobile = $('.mobile').val();
			var smsbdy = $('.smsbdy').val();

			if (platform == "" || platform == null) {
				return false;
			}

			if (mobile == "" || mobile == null || mobile.length < 10 || mobile.length > 10) {
				$('.e_mobile').show();
				return false;
			} else {
				$('.e_mobile').hide();
			}

			if (smsbdy == "" || smsbdy == null) {
				return false;
			}

			$.ajax({
				success: function() {
					$('.sms_sendBtn').addClass('bg-danger').html('Sharing...').attr('disabled', 'disabled').css('cursor', 'not-allowed');
				}
			});

		});

		//send single whatsapp
		// $('form#whatsappForm').submit(function(e) {
		$('button.whp_sendBtn').click(function(e) {
			e.preventDefault();

			var platform = $('select[name="forwhpplatform"]').val();
			var mobile = $('.whpMobile').val();
			var whpbdy = $('.whpbdy').val();

			if (platform == "" || platform == null) {
				$('select[name="forwhpplatform"]').css('border-bottom', '2px solid #dc3545');
				$('select[name="forwhpplatform"]').css('border-bottom', '2px solid #dc3545');
				return false;
			} else {
				$('select[name="forwhpplatform"]').css('border-bottom', '1px solid #ced4da');
			}

			if (mobile == "" || mobile == null || mobile.length < 10 || mobile.length > 10) {
				$('.whpMobile').css('border-bottom', '2px solid #dc3545');
				$('.e_whpMobile').show();
				return false;
			} else {
				$('.whpMobile').css('border-bottom', '1px solid #ced4da');
				$('.e_whpMobile').hide();
			}

			if (whpbdy == "" || whpbdy == null) {
				$('.whpbdy').css('border-bottom', '2px solid #dc3545');
				return false;
			} else {
				$('.whpbdy').css('border-bottom', '1px solid #ced4da');
			}

			$.ajax({
				url: '<?php echo base_url('share-whatsapp') ?>',
				method: 'post',
				dataType: 'json',
				data: {
					mobile: mobile,
					whpbdy: whpbdy,
					[csrfName]: csrfHash
				},
				beforeSend: function() {
					$('.whp_sendBtn').addClass('bg-danger').html('Sharing...').attr('disabled', 'disabled').css('cursor', 'not-allowed');

					clearAlert();
				},
				success: function(data) {
					if (data.status === false) {
						$(".ajax_res_err").append(data.msg);
						$(".ajax_err_div").fadeIn();
					} else if (data.status === 'error') {
						window.location.assign(data.redirect);
					} else if (data.status === true) {
						var shareLink = "https://api.whatsapp.com/send?phone=" + mobile + "&text=" + whpbdy + "";
						window.open(shareLink);
						window.location.reload();
					}

					$('.csrf_hash').val(data.token);
					$('.whp_sendBtn').removeAttr('disabled').html('Send').css('cursor', 'pointer');
				},
				error: function() {
					alert('Error!');
					window.location.reload();
				}
			});

		});

		//send multiple email
		$('.email_sendBtn_m').click(function(e) {
			e.preventDefault();

			var platform = $('select[name="foremailplatform"]').val();
			var subj = $('.subj').val();
			var bdy = $('.emailbdy').val();
			var csrfName = $('.csrf_hash').attr('name');
			var csrfHash = $('.csrf_hash').val();

			if (platform == "" || platform == null) {
				$('select[name="foremailplatform"]').css('border-bottom', '2px solid #dc3545');
				return false;
			} else {
				$('select[name="foremailplatform"]').css('border-bottom', '1px solid #ced4da');
			}

			if (subj == "" || subj == null) {
				$('.subj').css('border-bottom', '2px solid #dc3545');
				return false;
			} else {
				$('.subj').css('border-bottom', '1px solid #ced4da');
			}

			if (bdy == "" || bdy == null) {
				$('.emailbdy').css('border-bottom', '2px solid #dc3545');
				return false;
			} else {
				$('.emailbdy').css('border-bottom', '1px solid #ced4da');
			}

			var emaildata = [];
			$(".email_options").each(function() {
				var eachopt = $(this).val();
				emaildata.push(eachopt);
			});

			if (parseInt(emaildata.length) == 0 || parseInt(emaildata.length) < 0) {
				return false;
			}

			$.ajax({
				url: "<?php echo base_url('share-email-multiple'); ?>",
				method: "post",
				dataType: "json",
				data: {
					emaildata: emaildata,
					subj: subj,
					bdy: bdy,
					[csrfName]: csrfHash,
				},
				beforeSend: function() {
					clearAlert();

					$('.email_sendBtn_m').addClass('bg-danger').html('Sharing...').attr('disabled', 'disabled').css('cursor', 'not-allowed');
				},
				success: function(data) {
					if (data.status === false) {
						$(".ajax_res_err").append(data.msg);

						//show user emails that were not sent
						if (data.emailnotsentarr) {
							if (data.emailnotsentarr.length > 0) {
								for (let index = 0; index < data.emailnotsentarr.length; index++) {
									$(".ajax_res_err").append('<div>' + data.emailnotsentarr[index] + '</div>');
								}
							}
						}

						$(".ajax_err_div").fadeIn();
					} else if (data.status === 'error') {
						window.location.assign(data.redirect);
					} else if (data.status === true) {
						window.location.reload();
					}

					$('.csrf_hash').val(data.token);
					$('.email_sendBtn_m').removeAttr('disabled').html('Send').css('cursor', 'pointer');

				},
				error: function() {
					alert("Error sending e-mails. Please try again");
					window.location.reload();
				}
			})
		});

		//send multiple sms
		$('.sms_sendBtn_m').click(function(e) {
			e.preventDefault();

			var platform = $('select[name="forsmsplatform"]').val();
			var mobile = $('.mobile').val();
			var smsbdy = $('.smsbdy').val();
			var csrfName = $('.csrf_hash').attr('name');
			var csrfHash = $('.csrf_hash').val();

			if (platform == "" || platform == null) {
				$('select[name="forsmsplatform"]').css('border-bottom', '2px solid #dc3545');
				return false;
			} else {
				$('select[name="forsmsplatform"]').css('border-bottom', '1px solid #ced4da');
			}

			if (smsbdy == "" || smsbdy == null) {
				$('.smsbdy').css('border-bottom', '2px solid #dc3545');
				return false;
			} else {
				$('.smsbdy').css('border-bottom', '1px solid #ced4da');
			}

			if (mobile == "" || mobile == null || mobile.length < 10 || mobile.length > 10) {
				$('.mobile').css('border-bottom', '2px solid #dc3545');
				$('.e_mobile').show();
				return false;
			} else {
				$('.mobile').css('border-bottom', '1px solid #ced4da');
				$('.e_mobile').hide();
			}

			var mobiledata = [];
			$(".sms_options").each(function() {
				var eachopt = $(this).val();
				mobiledata.push(eachopt);
			});

			if (parseInt(mobiledata.length) == 0 || parseInt(mobiledata.length) < 0) {
				return false;
			}

			$.ajax({
				url: "<?php echo base_url('share-sms-multiple'); ?>",
				method: "post",
				dataType: 'json',
				data: {
					mobiledata: mobiledata,
					smsbdy: smsbdy,
					[csrfName]: csrfHash,
				},
				beforeSend: function() {
					clearAlert();

					$('.sms_sendBtn_m').addClass('bg-danger').html('Sharing...').attr('disabled', 'disabled').css('cursor', 'not-allowed');
				},
				success: function(data) {
					if (data.status === false) {
						$(".ajax_res_err").append(data.msg);

						//show user numbers that were not sent
						if (data.mobilenotsentarr) {
							if (data.mobilenotsentarr.length > 0) {
								for (let index = 0; index < data.mobilenotsentarr.length; index++) {
									$(".ajax_res_err").append('<div>' + data.mobilenotsentarr[index].mobile + ' - ' + data.mobilenotsentarr[index].errorCode + ' - ' + data.mobilenotsentarr[index].errorInfo + '</div>');
								}
							}
						}

						$(".ajax_err_div").fadeIn();
					} else if (data.status === 'error') {
						window.location.assign(data.redirect);
					} else if (data.status === true) {
						window.location.reload();
					}

					$('.csrf_hash').val(data.token);
					$('.sms_sendBtn_m').removeAttr('disabled').html('Send').css('cursor', 'pointer');

				},
				error: function() {
					alert("Error sending messages. Please try again");
					window.location.reload();
				}
			})
		});


		// add new website modal
		$(document).on('click', '.addwebmodal_btn', function(e) {
			e.preventDefault();

			$('.add_web_modal').modal("show");
		});

		$(document).on('click', '.closewebmodal_btn', function(e) {
            e.preventDefault();

            $('.add_web_modal').modal("hide");

            $(".add_web_modal_btn").removeAttr("disabled readonly").attr("type", "submit").css("cursor", "pointer");

            $(".web_link_err,.web_name_err").fadeOut();
            $('.web_link_new,.web_name_new').css('border', '1px solid #ced4da').removeAttr("readonly").val("");
        });

		// check for duplicate web-name
        $(".web_name_new").keyup(function() {
            var webname = $(".web_name_new").val();
            var csrfName = $(".csrf_token").attr("name");
            var csrfHash = $(".csrf_token").val();

            $.ajax({
                url: "<?php echo base_url("duplicate-webname") ?>",
                method: "post",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    webname: webname
                },
                success: function(data) {
                    $(".csrf_token").val(data.token);

                    if (data.webdata > 0) {
                        $('.web_name_err').html("You already have a platform with this name").show();
                        $(".web_name_new").css('border-bottom', '2px solid #dc3545');
                        $(".add_web_modal_btn").attr({
                            type: "button",
                            disabled: "disabled",
                            readonly: "readonly"
                        }).css("cursor", "not-allowed");
                    } else {
                        $('.web_name_err').hide();
                        $(".web_name_new").css('border', '1px solid #ced4da');
                        $(".add_web_modal_btn").removeAttr("disabled readonly").attr("type", "submit").css("cursor", "pointer");
                    }
                },
                error: function(data) {
                    window.location.reload();
                }
            });
        });

        // check for duplicate web-link
        $(".web_link_new").keyup(function() {
            var weblink = $(".web_link_new").val();
            var csrfName = $(".csrf_token").attr("name");
            var csrfHash = $(".csrf_token").val();

            $.ajax({
                url: "<?php echo base_url("duplicate-weblink") ?>",
                method: "post",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    weblink: weblink
                },
                success: function(data) {
                    $(".csrf_token").val(data.token);

                    if (data.webdata > 0) {
                        $('.web_link_err').html("You already have a platform with this Link").show();
                        $(".web_link_new").css('border-bottom', '2px solid #dc3545');
                        $(".add_web_modal_btn").attr({
                            type: "button",
                            disabled: "disabled",
                            readonly: "readonly"
                        }).css("cursor", "not-allowed");
                    } else {
                        $('.web_link_err').hide();
                        $(".web_link_new").css('border', '1px solid #ced4da');
                        $(".add_web_modal_btn").removeAttr("disabled readonly").attr("type", "submit").css("cursor", "pointer");
                    }
                },
                error: function(data) {
                    window.location.reload();
                }
            });
        });

        // add website to database
        $(document).on('click', 'button.add_web_modal_btn', function(e) {
            e.preventDefault();

            var csrfName = $('.csrf_token').attr('name');
            var csrfHash = $('.csrf_token').val();
            var web_name_new = $('.web_name_new').val();
            var web_link_new = $('.web_link_new').val();
            var web_subject_new = $('.web_subject_new').val();
            var web_desc_new = $('.web_desc_new').val();

            if (web_name_new == "" || web_name_new == null || web_name_new == undefined) {
                $('.web_name_new').css('border-bottom', '2px solid #dc3545');
                return false;
            } else {
                $('.web_name_new').css('border', '1px solid #ced4da');
            }
            if (web_link_new == "" || web_link_new == null || web_link_new == undefined) {
                $(".web_link_new").css('border-bottom', '2px solid #dc3545');
                return false;
            }

            var patt = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + //port
                '(\\?[;&amp;a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i');
            var res = patt.test(web_link_new);
            if (res == true) {
                $(".web_link_err").fadeOut();
                $('.web_link_new').css('border', '1px solid #ced4da');
            } else if (res == false) {
                $(".web_link_new").css('border-bottom', '2px solid #dc3545');
                $(".web_link_err").html("Invalid WEB URL").fadeIn();
                return false;
            }

            $.ajax({
                url: "<?php echo base_url("create-website") ?>",
                method: "post",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    web_name_new: web_name_new,
                    web_link_new: web_link_new,
                    web_subject_new: web_subject_new,
                    web_desc_new: web_desc_new
                },
                beforeSend: function() {
                    clearAlert();

                    $('.add_web_modal_btn').addClass('bg-danger').html('Saving...').attr('disabled', 'disabled').css({
                        'cursor': 'not-allowed',
                    });
                },
                success: function(data) {
                    $(".csrf_token").val(data.token);

                    if (data.status === false) {
                        $(".ajax_res_err").text(data.msg);
                        $(".ajax_err_div").fadeIn();
                    } else if (data.status === true) {
                        $(".ajax_res_succ").text(data.msg);
                        $(".ajax_succ_div").fadeIn();

						$('select#platforms').append('<option value='+data.insert_id +'>'+web_name_new+'</option>');

                        $('.add_web_modal').modal("hide");
                    } else if (data.status === "error") {
                        window.location.assign(data.redirect);
                    }

                    $(".add_web_modal_btn").removeClass('bg-danger').html('Save').removeAttr("disabled").css("cursor", "pointer");
                }
            })
        });

	});
</script>
</body></html>