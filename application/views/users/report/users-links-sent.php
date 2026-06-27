<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $allls->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Links</span>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $allt_mail->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Emails</span>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $allt_sms->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">SMS</span>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $allt_wp->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Whatsapp</span>
    </div>
</div>


<table id="lstable" class="table" data-toggle="table" data-search="true" data-show-export="true" data-buttons-prefix="btn-md btn" data-buttons-align="right" data-pagination="true">
    <thead class="text-light" style="background:#294a63">
        <tr>
            <th data-field="uname" data-sortable="true">User</th>
            <th data-field="type" data-sortable="true">Type</th>
            <th data-field="sentto" data-sortable="true">Sent to</th>
            <th data-field="subj" data-sortable="true">Subject</th>
            <th data-field="msg" data-sortable="true">Message</th>
            <th data-field="date" data-sortable="true">Date</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($allls->result_array() as $als) : ?>
            <tr>
                <td><?php echo $als['uname']; ?></td>
                <td><?php echo strtoupper($als['link_for']) ?></td>
                <td>
                    <?php if (!empty($als['sent_to_sms']) && $als['sent_to_sms'] !== null) : ?>
                        <!-- <?php echo $als['sent_to_sms']; ?> -->
                        <a href="tel:<?php echo $als['sent_to_sms']; ?>"><?php echo $als['sent_to_sms']; ?></a>
                    <?php elseif (!empty($als['sent_to_email']) && $als['sent_to_email'] !== null) : ?>
                        <!-- <?php echo $als['sent_to_email']; ?> -->
                        <a href="mailto:<?php echo $als['sent_to_email']; ?>"><?php echo $als['sent_to_email']; ?></a>
                    <?php endif; ?>
                </td>
                <td><?php echo $als['subj']; ?></td>
                <td style="word-break:break-all;"><?php echo $als['body']; ?></td>
                <td class="date"><?php echo $als['sent_at']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<script>
    $(document).ready(function() {

    });
</script>