<?php $this->load->view('templates/tw_header'); ?>

    <?php if ($this->session->userdata("mr_cmpyid") === null) : ?>
        <?php if (isset($quota) && $quota->balance !== '0' && $quota->balance !== null) : ?>
            <div class="max-w-6xl mx-auto w-full px-6 md:px-8 mt-6">
                <div class="bg-red-50 text-red-800 p-4 rounded-xl flex items-center justify-between border border-red-200">
                    <div>
                        <span class="font-bold">Past Due Balance:</span> ₹<?php echo $quota->balance; ?>
                    </div>
                    <form action="<?php echo base_url('payment-response') ?>" method="POST" class="m-0">
                        <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        
                        <?php if (isset($error) && $error === false && isset($order)) : ?>
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo isset($key_id) ? $key_id : ''; ?>" data-amount="<?php echo $order->amount ?>" data-currency="INR" data-order_id="<?php echo $order->id ?>" data-buttontext="Pay Balance" data-name="Bizorm" data-description="Review Plan Payment" data-theme.color="#000000"></script>
                            <input type="hidden" custom="Hidden Element" name="hidden">
                        <?php elseif (isset($error) && $error === true) : ?>
                            <p class="text-red-500 text-sm"><?php echo isset($error_msg) ? $error_msg : 'Payment gateway missing.'; ?></p>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="p-4 md:p-6 max-w-6xl mx-auto w-full mt-4">
        <div class="flex flex-col md:flex-row gap-4 items-stretch">
            <?php if(isset($plans)) { foreach ($plans->result_array() as $p) : if($p['active'] == '1') { 
                
                $isCurrentPlan = false;
                if(isset($quota)) {
                    if($quota->plan_id == $p['id'] || (($quota->plan_id == 0 || $quota->plan_id == null) && (strtolower($p['name']) == 'free' || strtolower($p['name']) == 'go' || $p['amount'] == 0))) {
                        $isCurrentPlan = true;
                    }
                }

                // Determine styling based on tier
                $isFree = ($p['amount'] == 0 || strtolower($p['name']) == 'free' || strtolower($p['name']) == 'go');
                $isPlus = (strtolower($p['name']) == 'plus' || strtolower($p['name']) == 'premium' || ($p['amount'] > 0 && $p['amount'] < 5000));
                $isPro = (strtolower($p['name']) == 'pro' || strtolower($p['name']) == 'enterprise' || $p['amount'] >= 5000);
                
                $desc = "Keep tracking with essential access";
                if($isPlus) $desc = "Unlock the full experience";
                if($isPro) $desc = "Maximize your productivity";
            ?>
            <div class="flex-1 bg-white rounded-3xl p-6 flex flex-col border <?php echo ($isPlus || $isPro) ? 'border-gray-200' : 'border-gray-200'; ?>">
                
                <h3 class="text-xl font-medium text-gray-900 mb-3"><?php echo $p['name']; ?></h3>
                
                <div class="flex items-baseline mb-2">
                    <span class="text-sm font-medium text-gray-500 mr-1 relative -top-2">₹</span>
                    <span class="text-3xl font-semibold text-gray-900 tracking-tight"><?php echo $p['amount']; ?></span>
                    <span class="text-[10px] text-gray-500 ml-1 font-medium max-w-[80px] leading-tight">INR / <?php echo $p['per'] ? $p['per'] : 'month'; ?> (inc. GST)</span>
                </div>
                
                <p class="text-[13px] text-gray-700 mb-5"><?php echo $desc; ?></p>
                
                <?php if($isCurrentPlan) : ?>
                    <button class="w-full py-2 px-3 rounded-full border border-green-300 text-green-700 font-medium text-[13px] mb-5 bg-green-50 flex items-center justify-center gap-2 cursor-default"><span class="material-symbols-outlined text-[16px]">check_circle</span> Active Plan</button>
                <?php else : ?>
                    <button data-planid="<?php echo $p['id']; ?>" data-amount="<?php echo $p['amount']; ?>" data-name="<?php echo $p['name']; ?>" class="reqPlanBtn w-full py-2 px-3 rounded-full bg-primary text-white font-medium text-[13px] mb-5 text-center transition-colors hover:bg-blue-700 shadow-sm block">Upgrade to <?php echo $p['name']; ?></button>
                <?php endif; ?>

                <?php if($isPro) : ?>
                    <p class="text-[12px] font-semibold text-gray-800 mb-3">Everything in Plus and:</p>
                <?php endif; ?>
                
                <ul class="flex flex-col gap-2 flex-grow">
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-700 text-[18px]">sms</span>
                        <span class="text-[13px] text-gray-700 leading-tight"><?php echo $p['sms_quota']; ?> SMS Credits</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-700 text-[18px]">mail</span>
                        <span class="text-[13px] text-gray-700 leading-tight"><?php echo $p['email_quota']; ?> Email Credits</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-700 text-[18px]">chat</span>
                        <span class="text-[13px] text-gray-700 leading-tight"><?php echo $p['whatsapp_quota']; ?> WhatsApp Credits</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-700 text-[18px]">language</span>
                        <span class="text-[13px] text-gray-700 leading-tight"><?php echo $p['web_quota']; ?> Web Review Limits</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-700 text-[18px] <?php echo (!$isFree) ? '' : 'opacity-40'; ?>">analytics</span>
                        <span class="text-[13px] leading-tight <?php echo (!$isFree) ? 'text-gray-700' : 'text-gray-400'; ?>">Advanced Analytics</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-700 text-[18px] <?php echo (!$isFree) ? '' : 'opacity-40'; ?>">support_agent</span>
                        <span class="text-[13px] leading-tight <?php echo (!$isFree) ? 'text-gray-700' : 'text-gray-400'; ?>">Priority Support</span>
                    </li>
                    <?php if($isPro) : ?>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-700 text-[18px]">bolt</span>
                        <span class="text-[13px] text-gray-700 leading-tight">Unlimited core generation</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-700 text-[18px]">science</span>
                        <span class="text-[13px] text-gray-700 leading-tight">Early access to experimental features</span>
                    </li>
                    <?php endif; ?>
                </ul>

                <?php if($isPro) : ?>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-[10px] text-gray-500 leading-tight">Unlimited subject to abuse guardrails.<br><a href="#" class="underline">Learn about limits</a><br><a href="#" class="underline">I need help with a billing issue</a></p>
                </div>
                <?php endif; ?>
            </div>
            <?php } endforeach; } ?>
        </div>
    </div>


