<?php $this->load->view('templates/tw_header'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>

<?php
// Company-wide analytics (populated by User::dashboard for Company Admins).
$cmpy = isset($cmpy) ? $cmpy : array(
    'total_reviews' => 0, 'avg_rating' => 0, 'reviews_month' => 0,
    'total_platforms' => 0, 'active_platforms' => 0,
    'per_platform' => array(), 'monthly' => array(),
    'distribution' => array(0, 0, 0, 0, 0), 'per_staff' => array(),
);
$staff_count = isset($branches) ? $branches->num_rows() : 0;
$quota_credits = isset($quota) ? ((int)$quota->sms_quota + (int)$quota->email_quota + (int)$quota->whatsapp_quota) : 0;
$avg_rating = (float) $cmpy['avg_rating'];
?>

<div class="p-lg lg:p-xl space-y-xl max-w-7xl mx-auto w-full">

    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 mb-lg">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Welcome back, <?php echo $this->session->userdata('mr_uname'); ?> (Admin)</h2>
                <p class="text-on-surface-variant font-body-md mt-1">Company feedback overview across you and your staff.</p>
            </div>
            <div>
                <?php if ($this->session->userdata('mr_sub') == '1'): ?>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-success/10 text-success border border-success/20 text-sm font-medium">
                        <span class="material-symbols-outlined text-sm">check_circle</span> Subscription Active
                    </span>
                <?php else: ?>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200 text-sm font-medium">
                        <span class="material-symbols-outlined text-sm">warning</span> Subscription Inactive
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 mb-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-lg">
            <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm transition-all hover:shadow-md">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Total Sub-Users</p>
                <h3 class="text-2xl font-bold text-primary"><?php echo $staff_count; ?></h3>
                <p class="text-[11px] text-gray-500 mt-1">Registered staff accounts</p>
            </div>

            <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm transition-all hover:shadow-md">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Company Platforms</p>
                <h3 class="text-2xl font-bold text-primary">
                    <?php echo (int) $cmpy['active_platforms']; ?>
                    <span class="text-gray-400 text-sm font-normal">/ <?php echo (int) $cmpy['total_platforms']; ?></span>
                </h3>
                <p class="text-[11px] text-gray-500 mt-1">Active / total across company</p>
            </div>

            <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm transition-all hover:shadow-md">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Total Reviews</p>
                <h3 class="text-2xl font-bold text-primary"><?php echo (int) $cmpy['total_reviews']; ?></h3>
                <p class="text-[11px] text-gray-500 mt-1"><?php echo (int) $cmpy['reviews_month']; ?> received this month</p>
            </div>

            <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm transition-all hover:shadow-md">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Average Rating</p>
                <div class="flex items-center gap-2">
                    <h3 class="text-2xl font-bold text-primary"><?php echo $avg_rating > 0 ? number_format($avg_rating, 1) : '0.0'; ?></h3>
                    <div class="flex text-sm">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="<?php echo ($i <= round($avg_rating)) ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300'; ?>"></i>
                        <?php endfor; ?>
                    </div>
                </div>
                <p class="text-[11px] text-gray-500 mt-1">Company-wide average</p>
            </div>
        </div>
    </div>

    <!-- Your Link -->
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 relative overflow-hidden mb-lg">
        <div class="flex items-center gap-sm mb-md text-primary">
            <span class="material-symbols-outlined">link</span>
            <h3 class="font-headline-md text-label-md uppercase tracking-wider">Your Admin Link</h3>
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
                <span class="ml-auto text-xs text-gray-500">Quota credits: <strong class="text-gray-700"><?php echo $quota_credits; ?></strong></span>
            </div>
            <p class="font-caption text-caption text-outline mt-sm flex items-center gap-xs">
                <span class="material-symbols-outlined text-xs">info</span> Share this link to collect feedback directly.
            </p>
        </div>
        <div class="absolute -right-12 -bottom-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Staff Summaries -->
    <div class="mb-lg">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-headline-md text-body-lg font-bold text-gray-800">Staff Summaries</h3>
            <a href="<?php echo base_url('users') ?>" class="text-sm text-primary hover:underline font-semibold">View All Staff</a>
        </div>
        <div class="flex overflow-x-auto pb-4 gap-6 snap-x" style="scrollbar-width: thin;">
            <?php if (isset($branches) && $branches->num_rows() > 0): ?>
                <?php foreach($branches->result() as $branch): ?>
                <div class="min-w-[320px] bg-white p-5 rounded-xl shadow-sm border border-slate-200 snap-start flex-shrink-0 relative group hover:border-primary/50 transition-all cursor-pointer">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-bold text-gray-800 text-lg truncate max-w-[200px]" title="<?php echo $branch->uname; ?>">
                            <?php echo (!empty($branch->fname)) ? $branch->fname . ' ' . $branch->lname : $branch->uname; ?>
                        </h4>
                        <span class="text-xs font-mono bg-blue-50 text-blue-600 px-2 py-1 rounded border border-blue-100">
                            ID: <?php echo $branch->id; ?>
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-y-4 gap-x-2">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold mb-1">Company</p>
                            <p class="font-bold text-sm text-gray-600 truncate" title="<?php echo $branch->cmpy; ?>"><?php echo !empty($branch->cmpy) ? $branch->cmpy : 'N/A'; ?></p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold mb-1">Email</p>
                            <p class="font-bold text-sm text-gray-600 truncate" title="<?php echo $branch->email; ?>"><?php echo $branch->email; ?></p>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-between items-center border-t border-slate-100 pt-3">
                        <?php if ($branch->active == '1'): ?>
                            <span class="text-xs font-semibold text-green-700 bg-green-50 border border-green-200 px-2 py-1 rounded">Active</span>
                        <?php else: ?>
                            <span class="text-xs font-semibold text-red-700 bg-red-50 border border-red-200 px-2 py-1 rounded">Inactive</span>
                        <?php endif; ?>
                        <a href="<?php echo base_url('users') ?>" class="text-xs text-gray-500 group-hover:text-primary flex items-center gap-1 transition-colors font-medium">Manage User <span class="material-symbols-outlined text-xs">arrow_forward</span></a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="w-full bg-white p-8 text-center rounded-xl border border-dashed border-gray-300">
                    <span class="material-symbols-outlined text-gray-400 text-4xl mb-2">domain_disabled</span>
                    <p class="text-gray-500 font-medium">No sub-users configured yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-lg">
        <div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
            <h3 class="font-headline-md text-body-lg font-bold mb-xl">Reviews per Platform</h3>
            <div class="chart-container" style="position: relative; height: 250px; width: 100%;">
                <canvas id="adminPlatformChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
            <h3 class="font-headline-md text-body-lg font-bold mb-xl">Reviews Over Time</h3>
            <div class="chart-container" style="position: relative; height: 250px; width: 100%;">
                <canvas id="adminMonthlyChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
            <h3 class="font-headline-md text-body-lg font-bold mb-xl">Rating Distribution</h3>
            <div class="chart-container" style="position: relative; height: 250px; width: 100%;">
                <canvas id="adminDistChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
            <h3 class="font-headline-md text-body-lg font-bold mb-xl">Reviews per Staff</h3>
            <div class="chart-container" style="position: relative; height: 250px; width: 100%;">
                <canvas id="adminStaffChart"></canvas>
            </div>
        </div>
    </div>

</div>

<script>
var adminDash = {
    perPlatform: <?php echo json_encode($cmpy['per_platform']); ?>,
    monthly: <?php echo json_encode($cmpy['monthly']); ?>,
    distribution: <?php echo json_encode(array_values($cmpy['distribution'])); ?>,
    perStaff: <?php echo json_encode($cmpy['per_staff']); ?>
};

$(document).ready(function() {
    var palette = ['#004ac6', '#2563eb', '#60a5fa', '#93c5fd', '#b4c5ff', '#10B981', '#f59e0b', '#ef4444'];
    var baseOpts = { responsive: true, maintainAspectRatio: false };

    // Reviews per Platform (doughnut)
    new Chart(document.getElementById('adminPlatformChart'), {
        type: 'doughnut',
        data: {
            labels: adminDash.perPlatform.map(function(r) { return r.label; }),
            datasets: [{
                data: adminDash.perPlatform.map(function(r) { return r.count; }),
                backgroundColor: palette,
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: Object.assign({}, baseOpts, { cutout: '70%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true } } } })
    });

    // Reviews Over Time (line)
    new Chart(document.getElementById('adminMonthlyChart'), {
        type: 'line',
        data: {
            labels: adminDash.monthly.map(function(r) { return r.month; }),
            datasets: [{
                label: 'Reviews',
                data: adminDash.monthly.map(function(r) { return r.count; }),
                borderColor: '#004ac6',
                backgroundColor: 'rgba(0, 74, 198, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 3
            }]
        },
        options: Object.assign({}, baseOpts, { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f3ff' } }, x: { grid: { display: false } } } })
    });

    // Rating Distribution (bar)
    new Chart(document.getElementById('adminDistChart'), {
        type: 'bar',
        data: {
            labels: ['1 Star', '2 Star', '3 Star', '4 Star', '5 Star'],
            datasets: [{
                label: 'Reviews',
                data: adminDash.distribution,
                backgroundColor: ['#ef4444', '#f59e0b', '#eab308', '#84cc16', '#10B981'],
                borderRadius: 4
            }]
        },
        options: Object.assign({}, baseOpts, { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f3ff' } }, x: { grid: { display: false } } } })
    });

    // Reviews per Staff (horizontal bar)
    new Chart(document.getElementById('adminStaffChart'), {
        type: 'bar',
        data: {
            labels: adminDash.perStaff.map(function(r) { return r.label; }),
            datasets: [{
                label: 'Reviews',
                data: adminDash.perStaff.map(function(r) { return r.count; }),
                backgroundColor: '#2563eb',
                borderRadius: 4
            }]
        },
        options: Object.assign({}, baseOpts, { indexAxis: 'y', plugins: { legend: { display: false } }, scales: { x: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f3ff' } }, y: { grid: { display: false } } } })
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
            success: function(data) {
                if (data.status === false) {
                    alert(data.msg);
                } else if (data.status === 'error') {
                    window.location.assign(data.redirect);
                } else if (data.status === true) {
                    $('#qrcode').html('<img src="' + data.qr + '" class="rounded-lg shadow-sm">');
                    $('.downloadqrcode').html('<a href="<?php echo base_url('download-qr-code') ?>?fp=' + data.qr + '&fn='+data.qrfileName+'" class="inline-flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg hover:shadow-lg transition-all"><span class="material-symbols-outlined">download</span> Download</a>');
                    $('#qrModal').removeClass('hidden').addClass('flex');
                }
                $('.csrf_token').val(data.token);
            }
        });
    });
});

function copylink_fun(selector) {
    var copyText = $(selector);
    copyText.select();
    document.execCommand("copy");
    alert('Link copied to clipboard');
}

function closeQrModal() {
    $('#qrModal').addClass('hidden').removeClass('flex');
    $('#qrcode').empty();
    $('.downloadqrcode').empty();
}
</script>

<!-- QR Modal -->
<div id="qrModal" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center backdrop-blur-sm">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-sm mx-4 transform transition-all relative" style="background-color: white; padding: 1.5rem; border-radius: 0.75rem;">
        <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors" onclick="closeQrModal()">
            <span class="material-symbols-outlined">close</span>
        </button>
        <h3 class="text-xl font-display font-bold text-gray-900 mb-4 text-center">QR Code</h3>
        <div id="qrcode" class="flex justify-center mb-6"></div>
        <div class="downloadqrcode text-center"></div>
    </div>
</div>

<?php $this->load->view('templates/tw_footer'); ?>
