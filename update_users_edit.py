import os
import re

file_path = 'application/views/admin/users.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Add the Edit User Modal before tw_footer
edit_modal = """
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
"""
content = content.replace("<?php $this->load->view('templates/tw_footer'); ?>", edit_modal + "\n<?php $this->load->view('templates/tw_footer'); ?>")

# Replace placeholder edit script
edit_placeholder = r"\$\('\.edit-user-btn'\)\.click\(function\(\) \{\s*alert\('Edit functionality goes here!'\);\s*\}\);"

edit_js = """
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
"""

content = re.sub(edit_placeholder, edit_js, content)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Updated users.php edit functionality")
