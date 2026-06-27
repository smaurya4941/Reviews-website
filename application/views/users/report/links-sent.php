<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $ls->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Links</span>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $t_mail->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Emails</span>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $t_sms->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">SMS</span>
    </div>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col items-center justify-center">
        <h3 class="text-3xl font-bold text-primary mb-1"><?php echo $t_wp->num_rows() ?></h3>
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Whatsapp</span>
    </div>
</div>


<table id="lstable" class="table" data-toggle="table" data-search="true" data-show-export="true" data-buttons-prefix="btn-md btn" data-buttons-align="right" data-pagination="true">
    <thead class="text-light" style="background:#294a63">
        <tr>
            <th data-field="type" data-sortable="true">Type</th>
            <th data-field="sentto" data-sortable="true">Sent to</th>
            <th data-field="subj" data-sortable="true">Subject</th>
            <th data-field="msg" data-sortable="true">Message</th>
            <th data-field="date" data-sortable="true">Date</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($ls->result_array() as $l) : ?>
            <tr>
                <td><?php echo strtoupper($l['link_for']) ?></td>
                <td>
                    <?php if (!empty($l['sent_to_sms']) && $l['sent_to_sms'] !== null) : ?>
                        <!-- <?php echo $l['sent_to_sms']; ?> -->
                        <a href="tel:<?php echo $l['sent_to_sms']; ?>"><?php echo $l['sent_to_sms']; ?></a>
                    <?php elseif (!empty($l['sent_to_email']) && $l['sent_to_email'] !== null) : ?>
                        <!-- <?php echo $l['sent_to_email']; ?> -->
                        <a href="mailto:<?php echo $l['sent_to_email']; ?>"><?php echo $l['sent_to_email']; ?></a>
                    <?php endif; ?>
                </td>
                <td><?php echo $l['subj']; ?></td>
                <td style="word-break:break-all;"><?php echo $l['body']; ?></td>
                <td class="date"><?php echo $l['sent_at']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<script>
    $(document).ready(function() {

    });
</script>