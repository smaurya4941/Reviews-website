<?php $this->load->view('templates/tw_header'); ?>
<style>
/* CSS Shims for legacy Bootstrap Grid and Forms */
.row { display: flex; flex-wrap: wrap; margin: -0.5rem; }
.col-md-6 { width: 50%; padding: 0.5rem; box-sizing: border-box; }
.form-group { margin-bottom: 1rem; width: 100%; position: relative; }
.form-group label { display: inline-block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 0.25rem; }
.form-group span { color: #ef4444; margin-left: 0.25rem; font-weight: bold; }
.form-control { display: block; width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s; }
.form-control:focus { border-color: #004ac6; box-shadow: 0 0 0 2px rgba(0, 74, 198, 0.2); }
hr { border: 0; border-top: 1px solid #e2e8f0; margin: 1.5rem 0; }
.btn { background: #004ac6; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; cursor: pointer; text-decoration: none; }
.btn:hover { background: #003da8; }
.text-danger { color: #ef4444 !important; }
.text-success { color: #10b981 !important; }

/* Modal Shims */
.modal { display: none; position: fixed; inset: 0; z-index: 50; background: rgba(0,0,0,0.5); overflow-y: auto; padding: 2rem 1rem; }
.modal.show { display: block; }
.modal-dialog { width: 100%; max-width: 600px; margin: 0 auto; background: #fff; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); overflow: hidden; position: relative; }
.modal-body { padding: 1.5rem; }
.modalcloseDiv { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1rem; }
.modalcloseDiv h6 { font-size: 1.125rem; font-weight: 600; color: #1e293b; margin: 0; }
.closevplanbtn, .closeaplanbtn { cursor: pointer; font-size: 1.25rem; transition: color 0.2s; }
.closevplanbtn:hover, .closeaplanbtn:hover { color: #b91c1c !important; }

/* Bootstrap Table Shims */
.bootstrap-table .fixed-table-container { border: none !important; }
table { width: 100% !important; border-collapse: collapse; background: #fff; }
table th { background: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-align: left; padding: 0.75rem 1rem !important; border-bottom: 1px solid #e2e8f0 !important; font-size: 0.8125rem !important; }
table td { padding: 0.75rem 1rem !important; border-bottom: 1px solid #e2e8f0 !important; color: #334155; font-size: 0.8125rem !important; }
table tbody tr:hover { background-color: #f1f5f9; }
.search input { border: 1px solid #cbd5e1; border-radius: 0.5rem; padding: 0.375rem 0.75rem; outline: none; width: 250px; font-size: 0.875rem; }
.search input:focus { border-color: #004ac6; box-shadow: 0 0 0 2px rgba(0,74,198,0.2); }
.fixed-table-toolbar .columns { float: right; margin-left: 0.5rem; }
.fixed-table-toolbar .btn { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
.fixed-table-toolbar .btn:hover { background: #e2e8f0; }
.editPlanI { cursor: pointer; font-size: 1rem; color: #004ac6; padding-right: 0.5rem; }
.editPlanI:hover { color: #003da8; }
@media (max-width: 640px) { .col-md-6 { width: 100%; } }
</style>

<div class="p-6 md:p-8 max-w-5xl mx-auto w-full">
    <div class="flex justify-between items-end mb-6">
        <div>
            <h2 class="text-2xl font-display font-bold text-gray-900">Subscription Plans</h2>
            <p class="text-sm text-gray-500 mt-1">Manage all available subscription tiers and their respective quotas.</p>
        </div>
        <a href="#" class="btn aplanbtn">
            <span class="material-symbols-outlined" style="font-size: 18px;">add</span> New Plan
        </a>
    </div>

    <!-- Alert Containers -->
    <div class="ajax_alert_div ajax_err_div bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 shadow-sm hidden">
        <strong class="ajax_res_err text-sm font-medium"></strong>
    </div>
    <div class="ajax_alert_div ajax_succ_div bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-6 shadow-sm hidden">
        <strong class="ajax_res_succ text-sm font-medium"></strong>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($plans->result_array() as $p) : 
            $isFree = ($p['amount'] == 0 || strtolower($p['name']) == 'free' || strtolower($p['name']) == 'go');
            $isPlus = (strtolower($p['name']) == 'plus' || strtolower($p['name']) == 'premium' || ($p['amount'] > 0 && $p['amount'] < 5000));
            $isPro = (strtolower($p['name']) == 'pro' || strtolower($p['name']) == 'enterprise' || $p['amount'] >= 5000);
            
            $desc = "Keep tracking with essential access";
            if($isPlus) $desc = "Unlock the full experience";
            if($isPro) $desc = "Maximize your productivity";
        ?>
        <div class="bg-white rounded-3xl p-6 flex flex-col border border-gray-200 relative shadow-sm hover:shadow-md transition-shadow">
            
            <?php if ($p['active'] == '0') : ?>
                <span class="absolute top-6 right-6 text-[10px] font-bold uppercase tracking-wider bg-red-100 text-red-600 px-2 py-1 rounded-full">Inactive</span>
            <?php else : ?>
                <span class="absolute top-6 right-6 text-[10px] font-bold uppercase tracking-wider bg-green-100 text-green-600 px-2 py-1 rounded-full">Active</span>
            <?php endif; ?>

            <h3 class="text-xl font-medium text-gray-900 mb-3"><?php echo $p['name']; ?></h3>
            
            <div class="flex items-baseline mb-2">
                <span class="text-sm font-medium text-gray-500 mr-1 relative -top-2">₹</span>
                <span class="text-3xl font-semibold text-gray-900 tracking-tight"><?php echo $p['amount']; ?></span>
                <span class="text-[10px] text-gray-500 ml-1 font-medium max-w-[80px] leading-tight">INR / <?php echo $p['per'] ? $p['per'] : 'month'; ?> (inc. GST)</span>
            </div>
            
            <p class="text-[13px] text-gray-700 mb-5 pr-14"><?php echo $desc; ?></p>
            
            <button id="<?php echo $p['id']; ?>" class="editPlanI w-full py-2 px-3 rounded-full border border-gray-300 text-gray-700 font-medium text-[13px] mb-5 bg-white hover:bg-gray-50 hover:border-gray-400 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[16px]">edit</span> Edit Plan Limits
            </button>

            <?php if($isPro) : ?>
                <p class="text-[12px] font-semibold text-gray-800 mb-3">Everything in Plus and:</p>
            <?php endif; ?>
            
            <ul class="flex flex-col gap-2 flex-grow">
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-gray-700 text-[18px]">sms</span>
                    <span class="text-[13px] text-gray-700 leading-tight"><strong><?php echo $p['sms_quota']; ?></strong> SMS Credits</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-gray-700 text-[18px]">mail</span>
                    <span class="text-[13px] text-gray-700 leading-tight"><strong><?php echo $p['email_quota']; ?></strong> Email Credits</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-gray-700 text-[18px]">chat</span>
                    <span class="text-[13px] text-gray-700 leading-tight"><strong><?php echo $p['whatsapp_quota']; ?></strong> WhatsApp Credits</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-gray-700 text-[18px]">language</span>
                    <span class="text-[13px] text-gray-700 leading-tight"><strong><?php echo $p['web_quota']; ?></strong> Web Review Limits</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-gray-700 text-[18px] <?php echo (!$isFree) ? '' : 'opacity-40'; ?>">analytics</span>
                    <span class="text-[13px] leading-tight <?php echo (!$isFree) ? 'text-gray-700' : 'text-gray-400'; ?>">Advanced Analytics</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-gray-700 text-[18px] <?php echo (!$isFree) ? '' : 'opacity-40'; ?>">support_agent</span>
                    <span class="text-[13px] leading-tight <?php echo (!$isFree) ? 'text-gray-700' : 'text-gray-400'; ?>">Priority Support</span>
                </li>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Pending Subscription Requests -->
    <div class="mt-10">
        <h3 class="text-xl font-display font-bold text-gray-900 mb-4">Pending Plan Requests</h3>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <?php if (isset($plan_requests) && $plan_requests->num_rows() > 0) : ?>
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-600">User</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Plan Requested</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Amount</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Method</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-600">Date</th>
                            <th class="py-3 px-4 text-sm font-semibold text-gray-600 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($plan_requests->result() as $req) : ?>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="font-medium text-gray-900"><?php echo $req->user_name; ?></div>
                                    <div class="text-xs text-gray-500"><?php echo $req->user_email; ?></div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-800 font-medium"><?php echo $req->plan_name; ?></td>
                                <td class="py-3 px-4 text-sm text-gray-800">₹<?php echo $req->amount; ?></td>
                                <td class="py-3 px-4">
                                    <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-full"><?php echo $req->payment_method; ?></span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600"><?php echo date('M j, Y g:i A', strtotime($req->created_at)); ?></td>
                                <td class="py-3 px-4 text-right flex justify-end gap-2">
                                    <button class="reqActBtn bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 py-1 px-3 rounded-md text-xs font-semibold transition-colors flex items-center gap-1" data-id="<?php echo $req->id; ?>" data-status="approved">
                                        <span class="material-symbols-outlined text-[14px]">check</span> Approve
                                    </button>
                                    <button class="reqActBtn bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 py-1 px-3 rounded-md text-xs font-semibold transition-colors flex items-center gap-1" data-id="<?php echo $req->id; ?>" data-status="rejected">
                                        <span class="material-symbols-outlined text-[14px]">close</span> Reject
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="text-center py-8 text-gray-500">
                    <span class="material-symbols-outlined text-4xl mb-2 text-gray-300">inbox</span>
                    <p>No pending subscription requests.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Edit Plan Modal -->
<div class="modal vplanmodal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modalcloseDiv">
                    <h6>Edit Plan</h6>
                    <i class="fas fa-times closevplanbtn text-danger"></i>
                </div>
                <form action="<?php echo base_url(''); ?>" method="post" id="planForm">
                    <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label>Plan Name</label> <span>*</span>
                        <input type="text" name="name" class="form-control name" value="" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Amount</label> <span>*</span>
                            <input type="text" name="amount" class="form-control amount" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>per</label>
                            <input type="text" name="per" class="form-control per" placeholder="e.g. month" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>SMS Quota</label> <span>*</span>
                            <input type="number" name="sms_quota" class="form-control sms_quota" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email Quota</label> <span>*</span>
                            <input type="number" name="email_quota" class="form-control email_quota" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Whatsapp Quota</label> <span>*</span>
                            <input type="number" name="whatsapp_quota" class="form-control whatsapp_quota" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Web Quota</label> <span>*</span>
                            <input type="number" name="web_quota" class="form-control web_quota" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Order</label>
                            <input type="number" name="orderBy" class="form-control orderBy">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="active" class="form-control active" required>
                                <option value="">Select</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="flex justify-end gap-3">
                        <button type="button" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300 closevplanbtn">Cancel</button>
                        <button class="btn text-light save_plan_btn" type="submit" planid="">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Plan Modal -->
<div class="modal aplanmodal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modalcloseDiv">
                    <h6>Create New Plan</h6>
                    <i class="fas fa-times closeaplanbtn text-danger"></i>
                </div>
                <form action="<?php echo base_url(''); ?>" method="post" id="addplanForm">
                    <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label>Plan Name</label> <span>*</span>
                        <input type="text" name="add_name" class="form-control add_name" value="" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Amount</label> <span>*</span>
                            <input type="text" name="add_amount" class="form-control add_amount" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>per</label>
                            <input type="text" name="add_per" class="form-control add_per" placeholder="e.g. month" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>SMS Quota</label> <span>*</span>
                            <input type="number" name="add_sms_quota" class="form-control add_sms_quota" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email Quota</label> <span>*</span>
                            <input type="number" name="add_email_quota" class="form-control add_email_quota" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Whatsapp Quota</label> <span>*</span>
                            <input type="number" name="add_whatsapp_quota" class="form-control add_whatsapp_quota" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Web Quota</label> <span>*</span>
                            <input type="number" name="add_web_quota" class="form-control add_web_quota" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Order</label>
                            <input type="number" name="add_orderBy" class="form-control add_orderBy" value="1">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="add_active" class="form-control add_active" required>
                                <option value="">Select</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="flex justify-end gap-3">
                        <button type="button" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300 closeaplanbtn">Cancel</button>
                        <button class="btn text-light add_plan_btn" type="submit">Create Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // jQuery Mock Modal
    $.fn.modal = function(action) {
        if (action === 'show') {
            this.fadeIn(200).addClass('show');
            $('body').css('overflow', 'hidden');
        } else if (action === 'hide') {
            this.fadeOut(200, function() { $(this).removeClass('show'); });
            $('body').css('overflow', '');
        }
        return this;
    };

    function clearAlert() {
        $(".ajax_alert_div").hide();
        $(".ajax_res_err, .ajax_res_succ").html('');
    }

    var csrfName = $('.csrf_token').attr('name');
    var csrfHash = $('.csrf_token').val();

    $(document).ready(function() {
        $(document).on('click', '.closevplanbtn', function(e) { e.preventDefault(); $(".vplanmodal").modal("hide"); });
        $(document).on('click', '.closeaplanbtn', function(e) { e.preventDefault(); $(".aplanmodal").modal("hide"); });
        $(document).on('click', '.aplanbtn', function(e) { e.preventDefault(); $(".aplanmodal").modal("show"); });

        $(document).on('click', 'button.editPlanI', function(e) {
            e.preventDefault();
            var planid = $(this).attr("id");
            if (planid) {
                $.ajax({
                    url: "<?php echo base_url('get-plan'); ?>",
                    method: "post",
                    dataType: "json",
                    data: { [csrfName]: csrfHash, planid: planid },
                    beforeSend: function(res) { clearAlert(); },
                    success: function(res) {
                        if (res.status === 'error') { window.location.assign(res.redirect); }
                        else if (res.status === false) { $(".ajax_res_err").append(res.msg); $(".ajax_err_div").fadeIn(); }
                        else if (res.status === true) {
                            $('.name').val(res.details.name); $('.amount').val(res.details.amount);
                            $('.per').val(res.details.per); $('.sms_quota').val(res.details.sms_quota);
                            $('.email_quota').val(res.details.email_quota); $('.whatsapp_quota').val(res.details.whatsapp_quota);
                            $('.web_quota').val(res.details.web_quota); $('.orderBy').val(res.details.orderBy);
                            $('.active').val(res.details.active); $('.save_plan_btn').attr('planid', res.details.id);
                            $(".vplanmodal").modal("show");
                        }
                        $('.csrf_token').val(res.token); csrfHash = res.token;
                    }
                });
            }
        });

        $('form#planForm').submit(function(e) {
            e.preventDefault();
            var data = {
                [csrfName]: csrfHash, planid: $('.save_plan_btn').attr("planid"),
                name: $('.name').val(), amount: $('.amount').val(), per: $('.per').val(),
                sms_quota: $('.sms_quota').val(), email_quota: $('.email_quota').val(),
                whatsapp_quota: $('.whatsapp_quota').val(), web_quota: $('.web_quota').val(),
                orderBy: $('.orderBy').val(), active: $('.active').val()
            };
            if (!data.email_quota || !data.sms_quota || !data.whatsapp_quota || !data.web_quota) return false;
            $.ajax({
                url: "<?php echo base_url('update-plan'); ?>", method: "post", dataType: "json", data: data,
                beforeSend: function() { clearAlert(); $('.save_plan_btn').addClass('opacity-50').html('Saving...'); },
                success: function(res) {
                    if (res.status === true) { window.location.reload(); }
                    else { $(".ajax_res_err").append(res.msg); $(".ajax_err_div").fadeIn(); }
                    $('.save_plan_btn').removeClass('opacity-50').html('Save Changes');
                    $('.csrf_token').val(res.token); csrfHash = res.token;
                }
            });
        });

        $('form#addplanForm').submit(function(e) {
            e.preventDefault();
            var data = {
                [csrfName]: csrfHash,
                name: $('.add_name').val(), amount: $('.add_amount').val(), per: $('.add_per').val(),
                sms_quota: $('.add_sms_quota').val(), email_quota: $('.add_email_quota').val(),
                whatsapp_quota: $('.add_whatsapp_quota').val(), web_quota: $('.add_web_quota').val(),
                orderBy: $('.add_orderBy').val(), active: $('.add_active').val()
            };
            if (!data.email_quota || !data.sms_quota || !data.whatsapp_quota || !data.web_quota) return false;
            $.ajax({
                url: "<?php echo base_url('add-plan'); ?>", method: "post", dataType: "json", data: data,
                beforeSend: function() { clearAlert(); $('.add_plan_btn').addClass('opacity-50').html('Saving...'); },
                success: function(res) {
                    if (res.status === true) { window.location.reload(); }
                    else { $(".ajax_res_err").append(res.msg); $(".ajax_err_div").fadeIn(); }
                    $('.add_plan_btn').removeClass('opacity-50').html('Create Plan');
                    $('.csrf_token').val(res.token); csrfHash = res.token;
                }
            });
        });

        // Plan Requests Action
        $(document).on('click', '.reqActBtn', function(e) {
            e.preventDefault();
            var reqId = $(this).data('id');
            var status = $(this).data('status');
            var actionText = status === 'approved' ? 'approve and activate' : 'reject';
            
            if(confirm("Are you sure you want to " + actionText + " this subscription request?")) {
                var btn = $(this);
                var originalHtml = btn.html();
                btn.html('Processing...').addClass('opacity-50 cursor-not-allowed');
                
                $.ajax({
                    url: "<?php echo base_url('approve-plan'); ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        [csrfName]: csrfHash,
                        req_id: reqId,
                        status: status
                    },
                    success: function(res) {
                        if(res.status) {
                            window.location.reload();
                        } else {
                            alert(res.message || "An error occurred.");
                            btn.html(originalHtml).removeClass('opacity-50 cursor-not-allowed');
                        }
                    },
                    error: function() {
                        alert("Network error.");
                        btn.html(originalHtml).removeClass('opacity-50 cursor-not-allowed');
                    }
                });
            }
        });
    });
</script>
<?php $this->load->view('templates/tw_footer'); ?>