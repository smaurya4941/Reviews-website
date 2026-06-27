<?php
/**
 * Rate/index view — Restaurant Smile Meter Feedback Form
 * Backend variables: $platform, $redirect_url
 */

$redirect_url_val = isset($redirect_url->url) && !empty($redirect_url->url)
    ? $redirect_url->url
    : base_url();

// Questions definition
$questions = [
    ['id' => 'q_food',      'text' => 'Did our food satisfy your taste buds?'],
    ['id' => 'q_beverages', 'text' => 'Did you enjoy the beverages?'],
    ['id' => 'q_order',     'text' => 'Did we take your order on time?'],
    ['id' => 'q_serve',     'text' => 'Did we serve you on time?'],
    ['id' => 'q_staff',     'text' => 'Were our staff members friendly?'],
    ['id' => 'q_restaurant','text' => 'Do you like our restaurant?'],
    ['id' => 'q_menu',      'text' => 'Do you like our menu selections / variety?'],
    ['id' => 'q_care',      'text' => 'We care — did it show?'],
];

// Smile emojis for rating 1-5
$smiles = ['😞', '😕', '😐', '😊', '🤩'];
$smile_labels = ['Very Bad', 'Bad', 'Okay', 'Good', 'Excellent'];
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/rating.css'); ?>">

<!-- Hidden platform data -->
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
       value="<?php echo $this->security->get_csrf_hash(); ?>" class="csrf_token" id="csrf_token">
<input type="hidden" id="web_id"   value="<?php echo $platform->id; ?>">
<input type="hidden" id="web_name" value="<?php echo htmlspecialchars($platform->web_name); ?>">
<input type="hidden" id="web_link" value="<?php echo htmlspecialchars($platform->web_link); ?>">
<input type="hidden" id="form_key" value="<?php echo $platform->form_key; ?>">

<div class="review-page-wrapper">
    <div class="review-card" id="review-card">

        <!-- ── HEADER ── -->
        <div class="review-card-header">
            <div class="brand-area">
                <?php if (!empty($platform->logo)): ?>
                    <img src="<?php echo base_url('uploads/platform/') . $platform->logo; ?>"
                         alt="<?php echo htmlspecialchars($platform->web_name); ?>"
                         class="brand-logo">
                <?php elseif (!empty($platform->icon)): ?>
                    <div class="brand-icon"><i class="<?php echo $platform->icon; ?>"></i></div>
                <?php else: ?>
                    <div class="brand-icon"><i class="fa-solid fa-utensils"></i></div>
                <?php endif; ?>
                <span class="brand-name"><?php echo htmlspecialchars($platform->web_name); ?></span>
            </div>
            <p class="review-subtitle">Guest Feedback Form</p>
            <span class="smile-instruction">
                ☞ &nbsp;Using the smile meter, circle the number that best describes your experience
            </span>
        </div>

        <!-- ── SMILE METER LEGEND ── -->
        <div class="smile-legend">
            <?php foreach ($smiles as $i => $emoji): ?>
                <div class="legend-item">
                    <span class="legend-emoji"><?php echo $emoji; ?></span>
                    <span class="legend-num"><?php echo ($i + 1); ?></span>
                    <span class="legend-text"><?php echo $smile_labels[$i]; ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- ── SUCCESS SCREEN (hidden until save) ── -->
        <div class="success-screen" id="success-screen">
            <div class="success-emoji">🎉</div>
            <div class="success-checkmark">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div class="success-title">Thank you!</div>
            <div class="success-sub" id="success-msg">
                Your feedback has been recorded. We truly appreciate your time!
            </div>
        </div>

        <!-- ── MAIN FORM (hidden after save) ── -->
        <div id="main-form">

            <!-- QUESTIONS -->
            <div class="questions-section">
                <p class="section-title">Rate your experience &nbsp;·&nbsp; 1 = Very Bad &nbsp; 5 = Excellent</p>

                <?php foreach ($questions as $q): ?>
                <div class="question-row" id="row-<?php echo $q['id']; ?>">
                    <span class="question-text">
                        <?php echo htmlspecialchars($q['text']); ?>
                        <span class="question-required">*</span>
                    </span>
                    <div class="smile-options" data-qid="<?php echo $q['id']; ?>">
                        <?php foreach ($smiles as $i => $emoji): ?>
                            <button type="button"
                                    class="smile-btn"
                                    data-value="<?php echo ($i + 1); ?>"
                                    data-qid="<?php echo $q['id']; ?>"
                                    title="<?php echo $smile_labels[$i]; ?> (<?php echo ($i + 1); ?>)">
                                <?php echo $emoji; ?>
                                <span class="smile-btn-num"><?php echo ($i + 1); ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- CONTACT + COMMENTS -->
            <div class="contact-section">
                <p class="section-title">Your details</p>

                <!-- Special Comments -->
                <div class="form-group-full">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="input-comments">
                            Special Comments / How can we serve you better?
                        </label>
                        <textarea id="input-comments"
                                  class="form-input-custom"
                                  placeholder="Share your thoughts, suggestions, or anything we can improve…"
                                  rows="3"></textarea>
                    </div>
                </div>

                <!-- Name + Mobile -->
                <div class="form-row-grid">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="input-name">
                            Your Name <span>*</span>
                        </label>
                        <input type="text"
                               id="input-name"
                               class="form-input-custom"
                               placeholder="e.g. Satyam Kumar"
                               autocomplete="name"
                               required>
                        <span class="form-error-msg" id="err-name">Please enter your name</span>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom" for="input-mobile">
                            Contact <span>*</span>
                        </label>
                        <div class="input-wrapper">
                            <span class="input-prefix">+91</span>
                            <input type="number"
                                   id="input-mobile"
                                   class="form-input-custom has-prefix"
                                   placeholder="9876543210"
                                   autocomplete="tel"
                                   required>
                        </div>
                        <span class="form-error-msg" id="err-mobile">Must be exactly 10 digits</span>
                    </div>
                </div>

                <!-- Date -->
                <div class="form-group-custom">
                    <label class="form-label-custom" for="input-date">Date</label>
                    <input type="date"
                           id="input-date"
                           class="form-input-custom"
                           value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>

            <!-- ALERT -->
            <div id="review-alert" class="review-alert"></div>

            <!-- SUBMIT -->
            <div class="submit-area">
                <button type="button" id="submitbtn" class="submit-btn">
                    <span class="btn-spinner" id="btn-spinner"></span>
                    <span id="btn-text">Submit Feedback</span>
                </button>
            </div>

        </div>
        <!-- /main-form -->

        <!-- FOOTER -->
        <div class="review-card-footer">
            <p class="powered-by">Powered by <a href="https://bizorm.com" target="_blank" rel="noopener">Bizorm</a></p>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/rating.js'); ?>"></script>
