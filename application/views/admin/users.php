<?php $this->load->view('templates/tw_header'); ?>
<div class="p-6 md:p-8 max-w-[1200px] mx-auto w-full">
    
    <!-- Alerts -->
    <div id="ajax_succ_div" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 hidden">
        <span class="block sm:inline" id="ajax_res_succ"></span>
    </div>
    <div id="ajax_err_div" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 hidden">
        <span class="block sm:inline" id="ajax_res_err"></span>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-display font-bold text-gray-900">Manage Users</h2>
            <p class="text-sm text-gray-500 mt-1">View and manage all registered accounts on the platform.</p>
        </div>
        <button onclick="openAddUserModal()" class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-all text-sm font-medium whitespace-nowrap">
            <span class="material-symbols-outlined text-[18px]">add</span> Create User
        </button>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-700 font-medium border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Role & Company</th>
                        <th class="px-6 py-4">Status</th>
                        <?php if ($this->session->userdata('mr_sadmin') == '1'): ?>
                        <th class="px-6 py-4">Subscription</th>
                        <?php endif; ?>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php 
                    $users = ($this->session->userdata('mr_sadmin') === "1" || $this->session->userdata('mr_sadmin') == 1) ? $allusers : $adminusers;
                    if ($users->num_rows() > 0):
                        foreach ($users->result() as $user): 
                            $name = (!empty($user->fname) || !empty($user->lname)) ? $user->fname . " " . $user->lname : $user->uname;
                    ?>
                    <tr class="hover:bg-gray-50 transition-colors user-row" id="row_<?php echo $user->id; ?>">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                    <?php echo strtoupper(substr($name, 0, 1)); ?>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800"><?php echo $name; ?></p>
                                    <p class="text-xs text-gray-500"><?php echo isset($user->email) ? $user->email : $user->uname; ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($user->sadmin == '1'): ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-purple-50 text-purple-700 text-xs font-semibold border border-purple-200">System Admin</span>
                            <?php elseif ($user->admin == '1' && $user->iscmpy == '1'): ?>
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-blue-50 text-blue-700 text-xs font-semibold border border-blue-200">Company Admin</span>
                                    <p class="text-xs text-gray-500 mt-1 truncate max-w-[150px]" title="<?php echo $user->cmpy; ?>"><?php echo !empty($user->cmpy) ? $user->cmpy : 'Independent'; ?></p>
                                </div>
                            <?php elseif ($user->iscmpy == '1'): ?>
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-gray-50 text-gray-700 text-xs font-semibold border border-gray-200">Staff</span>
                                    <p class="text-xs text-gray-500 mt-1 truncate max-w-[150px]" title="<?php echo $user->cmpy; ?>"><?php echo $user->cmpy; ?></p>
                                </div>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-gray-50 text-gray-700 text-xs font-semibold border border-gray-200">Standard User</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($user->active == '1'): ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-50 text-green-700 text-xs font-medium border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Verified
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-medium border border-yellow-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Unverified
                                </span>
                            <?php endif; ?>
                        </td>
                        <?php if ($this->session->userdata('mr_sadmin') == '1'): ?>
                        <td class="px-6 py-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer toggle-sub" data-id="<?php echo $user->id; ?>" data-formkey="<?php echo $user->form_key; ?>" <?php echo $user->sub == '1' ? 'checked' : ''; ?>>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                            </label>
                        </td>
                        <?php endif; ?>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <input type="hidden" id="link_<?php echo $user->id; ?>" value="<?php echo base_url('wtr/') . $user->form_key; ?>">
                                <button class="p-2 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors copy-link-btn" data-id="<?php echo $user->id; ?>" title="Copy Link">
                                    <span class="material-symbols-outlined text-[20px]">content_copy</span>
                                </button>
                                <button class="p-2 text-gray-500 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-colors gen-qr-btn" data-id="<?php echo $user->id; ?>" data-formkey="<?php echo $user->form_key; ?>" title="QR Code">
                                    <span class="material-symbols-outlined text-[20px]">qr_code_2</span>
                                </button>
                                <button class="p-2 text-gray-500 hover:text-primary hover:bg-blue-50 rounded-lg transition-colors edit-user-btn" data-id="<?php echo $user->id; ?>" data-formkey="<?php echo $user->form_key; ?>" title="Edit User">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors delete-user-btn" data-id="<?php echo $user->id; ?>" data-formkey="<?php echo $user->form_key; ?>" title="Delete User">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        endforeach; 
                    else:
                    ?>
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">No users found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add User Modal (Slide-over) -->
<div id="addUserModal" class="hidden fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm transition-opacity">
    <div class="fixed inset-y-0 right-0 w-full max-w-md bg-white shadow-2xl transform transition-transform translate-x-full duration-300 flex flex-col" id="addUserSlide">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-display font-bold text-gray-900">Create User</h3>
                <p class="text-sm text-gray-500 mt-1">Add a new user to your company.</p>
            </div>
            <button onclick="closeAddUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <div class="p-6 overflow-y-auto flex-1">
            <form id="addUserForm" action="<?php echo base_url('admin-add-user'); ?>" method="post">
                <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                        <input type="text" name="fname" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                        <input type="text" name="lname" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">E-mail <span class="text-red-500">*</span></label>
                    <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mobile <span class="text-red-500">*</span></label>
                    <div class="flex">
                        <span class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm font-bold">+91</span>
                        <input type="number" name="mobile" required class="flex-1 min-w-0 block w-full px-4 py-2 rounded-none rounded-r-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                    <input type="text" name="uname" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Unique username">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="pwd" required minlength="6" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Min. 6 characters">
                </div>

                <div class="mb-6 bg-blue-50 p-4 rounded-lg border border-blue-100 flex items-start gap-3">
                    <input type="checkbox" name="logincred" id="logincred" class="mt-1 w-4 h-4 text-primary bg-white border-gray-300 rounded focus:ring-primary" checked>
                    <label for="logincred" class="text-sm text-blue-800 font-medium">Send login credentials to user via email</label>
                </div>
                
                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="closeAddUserModal()" class="px-4 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white hover:bg-blue-700 rounded-lg font-semibold transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">person_add</span> Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit User Modal (Slide-over) -->
