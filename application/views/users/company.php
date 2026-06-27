<?php $this->load->view('templates/tw_header'); ?>


    <div class="p-6 md:p-8 max-w-4xl mx-auto w-full">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Company Settings</h2>
                <p class="text-sm text-gray-500 mt-1">Manage your organization's details and branding.</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <form action="<?php echo base_url('company-edit'); ?>" enctype="multipart/form-data" method="post" id="cmpyForm" class="p-6 space-y-6">
                <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company Name *</label>
                    <input type="text" name="cmpyName" class="cmpyName w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" value="<?php echo $cmpyInfo->cmpyName ?? '' ?>" placeholder="Company Name" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company Email</label>
                    <input type="email" name="cmpyEmail" class="cmpyEmail w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" value="<?php echo $cmpyInfo->cmpyEmail ?? '' ?>" placeholder="example@domain.com">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Company Mobile</label>
                    <input type="number" name="cmpyMobile" class="cmpyMobile w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" value="<?php echo $cmpyInfo->cmpyMobile ?? '' ?>">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Company Logo</label>
                        <p class="text-xs text-gray-500 mb-2">Max size: 2MB. Recommended format: PNG, JPG.</p>
                        <input type="file" name="cmpyLogo" class="cmpyLogo w-full border border-gray-300 rounded-lg p-2 text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100 transition-all cursor-pointer">
                    </div>
                    <?php if($this->session->userdata('mr_cmpy_logo')): ?>
                    <div class="bg-gray-50 border border-gray-100 rounded-lg p-4 flex items-center justify-center">
                        <img src="<?php echo base_url('uploads/company/') . $this->session->userdata('mr_cmpy_logo'); ?>" alt="Company Logo" class="max-h-20 object-contain rounded">
                    </div>
                    <?php endif; ?>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-end">
                    <button class="save_cmpy_btn px-6 py-2 bg-primary text-white font-medium rounded-lg shadow hover:bg-blue-700 transition-all" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
<?php $this->load->view('templates/tw_footer'); ?>
