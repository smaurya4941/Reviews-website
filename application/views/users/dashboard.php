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

<div class="p-lg lg:p-xl space-y-xl max-w-7xl mx-auto w-full">
<div class="ajax_succ_div bg-success/10 border border-success text-success px-4 py-3 rounded-lg relative hidden" role="alert">
  <span class="block sm:inline ajax_res_succ"></span>
</div>
<div class="ajax_err_div bg-error/10 border border-error text-error px-4 py-3 rounded-lg relative hidden" role="alert">
  <span class="block sm:inline ajax_res_err"></span>
</div>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-md">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Dashboard</h2>
<p class="text-on-surface-variant font-body-md">Real-time overview of your business reputation</p>
</div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-lg">
<!-- Misc -->
<div class="lg:col-span-1 bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 flex flex-col justify-between">
<div>
<div class="flex items-center gap-sm mb-md text-primary">
<span class="material-symbols-outlined">store</span>
<h3 class="font-headline-md text-label-md uppercase tracking-wider">Misc Campaigns</h3>
</div>
<form method="post" id="genFrameForm">
<input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
<input type="hidden" name="form_key" id="form_key" value='<?php echo $this->session->userdata('mr_form_key') ?>'>
<input type="hidden" name="id" id="id" value='<?php echo $this->session->userdata('mr_id') ?>'>

<label class="block font-label-md text-on-surface-variant mb-sm">Select Platform</label>
<select name="platforms[]" class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary transition-all cursor-pointer" multiple required style="min-height:80px;">
<?php if ($platforms->num_rows() > 0) : ?>
<?php foreach ($platforms->result_array() as $p) : ?>
<?php if ($p['active'] === '1') : ?>
<option value="<?php echo $p['id'] ?>"><?php echo $p['web_name'] ?></option>
<?php endif; ?>
<?php endforeach; ?>
<?php else : ?>
<option value="" disabled>No platform created</option>
<?php endif; ?>
</select>
<button type="submit" class="genFrameBtn mt-lg w-full py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-lg hover:shadow-primary/20 active:scale-95 transition-all flex items-center justify-center gap-sm">
<span class="material-symbols-outlined">add</span> Create Campaign
</button>
</form>
</div>
<div id="frameCode" class="mt-4 pt-4 border-t border-outline-variant/30" <?php echo ($this->session->userdata('mr_frame_id')) ? '' : 'style="display:none"' ?>>
<label class="block font-label-md text-on-surface-variant mb-sm">Embed Code</label>
<div class="flex items-center gap-sm">
<input type="text" name="frameshare" class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-mono text-xs text-on-surface-variant" id='frameshare' value='<iframe width="100%" height="100" src="<?php echo base_url('pf/') . $this->session->userdata('mr_frame_id') ?>" frameborder="0" allowfullscreen></iframe>' readonly>
<button class="p-2 bg-surface-container-high hover:bg-primary-container hover:text-on-primary rounded-lg transition-all" onclick="copylink_fun('#frameshare')" title="Copy Embed">
<span class="material-symbols-outlined text-body-md">content_copy</span>
</button>
</div>
</div>
</div>

