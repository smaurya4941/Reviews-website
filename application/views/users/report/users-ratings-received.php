<?php
/**
 * Report: users-ratings-received.php  (admin view — all users)
 * Variable: $allrr  (CodeIgniter DB result object from all_ratings joined with users)
 */

// Helper defined in ratings-received.php but guard against re-declaration
if (!function_exists('ratingBadge')) {
    function ratingBadge($val) {
        if ($val === null || $val === '') return '<span class="r-null">—</span>';
        $emojis = ['', '😞', '😕', '😐', '😊', '🤩'];
        $colors = ['', '#ef4444', '#f97316', '#f59e0b', '#22c55e', '#16a34a'];
        $v = (int)$val;
        $emoji = isset($emojis[$v]) ? $emojis[$v] : '';
        $color = isset($colors[$v]) ? $colors[$v] : '#64748b';
        return '<span class="r-badge" style="background:' . $color . '15;color:' . $color . ';border:1px solid ' . $color . '40">'
             . $emoji . ' ' . $v
             . '</span>';
    }
}
?>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $allrr->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Reviews</span>
    </div>
</div>

<div style="overflow-x:auto;">
<table id="all_rrtable" class="table"
       data-toggle="table"
       data-search="true"
       data-show-export="true"
       data-buttons-prefix="btn-md btn"
       data-buttons-align="right"
       data-pagination="true"
       data-page-size="15">
    <thead class="text-light" style="background:#294a63">
        <tr>
            <th data-field="uname"       data-sortable="true">User</th>
            <th data-field="webname"     data-sortable="true">Platform</th>
            <th data-field="avg_star"    data-sortable="true">Avg ★</th>
            <th data-field="r_food"      data-sortable="true">🍽 Food</th>
            <th data-field="r_beverages" data-sortable="true">🥤 Beverages</th>
            <th data-field="r_order"     data-sortable="true">⏱ Order Time</th>
            <th data-field="r_serve"     data-sortable="true">🚀 Serve Time</th>
            <th data-field="r_staff"     data-sortable="true">🤝 Staff</th>
            <th data-field="r_restaurant"data-sortable="true">🏠 Restaurant</th>
            <th data-field="r_menu"      data-sortable="true">📋 Menu</th>
            <th data-field="r_care"      data-sortable="true">💛 Care</th>
            <th data-field="name"        data-sortable="true">Guest Name</th>
            <th data-field="mobile"      data-sortable="true">Contact</th>
            <th data-field="comments"    data-sortable="true">Comments</th>
            <th data-field="visit_date"  data-sortable="true">Visit Date</th>
            <th data-field="ip"          data-sortable="true">IP</th>
            <th data-field="rated_at"    data-sortable="true">Submitted</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allrr->result() as $arr) : ?>
            <tr>
                <td><?php echo htmlspecialchars($arr->uname ?? ''); ?></td>
                <td>
                    <a href="<?php echo $arr->web_link; ?>" target="_blank">
                        <?php echo htmlspecialchars($arr->web_name); ?>
                    </a>
                </td>
                <td class="avg-star"><?php echo $arr->star; ?> ★</td>
                <td><?php echo ratingBadge($arr->r_food); ?></td>
                <td><?php echo ratingBadge($arr->r_beverages); ?></td>
                <td><?php echo ratingBadge($arr->r_order_time); ?></td>
                <td><?php echo ratingBadge($arr->r_serve_time); ?></td>
                <td><?php echo ratingBadge($arr->r_staff); ?></td>
                <td><?php echo ratingBadge($arr->r_restaurant); ?></td>
                <td><?php echo ratingBadge($arr->r_menu); ?></td>
                <td><?php echo ratingBadge($arr->r_care); ?></td>
                <td><?php echo htmlspecialchars($arr->name); ?></td>
                <td><?php echo $arr->mobile; ?></td>
                <td class="comment-cell" title="<?php echo htmlspecialchars($arr->comments ?? ''); ?>">
                    <?php echo htmlspecialchars($arr->comments ?? '—'); ?>
                </td>
                <td><?php echo $arr->visit_date ? date('d M Y', strtotime($arr->visit_date)) : '—'; ?></td>
                <td><?php echo $arr->user_ip; ?></td>
                <td><?php echo date('d M Y, h:i A', strtotime($arr->rated_at)); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>