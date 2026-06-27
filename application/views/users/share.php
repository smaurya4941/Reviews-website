<?php $this->load->view('templates/tw_header'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>


<div class="p-4 md:p-6 max-w-3xl mx-auto w-full">
<!-- Alerts -->
<div class="ajax_succ_div bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-lg relative hidden mb-4 text-[13px]" role="alert">
  <span class="block sm:inline ajax_res_succ"></span>
</div>
<div class="ajax_err_div bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-lg relative hidden mb-4 text-[13px]" role="alert">
  <span class="block sm:inline ajax_res_err"></span>
</div>

<div class="mb-5">
<h2 class="text-xl font-display font-bold text-gray-900">Send Link</h2>
<p class="text-[13px] text-gray-600">Share your feedback link with customers via Email, SMS, or WhatsApp.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <!-- Tabs -->
    <div class="flex border-b border-gray-200 bg-gray-50">
        <button class="flex-1 py-2 text-[13px] font-semibold text-primary border-b-2 border-primary tab-btn transition-colors" onclick="openTab('emailForm', this)">Email</button>
        <button class="flex-1 py-2 text-[13px] font-semibold text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:bg-gray-100 tab-btn transition-colors" onclick="openTab('smsForm', this)">SMS</button>
        <button class="flex-1 py-2 text-[13px] font-semibold text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:bg-gray-100 tab-btn transition-colors" onclick="openTab('whatsappForm', this)">WhatsApp</button>
    </div>

    <div class="p-4 md:p-5">
        <!-- Email Form -->
        <form action="<?php echo base_url('share-email'); ?>" method="post" id="emailForm" class="tab-content block genform">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
			<input type="hidden" name="userid" value="<?php echo $this->session->userdata('mr_id'); ?>" class="userid">

            <div class="flex flex-wrap gap-2 mb-4 justify-end">
				<button class="px-3 py-1.5 bg-gray-100 border border-gray-200 text-gray-700 hover:bg-gray-200 rounded-lg text-[12px] font-semibold transition-colors email_SendSingleBtn" type="button" style="display:none">Send single</button>
				<button class="px-3 py-1.5 bg-gray-100 border border-gray-200 text-gray-700 hover:bg-gray-200 rounded-lg text-[12px] font-semibold transition-colors email_ImportMultipleBtn" type="button">Import multiple</button>
				<a href="<?php echo base_url('email-sample-csv'); ?>" class="px-3 py-1.5 bg-red-50 border border-red-200 text-red-700 rounded-lg text-[12px] font-semibold hover:bg-red-100 transition-colors flex items-center gap-1">
					<span class="material-symbols-outlined text-[14px]">download</span> Sample
                </a>
			</div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Platform</label>
                    <div class="flex gap-2">
                        <select name="foremailplatform" id="platforms" platformTab="email" class="flex-1 bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none" required>
                            <?php if ($platforms->num_rows() > 0) : ?>
                                <option value="">Select</option>
                                <?php foreach ($platforms->result_array() as $p) : ?>
                                    <?php if ($p['active'] === '1') : ?>
                                        <option value="<?php echo $p['id'] ?>"><?php echo $p['web_name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">No platform created</option>
                            <?php endif; ?>
                        </select>
                        <button type="button" class="w-8 h-8 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg flex items-center justify-center addwebmodal_btn hover:bg-blue-100 transition-colors shrink-0">
                            <span class="material-symbols-outlined text-[16px]">add</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5 labelemail">E-mail</label>
                    <input type="email" name="email" class="w-full bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none email" placeholder="example@domain.com" id="email" required>
                    <select class="w-full bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none email_select" name="email_select" id="email_select" style="display: none;" readonly conn="false"></select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Subject</label>
                    <input type="text" name="subj" class="w-full bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none subj" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Body</label>
                    <textarea class="w-full bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none emailbdy" rows="4" name="emailbdy" required></textarea>
                </div>
            </div>

            <div class="mt-5 flex justify-end">
                <button class="px-5 py-2 bg-primary text-white text-[13px] font-semibold rounded-lg shadow-sm hover:bg-blue-700 transition-colors email_sendBtn" type="submit">Share</button>
                <button class="px-5 py-2 bg-primary text-white text-[13px] font-semibold rounded-lg shadow-sm hover:bg-blue-700 transition-colors email_sendBtn_m hidden" type="submit" style="display:none">Share Multiple</button>
            </div>
        </form>

        <!-- SMS Form -->
        <form action="<?php echo base_url('share-sms'); ?>" method="post" id="smsForm" class="tab-content hidden genform" style="display:none">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
			<input type="hidden" name="userid" value="<?php echo $this->session->userdata('mr_id'); ?>" class="userid">

            <div class="flex flex-wrap gap-2 mb-4 justify-end">
				<button class="px-3 py-1.5 bg-gray-100 border border-gray-200 text-gray-700 hover:bg-gray-200 rounded-lg text-[12px] font-semibold transition-colors sms_SendSingleBtn" type="button" style="display:none">Send single</button>
				<button class="px-3 py-1.5 bg-gray-100 border border-gray-200 text-gray-700 hover:bg-gray-200 rounded-lg text-[12px] font-semibold transition-colors sms_ImportMultipleBtn" type="button">Import multiple</button>
				<a href="<?php echo base_url('sms-sample-csv'); ?>" class="px-3 py-1.5 bg-red-50 border border-red-200 text-red-700 rounded-lg text-[12px] font-semibold hover:bg-red-100 transition-colors flex items-center gap-1">
					<span class="material-symbols-outlined text-[14px]">download</span> Sample
                </a>
			</div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Platform</label>
                    <div class="flex gap-2">
                        <select name="forsmsplatform" id="platforms" platformTab="sms" class="flex-1 bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none" required>
                            <?php if ($platforms->num_rows() > 0) : ?>
                                <option value="">Select</option>
                                <?php foreach ($platforms->result_array() as $p) : ?>
                                    <?php if ($p['active'] === '1') : ?>
                                        <option value="<?php echo $p['id'] ?>"><?php echo $p['web_name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">No platform created</option>
                            <?php endif; ?>
                        </select>
                        <button type="button" class="w-8 h-8 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg flex items-center justify-center addwebmodal_btn hover:bg-blue-100 transition-colors shrink-0">
                            <span class="material-symbols-outlined text-[16px]">add</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5 phonelabel">Phone number</label>
                    <div class="flex gap-2">
                        <div class="w-12 bg-gray-100 rounded-lg flex items-center justify-center font-medium border border-gray-300 text-[13px] text-gray-600 shrink-0">+91</div>
                        <input type="number" name="mobile" class="flex-1 bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none mobile" placeholder="Your mobile number" id="mobile" required>
                        <select class="flex-1 bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none sms_select" name="sms_select" id="sms_select" style="display: none;" readonly conn="false"></select>
                    </div>
                    <span class="e_mobile text-red-500 text-[11px] mt-1" style="display:none">Invalid mobile length</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Body</label>
                    <textarea class="w-full bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none smsbdy" rows="4" name="smsbdy" required></textarea>
                </div>
            </div>

            <div class="mt-5 flex justify-end">
                <button class="px-5 py-2 bg-primary text-white text-[13px] font-semibold rounded-lg shadow-sm hover:bg-blue-700 transition-colors sms_sendBtn" type="submit">Share</button>
                <button class="px-5 py-2 bg-primary text-white text-[13px] font-semibold rounded-lg shadow-sm hover:bg-blue-700 transition-colors sms_sendBtn_m hidden" type="submit" style="display:none">Share Multiple</button>
            </div>
        </form>

        <!-- WhatsApp Form -->
        <form action="<?php echo base_url('share-whatsapp'); ?>" method="post" id="whatsappForm" class="tab-content hidden genform" style="display:none">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
			<input type="hidden" name="userid" value="<?php echo $this->session->userdata('mr_id'); ?>" class="userid">

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Platform</label>
                    <div class="flex gap-2">
                        <select name="forwhpplatform" id="platforms" platformTab="whp" class="flex-1 bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none" required>
                            <?php if ($platforms->num_rows() > 0) : ?>
                                <option value="">Select</option>
                                <?php foreach ($platforms->result_array() as $p) : ?>
                                    <?php if ($p['active'] === '1') : ?>
                                        <option value="<?php echo $p['id'] ?>"><?php echo $p['web_name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">No platform created</option>
                            <?php endif; ?>
                        </select>
                        <button type="button" class="w-8 h-8 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg flex items-center justify-center addwebmodal_btn hover:bg-blue-100 transition-colors shrink-0">
                            <span class="material-symbols-outlined text-[16px]">add</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5 phonelabel">Whatsapp Number</label>
                    <div class="flex gap-2">
                        <div class="w-12 bg-gray-100 rounded-lg flex items-center justify-center font-medium border border-gray-300 text-[13px] text-gray-600 shrink-0">+91</div>
                        <input type="number" name="whpMobile" class="flex-1 bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none whpMobile" placeholder="Whatsapp number" required>
                    </div>
                    <span class="e_whpMobile text-red-500 text-[11px] mt-1" style="display:none">Invalid mobile length</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Body</label>
                    <textarea class="w-full bg-white border border-gray-300 rounded-lg py-1.5 px-3 text-[13px] text-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none whpbdy" rows="4" name="whpbdy" required></textarea>
                </div>
            </div>

            <div class="mt-5 flex justify-end">
                <button class="px-5 py-2 bg-primary text-white text-[13px] font-semibold rounded-lg shadow-sm hover:bg-blue-700 transition-colors whp_sendBtn" type="button">Share</button>
            </div>
        </form>
    </div>
</div>
</div>
<?php $this->load->view('templates/tw_footer'); ?>