<div id="editUserModal" class="hidden fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm transition-opacity">
    <div class="fixed inset-y-0 right-0 w-full max-w-md bg-white shadow-2xl transform transition-transform translate-x-full duration-300 flex flex-col" id="editUserSlide">
        <div class="flex items-center justify-between p-6 border-b border-gray-100 relative">
            
            <div id="editUserLoader" class="absolute inset-0 bg-white/80 z-10 flex items-center justify-center hidden">
                <span class="material-symbols-outlined animate-spin text-primary text-3xl">refresh</span>
            </div>

            <div>
                <h3 class="text-xl font-display font-bold text-gray-900">Edit User</h3>
                <p class="text-sm text-gray-500 mt-1">Update user profile information.</p>
            </div>
            <button onclick="closeEditUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <div class="p-6 overflow-y-auto flex-1 relative">
            <form id="editUserForm">
                <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="user_id" id="edit_user_id">
                <input type="hidden" name="form_key" id="edit_form_key">
                <input type="hidden" name="uname" id="edit_uname">
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                        <input type="text" name="fname" id="edit_fname" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                        <input type="text" name="lname" id="edit_lname" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">E-mail <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="edit_email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mobile</label>
                    <input type="text" name="mobile" id="edit_mobile" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                </div>

                <input type="hidden" name="gender" id="edit_gender">
                <input type="hidden" name="dob" id="edit_dob">
                <input type="hidden" name="url" id="edit_url">
                
                <div class="pt-4 mt-6 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="closeEditUserModal()" class="px-4 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white hover:bg-blue-700 rounded-lg font-semibold transition-colors flex items-center gap-2" id="saveEditBtn">
                        <span class="material-symbols-outlined text-[18px]">save</span> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- QR Modal -->
<div id="qrModal" class="hidden fixed inset-0 z-[100] bg-black/50 items-center justify-center backdrop-blur-sm">
    <div class="bg-surface-container-lowest p-lg rounded-xl shadow-xl w-full max-w-sm mx-4 transform transition-all relative" style="background-color: white; padding: 1.5rem; border-radius: 0.75rem;">
        <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors" onclick="closeQrModal()">
            <span class="material-symbols-outlined">close</span>
        </button>
        <h3 class="text-xl font-display font-bold text-gray-900 mb-4 text-center">QR Code</h3>
        <div id="qrcode" class="flex justify-center mb-6"></div>
        <div class="downloadqrcode text-center"></div>
    </div>
</div>

<?php $this->load->view('templates/tw_footer'); ?>
<script>
function openAddUserModal() {
    $('#addUserModal').removeClass('hidden').addClass('flex');
    setTimeout(() => {
        $('#addUserSlide').removeClass('translate-x-full');
    }, 10);
}

function closeAddUserModal() {
    $('#addUserSlide').addClass('translate-x-full');
    setTimeout(() => {
        $('#addUserModal').addClass('hidden').removeClass('flex');
    }, 300);
}

