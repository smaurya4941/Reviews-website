<?php $this->load->view('templates/tw_header'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>


<div class="p-lg lg:p-xl space-y-xl max-w-7xl mx-auto w-full">
<div class="ajax_succ_div bg-success/10 border border-success text-success px-4 py-3 rounded-lg relative hidden" role="alert">
  <span class="block sm:inline ajax_res_succ"></span>
</div>
<div class="ajax_err_div bg-error/10 border border-error text-error px-4 py-3 rounded-lg relative hidden" role="alert">
  <span class="block sm:inline ajax_res_err"></span>
</div>


<div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 mb-lg">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-headline-md text-headline-md text-on-surface">Welcome back, <?php echo $this->session->userdata('mr_uname'); ?></h2>
            <p class="text-on-surface-variant font-body-md mt-1">Manage your review platforms and monitor overall customer feedback.</p>
        </div>
        <div>
            <?php if ($this->session->userdata('mr_sub') == '1'): ?>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-success/10 text-success border border-success/20 text-sm font-medium">
                    <span class="material-symbols-outlined text-sm">check_circle</span> Active Subscription
                </span>
            <?php else: ?>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200 text-sm font-medium">
                    <span class="material-symbols-outlined text-sm">warning</span> Inactive Subscription
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 mb-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-lg">
        <!-- Subscribed Plan -->
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Subscribed Plan</p>
            <h3 class="text-lg font-bold text-gray-800">Trial / Default Plan</h3>
            <p class="text-[11px] text-gray-500 mt-1">Active billing plan</p>
        </div>
        <!-- Active User Seats -->
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Active User Seats</p>
            <h3 class="text-lg font-bold text-gray-800">1 <span class="text-gray-400 text-sm font-normal">/ 0 seats</span></h3>
        </div>
        <!-- Trial / Account Status -->
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Trial / Account Status</p>
            <?php if ($this->session->userdata('mr_sub') == '1'): ?>
                <span class="inline-block px-2 py-1 bg-green-50 text-green-600 rounded text-xs font-medium border border-green-200">Subscription active</span>
            <?php else: ?>
                <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs font-medium border border-gray-200">No active plan</span>
            <?php endif; ?>
            <p class="text-[11px] text-gray-500 mt-2">Billing lifecycle status</p>
        </div>
        <!-- Combined Quota Credits -->
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Combined Quota Credits</p>
            <h3 class="text-lg font-bold text-gray-800"><?php echo isset($quota) ? ((int)$quota->sms_quota + (int)$quota->email_quota + (int)$quota->whatsapp_quota) : 0; ?></h3>
            <p class="text-[11px] text-gray-500 mt-1">Remaining messages balance</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-lg mb-lg">
    <!-- Total Reviews -->
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined">chat</span>
        </div>
        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Reviews</p>
            <h3 class="text-2xl font-bold text-gray-800" id="stat-total-reviews">0</h3>
        </div>
    </div>
    <!-- Average Rating -->
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 flex items-center gap-4">
        <div class="w-12 h-12 bg-yellow-50 text-yellow-500 rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined">star</span>
        </div>
        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Average Rating</p>
            <div class="flex items-center gap-2">
                <h3 class="text-2xl font-bold text-gray-800" id="stat-avg-rating">0</h3>
                <div class="flex text-gray-300 text-sm" id="stat-stars">
                    <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Active Platforms -->
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 flex items-center gap-4">
        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined">language</span>
        </div>
        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Active Platforms</p>
            <h3 class="text-2xl font-bold text-gray-800" id="stat-active-platforms">
                <?php 
                $active_platforms = 0;
                if (isset($platforms) && $platforms->num_rows() > 0) {
                    foreach ($platforms->result_array() as $p) {
                        if ($p['active'] === '1') $active_platforms++;
                    }
                }
                echo $active_platforms;
                ?>
            </h3>
        </div>
    </div>
</div>

<div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 mb-lg">
    <h3 class="font-bold text-gray-800 mb-4 text-sm">Remaining Quota Summary</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-lg">
        <!-- SMS -->
        <div class="bg-surface-subtle p-6 rounded-xl border border-gray-100 flex flex-col items-center justify-center text-center">
            <span class="material-symbols-outlined text-blue-500 mb-2">smartphone</span>
            <p class="text-xs text-gray-500 mb-1">SMS Quota</p>
            <h4 class="text-xl font-bold text-gray-800"><?php echo isset($quota) ? $quota->sms_quota : 0; ?></h4>
        </div>
        <!-- Email -->
        <div class="bg-surface-subtle p-6 rounded-xl border border-gray-100 flex flex-col items-center justify-center text-center">
            <span class="material-symbols-outlined text-green-500 mb-2">mail</span>
            <p class="text-xs text-gray-500 mb-1">Email Quota</p>
            <h4 class="text-xl font-bold text-gray-800"><?php echo isset($quota) ? $quota->email_quota : 0; ?></h4>
        </div>
        <!-- WhatsApp -->
        <div class="bg-surface-subtle p-6 rounded-xl border border-gray-100 flex flex-col items-center justify-center text-center">
            <i class="fab fa-whatsapp text-green-600 text-2xl mb-2"></i>
            <p class="text-xs text-gray-500 mb-1">WhatsApp Quota</p>
            <h4 class="text-xl font-bold text-gray-800"><?php echo isset($quota) ? $quota->whatsapp_quota : 0; ?></h4>
        </div>
        <!-- Web platforms -->
        <div class="bg-surface-subtle p-6 rounded-xl border border-gray-100 flex flex-col items-center justify-center text-center">
            <span class="material-symbols-outlined text-purple-500 mb-2">language</span>
            <p class="text-xs text-gray-500 mb-1">Web platforms</p>
            <h4 class="text-xl font-bold text-gray-800"><?php echo isset($quota) ? $quota->web_quota : 0; ?></h4>
        </div>
    </div>
</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-lg mb-lg">
<!-- Your Link -->
<div class="lg:col-span-3 bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 relative overflow-hidden">
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
<div class="flex items-center gap-sm mt-3 pt-2 border-t border-gray-100">
    <span class="text-sm font-medium text-gray-500 mr-2">Share directly via:</span>
    <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('Please share your feedback with us: ' . base_url('wtr/') . $this->session->userdata('mr_form_key')); ?>" target="_blank" class="w-10 h-10 flex items-center justify-center bg-green-50 text-green-600 hover:bg-green-100 rounded-lg transition-all" title="Share via WhatsApp">
        <i class="fab fa-whatsapp text-lg"></i>
    </a>
    <a href="mailto:?subject=<?php echo urlencode('We would love your feedback!'); ?>&body=<?php echo urlencode('Please share your feedback with us: ' . base_url('wtr/') . $this->session->userdata('mr_form_key')); ?>" class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition-all" title="Share via Email">
        <span class="material-symbols-outlined text-[20px]">mail</span>
    </a>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(base_url('wtr/') . $this->session->userdata('mr_form_key')); ?>" target="_blank" class="w-10 h-10 flex items-center justify-center bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded-lg transition-all" title="Share on Facebook">
        <i class="fab fa-facebook-f text-lg"></i>
    </a>
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
<style>
.chart-container { position: relative; height: 220px; width: 100%; }
</style>
<div id="qrModal" class="modal-overlay hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center backdrop-blur-sm">
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
    var copyText = $(selector);
    copyText.select();
    document.execCommand("copy");
    $('.ajax_res_succ').html('Copied to clipboard');
    $('.ajax_succ_div').fadeIn().delay(3000).fadeOut();
}
function clearAlert() {
    $('.ajax_succ_div').hide();
    $('.ajax_err_div').hide();
    $('.ajax_res_succ').html('');
    $('.ajax_res_err').html('');
}
function closeQrModal() {
    $('#qrModal').addClass('hidden').removeClass('flex');
    $('#qrcode').empty();
    $('.downloadqrcode').empty();
}

$(document).ready(function() {
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
                    
                    let totalReviews = 0;
                    let totalStars = 0;
                    
                    if (res.chartData && res.chartData.cr) {
                        for (let a = 0; a < res.chartData.cr.length; a++) {
                            let stars = res.chartData.cr[a].starArr;
                            for (let i = 0; i < 5; i++) {
                                let count = parseInt(stars[i] || 0);
                                totalReviews += count;
                                totalStars += count * (i + 1);
                            }
                        }
                    }
                    let avgRating = totalReviews > 0 ? (totalStars / totalReviews).toFixed(1) : 0;
                    $('#stat-total-reviews').text(totalReviews);
                    $('#stat-avg-rating').text(avgRating);
                    
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        if (i <= Math.round(avgRating)) {
                            starsHtml += '<i class="fas fa-star text-yellow-400"></i>';
                        } else {
                            starsHtml += '<i class="far fa-star text-gray-300"></i>';
                        }
                    }
                    $('#stat-stars').html(starsHtml);

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
                    $('#qrModal').removeClass('hidden').addClass('flex');
                }
                $('.csrf_token, .csrf_hash').val(data.token);
            }
        });
    });
});
</script>
<?php $this->load->view('templates/tw_footer'); ?>
