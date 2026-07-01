<?php
/**
 * Report partial: company-analytics.php  (Company Admin only)
 * Company-wide KPI + chart summary spanning the admin and all sub-users.
 * Variable: $cmpy  (from Usermodel::cmpy_dashboard)
 */
$cmpy = isset($cmpy) ? $cmpy : array(
    'total_reviews' => 0, 'avg_rating' => 0, 'reviews_month' => 0,
    'total_platforms' => 0, 'active_platforms' => 0,
    'per_platform' => array(), 'monthly' => array(),
    'distribution' => array(0, 0, 0, 0, 0), 'per_staff' => array(),
);
$avg_rating = (float) $cmpy['avg_rating'];
$has_data = ((int) $cmpy['total_reviews'] > 0);
?>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo (int) $cmpy['total_reviews']; ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Reviews</span>
        <span class="text-xs text-gray-400 mt-1"><?php echo (int) $cmpy['reviews_month']; ?> this month</span>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <div class="flex items-center gap-2 mb-1">
            <h3 class="text-3xl font-bold text-primary"><?php echo $avg_rating > 0 ? number_format($avg_rating, 1) : '0.0'; ?></h3>
            <div class="flex text-sm">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <i class="<?php echo ($i <= round($avg_rating)) ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300'; ?>"></i>
                <?php endfor; ?>
            </div>
        </div>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Average Rating</span>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1">
            <?php echo (int) $cmpy['active_platforms']; ?><span class="text-gray-400 text-lg font-normal">/<?php echo (int) $cmpy['total_platforms']; ?></span>
        </h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Active Platforms</span>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo max(0, count($cmpy['per_staff']) - 1); ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Sub-Users</span>
    </div>
</div>

<!-- Charts -->
<?php if (!$has_data): ?>
<div class="bg-white p-10 rounded-xl border border-dashed border-gray-300 text-center mb-8">
    <span class="material-symbols-outlined text-gray-400 text-5xl mb-2">insights</span>
    <p class="text-gray-600 font-semibold">No feedback data yet</p>
    <p class="text-sm text-gray-400 mt-1">Charts will appear here once your team starts collecting reviews.</p>
</div>
<?php else: ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<div class="grid grid-cols-1 xl:grid-cols-2 gap-4 mb-8">
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <h3 class="text-sm font-bold text-gray-800 mb-4">Reviews per Platform</h3>
        <div style="position: relative; height: 240px; width: 100%;"><canvas id="rptPlatformChart"></canvas></div>
    </div>
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <h3 class="text-sm font-bold text-gray-800 mb-4">Reviews Over Time</h3>
        <div style="position: relative; height: 240px; width: 100%;"><canvas id="rptMonthlyChart"></canvas></div>
    </div>
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <h3 class="text-sm font-bold text-gray-800 mb-4">Rating Distribution</h3>
        <div style="position: relative; height: 240px; width: 100%;"><canvas id="rptDistChart"></canvas></div>
    </div>
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <h3 class="text-sm font-bold text-gray-800 mb-4">Reviews per Staff</h3>
        <div style="position: relative; height: 240px; width: 100%;"><canvas id="rptStaffChart"></canvas></div>
    </div>
</div>

<script>
var rptDash = {
    perPlatform: <?php echo json_encode($cmpy['per_platform']); ?>,
    monthly: <?php echo json_encode($cmpy['monthly']); ?>,
    distribution: <?php echo json_encode(array_values($cmpy['distribution'])); ?>,
    perStaff: <?php echo json_encode($cmpy['per_staff']); ?>
};

// Lazy init: charts live inside a hidden tab, so render only once it is shown.
window.rptChartsInit = false;
function initCompanyReportCharts() {
    if (window.rptChartsInit || typeof Chart === 'undefined') return;
    window.rptChartsInit = true;

    var palette = ['#004ac6', '#2563eb', '#60a5fa', '#93c5fd', '#b4c5ff', '#10B981', '#f59e0b', '#ef4444'];
    var baseOpts = { responsive: true, maintainAspectRatio: false };

    new Chart(document.getElementById('rptPlatformChart'), {
        type: 'doughnut',
        data: {
            labels: rptDash.perPlatform.map(function(r) { return r.label; }),
            datasets: [{ data: rptDash.perPlatform.map(function(r) { return r.count; }), backgroundColor: palette, borderWidth: 0, hoverOffset: 10 }]
        },
        options: Object.assign({}, baseOpts, { cutout: '70%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true } } } })
    });

    new Chart(document.getElementById('rptMonthlyChart'), {
        type: 'line',
        data: {
            labels: rptDash.monthly.map(function(r) { return r.month; }),
            datasets: [{ label: 'Reviews', data: rptDash.monthly.map(function(r) { return r.count; }), borderColor: '#004ac6', backgroundColor: 'rgba(0, 74, 198, 0.1)', fill: true, tension: 0.4, pointRadius: 3 }]
        },
        options: Object.assign({}, baseOpts, { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f3ff' } }, x: { grid: { display: false } } } })
    });

    new Chart(document.getElementById('rptDistChart'), {
        type: 'bar',
        data: {
            labels: ['1 Star', '2 Star', '3 Star', '4 Star', '5 Star'],
            datasets: [{ label: 'Reviews', data: rptDash.distribution, backgroundColor: ['#ef4444', '#f59e0b', '#eab308', '#84cc16', '#10B981'], borderRadius: 4 }]
        },
        options: Object.assign({}, baseOpts, { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f3ff' } }, x: { grid: { display: false } } } })
    });

    new Chart(document.getElementById('rptStaffChart'), {
        type: 'bar',
        data: {
            labels: rptDash.perStaff.map(function(r) { return r.label; }),
            datasets: [{ label: 'Reviews', data: rptDash.perStaff.map(function(r) { return r.count; }), backgroundColor: '#2563eb', borderRadius: 4 }]
        },
        options: Object.assign({}, baseOpts, { indexAxis: 'y', plugins: { legend: { display: false } }, scales: { x: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f3ff' } }, y: { grid: { display: false } } } })
    });
}

$(document).ready(function() {
    // Render when the "Users" main tab is first opened.
    $('.main-tab-btn[data-target="#userReports"]').on('click', function() {
        setTimeout(initCompanyReportCharts, 50);
    });
    // In case that tab is already active on load.
    if ($('#userReports').is(':visible')) {
        initCompanyReportCharts();
    }
});
</script>
<?php endif; ?>