$(document).ready(function() {
    // Check URL params for errors/success
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab') === 'add') {
        openAddUserModal();
    }

    // Toggle Subscription
    $('.toggle-sub').change(function() {
        var isChecked = $(this).is(':checked');
        var formkey = $(this).data('formkey');
        var sub_id = $(this).data('id');
        var csrfName = $('.csrf_token').first().attr('name');
        var csrfHash = $('.csrf_token').first().val();
        
        var mod = isChecked ? 'active' : 'not_active';
        var sub_val = isChecked ? '1' : '0';

        $.ajax({
            method: "post",
            url: "<?php echo base_url('user-subscription'); ?>",
            data: { mod: mod, sub: sub_val, sub_id: sub_id, form_key: formkey, [csrfName]: csrfHash },
            dataType: "json",
            success: function(data) {
                $('.csrf_token').val(data.token);
                if (data.status === true) {
                    $('#ajax_res_succ').text(data.msg);
                    $('#ajax_succ_div').fadeIn().delay(3000).fadeOut();
                } else {
                    $('#ajax_res_err').text(data.msg);
                    $('#ajax_err_div').fadeIn().delay(3000).fadeOut();
                }
            }
        });
    });

    // QR Modal logic
    function closeQrModal() {
        $('#qrModal').addClass('hidden').removeClass('flex');
        $('#qrcode').empty();
        $('.downloadqrcode').empty();
    }
    window.closeQrModal = closeQrModal;

    $(document).on('click', '.copy-link-btn', function(e) {
        e.preventDefault();
        var userId = $(this).data('id');
        var linkVal = $('#link_' + userId).val();
        
        if (navigator.clipboard) {
            navigator.clipboard.writeText(linkVal).then(function() {
                $('#ajax_res_succ').text('Link copied to clipboard!');
                $('#ajax_succ_div').fadeIn().delay(3000).fadeOut();
            });
        } else {
            // fallback
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(linkVal).select();
            document.execCommand("copy");
            $temp.remove();
            $('#ajax_res_succ').text('Link copied to clipboard!');
            $('#ajax_succ_div').fadeIn().delay(3000).fadeOut();
        }
    });

    $(document).on('click', '.gen-qr-btn', function(e) {
        e.preventDefault();
        var csrfName = $('.csrf_token').first().attr('name');
        var csrfHash = $('.csrf_token').first().val();
        var id = $(this).data('id');
        var form_key = $(this).data('formkey');
        var link = $('#link_' + id).val();

        $.ajax({
            url: "<?php echo base_url('generate-qr-code') ?>",
            method: "post",
            dataType: 'json',
            data: { [csrfName]: csrfHash, id: id, form_key: form_key, link: link },
            success: function(data) {
                if (data.status === false) {
                    $("#ajax_res_err").html(data.msg);
                    $("#ajax_err_div").fadeIn().delay(3000).fadeOut();
                } else if (data.status === 'error') {
                    window.location.assign(data.redirect);
                } else if (data.status === true) {
                    $('#qrcode').html('<img src="' + data.qr + '" class="rounded-lg shadow-sm">');
                    $('.downloadqrcode').html('<a href="<?php echo base_url('download-qr-code') ?>?fp=' + data.qr + '&fn='+data.qrfileName+'" class="inline-flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition-all"><span class="material-symbols-outlined">download</span> Download</a>');
                    $('#qrModal').removeClass('hidden').addClass('flex');
                }
                
                // Update CSRF tokens
                $('.csrf_token').val(data.token);
            },
            error: function() {
                $('#ajax_res_err').text('Server error while generating QR.');
                $('#ajax_err_div').fadeIn().delay(3000).fadeOut();
            }
        });
    });

    // Delete User
    $('.delete-user-btn').click(function() {
        if (!confirm('Are you sure you want to delete this user? This action cannot be undone.')) return;
        
        var btn = $(this);
        var user_id = btn.data('id');
        var form_key = btn.data('formkey');
        var csrfName = $('.csrf_token').first().attr('name');
        var csrfHash = $('.csrf_token').first().val();
        
        btn.html('<span class="material-symbols-outlined text-[20px] animate-spin">refresh</span>').attr('disabled', true);

        $.ajax({
            method: "post",
            url: "<?php echo base_url('delete-user'); ?>",
            data: { user_id: user_id, form_key: form_key, [csrfName]: csrfHash },
            dataType: "json",
            success: function(data) {
                $('.csrf_token').val(data.token);
                if (data.status === true) {
                    $('#row_' + user_id).fadeOut(300, function() { $(this).remove(); });
                    $('#ajax_res_succ').text(data.msg);
                    $('#ajax_succ_div').fadeIn().delay(3000).fadeOut();
                } else {
                    btn.html('<span class="material-symbols-outlined text-[20px]">delete</span>').attr('disabled', false);
                    $('#ajax_res_err').text(data.msg);
                    $('#ajax_err_div').fadeIn().delay(3000).fadeOut();
                }
            }
        });
    });

    // Edit User - Placeholder for now as per instructions it just needs the button
    
    function closeEditUserModal() {
        $('#editUserSlide').addClass('translate-x-full');
        setTimeout(() => {
            $('#editUserModal').addClass('hidden').removeClass('flex');
        }, 300);
    }
    window.closeEditUserModal = closeEditUserModal;

    $('.edit-user-btn').click(function(e) {
        e.preventDefault();
        var user_id = $(this).data('id');
        var form_key = $(this).data('formkey');
        var iscmpy = $(this).data('iscmpy') || '0';
        var cmpyid = $(this).data('cmpyid') || '0';
        var csrfName = $('.csrf_token').first().attr('name');
        var csrfHash = $('.csrf_token').first().val();
        
        $('#editUserModal').removeClass('hidden').addClass('flex');
        $('#editUserLoader').removeClass('hidden');
        $('#editUserForm')[0].reset();
        
        setTimeout(() => {
            $('#editUserSlide').removeClass('translate-x-full');
        }, 10);

        $.ajax({
            url: "<?php echo base_url('admin-view-user'); ?>",
            method: "post",
            dataType: "json",
            data: {
                [csrfName]: csrfHash,
                user_id: user_id,
                form_key: form_key,
                iscmpy: iscmpy,
                cmpyid: cmpyid
            },
            success: function(res) {
                $('.csrf_token').val(res.token);
                if (res.status === true) {
                    $('#edit_user_id').val(res.uinfos.id);
                    $('#edit_form_key').val(res.uinfos.form_key);
                    $('#edit_fname').val(res.uinfos.fname);
                    $('#edit_lname').val(res.uinfos.lname);
                    $('#edit_email').val(res.uinfos.email);
                    $('#edit_mobile').val(res.uinfos.mobile);
                    $('#edit_uname').val(res.uinfos.uname);
                    $('#edit_gender').val(res.uinfos.gender || '');
                    $('#edit_dob').val(res.uinfos.dob || '');
                    $('#edit_url').val(res.uinfos.url || '');
                    
                    $('#editUserLoader').addClass('hidden');
                } else {
                    closeEditUserModal();
                    $('#ajax_res_err').text(res.msg || 'Failed to load user.');
                    $('#ajax_err_div').fadeIn().delay(3000).fadeOut();
                }
            },
            error: function() {
                closeEditUserModal();
                $('#ajax_res_err').text('Server error while loading user.');
                $('#ajax_err_div').fadeIn().delay(3000).fadeOut();
            }
        });
    });

    $('#editUserForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var csrfName = $('.csrf_token').first().attr('name');
        var csrfHash = $('.csrf_token').first().val();
        
        // Make sure token is updated in serialized string if multiple tokens exist
        formData = formData.replace(new RegExp(csrfName + '=[^&]+'), csrfName + '=' + csrfHash);
        
        $('#saveEditBtn').html('<span class="material-symbols-outlined animate-spin text-[18px]">refresh</span> Saving...').attr('disabled', true);

        $.ajax({
            url: "<?php echo base_url('admin/updateprofile'); ?>",
            method: "post",
            dataType: "json",
            data: formData,
            success: function(res) {
                $('.csrf_token').val(res.token);
                $('#saveEditBtn').html('<span class="material-symbols-outlined text-[18px]">save</span> Save Changes').attr('disabled', false);
                
                if (res.status === true) {
                    closeEditUserModal();
                    $('#ajax_res_succ').text(res.msg);
                    $('#ajax_succ_div').fadeIn().delay(3000).fadeOut();
                    
                    // Update DOM (Name and email)
                    var fullName = ($('#edit_fname').val() + ' ' + $('#edit_lname').val()).trim() || $('#edit_uname').val();
                    var userEmail = $('#edit_email').val();
                    
                    $('#row_' + $('#edit_user_id').val() + ' td:first-child p.font-bold').text(fullName);
                    $('#row_' + $('#edit_user_id').val() + ' td:first-child p.text-gray-500').text(userEmail);
                } else {
                    $('#ajax_res_err').text(res.msg);
                    $('#ajax_err_div').fadeIn().delay(3000).fadeOut();
                }
            },
            error: function() {
                $('#saveEditBtn').html('<span class="material-symbols-outlined text-[18px]">save</span> Save Changes').attr('disabled', false);
                $('#ajax_res_err').text('Server error while updating user.');
                $('#ajax_err_div').fadeIn().delay(3000).fadeOut();
            }
        });
    });

});
</script>
</body>
</html>