<!-- Your Link -->
<div class="lg:col-span-2 bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 relative overflow-hidden">
<div class="flex items-center gap-sm mb-md text-primary">
<span class="material-symbols-outlined">link</span>
<h3 class="font-headline-md text-label-md uppercase tracking-wider">Your Link</h3>
</div>
<div class="space-y-sm z-10 relative">
<label class="block font-label-md text-on-surface-variant">Feedback Link</label>
<div class="flex items-center gap-sm">
<input type="text" name="linkshare" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg p-2 font-mono text-label-md text-on-surface-variant truncate" id='linkshare' value="<?php echo base_url("wtr/") . $this->session->userdata('mr_form_key') ?>" readonly>
<button class="p-2 bg-primary-fixed hover:bg-primary-container hover:text-on-primary rounded-lg transition-all" onclick="copylink_fun('#linkshare')" title="Copy Link">
<span class="material-symbols-outlined text-body-md">content_copy</span>
</button>
<button class="genQrcode p-2 bg-surface-container-high hover:bg-primary-container hover:text-on-primary rounded-lg transition-all" title="Generate QR">
<span class="material-symbols-outlined text-body-md">qr_code_2</span>
</button>
</div>
<p class="font-caption text-caption text-outline mt-sm flex items-center gap-xs">
<span class="material-symbols-outlined text-xs">info</span> Share this link with customers to collect verified feedback.
</p>
</div>
<div class="absolute -right-12 -bottom-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>
</div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-lg">
<div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
<div class="flex items-center justify-between mb-xl">
<h3 class="font-headline-md text-body-lg font-bold">Reviews per Platform</h3>
</div>
<div class="chart-container">
<canvas id="chart1"></canvas>
</div>
</div>
<div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
<div class="flex items-center justify-between mb-xl">
<h3 class="font-headline-md text-body-lg font-bold">Reviews Over Time</h3>
</div>
<div class="chart-container">
<canvas id="chart2"></canvas>
</div>
</div>
</div>

<div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30 mb-8">
<div class="flex items-center justify-between mb-xl">
<h3 class="font-headline-md text-body-lg font-bold">Rating Distribution</h3>
</div>
<div class="chart-container" style="height: 180px;">
<canvas id="chart3"></canvas>
</div>
</div>
</div>
</main>

<div id="qrModal" class="modal-overlay">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-sm mx-4 transform transition-all relative">
        <button class="absolute top-4 right-4 text-outline hover:text-error transition-colors" onclick="closeQrModal()">
            <span class="material-symbols-outlined">close</span>
        </button>
        <h3 class="font-headline-md text-body-lg font-bold mb-4 text-center">Your QR Code</h3>
        <div id="qrcode" class="flex justify-center mb-6"></div>
        <div class="downloadqrcode text-center"></div>
    </div>
</div>

