<?php $this->load->view('templates/tw_header'); ?>
<style>
/* CSS Shims for legacy Forms */
.row { display: flex; flex-wrap: wrap; margin: -0.5rem; }
.col-md-6 { width: 50%; padding: 0.5rem; box-sizing: border-box; }
.form-group { margin-bottom: 1.25rem; width: 100%; position: relative; }
.form-group label { display: block; font-size: 0.8125rem; font-weight: 600; color: #334155; margin-bottom: 0.375rem; }
.form-group span { color: #64748b; font-size: 0.75rem; font-weight: 400; margin-left: 0.25rem; }
.form-control { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.8125rem; outline: none; transition: all 0.2s; }
.form-control:focus { border-color: #004ac6; box-shadow: 0 0 0 2px rgba(0, 74, 198, 0.2); }
hr { border: 0; border-top: 1px solid #e2e8f0; margin: 1.5rem 0; }
.btn { background: #004ac6; color: white; border: none; padding: 0.625rem 1.25rem; border-radius: 0.5rem; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 0.8125rem;}
.btn:hover { background: #003da8; }

.settings-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
.settings-card h5 { font-size: 1.125rem; font-weight: 600; color: #1e293b; margin: 0 0 1rem 0; font-family: 'Plus Jakarta Sans', sans-serif; }
.settings-card hr { margin: 1rem -1.5rem 1.5rem -1.5rem; }

@media (max-width: 768px) { .col-md-6 { width: 100%; } }
</style>

<div class="p-6 md:p-8 max-w-4xl mx-auto w-full">
    <div class="mb-6">
        <h2 class="text-2xl font-display font-bold text-gray-900">Platform Settings</h2>
        <p class="text-sm text-gray-500 mt-1">Configure global application settings, API keys, and email protocols.</p>
    </div>

    <!-- Alert Containers -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 shadow-sm">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-6 shadow-sm">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo base_url('save-settings') ?>" method="post" id="settingsForm" enctype="multipart/form-data">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" class="csrf_token">

        <!-- General Settings -->
        <div class="settings-card">
            <h5>General Settings</h5><hr>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="<?php echo $settings->site_name ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Site Title</label>
                    <input type="text" name="site_title" class="form-control" value="<?php echo $settings->site_title ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Site Description</label>
                    <textarea name="site_desc" class="form-control" cols="30" rows="3"><?php echo $settings->site_desc ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>Site Keywords</label>
                    <textarea name="site_keywords" class="form-control" cols="30" rows="3"><?php echo $settings->site_keywords ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Site Logo <span>(Max size: 2MB)</span></label>
                    <div class="flex items-center gap-3">
                        <img src="<?php echo base_url('assets/images/') . $settings->site_logo ?>" class="h-10 border rounded bg-gray-50" alt="Logo">
                        <input type="file" name="site_logo" class="form-control">
                        <input type="hidden" name="current_site_logo" value="<?php echo $settings->site_logo ?>">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Site Favicon <span>(Max size: 2MB)</span></label>
                    <div class="flex items-center gap-3">
                        <img src="<?php echo base_url('assets/images/') . $settings->site_fav_icon ?>" class="h-8 w-8 object-cover border rounded bg-gray-50" alt="Favicon">
                        <input type="file" name="site_fav_icon" class="form-control">
                        <input type="hidden" name="current_site_fav_icon" value="<?php echo $settings->site_fav_icon ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Settings -->
        <div class="settings-card">
            <h5>Razorpay Integration</h5><hr>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Key ID <span>(TEST)</span></label>
                    <input type="password" name="rz_test_key_id" class="form-control font-mono text-xs" value="<?php echo $settings->rz_test_key_id ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Secret Key <span>(TEST)</span></label>
                    <input type="password" name="rz_test_key_secret" class="form-control font-mono text-xs" value="<?php echo $settings->rz_test_key_secret ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Key ID <span>(LIVE)</span></label>
                    <input type="password" name="rz_live_key_id" class="form-control font-mono text-xs border-green-200 focus:border-green-500" value="<?php echo $settings->rz_live_key_id ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Secret Key <span>(LIVE)</span></label>
                    <input type="password" name="rz_live_key_secret" class="form-control font-mono text-xs border-green-200 focus:border-green-500" value="<?php echo $settings->rz_live_key_secret ?>">
                </div>
            </div>
        </div>

        <!-- Captcha Settings -->
        <div class="settings-card">
            <h5>Google reCAPTCHA v2</h5><hr>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Site Key <span class="text-red-500">*</span></label>
                    <input type="password" name="captcha_site_key" class="form-control font-mono text-xs" required value="<?php echo $settings->captcha_site_key ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Secret Key <span class="text-red-500">*</span></label>
                    <input type="password" name="captcha_secret_key" class="form-control font-mono text-xs" required value="<?php echo $settings->captcha_secret_key ?>">
                </div>
            </div>
        </div>

        <!-- SMTP Settings -->
        <div class="settings-card">
            <h5>Email Configuration (SMTP)</h5><hr>
            <div class="form-group">
                <label>Protocol</label>
                <input type="text" name="protocol" class="form-control" required value="<?php echo $settings->protocol ?>">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>SMTP Host</label>
                    <input type="text" name="smtp_host" class="form-control font-mono text-xs" value="<?php echo $settings->smtp_host ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>SMTP Port</label>
                    <input type="text" name="smtp_port" class="form-control font-mono text-xs" value="<?php echo $settings->smtp_port ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>SMTP User</label>
                    <input type="text" name="smtp_user" class="form-control" value="<?php echo $settings->smtp_user ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>SMTP Password</label>
                    <input type="password" name="smtp_pwd" class="form-control" value="<?php echo $settings->smtp_pwd ?>">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 sticky bottom-6 z-10 p-4 bg-white/90 backdrop-blur border border-gray-200 rounded-xl shadow-lg">
            <button class="btn saveSettingsBtn w-full md:w-auto px-8" type="submit">
                <span class="material-symbols-outlined" style="font-size:18px;">save</span> Save Settings
            </button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#settingsForm').submit(function(e) {
            var site_name = $('input[name="site_name"]').val();
            if (!site_name) return false;
            $('.saveSettingsBtn').attr('disabled', 'disabled').html('Saving...').addClass('opacity-50 cursor-not-allowed');
        });
    });
</script>
<?php $this->load->view('templates/tw_footer'); ?>