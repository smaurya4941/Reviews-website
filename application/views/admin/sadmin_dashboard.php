<?php $this->load->view('templates/tw_header'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>

<?php
// Platform-wide analytics (populated by User::dashboard for Super Admins).
$stats = isset($stats) ? $stats : array(
    'total_accounts' => 0, 'companies' => 0, 'sub_users' => 0, 'independent' => 0,
    'active_users' => 0, 'inactive_users' => 0, 'active_subs' => 0,
    'total_platforms' => 0, 'active_platforms' => 0,
    'total_reviews' => 0, 'avg_rating' => 0, 'reviews_month' => 0,
    'pending_requests' => 0, 'revenue' => 0,
    'per_platform' => array(), 'monthly' => array(),
    'distribution' => array(0, 0, 0, 0, 0), 'top_accounts' => array(),
);
$avg_rating = (float) $stats['avg_rating'];
$has_reviews = ((int) $stats['total_reviews'] > 0);
?>

<div class="p-lg lg:p-xl space-y-xl max-w-7xl mx-auto w-full">

    <!-- Header -->
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 mb-lg">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Platform Overview</h2>
                <p class="text-on-surface-variant font-body-md mt-1">Welcome back, <?php echo htmlspecialchars($this->session->userdata('mr_uname')); ?> — system-wide activity across all tenants.</p>
            </div>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-success/10 text-success border border-success/20 text-sm font-medium">
                <span class="material-symbols-outlined text-sm">shield_person</span> Super Admin
            </span>
        </div>
    </div>

    <!-- Primary KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-lg mb-lg">
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm transition-all hover:shadow-md flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined">groups</span></div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Accounts</p>
                <h3 class="text-2xl font-bold text-gray-800"><?php echo (int) $stats['total_accounts']; ?></h3>
                <p class="text-[11px] text-gray-500"><?php echo (int) $stats['sub_users']; ?> sub-users</p>
            </div>
        </div>
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm transition-all hover:shadow-md flex items-center gap-4">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined">domain</span></div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Companies</p>
                <h3 class="text-2xl font-bold text-gray-800"><?php echo (int) $stats['companies']; ?></h3>
                <p class="text-[11px] text-gray-500"><?php echo (int) $stats['independent']; ?> independent users</p>
            </div>
        </div>
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm transition-all hover:shadow-md flex items-center gap-4">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined">verified</span></div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Active Subscriptions</p>
                <h3 class="text-2xl font-bold text-gray-800"><?php echo (int) $stats['active_subs']; ?></h3>
                <p class="text-[11px] text-gray-500"><?php echo (int) $stats['active_users']; ?> active accounts</p>
            </div>
        </div>
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm transition-all hover:shadow-md flex items-center gap-4">
            <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined">payments</span></div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Revenue</p>
                <h3 class="text-2xl font-bold text-gray-800">&#8377;<?php echo number_format((float) $stats['revenue'], 2); ?></h3>
                <p class="text-[11px] text-gray-500">All transactions</p>
            </div>
        </div>
    </div>

    <!-- Secondary KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-lg mb-lg">
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Total Reviews</p>
            <h3 class="text-2xl font-bold text-primary"><?php echo (int) $stats['total_reviews']; ?></h3>
            <p class="text-[11px] text-gray-500 mt-1"><?php echo (int) $stats['reviews_month']; ?> received this month</p>
        </div>
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Average Rating</p>
            <div class="flex items-center gap-2">
                <h3 class="text-2xl font-bold text-primary"><?php echo $avg_rating > 0 ? number_format($avg_rating, 1) : '0.0'; ?></h3>
                <div class="flex text-sm">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="<?php echo ($i <= round($avg_rating)) ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300'; ?>"></i>
                    <?php endfor; ?>
                </div>
            </div>
            <p class="text-[11px] text-gray-500 mt-1">Across all platforms</p>
        </div>
        <div class="bg-white p-md rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Platforms</p>
            <h3 class="text-2xl font-bold text-primary"><?php echo (int) $stats['active_platforms']; ?><span class="text-gray-400 text-base font-normal">/<?php echo (int) $stats['total_platforms']; ?></span></h3>
            <p class="text-[11px] text-gray-500 mt-1">Active / total configured</p>
        </div>
        <a href="<?php echo base_url('admin/plans'); ?>" class="bg-white p-md rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-primary/40 transition-all block">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Pending Plan Requests</p>
            <h3 class="text-2xl font-bold <?php echo ((int) $stats['pending_requests'] > 0) ? 'text-amber-600' : 'text-primary'; ?>"><?php echo (int) $stats['pending_requests']; ?></h3>
            <p class="text-[11px] text-primary mt-1 flex items-center gap-1">Review requests <span class="material-symbols-outlined text-xs">arrow_forward</span></p>
        </a>
    </div>

    <!-- Quick actions -->
    <div class="flex flex-wrap gap-3 mb-lg">
        <a href="<?php echo base_url('users'); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:shadow-lg transition-all"><span class="material-symbols-outlined text-base">manage_accounts</span> Manage Users</a>
        <a href="<?php echo base_url('admin/plans'); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:border-primary/40 hover:text-primary transition-all"><span class="material-symbols-outlined text-base">workspace_premium</span> Plans</a>
        <a href="<?php echo base_url('logs'); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:border-primary/40 hover:text-primary transition-all"><span class="material-symbols-outlined text-base">history</span> Activity Logs</a>
        <a href="<?php echo base_url('support'); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:border-primary/40 hover:text-primary transition-all"><span class="material-symbols-outlined text-base">support_agent</span> Support</a>
    </div>

    <!-- Charts -->
    <?php if (!$has_reviews): ?>
    <div class="bg-white p-10 rounded-xl border border-dashed border-gray-300 text-center mb-lg">
        <span class="material-symbols-outlined text-gray-400 text-5xl mb-2">insights</span>
        <p class="text-gray-600 font-semibold">No feedback collected yet</p>
        <p class="text-sm text-gray-400 mt-1">Platform analytics will populate once tenants start receiving reviews.</p>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-lg mb-lg">
        <div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
            <h3 class="font-headline-md text-body-lg font-bold mb-xl">Reviews per Platform</h3>
            <div class="chart-container" style="position: relative; height: 250px; width: 100%;"><canvas id="saPlatformChart"></canvas></div>
        </div>
        <div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
            <h3 class="font-headline-md text-body-lg font-bold mb-xl">Reviews Over Time</h3>
            <div class="chart-container" style="position: relative; height: 250px; width: 100%;"><canvas id="saMonthlyChart"></canvas></div>
        </div>
        <div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
            <h3 class="font-headline-md text-body-lg font-bold mb-xl">Rating Distribution</h3>
            <div class="chart-container" style="position: relative; height: 250px; width: 100%;"><canvas id="saDistChart"></canvas></div>
        </div>
        <div class="bg-white p-lg rounded-xl shadow-sm border border-outline-variant/30">
            <h3 class="font-headline-md text-body-lg font-bold mb-xl">Top Accounts by Reviews</h3>
            <div class="chart-container" style="position: relative; height: 250px; width: 100%;"><canvas id="saTopChart"></canvas></div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Recent accounts -->
    <div class="mb-lg">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-headline-md text-body-lg font-bold text-gray-800">Recent Accounts</h3>
            <a href="<?php echo base_url('users'); ?>" class="text-sm text-primary hover:underline font-semibold">View All</a>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <?php if (isset($branches) && $branches->num_rows() > 0): ?>
            <div style="overflow-x:auto;">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500">
                        <tr>
                            <th class="text-left font-semibold px-4 py-3">Account</th>
                            <th class="text-left font-semibold px-4 py-3">Company</th>
                            <th class="text-left font-semibold px-4 py-3">Email</th>
                            <th class="text-left font-semibold px-4 py-3">Type</th>
                            <th class="text-left font-semibold px-4 py-3">Status</th>
                            <th class="text-left font-semibold px-4 py-3">Subscription</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rows = $branches->result();
                        $rows = array_slice($rows, 0, 10);
                        foreach ($rows as $b):
                            $name = trim($b->fname . ' ' . $b->lname);
                            $name = ($name !== '') ? $name : $b->uname;
                        ?>
                        <tr class="border-t border-gray-100 hover:bg-gray-50/60">
                            <td class="px-4 py-3 font-medium text-gray-800"><?php echo htmlspecialchars($name); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo !empty($b->cmpy) ? htmlspecialchars($b->cmpy) : '—'; ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($b->email); ?></td>
                            <td class="px-4 py-3">
                                <?php if ($b->admin == '1' && $b->iscmpy == '1'): ?>
                                    <span class="text-xs font-semibold text-indigo-700 bg-indigo-50 border border-indigo-200 px-2 py-1 rounded">Company</span>
                                <?php else: ?>
                                    <span class="text-xs font-semibold text-slate-600 bg-slate-50 border border-slate-200 px-2 py-1 rounded">User</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if ($b->active == '1'): ?>
                                    <span class="text-xs font-semibold text-green-700 bg-green-50 border border-green-200 px-2 py-1 rounded">Active</span>
                                <?php else: ?>
                                    <span class="text-xs font-semibold text-red-700 bg-red-50 border border-red-200 px-2 py-1 rounded">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if ($b->sub == '1'): ?>
                                    <span class="text-xs font-semibold text-green-700">Subscribed</span>
                                <?php else: ?>
                                    <span class="text-xs font-semibold text-gray-400">None</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="p-8 text-center">
                <span class="material-symbols-outlined text-gray-400 text-4xl mb-2">person_off</span>
                <p class="text-gray-500 font-medium">No accounts registered yet.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php if ($has_reviews): ?>
<script>
var saDash = {
    perPlatform: <?php echo json_encode($stats['per_platform']); ?>,
    monthly: <?php echo json_encode($stats['monthly']); ?>,
    distribution: <?php echo json_encode(array_values($stats['distribution'])); ?>,
    topAccounts: <?php echo json_encode($stats['top_accounts']); ?>
};

$(document).ready(function() {
    var palette = ['#004ac6', '#2563eb', '#60a5fa', '#93c5fd', '#b4c5ff', '#10B981', '#f59e0b', '#ef4444'];
    var baseOpts = { responsive: true, maintainAspectRatio: false };

    new Chart(document.getElementById('saPlatformChart'), {
        type: 'doughnut',
        data: {
            labels: saDash.perPlatform.map(function(r) { return r.label; }),
            datasets: [{ data: saDash.perPlatform.map(function(r) { return r.count; }), backgroundColor: palette, borderWidth: 0, hoverOffset: 10 }]
        },
        options: Object.assign({}, baseOpts, { cutout: '70%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true } } } })
    });

    new Chart(document.getElementById('saMonthlyChart'), {
        type: 'line',
        data: {
            labels: saDash.monthly.map(function(r) { return r.month; }),
            datasets: [{ label: 'Reviews', data: saDash.monthly.map(function(r) { return r.count; }), borderColor: '#004ac6', backgroundColor: 'rgba(0, 74, 198, 0.1)', fill: true, tension: 0.4, pointRadius: 3 }]
        },
        options: Object.assign({}, baseOpts, { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f3ff' } }, x: { grid: { display: false } } } })
    });

    new Chart(document.getElementById('saDistChart'), {
        type: 'bar',
        data: {
            labels: ['1 Star', '2 Star', '3 Star', '4 Star', '5 Star'],
            datasets: [{ label: 'Reviews', data: saDash.distribution, backgroundColor: ['#ef4444', '#f59e0b', '#eab308', '#84cc16', '#10B981'], borderRadius: 4 }]
        },
        options: Object.assign({}, baseOpts, { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f3ff' } }, x: { grid: { display: false } } } })
    });

    new Chart(document.getElementById('saTopChart'), {
        type: 'bar',
        data: {
            labels: saDash.topAccounts.map(function(r) { return r.label; }),
            datasets: [{ label: 'Reviews', data: saDash.topAccounts.map(function(r) { return r.count; }), backgroundColor: '#2563eb', borderRadius: 4 }]
        },
        options: Object.assign({}, baseOpts, { indexAxis: 'y', plugins: { legend: { display: false } }, scales: { x: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f3ff' } }, y: { grid: { display: false } } } })
    });
});
</script>
<?php endif; ?>

<?php $this->load->view('templates/tw_footer'); ?>
