<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $allweb->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Platforms</span>
    </div>
</div>

<table id="webtable" class="table" data-toggle="table" data-search="true" data-show-export="true" data-buttons-prefix="btn-md btn" data-buttons-align="right" data-pagination="true">
    <thead class="text-light" style="background:#294a63">
        <tr>
            <th data-field="uname" data-sortable="true">User</th>
            <th data-field="web_name" data-sortable="true">Platform Name</th>
            <th data-field="web_link" data-sortable="true">Platform Link</th>
            <th data-field="total_ratings" data-sortable="true">Total Ratings</th>
            <th data-field="active" data-sortable="true">Active</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allweb->result() as $aw) : ?>
            <tr>
                <td><?php echo $aw->uname; ?></td>
                <td><?php echo $aw->web_name; ?></td>
                <td><?php echo $aw->web_link; ?></td>
                <td><?php echo $aw->total_ratings; ?></td>
                <td class="date">
                    <?php if ($aw->active == '0') : ?>
                        <i class="fa-solid fa-circle text-danger"></i>
                    <?php elseif ($aw->active == '1') : ?>
                        <i class="fa-solid fa-circle text-success"></i>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {});
</script>