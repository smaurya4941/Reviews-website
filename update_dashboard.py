import re
import sys

file_path = 'application/views/users/dashboard.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace the old dashboard header (lines 13-18)
old_header = r'<div class="flex flex-col md:flex-row md:items-center justify-between gap-md">\s*<div>\s*<h2 class="font-headline-lg text-headline-lg text-on-surface">Dashboard</h2>\s*<p class="text-on-surface-variant font-body-md">Real-time overview of your business reputation</p>\s*</div>\s*</div>'

new_header_and_cards = """
<div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30 mb-lg">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-headline-md text-headline-md text-on-surface">Welcome back, <?php echo $this->session->userdata('mr_uname'); ?></h2>
            <p class="text-on-surface-variant font-body-md mt-1">Manage your review platforms and monitor overall customer feedback.</p>
        </div>
        <div>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200 text-sm font-medium">
                <span class="material-symbols-outlined text-sm">warning</span> Inactive Subscription
            </span>
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
            <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs font-medium border border-gray-200">No active plan</span>
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
"""

content = re.sub(old_header, new_header_and_cards, content, count=1)

# Inject JS into fillChart
js_injection = """
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

                    const chartConfig"""

content = content.replace("const chartConfig", js_injection)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Updated dashboard.php")
