import re

file_path = 'application/views/users/platforms.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Fix the buttons inside the loop to have remove button
old_buttons = r'<button class="viewweb_btn[^>]+>\s*<span[^>]+>edit</span>\s*</button>'
new_buttons = """
<button class="remove_web_btn p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" web_id="<?php echo $web['id'] ?>" web_name="<?php echo $web['web_name'] ?>" web_link="<?php echo $web['web_link'] ?>" title="Remove Platform">
    <span class="material-symbols-outlined text-[20px]">delete</span>
</button>
"""
content = re.sub(old_buttons, new_buttons, content)

# Append Modal and JS before tw_footer
modal_and_js = """
    <!-- Add Platform Modal -->
    <div id="addPlatformModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center backdrop-blur-sm">
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-xl w-full max-w-md mx-4 relative">
            <button class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors close_modal_btn">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-xl font-display font-bold text-gray-800 mb-4">Add New Platform</h3>
            
            <form id="addPlatformForm">
                <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Platform Name</label>
                    <input type="text" name="web_name" class="web_name w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="e.g. Google Maps" required>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Platform Link</label>
                    <div class="text-red-500 text-xs mb-1 hidden web_link_err"></div>
                    <input type="url" name="web_link" class="web_link w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="e.g. https://g.page/..." required>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" class="px-4 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition-colors close_modal_btn">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white hover:bg-blue-700 rounded-lg font-semibold transition-colors flex items-center gap-2" id="submitPlatformBtn">
                        <span class="material-symbols-outlined text-[18px]">save</span> Save Platform
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
$(document).ready(function() {
    getUserQuota();

    function getUserQuota() {
        var csrfName = $('.csrf_token').first().attr('name');
        var csrfHash = $('.csrf_token').first().val();

        $.ajax({
            url: "<?php echo base_url('get-user-quota'); ?>",
            method: "post",
            data: { [csrfName]: csrfHash },
            dataType: "json",
            success: function(data) {
                $('.csrf_token').val(data.token);

                if (data.status === true) {
                    if (parseInt(data.userQuota.web_quota) <= 0) {
                        $(".addwebmodal_btn").addClass('hidden').removeClass('flex');
                    } else if (parseInt(data.userQuota.web_quota) > 0) {
                        $(".addwebmodal_btn").removeClass('hidden').addClass('flex');
                    }
                    $(".webspaceleft").text(data.userQuota.web_quota);
                } else if (data.status == "error" || data.status == false) {
                    window.location.assign(data.redirect);
                }
            },
            error: function(data) {
                if(data.redirect) window.location.assign(data.redirect);
            }
        });
    }

    $('.addwebmodal_btn').click(function(e) {
        e.preventDefault();
        $('#addPlatformModal').removeClass('hidden').addClass('flex');
        $('.ajax_succ_div, .ajax_err_div').hide();
    });

    $('.close_modal_btn').click(function(e) {
        e.preventDefault();
        $('#addPlatformModal').addClass('hidden').removeClass('flex');
        $('.web_name, .web_link').val('');
        $('.web_link').removeClass('border-red-500');
        $('.web_name').removeClass('border-red-500');
        $('.web_link_err').hide();
    });

    $('#addPlatformForm').submit(function(e) {
        e.preventDefault();
        
        var csrfName = $('.csrf_token').first().attr('name');
        var csrfHash = $('.csrf_token').first().val();
        var web_name = $('.web_name').val().trim();
        var web_link = $('.web_link').val().trim();
        
        if (web_name == "") {
            $('.web_name').addClass('border-red-500');
            return false;
        } else {
            $('.web_name').removeClass('border-red-500');
        }
        
        if (web_link == "") {
            $('.web_link').addClass('border-red-500');
            return false;
        }
        
        var patt = new RegExp('^(https?:\\\\/\\\\/)?' + 
            '((([a-z\\\\d]([a-z\\\\d-]*[a-z\\\\d])*)\\\\.?)+[a-z]{2,}|' + 
            '((\\\\d{1,3}\\\\.){3}\\\\d{1,3}))' + 
            '(\\\\:\\\\d+)?(\\\\/[-a-z\\\\d%_.~+]*)*' + 
            '(\\\\?[;&a-z\\\\d%_.~+=-]*)?' + 
            '(\\\\#[-a-z\\\\d_]*)?$', 'i');
        
        if (patt.test(web_link)) {
            $(".web_link_err").hide();
            $('.web_link').removeClass('border-red-500');
        } else {
            $('.web_link').addClass('border-red-500');
            $(".web_link_err").text("Invalid WEB URL").show();
            return false;
        }

        $('#submitPlatformBtn').html('Saving...').attr('disabled', true).addClass('opacity-50 cursor-not-allowed');

        $.ajax({
            method: "post",
            url: "<?php echo base_url('add-website') ?>",
            data: { web_name: web_name, web_link: web_link, [csrfName]: csrfHash },
            dataType: "json",
            success: function(data) {
                $('.csrf_token').val(data.token);
                $('#submitPlatformBtn').html('<span class="material-symbols-outlined text-[18px]">save</span> Save Platform').attr('disabled', false).removeClass('opacity-50 cursor-not-allowed');

                if (data.status === true) {
                    $(".ajax_err_div").hide();
                    $('.ajax_res_succ').html(data.msg);
                    $('.ajax_succ_div').fadeIn().delay(3000).fadeOut();
                    
                    $('.noweb').remove();

                    let newHtml = `
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100 eachwebinfo" id="web_${data.webID}">
                            <div class="flex items-center gap-4 flex-1">
                                <div class="w-2 h-2 rounded-full bg-green-500 shadow-sm"></div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-800 text-sm mb-1">${web_name}</h4>
                                    <a href="${web_link}" target="_blank" class="text-xs text-blue-500 hover:underline">${web_link}</a>
                                </div>
                            </div>
                            <div>
                                <button class="remove_web_btn p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" web_id="${data.webID}" web_name="${web_name}" web_link="${web_link}" title="Remove Platform">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </div>
                    `;
                    $("#eachwebwrapper").append(newHtml);
                    
                    $('.close_modal_btn').click();
                    getUserQuota();
                } else if (data.status == false) {
                    $('.close_modal_btn').click();
                    $(".ajax_succ_div").hide();
                    $('.ajax_res_err').html(data.msg);
                    $('.ajax_err_div').fadeIn();
                } else if (data.status == "error") {
                    window.location.assign(data.redirect);
                }
            }
        });
    });

    $(document).on('click', '.remove_web_btn', function() {
        if(!confirm("Are you sure you want to remove this platform?")) return;
        
        var btn = $(this);
        var csrfName = $('.csrf_token').first().attr('name');
        var csrfHash = $('.csrf_token').first().val();
        var web_name = btn.attr("web_name");
        var web_link = btn.attr("web_link");
        var web_id = btn.attr("web_id");

        btn.html('<span class="material-symbols-outlined text-[20px] animate-spin">refresh</span>').attr('disabled', true);

        $.ajax({
            method: "post",
            url: "<?php echo base_url('remove-website') ?>",
            data: { web_name: web_name, web_link: web_link, web_id: web_id, [csrfName]: csrfHash },
            dataType: "json",
            success: function(data) {
                $('.csrf_token').val(data.token);

                if (data.status === true) {
                    $(".ajax_err_div").hide();
                    $('.ajax_res_succ').html(data.msg);
                    $('.ajax_succ_div').fadeIn().delay(3000).fadeOut();
                    
                    btn.closest('.eachwebinfo').remove();
                    
                    if ($('.eachwebinfo').length === 0) {
                        $("#eachwebwrapper").html('<p class="text-center py-8 text-gray-400 font-medium noweb">No platforms created yet.</p>');
                    }
                    getUserQuota();
                } else {
                    $(".ajax_succ_div").hide();
                    $('.ajax_res_err').html(data.msg);
                    $('.ajax_err_div').fadeIn();
                    btn.html('<span class="material-symbols-outlined text-[20px]">delete</span>').attr('disabled', false);
                }
            }
        });
    });
});
</script>
"""

content = content.replace("<?php $this->load->view('templates/tw_footer'); ?>", modal_and_js + "\n<?php $this->load->view('templates/tw_footer'); ?>")

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Updated platforms.php")
