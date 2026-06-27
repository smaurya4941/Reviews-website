<!-- plans -->
<div class="w-full">
	<input type="hidden" name="sms_quota" id="sms_quota">
	<input type="hidden" name="email_quota" id="email_quota">
	<input type="hidden" name="whatsapp_quota" id="whatsapp_quota">
	<input type="hidden" name="web_quota" id="web_quota">
	<input type="hidden" name="plan_id" id="plan_id">
	<input type="hidden" name="amount" id="amount">

	<div class="space-y-xs w-full">
		<label class="font-label-md text-label-md text-on-surface-variant" for="plan_select">Select Plan *</label>
		<div class="relative group">
            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">credit_card</span>
			<select id="plan_select" class="w-full pl-xl pr-md py-sm rounded-lg border-outline-variant bg-surface-subtle focus:ring-4 focus:ring-primary-container/20 focus:border-primary transition-all font-body-md outline-none border appearance-none" required>
				<option value="" disabled selected>-- Choose a Plan --</option>
				<?php foreach ($plans->result_array() as $p) : ?>
					<?php if ($p['active'] === '1') : ?>
						<option 
                            value="<?php echo $p['id']; ?>"
                            data-sms="<?php echo $p['sms_quota']; ?>"
                            data-email="<?php echo $p['email_quota']; ?>"
                            data-wa="<?php echo $p['whatsapp_quota']; ?>"
                            data-web="<?php echo $p['web_quota']; ?>"
                            data-amount="<?php echo $p['amount']; ?>"
                        >
                            <?php echo $p['name'] ?> - Rs <?php echo $p['amount'].' '. $p['per'] ?>
                        </option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-on-surface-variant">
                <span class="material-symbols-outlined">expand_more</span>
            </div>
		</div>
	</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const planSelect = document.getElementById('plan_select');
        planSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if(selectedOption.value) {
                document.getElementById('plan_id').value = selectedOption.value;
                document.getElementById('sms_quota').value = selectedOption.getAttribute('data-sms');
                document.getElementById('email_quota').value = selectedOption.getAttribute('data-email');
                document.getElementById('whatsapp_quota').value = selectedOption.getAttribute('data-wa');
                document.getElementById('web_quota').value = selectedOption.getAttribute('data-web');
                document.getElementById('amount').value = selectedOption.getAttribute('data-amount');
            }
        });
    });
</script>