<script type="text/javascript">
(function () {
    'use strict';

    /* ── Config ── */
    var QUESTIONS = <?php echo json_encode(array_column($questions, 'id')); ?>;
    var ratings   = {};   // { q_food: 3, q_beverages: 5, … }

    var csrfName  = document.getElementById('csrf_token').name;
    var csrfHash  = document.getElementById('csrf_token').value;
    var formKey   = document.getElementById('form_key').value;
    var webId     = document.getElementById('web_id').value;
    var webName   = document.getElementById('web_name').value;
    var webLink   = document.getElementById('web_link').value;
    var lowStarUrl= '<?php echo addslashes($redirect_url_val); ?>';

    /* ── DOM refs ── */
    var submitBtn    = document.getElementById('submitbtn');
    var btnText      = document.getElementById('btn-text');
    var btnSpinner   = document.getElementById('btn-spinner');
    var alertBox     = document.getElementById('review-alert');
    var successScreen= document.getElementById('success-screen');
    var mainForm     = document.getElementById('main-form');
    var successMsg   = document.getElementById('success-msg');

    /* ── Smile button click ── */
    document.querySelectorAll('.smile-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var qid   = this.getAttribute('data-qid');
            var value = parseInt(this.getAttribute('data-value'));

            /* Deselect siblings */
            document.querySelectorAll('.smile-btn[data-qid="' + qid + '"]').forEach(function (b) {
                b.classList.remove('selected');
            });

            /* Select this one */
            this.classList.add('selected');
            ratings[qid] = value;

            /* Clear validation state */
            var row = document.getElementById('row-' + qid);
            if (row) row.classList.remove('unanswered');
        });
    });

    /* ── Alert helpers ── */
    function showAlert(msg, type) {
        alertBox.className = 'review-alert alert-' + type;
        alertBox.innerHTML = msg;
        alertBox.style.display = 'block';
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    function hideAlert() {
        alertBox.style.display = 'none';
        alertBox.innerHTML = '';
    }

    /* ── Loading state ── */
    function setLoading(on) {
        submitBtn.disabled = on;
        btnSpinner.style.display = on ? 'block' : 'none';
        btnText.textContent = on ? 'Saving…' : 'Submit Feedback';
    }

    /* ── Validate ── */
    function validate() {
        var valid     = true;
        var unanswered = [];

        QUESTIONS.forEach(function (qid) {
            if (!ratings[qid]) {
                var row = document.getElementById('row-' + qid);
                if (row) row.classList.add('unanswered');
                unanswered.push(qid);
                valid = false;
            }
        });

        var name   = document.getElementById('input-name').value.trim();
        var mobile = document.getElementById('input-mobile').value.trim();

        if (!name) {
            document.getElementById('input-name').classList.add('error');
            document.getElementById('err-name').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('input-name').classList.remove('error');
            document.getElementById('err-name').style.display = 'none';
        }

        if (!mobile || mobile.length !== 10) {
            document.getElementById('input-mobile').classList.add('error');
            document.getElementById('err-mobile').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('input-mobile').classList.remove('error');
            document.getElementById('err-mobile').style.display = 'none';
        }

        if (unanswered.length > 0) {
            showAlert('Please rate all ' + unanswered.length + ' unanswered question(s) above.', 'error');
        }

        return valid;
    }

    /* ── Submit ── */
    submitBtn.addEventListener('click', function () {
        hideAlert();
        if (!validate()) return;

        var name     = document.getElementById('input-name').value.trim();
        var mobile   = document.getElementById('input-mobile').value.trim();
        var comments = document.getElementById('input-comments').value.trim();
        var date     = document.getElementById('input-date').value;

        /* Average star value (for the existing `star` DB column) */
        var values = QUESTIONS.map(function (q) { return ratings[q]; });
        var avg    = values.reduce(function (a, b) { return a + b; }, 0) / values.length;
        var starv  = Math.round(avg);

        setLoading(true);

        /* Map question IDs → DB column names */
        var colMap = {
            'q_food':       'r_food',
            'q_beverages':  'r_beverages',
            'q_order':      'r_order_time',
            'q_serve':      'r_serve_time',
            'q_staff':      'r_staff',
            'q_restaurant': 'r_restaurant',
            'q_menu':       'r_menu',
            'q_care':       'r_care'
        };

        var postData = {};
        postData[csrfName]     = csrfHash;
        postData['starv']      = starv;
        postData['review']     = '';          // kept for backward compat
        postData['comments']   = comments;
        postData['visit_date'] = date;
        postData['name']       = name;
        postData['mobile']     = mobile;
        postData['web_name']   = webName;
        postData['web_link']   = webLink;
        postData['web_id']     = webId;
        postData['form_key']   = formKey;

        /* Add individual question ratings */
        QUESTIONS.forEach(function (qid) {
            var col = colMap[qid];
            if (col) postData[col] = ratings[qid];
        });

        $.ajax({
            url: '<?php echo base_url('save-rating'); ?>',
            method: 'POST',
            dataType: 'json',
            data: postData,

            success: function (data) {
                /* Refresh CSRF */
                if (data.token) {
                    document.getElementById('csrf_token').value = data.token;
                    csrfHash = data.token;
                }

                if (data.status === true) {
                    mainForm.style.display  = 'none';
                    successScreen.classList.add('active');

                    if (starv >= 4 && data.redirectLink) {
                        setTimeout(function () {
                            window.location.assign(data.redirectLink);
                        }, 2000);
                    } else if (starv < 4 && lowStarUrl) {
                        setTimeout(function () {
                            window.open(lowStarUrl, '_blank');
                        }, 2000);
                    }

                } else if (data.status === false) {
                    showAlert(data.msg || 'Something went wrong. Please try again.', 'error');
                    setLoading(false);
                }
            },

            error: function () {
                showAlert('Network error. Please refresh the page and try again.', 'error');
                setLoading(false);
            }
        });
    });

    /* ── Live clear errors on input ── */
    document.getElementById('input-name').addEventListener('input', function () {
        this.classList.remove('error');
        document.getElementById('err-name').style.display = 'none';
    });
    document.getElementById('input-mobile').addEventListener('input', function () {
        this.classList.remove('error');
        document.getElementById('err-mobile').style.display = 'none';
    });

})();
</script>