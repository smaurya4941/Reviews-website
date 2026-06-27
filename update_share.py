import sys
import re

with open(r'd:\bizorm\application\views\users\dashboard.php', 'r', encoding='utf-8') as f:
    dashboard_lines = f.readlines()

header_html = "".join(dashboard_lines[:190])

main_body = """
<div class="p-lg lg:p-xl space-y-xl max-w-5xl mx-auto w-full">
<!-- Alerts -->
<div class="ajax_succ_div bg-success/10 border border-success text-success px-4 py-3 rounded-lg relative hidden" role="alert">
  <span class="block sm:inline ajax_res_succ"></span>
</div>
<div class="ajax_err_div bg-error/10 border border-error text-error px-4 py-3 rounded-lg relative hidden" role="alert">
  <span class="block sm:inline ajax_res_err"></span>
</div>

<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Send Link</h2>
<p class="text-on-surface-variant font-body-md">Share your feedback link with customers via Email, SMS, or WhatsApp.</p>
</div>

<div class="bg-surface-container-lowest p-0 rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
    <!-- Tabs -->
    <div class="flex border-b border-outline-variant/30 bg-surface-subtle">
        <button class="flex-1 py-3 font-label-md text-primary border-b-2 border-primary tab-btn" onclick="openTab('emailForm', this)">Email</button>
        <button class="flex-1 py-3 font-label-md text-on-surface-variant border-b-2 border-transparent hover:text-primary tab-btn" onclick="openTab('smsForm', this)">SMS</button>
        <button class="flex-1 py-3 font-label-md text-on-surface-variant border-b-2 border-transparent hover:text-primary tab-btn" onclick="openTab('whatsappForm', this)">WhatsApp</button>
    </div>

    <div class="p-lg">
        <!-- Email Form -->
        <form action="<?php echo base_url('share-email'); ?>" method="post" id="emailForm" class="tab-content block genform">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
			<input type="hidden" name="userid" value="<?php echo $this->session->userdata('mr_id'); ?>" class="userid">

            <div class="flex flex-wrap gap-2 mb-md justify-end">
				<button class="px-4 py-2 bg-surface-container-high hover:bg-primary hover:text-on-primary rounded-lg text-sm font-medium transition-colors email_SendSingleBtn" type="button" style="display:none">Send single</button>
				<button class="px-4 py-2 bg-surface-container-high hover:bg-primary hover:text-on-primary rounded-lg text-sm font-medium transition-colors email_ImportMultipleBtn" type="button">Import multiple</button>
				<a href="<?php echo base_url('email-sample-csv'); ?>" class="px-4 py-2 bg-error text-on-error rounded-lg text-sm font-medium hover:bg-error/90 transition-colors flex items-center gap-1">
					<span class="material-symbols-outlined text-sm" style="font-size: 16px;">download</span> Sample
                </a>
			</div>

            <div class="space-y-md">
                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Platform</label>
                    <div class="flex gap-2">
                        <select name="foremailplatform" id="platforms" platformTab="email" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" required>
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
                        <button type="button" class="w-10 h-10 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center addwebmodal_btn hover:bg-primary hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs labelemail">E-mail</label>
                    <input type="email" name="email" class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary email" placeholder="example@domain.com" id="email" required>
                    <select class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md email_select" name="email_select" id="email_select" style="display: none;" readonly conn="false"></select>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Subject</label>
                    <input type="text" name="subj" class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary subj" required>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Body</label>
                    <textarea class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary emailbdy" rows="6" name="emailbdy" required></textarea>
                </div>
            </div>

            <div class="mt-lg flex justify-end">
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all email_sendBtn" type="submit">Share</button>
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all email_sendBtn_m hidden" type="submit" style="display:none">Share Multiple</button>
            </div>
        </form>

        <!-- SMS Form -->
        <form action="<?php echo base_url('share-sms'); ?>" method="post" id="smsForm" class="tab-content hidden genform" style="display:none">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
			<input type="hidden" name="userid" value="<?php echo $this->session->userdata('mr_id'); ?>" class="userid">

            <div class="flex flex-wrap gap-2 mb-md justify-end">
				<button class="px-4 py-2 bg-surface-container-high hover:bg-primary hover:text-on-primary rounded-lg text-sm font-medium transition-colors sms_SendSingleBtn" type="button" style="display:none">Send single</button>
				<button class="px-4 py-2 bg-surface-container-high hover:bg-primary hover:text-on-primary rounded-lg text-sm font-medium transition-colors sms_ImportMultipleBtn" type="button">Import multiple</button>
				<a href="<?php echo base_url('sms-sample-csv'); ?>" class="px-4 py-2 bg-error text-on-error rounded-lg text-sm font-medium hover:bg-error/90 transition-colors flex items-center gap-1">
					<span class="material-symbols-outlined text-sm" style="font-size: 16px;">download</span> Sample
                </a>
			</div>

            <div class="space-y-md">
                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Platform</label>
                    <div class="flex gap-2">
                        <select name="forsmsplatform" id="platforms" platformTab="sms" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" required>
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
                        <button type="button" class="w-10 h-10 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center addwebmodal_btn hover:bg-primary hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs phonelabel">Phonenumber</label>
                    <div class="flex gap-2">
                        <div class="w-12 bg-surface-container-high rounded-lg flex items-center justify-center font-medium border border-outline-variant/30">+91</div>
                        <input type="number" name="mobile" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary mobile" placeholder="Your mobile number" id="mobile" required>
                        <select class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md sms_select" name="sms_select" id="sms_select" style="display: none;" readonly conn="false"></select>
                    </div>
                    <span class="e_mobile text-error text-sm mt-1" style="display:none">Invalid mobile length</span>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Body</label>
                    <textarea class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary smsbdy" rows="6" name="smsbdy" required></textarea>
                </div>
            </div>

            <div class="mt-lg flex justify-end">
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all sms_sendBtn" type="submit">Share</button>
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all sms_sendBtn_m hidden" type="submit" style="display:none">Share Multiple</button>
            </div>
        </form>

        <!-- WhatsApp Form -->
        <form action="<?php echo base_url('share-whatsapp'); ?>" method="post" id="whatsappForm" class="tab-content hidden genform" style="display:none">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
			<input type="hidden" name="userid" value="<?php echo $this->session->userdata('mr_id'); ?>" class="userid">

            <div class="space-y-md mt-4">
                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Platform</label>
                    <div class="flex gap-2">
                        <select name="forwhpplatform" id="platforms" platformTab="whp" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" required>
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
                        <button type="button" class="w-10 h-10 bg-primary-container text-on-primary-container rounded-lg flex items-center justify-center addwebmodal_btn hover:bg-primary hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs phonelabel">Whatsapp Number</label>
                    <div class="flex gap-2">
                        <div class="w-12 bg-surface-container-high rounded-lg flex items-center justify-center font-medium border border-outline-variant/30">+91</div>
                        <input type="number" name="whpMobile" class="flex-1 bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary whpMobile" placeholder="Whatsapp number" required>
                    </div>
                    <span class="e_whpMobile text-error text-sm mt-1" style="display:none">Invalid mobile length</span>
                </div>

                <div>
                    <label class="block font-label-md text-on-surface-variant mb-xs">Body</label>
                    <textarea class="w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary whpbdy" rows="6" name="whpbdy" required></textarea>
                </div>
            </div>

            <div class="mt-lg flex justify-end">
                <button class="px-6 py-2 bg-primary text-on-primary font-label-md rounded-lg shadow-md hover:shadow-lg transition-all whp_sendBtn" type="button">Share</button>
            </div>
        </form>
    </div>
</div>
</div>
</main>

<!-- Modals -->
<div class="emailmodal modal-overlay">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-sm mx-4 transform transition-all relative">
        <button class="absolute top-4 right-4 text-outline hover:text-error transition-colors" onclick="$('.emailmodal').removeClass('modal-active')">
            <span class="material-symbols-outlined">close</span>
        </button>
        <h3 class="font-headline-md text-body-lg font-bold mb-2">Import Emails</h3>
        <p class="font-caption text-outline mb-4">CSV must have header of only "Email"</p>
        
        <form enctype="multipart/form-data" method="post" id="emailForm_csvUpload">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
            <input type="file" name="email_csv_file" id="email_csv_file" accept=".csv" class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-container file:text-primary hover:file:bg-primary/20 mb-6 border border-outline-variant/30">
            <div class="flex justify-end">
                <button class="px-4 py-2 bg-primary text-on-primary rounded-lg font-medium email_SendMultipleBtn" type="submit">Import CSV</button>
            </div>
        </form>
    </div>
</div>

<div class="smsmodal modal-overlay">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-sm mx-4 transform transition-all relative">
        <button class="absolute top-4 right-4 text-outline hover:text-error transition-colors" onclick="$('.smsmodal').removeClass('modal-active')">
            <span class="material-symbols-outlined">close</span>
        </button>
        <h3 class="font-headline-md text-body-lg font-bold mb-2">Import SMS</h3>
        <p class="font-caption text-outline mb-4">CSV must have header of only "Phonenumber"</p>
        
        <form enctype="multipart/form-data" method="post" id="smsForm_csvUpload">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" class="csrf_hash">
            <input type="file" name="sms_csv_file" id="sms_csv_file" accept=".csv" class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-container file:text-primary hover:file:bg-primary/20 mb-6 border border-outline-variant/30">
            <div class="flex justify-end">
                <button class="px-4 py-2 bg-primary text-on-primary rounded-lg font-medium sms_SendMultipleBtn" type="submit">Import CSV</button>
            </div>
        </form>
    </div>
</div>

<div class="add_web_modal modal-overlay">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-md mx-4 transform transition-all relative">
        <button class="absolute top-4 right-4 text-outline hover:text-error transition-colors closewebmodal_btn">
            <span class="material-symbols-outlined">close</span>
        </button>
        <h3 class="font-headline-md text-body-lg font-bold mb-4">Add Platform</h3>
        
        <form method="post" action="<?php echo base_url("user/user_new_website") ?>" class="add_web_modal_form space-y-4">
            <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            
            <div>
                <label class="block font-label-md text-on-surface-variant mb-1">Platform Name</label>
                <input type="text" name="web_name_new" class="web_name_new w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" placeholder="Platform Name" required>
                <div class="text-error text-sm mt-1 web_name_err" style="display:none"></div>
            </div>
            
            <div>
                <label class="block font-label-md text-on-surface-variant mb-1">Platform Link</label>
                <input type="url" name="web_link_new" class="web_link_new w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" placeholder="e.g https://domainname.com" required>
                <div class="text-error text-sm mt-1 web_link_err" style="display:none"></div>
            </div>
            
            <div>
                <label class="block font-label-md text-on-surface-variant mb-1">Subject</label>
                <input type="text" name="web_subject_new" class="web_subject_new w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" placeholder="Subject">
            </div>
            
            <div>
                <label class="block font-label-md text-on-surface-variant mb-1">Description</label>
                <textarea name="web_desc_new" class="web_desc_new w-full bg-surface-subtle border border-outline-variant/30 rounded-lg py-2 px-3 font-body-md focus:ring-2 focus:ring-primary" rows="3"></textarea>
            </div>
            
            <div class="flex justify-end pt-2">
                <button type="submit" class="px-6 py-2 bg-primary text-on-primary rounded-lg font-medium add_web_modal_btn">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTab(tabId, btn) {
        $('.tab-content').hide();
        $('#' + tabId).fadeIn();
        $('.tab-btn').removeClass('text-primary border-primary').addClass('text-on-surface-variant border-transparent');
        $(btn).removeClass('text-on-surface-variant border-transparent').addClass('text-primary border-primary');
    }

    $.fn.modal = function(action) {
        if (action === 'show') {
            this.addClass('modal-active');
        } else if (action === 'hide') {
            this.removeClass('modal-active');
        }
    };
    
    $(document).ready(function() {
        $('#mobile-menu-toggle').click(function(e){
            e.stopPropagation();
            $('#sidebar').toggleClass('-translate-x-full');
        });
        $(document).click(function(e){
            if (!$(e.target).closest('#sidebar, #mobile-menu-toggle').length) {
                $('#sidebar').addClass('-translate-x-full');
            }
        });
    });
</script>

"""

with open(r'd:\bizorm\application\views\users\share.php', 'r', encoding='utf-8') as f:
    share_lines = f.readlines()

js_script = "".join(share_lines[295:]) # index 295 is line 296

# Also need to close body and html at the very end.
closing_tags = "\n</body></html>"

final_content = header_html + main_body + js_script + closing_tags

with open(r'd:\bizorm\application\views\users\share.php', 'w', encoding='utf-8') as f:
    f.write(final_content)

print("Done replacing.")