<script>
function copylink_fun(selector) {
    var copyText = document.querySelector(selector);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("Copied!");
}
function clearAlert() {
    $('.ajax_succ_div').hide();
    $('.ajax_err_div').hide();
    $('.ajax_res_succ').html('');
    $('.ajax_res_err').html('');
}
function closeQrModal() {
    $('#qrModal').removeClass('modal-active');
    $('#qrcode').empty();
    $('.downloadqrcode').empty();
}

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

    fillChart();
    function fillChart() {
        var id = "<?php echo $this->session->userdata('mr_id'); ?>";
        var csrfName = $('.csrf_token').attr('name');
        var csrfHash = $('.csrf_token').val();
        var currentdate = new Date();
        var datetime_Year = currentdate.getFullYear();

        $.ajax({
            url: "<?php echo base_url('fill-chart'); ?>",
            method: "post",
            data: { id: id, datetime_Year: datetime_Year, [csrfName]: csrfHash },
            dataType: "json",
            beforeSend: function() { clearAlert(); },
            success: function(res) {
                $('.csrf_hash, .csrf_token').val(res.token);

                if (res.status === true) {
                    const chartConfig = { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, font: { family: 'Inter', size: 12 } } } } };

                    new Chart(document.getElementById('chart1'), {
                        type: 'doughnut',
                        data: {
                            labels: res.chartData.cp.map(row => row.web_name),
                            datasets: [{
                                data: res.chartData.cp.map(row => row.total_ratings),
                                backgroundColor: ['#004ac6', '#2563eb', '#60a5fa', '#d8e3fb', '#b4c5ff'],
                                borderWidth: 0,
                                hoverOffset: 10
                            }]
                        },
                        options: { ...chartConfig, cutout: '70%' }
                    });

                    new Chart(document.getElementById('chart2'), {
                        type: 'line',
                        data: {
                            labels: res.chartData.cm.map(row => row.month),
                            datasets: [{
                                label: 'Ratings ' + datetime_Year,
                                data: res.chartData.cm.map(row => row.rating),
                                borderColor: '#004ac6',
                                backgroundColor: 'rgba(0, 74, 198, 0.1)',
                                fill: true,
                                tension: 0.4,
                                pointRadius: 4,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#004ac6',
                                pointBorderWidth: 2
                            }]
                        },
                        options: { ...chartConfig, scales: { y: { beginAtZero: true, grid: { color: '#f0f3ff' } }, x: { grid: { display: false } } } }
                    });

                    var datastsArr = [];
                    var colors = ['#ffc329', '#10B981', '#3B82F6', '#EF4444', '#795900'];
                    for (let a = 0; a < res.chartData.cr.length; a++) {
                        datastsArr.push({
                            label: res.chartData.cr[a].web_name,
                            data: res.chartData.cr[a].starArr,
                            backgroundColor: colors[a % colors.length],
                            borderRadius: 4
                        });
                    }

                    new Chart(document.getElementById('chart3'), {
                        type: 'bar',
                        data: {
                            labels: ['1 Star', '2 Star', '3 Star', '4 Star', '5 Star'],
                            datasets: datastsArr,
                        },
                        options: { ...chartConfig, scales: { y: { beginAtZero: true, grid: { color: '#f0f3ff' } }, x: { grid: { display: false } } } }
                    });

                } else if (res.status == false) {
                    $('.ajax_res_err').html(res.msg);
                    $('.ajax_err_div').fadeIn();
                } else if (res.status == "error") {
                    window.location.assign(res.redirect);
                }
            }
        });
    }

    $('#genFrameForm').submit(function(e) {
        e.preventDefault();
        let myForm = document.getElementById('genFrameForm');
        let form_data = new FormData(myForm);

        $.ajax({
            url: "generate-frame",
            type: "POST",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                clearAlert();
                $('.genFrameBtn').html("Generating...").attr('disabled', 'disabled').addClass('opacity-50 cursor-not-allowed');
            },
            success: function(res) {
                if (res.status === true) {
                    $(".ajax_res_succ").html(res.msg);
                    $(".ajax_succ_div").fadeIn();
                    let frameCode = '<iframe width="100%" height="100" src="' + res.frameLink + '" frameborder="0" allowfullscreen></iframe>';
                    $('#frameshare').val(frameCode);
                    $('#frameCode').fadeIn();
                } else if (res.status === false) {
                    $(".ajax_res_err").html(res.msg);
                    $(".ajax_err_div").fadeIn();
                } else {
                    window.location.reload();
                }
                $('.csrf_token, .csrf_hash').val(res.token);
                $('.genFrameBtn').html('<span class="material-symbols-outlined">add</span> Create Campaign').removeAttr('disabled').removeClass('opacity-50 cursor-not-allowed');
            }
        });
    });

    $(document).on('click', '.genQrcode', function(e) {
        e.preventDefault();
        var csrfName = $('.csrf_token').attr('name');
        var csrfHash = $('.csrf_token').val();
        var id = "<?php echo $this->session->userdata('mr_id'); ?>";
        var form_key = "<?php echo $this->session->userdata('mr_form_key'); ?>";
        var link = "<?php echo base_url("wtr/") . $this->session->userdata('mr_form_key') ?>";

        $.ajax({
            url: "<?php echo base_url('generate-qr-code') ?>",
            method: "post",
            dataType: 'json',
            data: { [csrfName]: csrfHash, id: id, form_key: form_key, link: link },
            beforeSend: function() { clearAlert(); },
            success: function(data) {
                if (data.status === false) {
                    $(".ajax_res_err").html(data.msg);
                    $(".ajax_err_div").fadeIn();
                } else if (data.status === 'error') {
                    window.location.assign(data.redirect);
                } else if (data.status === true) {
                    $('#qrcode').html('<img src="' + data.qr + '" class="rounded-lg shadow-sm">');
                    $('.downloadqrcode').html('<a href="download-qr-code?fp=' + data.qr + '&fn='+data.qrfileName+'" class="inline-flex items-center gap-sm bg-primary text-on-primary px-4 py-2 rounded-lg hover:shadow-lg transition-all"><span class="material-symbols-outlined">download</span> Download</a>');
                    $('#qrModal').addClass('modal-active');
                }
                $('.csrf_token, .csrf_hash').val(data.token);
            }
        });
    });
});
</script>
</body></html>