<!-- Plan Request Confirmation Modal -->
<div id="planConfirmModal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 mb-4 mx-auto">
                <span class="material-symbols-outlined text-blue-600 text-2xl">verified</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Confirm Request</h3>
            <p class="text-gray-600 text-center text-sm mb-6">
                Do you want to request the <strong id="modalPlanName" class="text-gray-900"></strong> plan for <strong class="text-gray-900">₹<span id="modalPlanAmount"></span></strong> via Cash payment?<br><br>
                The Super Admin will review your request and activate the subscription upon receiving the payment.
            </p>
            <div class="flex gap-3">
                <button type="button" id="cancelPlanReq" class="flex-1 py-2.5 px-4 bg-white border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">Cancel</button>
                <button type="button" id="confirmPlanReq" class="flex-1 py-2.5 px-4 bg-primary rounded-xl text-sm font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm">Confirm & Request</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="planSuccessModal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden transform transition-all p-6 text-center">
        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-4 mx-auto">
            <span class="material-symbols-outlined text-green-600 text-3xl">check</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Request Submitted!</h3>
        <p class="text-gray-600 text-sm mb-6">Your subscription request has been submitted successfully. Waiting for Admin approval.</p>
        <button type="button" onclick="window.location.reload();" class="w-full py-2.5 px-4 bg-green-600 rounded-xl text-sm font-semibold text-white hover:bg-green-700 transition-colors shadow-sm">Okay</button>
    </div>
</div>

<script>
$(document).ready(function() {
    var selectedPlanId, selectedAmount, selectedName, currentBtn;

    $('.reqPlanBtn').click(function(e) {
        e.preventDefault();
        selectedPlanId = $(this).data('planid');
        selectedAmount = $(this).data('amount');
        selectedName = $(this).data('name');
        currentBtn = $(this);
        
        $('#modalPlanName').text(selectedName);
        $('#modalPlanAmount').text(selectedAmount);
        
        $('#planConfirmModal').removeClass('hidden').hide().fadeIn(200);
    });

    $('#cancelPlanReq').click(function() {
        $('#planConfirmModal').fadeOut(200, function() {
            $(this).addClass('hidden');
        });
    });

    $('#confirmPlanReq').click(function() {
        var modalBtn = $(this);
        modalBtn.addClass('opacity-50 cursor-not-allowed').text('Requesting...');
        currentBtn.addClass('opacity-50 cursor-not-allowed').text('Requesting...');
        
        $.ajax({
            url: "<?php echo base_url('request-plan'); ?>",
            method: "POST",
            data: {
                plan_id: selectedPlanId,
                amount: selectedAmount,
                payment_method: 'Cash',
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "json",
            success: function(res) {
                if(res.status) {
                    $('#planConfirmModal').hide();
                    $('#planSuccessModal').removeClass('hidden').hide().fadeIn(200);
                } else {
                    alert("Error submitting request: " + res.message);
                    modalBtn.removeClass('opacity-50 cursor-not-allowed').text('Confirm & Request');
                    currentBtn.removeClass('opacity-50 cursor-not-allowed').text('Upgrade to ' + selectedName);
                }
            },
            error: function() {
                alert("A network error occurred. Please try again.");
                modalBtn.removeClass('opacity-50 cursor-not-allowed').text('Confirm & Request');
                currentBtn.removeClass('opacity-50 cursor-not-allowed').text('Upgrade to ' + selectedName);
            }
        });
    });
});
</script>
<?php $this->load->view('templates/tw_footer'); ?>
