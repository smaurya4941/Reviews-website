<?php $this->load->view('templates/tw_header'); ?>


    <div class="p-6 md:p-8 max-w-4xl mx-auto w-full">
        <!-- Alerts -->
        <div class="ajax_succ_div bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 hidden">
            <span class="block sm:inline ajax_res_succ"></span>
        </div>
        <div class="ajax_err_div bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 hidden">
            <span class="block sm:inline ajax_res_err"></span>
        </div>

        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Account Settings</h2>
                <p class="text-sm text-gray-500 mt-1">Manage your personal information and security preferences.</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="flex border-b border-gray-100 bg-gray-50/50">
                <button class="tab-btn active px-6 py-4 text-sm font-semibold text-primary border-b-2 border-primary outline-none" data-target="#profile">Profile</button>
                <button class="tab-btn px-6 py-4 text-sm font-semibold text-gray-500 hover:text-gray-700 border-b-2 border-transparent outline-none" data-target="#security">Security</button>
                <?php if ($this->session->userdata("mr_sadmin") === "0" && $this->session->userdata("mr_admin") === "0") : ?>
                <button class="tab-btn px-6 py-4 text-sm font-semibold text-red-500 hover:text-red-700 border-b-2 border-transparent outline-none ml-auto" data-target="#danger">Danger Zone</button>
                <?php endif; ?>
            </div>

            <!-- Profile Tab -->
            <div id="profile" class="tab-content active p-6">
                <form action="<?php echo base_url('profile-edit'); ?>" method="post" id="profileForm" class="space-y-6">
                    <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                            <input type="text" name="fname" class="fname w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary outline-none transition-all" value="<?php echo $user_info->fname ?>" placeholder="First Name">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="lname" class="lname w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary outline-none transition-all" value="<?php echo $user_info->lname ?>" placeholder="Last Name">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" class="email w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary outline-none transition-all" value="<?php echo $user_info->email ?>" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mobile *</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm font-medium">+91</span>
                            <input type="number" name="mobile" class="mobile w-full border border-gray-300 rounded-r-lg p-2.5 text-sm focus:ring-2 focus:ring-primary outline-none transition-all" value="<?php echo $user_info->mobile ?>" required>
                        </div>
                        <div class="text-red-500 text-xs mt-1 mobileerr hidden">Invalid mobile length</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Gender</label>
                            <select name="gender" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary outline-none transition-all">
                                <option value=""></option>
                                <option value="Male" <?php echo ($user_info->gender === 'Male') ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?php echo ($user_info->gender === 'Female') ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?php echo ($user_info->gender === 'Other') ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Birth</label>
                            <input type="date" name="dob" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary outline-none transition-all" value="<?php echo $user_info->dob ?>">
                        </div>
                    </div>

                    <?php if ($this->session->userdata('mr_iscmpy') === "1") : ?>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Company</label>
                        <input type="text" name="uname" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm bg-gray-50 text-gray-500 cursor-not-allowed outline-none" value="<?php echo $user_info->cmpy ?>" readonly>
                    </div>
                    <?php endif; ?>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Your Share Link</label>
                        <div class="flex">
                            <input type="text" id="linkshare" class="w-full border border-gray-300 rounded-l-lg p-2.5 text-sm bg-gray-50 text-gray-500 outline-none" value="<?php echo base_url("wtr/") . $user_info->form_key ?>" readonly>
                            <button type="button" class="px-4 py-2 border border-l-0 border-gray-300 bg-gray-50 hover:bg-gray-100 text-gray-600 transition-colors" onclick="copylink_fun('#linkshare')" title="Copy Link">
                                <span class="material-symbols-outlined text-lg">content_copy</span>
                            </button>
                        </div>
                        <span class="text-green-500 text-xs mt-1 linkcopyalert hidden">Link copied to clipboard!</span>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="save_pinfo_btn px-6 py-2 bg-primary text-white font-medium rounded-lg shadow hover:bg-blue-700 transition-all">Save Profile</button>
                    </div>
                </form>
            </div>

            <!-- Security Tab -->
            <div id="security" class="tab-content p-6">
                <form action="<?php echo base_url('password-update'); ?>" method="post" id="pwdForm" class="space-y-6 max-w-lg">
                    <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Current Password *</label>
                        <input type="password" name="c_pwd" class="c_pwd w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary outline-none transition-all" required>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">New Password *</label>
                        <input type="password" name="n_pwd" class="n_pwd w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary outline-none transition-all" placeholder="Min 6 characters" required>
                        <span class="text-red-500 text-xs mt-1 n_pwd_err hidden">Password is too short</span>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Re-type Password *</label>
                        <input type="password" name="rtn_pwd" class="rtn_pwd w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-primary outline-none transition-all" required>
                        <span class="text-red-500 text-xs mt-1 rtn_pwd_err hidden">Passwords do not match</span>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                        <button type="button" class="pwd_f text-sm text-red-500 hover:text-red-700 font-medium transition-colors" user_id="<?php echo $user_info->id ?>">Forgot Password?</button>
                        <button type="submit" class="saveact_btn px-6 py-2 bg-primary text-white font-medium rounded-lg shadow hover:bg-blue-700 transition-all">Update Password</button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone -->
            <?php if ($this->session->userdata("mr_sadmin") === "0" && $this->session->userdata("mr_admin") === "0") : ?>
            <div id="danger" class="tab-content p-6">
                <div class="border border-red-200 bg-red-50 rounded-lg p-6 max-w-lg">
                    <h3 class="text-red-800 font-bold mb-2">Deactivate Account</h3>
                    <p class="text-red-600 text-sm mb-6">Once you deactivate your account, you will be logged out and your data will be suspended. This action cannot be easily undone.</p>
                    <button type="button" class="deact_btn px-6 py-2 bg-red-600 text-white font-medium rounded-lg shadow hover:bg-red-700 transition-all" user_id="<?php echo $user_info->id ?>">Deactivate My Account</button>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php $this->load->view('templates/tw_footer'); ?>
