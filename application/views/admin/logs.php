<?php $this->load->view('templates/tw_header'); ?>
<style>
/* CSS Shims for legacy Bootstrap Grid and Forms */
.row { display: flex; flex-wrap: wrap; margin: -0.5rem; }
.col-md-4 { width: 33.333%; padding: 0.5rem; box-sizing: border-box; }
.col-md-6 { width: 50%; padding: 0.5rem; box-sizing: border-box; }
.col-md-3 { width: 25%; padding: 0.5rem; box-sizing: border-box; }
.form-group { margin-bottom: 1rem; width: 100%; position: relative; }
.form-group label { display: block; font-size: 0.8125rem; font-weight: 600; color: #334155; margin-bottom: 0.25rem; }
.form-control { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.8125rem; outline: none; transition: all 0.2s; background: #f8fafc; }
.form-control[readonly] { cursor: not-allowed; opacity: 0.9; }
.btn { background: #ef4444; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.8125rem;}
.btn:hover { background: #dc2626; color: white; }

/* Tabs Layout Shim */
.log_wrapper { display: flex; flex-direction: row; min-height: 600px; background: #fff; border-radius: 0.75rem; overflow: hidden; border: 1px solid #e2e8f0; }
.tab_div { width: 200px; background: #f8fafc; border-right: 1px solid #e2e8f0; display: flex; flex-direction: column; padding: 1rem 0; }
.info_div { flex: 1; padding: 1.5rem; background: #fff; overflow-y: auto; }

.tab_link { padding: 0.75rem 1.5rem; color: #475569; font-weight: 500; font-size: 0.875rem; transition: all 0.2s; text-decoration: none; border-left: 3px solid transparent; }
.tab_link:hover { background: #f1f5f9; color: #0f172a; }
.tab_link.active { background: #fff; color: #004ac6; font-weight: 600; border-left: 3px solid #004ac6; }

/* Modal Shims */
.modal { display: none; position: fixed; inset: 0; z-index: 50; background: rgba(0,0,0,0.5); overflow-y: auto; align-items: center; justify-content: center; }
.modal.show { display: flex; }
.modal-dialog { width: 95%; max-width: 800px; margin: 2rem auto; background: #fff; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); overflow: hidden; position: relative; }
.modal-body { padding: 1.5rem; }
.modalcloseDiv { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1rem; }
.modalcloseDiv h6 { font-size: 1rem; font-weight: 600; color: #1e293b; margin: 0; }
.closevpaybtn { cursor: pointer; font-size: 1.25rem; transition: color 0.2s; }
.closevpaybtn:hover { color: #b91c1c !important; }

/* Bootstrap Table Shims */
.bootstrap-table .fixed-table-container { border: none !important; }
table { width: 100% !important; border-collapse: collapse; background: #fff; }
table th { background: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-align: left; padding: 0.75rem 1rem !important; border-bottom: 1px solid #e2e8f0 !important; font-size: 0.8125rem !important; }
table td { padding: 0.75rem 1rem !important; border-bottom: 1px solid #e2e8f0 !important; color: #334155; font-size: 0.8125rem !important; }
table tbody tr:hover { background-color: #f1f5f9; }
.search input { border: 1px solid #cbd5e1; border-radius: 0.5rem; padding: 0.375rem 0.75rem; outline: none; width: 250px; font-size: 0.8125rem; }
.fixed-table-toolbar .columns { float: right; margin-left: 0.5rem; }
.fixed-table-toolbar .btn { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
.showPaymentI { cursor: pointer; font-size: 1rem; color: #004ac6; }

@media (max-width: 768px) { .log_wrapper { flex-direction: column; } .tab_div { width: 100%; flex-direction: row; border-right: none; border-bottom: 1px solid #e2e8f0; overflow-x: auto; } .tab_link { border-left: none; border-bottom: 3px solid transparent; } .tab_link.active { border-left: none; border-bottom: 3px solid #004ac6; } .col-md-4, .col-md-6, .col-md-3 { width: 100%; } }
</style>

<div class="p-6 md:p-8 max-w-6xl mx-auto w-full">
    <div class="mb-6">
        <h2 class="text-2xl font-display font-bold text-gray-900">Activity Logs</h2>
        <p class="text-sm text-gray-500 mt-1">Review system activities, feedback submissions, and payment logs.</p>
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

    <input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <div class="log_wrapper shadow-sm">
        <!-- Sidebar Tabs -->
        <div class="tab_div">
            <a href="#activity" class="tab_link active" id="actLogs">Activity</a>
            <a href="#feedback" class="tab_link" id="feedbkLogs">Feedback</a>
            <a href="#payments" class="tab_link" id="paymentLogs">Payment</a>
        </div>

        <!-- Activity Tab -->
        <div class="info_div" id="actLogs_content">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">System Activity</h3>
                <?php if ($logs->num_rows() > 0) : ?>
                    <a href="<?php echo base_url('clear-activity-logs'); ?>" class="btn clearlogs">
                        <span class="material-symbols-outlined" style="font-size:16px;">delete</span> Clear Logs
                    </a>
                <?php endif; ?>
            </div>
            <table id="logstable" data-toggle="table" data-search="true" data-show-export="true" data-pagination="true">
                <thead class="text-light" style="background:#294a63">
                    <tr>
                        <th data-field="activity" data-sortable="true">Activity</th>
                        <th data-field="date" data-sortable="true" data-width="200">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs->result() as $log) : ?>
                        <tr>
                            <td class="text-gray-700"><?php echo $log->msg ?></td>
                            <td class="text-gray-500 whitespace-nowrap"><?php echo $log->act_time ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Feedback Tab -->
        <div class="info_div hidden" id="feedbkLogs_content">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Support & Feedback</h3>
                <?php if ($feedbacks->num_rows() > 0) : ?>
                    <a href="<?php echo base_url('clear-feedbacks'); ?>" class="btn clear_feedbacks">
                        <span class="material-symbols-outlined" style="font-size:16px;">delete</span> Clear Data
                    </a>
                <?php endif; ?>
            </div>
            <table id="feedbackstable" data-toggle="table" data-search="true" data-show-export="true" data-pagination="true">
                <thead class="text-light" style="background:#294a63">
                    <tr>
                        <th data-field="name" data-sortable="true">Name</th>
                        <th data-field="mail" data-sortable="true">E-mail</th>
                        <th data-field="msg">Message</th>
                        <th data-field="date" data-sortable="true" data-width="200">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedbacks->result_array() as $msg) : ?>
                        <tr>
                            <td class="font-medium text-gray-800"><?php echo $msg['name'] ?></td>
                            <td><a href="mailto:<?php echo $msg['user_mail'] ?>" class="text-primary hover:underline"><?php echo $msg['user_mail'] ?></a></td>
                            <td class="text-gray-600 text-xs"><?php echo $msg['bdy'] ?></td>
                            <td class="text-gray-500 whitespace-nowrap"><?php echo $msg['date'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Payments Tab -->
        <div class="info_div hidden" id="paymentLogs_content">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Payment Transactions</h3>
            </div>
            <table id="transactionstable" data-toggle="table" data-search="true" data-show-export="true" data-pagination="true">
                <thead class="text-light" style="background:#294a63">
                    <tr>
                        <th data-field="uname" data-sortable="true">User</th>
                        <th data-field="payment_id" data-sortable="true">Payment ID</th>
                        <th data-field="date" data-sortable="true">Date</th>
                        <th data-field="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $pay) : ?>
                        <tr>
                            <td class="font-medium text-gray-800"><?php echo $pay['uname'] ?></td>
                            <td class="text-gray-600 font-mono text-xs"><?php echo $pay['payment_id'] ?></td>
                            <td class="text-gray-500 whitespace-nowrap"><?php echo date('d M Y, h:i:s a', $pay['date']) ?></td>
                            <td>
                                <i class="fa fa-eye showPaymentI p-1 hover:bg-blue-50 rounded" title="View Details" id="<?php echo $pay['payment_id'] ?>" data-formkey="<?php echo $pay['form_key'] ?>" data-userid="<?php echo $pay['user_id'] ?>" data-date="<?php echo date('d M Y, h:i:s a', $pay['date']) ?>"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Payment Details Modal -->
<div class="modal vpaymodal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modalcloseDiv">
                    <h6>Paid on <span class="text-primary tran_date"></span></h6>
                    <i class="fas fa-times closevpaybtn text-gray-400 hover:text-red-500"></i>
                </div>
                <form id="payForm">
                    <div class="row">
                        <div class="form-group col-md-4"><label>Payee Name</label><input type="text" class="form-control uname" readonly></div>
                        <div class="form-group col-md-4"><label>Payee Email</label><input type="email" class="form-control email" readonly></div>
                        <div class="form-group col-md-4"><label>Payee Mobile</label><input type="text" class="form-control mobile" readonly></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4"><label>Payment ID</label><input type="text" class="form-control pay_id font-mono text-xs" readonly></div>
                        <div class="form-group col-md-4"><label>Order ID</label><input type="text" class="form-control order_id font-mono text-xs" readonly></div>
                        <div class="form-group col-md-4"><label>Transaction ID</label><input type="text" class="form-control tran_id font-mono text-xs" readonly></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6"><label>Currency</label><input type="text" class="form-control currency" readonly></div>
                        <div class="form-group col-md-6"><label>Amount</label><input type="text" class="form-control amount font-semibold text-green-600" readonly></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4"><label>Status</label><input type="text" class="form-control status uppercase font-bold" readonly></div>
                        <div class="form-group col-md-4"><label>Captured</label><input type="text" class="form-control captured" readonly></div>
                        <div class="form-group col-md-4"><label>Entity</label><input type="text" class="form-control entity" readonly></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3"><label>Mode</label><input type="text" class="form-control mop" readonly></div>
                        <div class="form-group col-md-3"><label>Card ID</label><input type="text" class="form-control card_id text-xs" readonly></div>
                        <div class="form-group col-md-3"><label>Bank</label><input type="text" class="form-control bank text-xs" readonly></div>
                        <div class="form-group col-md-3"><label>Wallet/UPI</label><input type="text" class="form-control wallet upi_id text-xs" readonly></div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea cols="30" rows="3" class="form-control desc text-sm" readonly></textarea>
                    </div>
                    <div class="text-right mt-4 pt-4 border-t border-gray-100">
                        <button type="button" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300 closevpaybtn">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // jQuery Mock Modal
    $.fn.modal = function(action) {
        if (action === 'show') { this.fadeIn(200).css('display', 'flex'); $('body').css('overflow', 'hidden'); } 
        else if (action === 'hide') { this.fadeOut(200); $('body').css('overflow', ''); }
        return this;
    };

    var csrfName = $('.csrf_token').attr('name');
    var csrfHash = $('.csrf_token').val();

    $(document).ready(function() {
        // Tab switching logic
        $('.tab_link').click(function(e) {
            e.preventDefault();
            $('.tab_link').removeClass('active');
            $(this).addClass('active');
            var target = $(this).attr('id') + '_content';
            $('.info_div').addClass('hidden');
            $('#' + target).removeClass('hidden');
            // Re-adjust bootstrap table layout if needed when unhidden
            $(window).trigger('resize');
        });

        // Clear confirm
        $(document).on('click', '.clearlogs, .clear_feedbacks', function(e) {
            if (!confirm("Are you sure you want to clear this data?")) {
                e.preventDefault();
            }
        });

        // Close modal
        $(document).on('click', '.closevpaybtn', function(e) { e.preventDefault(); $(".vpaymodal").modal("hide"); });

        // Show payment
        $(document).on('click', 'i.showPaymentI', function(e) {
            e.preventDefault();
            var payID = $(this).attr("id"), formkey = $(this).attr("data-formkey"), userid = $(this).attr("data-userid"), dataDate = $(this).attr("data-date");
            
            if (payID) {
                $.ajax({
                    url: "<?php echo base_url('get-payment-details'); ?>",
                    method: "post", dataType: "json",
                    data: { [csrfName]: csrfHash, payID: payID, formkey: formkey, userid: userid },
                    success: function(res) {
                        if (res.status === true) {
                            $('.amount').val(res.details.amount); $('.bank').val(res.details.bank);
                            $('.captured').val(res.details.captured); $('.card_id').val(res.details.card_id);
                            $('.currency').val(res.details.currency); $('span.tran_date').text(dataDate);
                            $('.desc').val(res.details.description); $('.email').val(res.details.email);
                            $('.entity').val(res.details.entity); $('.mobile').val(res.details.mobile);
                            $('.mop').val(res.details.mop); $('.order_id').val(res.details.order_id);
                            $('.pay_id').val(res.details.payment_id); $('.status').val(res.details.status);
                            $('.tran_id').val(res.details.transaction_id); $('.uname').val(res.details.uname);
                            $('.upi_id').val(res.details.vpa || res.details.wallet); 
                            $(".vpaymodal").modal("show");
                        } else if (res.status === false) { alert(res.msg); }
                        $('.csrf_token').val(res.token); csrfHash = res.token;
                    }
                });
            }
        });
    });
</script>
<?php $this->load->view('templates/tw_footer'); ?>