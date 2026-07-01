<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<?php $site_name = ($this->st && $this->st->site_name) ? $this->st->site_name : 'Bizorm'; ?>
<title><?php echo htmlspecialchars($site_name); ?> | Turn Customer Feedback into Your Greatest Asset</title>
<meta name="description" content="<?php echo htmlspecialchars($this->st->site_desc ?? 'Collect reviews, route happy customers to Google, and keep negative feedback private.'); ?>"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
  tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        colors: {
          "surface-container": "#e7eeff",
          "surface-container-low": "#f0f3ff",
          "surface-container-high": "#dee8ff",
          "surface-container-highest": "#d8e3fb",
          "surface-container-lowest": "#ffffff",
          "surface-bright": "#f9f9ff",
          "background": "#f9f9ff",
          "surface": "#f9f9ff",
          "success": "#10B981",
          "secondary": "#795900",
          "secondary-container": "#ffc329",
          "on-background": "#111c2d",
          "on-surface": "#111c2d",
          "on-surface-variant": "#434655",
          "on-primary": "#ffffff",
          "on-primary-container": "#eeefff",
          "primary": "#004ac6",
          "primary-container": "#2563eb",
          "outline-variant": "#c3c6d7",
          "outline": "#737686",
          "error": "#EF4444"
        },
        borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
        spacing: { "xs": "4px", "base": "4px", "sm": "8px", "md": "16px", "lg": "24px", "gutter": "24px", "xl": "40px", "section": "80px" },
        fontFamily: {
          "headline-lg": ["Plus Jakarta Sans"], "headline-md": ["Plus Jakarta Sans"], "display-lg": ["Plus Jakarta Sans"],
          "body-lg": ["Inter"], "body-md": ["Inter"], "caption": ["Inter"], "label-md": ["Inter"]
        },
        fontSize: {
          "headline-lg": ["32px", {"lineHeight": "1.25", "fontWeight": "700"}],
          "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
          "display-lg": ["46px", {"lineHeight": "1.15", "letterSpacing": "-0.02em", "fontWeight": "700"}],
          "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
          "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
          "caption": ["12px", {"lineHeight": "1.4", "fontWeight": "500"}],
          "label-md": ["14px", {"lineHeight": "1", "letterSpacing": "0.01em", "fontWeight": "600"}]
        }
      }
    }
  }
</script>
<style>
  .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
  .shadow-soft { box-shadow: 0 10px 30px -5px rgba(37, 99, 235, 0.1); }
</style>
</head>
<body class="bg-background text-on-surface font-body-md overflow-x-hidden">

<!-- Navigation -->
<nav class="bg-surface-container/80 backdrop-blur-md sticky top-0 z-50 shadow-sm h-20">
  <div class="flex justify-between items-center w-full px-md md:px-lg lg:px-xl max-w-7xl mx-auto h-full">
    <a href="<?php echo base_url(); ?>" class="flex items-center gap-sm">
      <?php if ($this->st && $this->st->site_logo): ?>
        <img alt="<?php echo htmlspecialchars($site_name); ?>" class="h-9 object-contain" src="<?php echo base_url('assets/images/') . $this->st->site_logo; ?>"/>
      <?php else: ?>
        <span class="font-headline-lg text-2xl font-extrabold text-primary"><?php echo htmlspecialchars($site_name); ?></span>
      <?php endif; ?>
    </a>
    <div class="hidden md:flex items-center gap-xl">
      <a class="text-label-md font-label-md text-on-surface-variant hover:text-primary transition-colors" href="#how-it-works">How it Works</a>
      <a class="text-label-md font-label-md text-on-surface-variant hover:text-primary transition-colors" href="#features">Features</a>
      <a class="text-label-md font-label-md text-on-surface-variant hover:text-primary transition-colors" href="#pricing">Pricing</a>
    </div>
    <div class="flex items-center gap-sm">
      <a href="<?php echo base_url('login'); ?>" class="hidden sm:flex items-center text-label-md font-label-md text-primary px-md py-sm rounded-lg hover:bg-surface-bright transition-all">Login</a>
      <a href="<?php echo base_url('register'); ?>" class="bg-primary-container text-on-primary-container px-lg py-sm rounded-lg font-label-md hover:opacity-90 active:scale-95 transition-all">Get Started</a>
    </div>
  </div>
</nav>

<!-- Hero -->
<header class="relative pt-section pb-xl md:pt-32 overflow-hidden">
  <div class="max-w-7xl mx-auto px-gutter grid grid-cols-1 lg:grid-cols-2 gap-xl items-center relative z-10">
    <div class="space-y-lg">
      <span class="inline-block py-1 px-3 bg-primary/10 text-primary rounded-full text-caption font-bold tracking-wide uppercase">Reputation management, simplified</span>
      <h1 class="font-display-lg text-display-lg text-on-background">
        Turn Customer Feedback into Your <span class="text-primary">Greatest Asset.</span>
      </h1>
      <p class="text-body-lg text-on-surface-variant max-w-xl">
        Collect ratings over Email, SMS &amp; WhatsApp. Happy customers are routed to Google and other public platforms — unhappy ones reach you privately, so you can fix it first.
      </p>
      <div class="flex flex-col sm:flex-row gap-md pt-md">
        <a href="<?php echo base_url('register'); ?>" class="bg-primary text-on-primary px-xl py-md rounded-lg font-label-md shadow-lg shadow-primary/20 hover:-translate-y-0.5 transition-all text-center">Start your 7-day free trial</a>
        <a href="#how-it-works" class="border border-outline-variant text-on-surface px-xl py-md rounded-lg font-label-md hover:bg-surface-container-low transition-all text-center">See how it works</a>
      </div>
      <p class="text-caption text-on-surface-variant pt-sm flex items-center gap-xs">
        <span class="material-symbols-outlined text-success text-base">check_circle</span>
        No credit card required · Free trial includes SMS, email &amp; WhatsApp credits
      </p>
    </div>

    <!-- Product mock -->
    <div class="relative lg:h-[520px] flex items-center justify-center lg:justify-end">
      <div class="relative z-10 w-full max-w-md bg-white rounded-xl shadow-2xl p-lg lg:rotate-2 hover:rotate-0 transition-transform duration-500">
        <div class="flex items-center justify-between mb-lg">
          <div class="flex gap-sm">
            <div class="w-3 h-3 rounded-full bg-error"></div>
            <div class="w-3 h-3 rounded-full bg-secondary-container"></div>
            <div class="w-3 h-3 rounded-full bg-success"></div>
          </div>
          <span class="text-caption text-outline">Real-time Analytics</span>
        </div>
        <div class="space-y-md">
          <div class="h-32 rounded-lg bg-surface-container-low flex items-end px-md gap-sm">
            <div class="flex-1 bg-primary/20 rounded-t-sm h-[40%]"></div>
            <div class="flex-1 bg-primary/40 rounded-t-sm h-[60%]"></div>
            <div class="flex-1 bg-primary/60 rounded-t-sm h-[85%]"></div>
            <div class="flex-1 bg-primary/80 rounded-t-sm h-[70%]"></div>
            <div class="flex-1 bg-primary rounded-t-sm h-[100%]"></div>
          </div>
          <div class="p-md rounded-lg border border-outline-variant flex items-center gap-md">
            <div class="w-12 h-12 rounded-full bg-success/10 flex items-center justify-center text-success">
              <span class="material-symbols-outlined">sentiment_very_satisfied</span>
            </div>
            <div>
              <p class="text-label-md text-on-surface">New 5-Star Review</p>
              <p class="text-caption text-on-surface-variant">Redirected to Google</p>
            </div>
          </div>
        </div>
      </div>
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-primary/5 rounded-full blur-3xl -z-10"></div>
    </div>
  </div>
</header>

<!-- How it works -->
<section id="how-it-works" class="py-section bg-surface-container-low">
  <div class="max-w-7xl mx-auto px-gutter text-center mb-xl">
    <h2 class="font-headline-lg text-headline-lg mb-md">How Smart Routing Works</h2>
    <p class="text-body-lg text-on-surface-variant max-w-2xl mx-auto">One rating decides the path — public praise goes out, private concerns come straight to you.</p>
  </div>
  <div class="max-w-5xl mx-auto px-gutter">
    <div class="flex flex-col md:flex-row items-center justify-between gap-xl">
      <div class="flex flex-col items-center text-center max-w-[220px]">
        <div class="w-16 h-16 rounded-full bg-white shadow-soft flex items-center justify-center mb-md border-2 border-primary/10">
          <span class="material-symbols-outlined text-primary text-3xl">qr_code_2</span>
        </div>
        <h3 class="font-bold mb-xs">1. Customer opens link</h3>
        <p class="text-caption">They scan a QR code or tap a link you send via SMS, email or WhatsApp.</p>
      </div>
      <div class="hidden md:block flex-1 h-[2px] bg-outline-variant"></div>
      <div class="flex flex-col items-center text-center max-w-[220px]">
        <div class="w-16 h-16 rounded-full bg-white shadow-soft flex items-center justify-center mb-md border-2 border-secondary-container/20">
          <span class="material-symbols-outlined text-secondary text-3xl">add_reaction</span>
        </div>
        <h3 class="font-bold mb-xs">2. They rate you</h3>
        <p class="text-caption">A quick 1–5 star rating — no friction, no long forms.</p>
      </div>
      <div class="hidden md:block flex-1 h-[2px] bg-outline-variant"></div>
      <div class="space-y-md">
        <div class="flex items-center gap-md p-md bg-success/5 border border-success/20 rounded-xl max-w-[280px]">
          <div class="w-10 h-10 rounded-full bg-success text-white flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined">thumb_up</span>
          </div>
          <div>
            <p class="text-label-md font-bold">Happy → Public</p>
            <p class="text-caption">Sent to Google &amp; your review platforms.</p>
          </div>
        </div>
        <div class="flex items-center gap-md p-md bg-error/5 border border-error/20 rounded-xl max-w-[280px]">
          <div class="w-10 h-10 rounded-full bg-error text-white flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined">lock</span>
          </div>
          <div>
            <p class="text-label-md font-bold">Unhappy → Private</p>
            <p class="text-caption">Kept private so you can resolve it.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Features -->
<section id="features" class="py-section">
  <div class="max-w-7xl mx-auto px-gutter">
    <div class="max-w-xl mb-xl">
      <h2 class="font-headline-lg text-headline-lg mb-md">Everything you need to grow your reputation.</h2>
      <p class="text-body-md text-on-surface-variant">Simple tools that get more reviews and keep your rating high.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-lg">
      <?php
      $features = array(
        array('auto_awesome', 'Smart Routing', 'Send happy customers to Google while private feedback comes to you.'),
        array('forum', 'Email, SMS &amp; WhatsApp', 'Invite customers on the channel they actually use — one at a time or in bulk via CSV.'),
        array('qr_code_2', 'QR Codes &amp; Widgets', 'Print a QR for your counter or embed a review widget on your site.'),
        array('bar_chart', 'Real-time Analytics', 'Track ratings, platforms and trends from a single dashboard.'),
      );
      foreach ($features as $f): ?>
      <div class="p-lg rounded-xl border border-outline-variant hover:border-primary/50 transition-all group">
        <div class="w-12 h-12 bg-primary/10 text-primary rounded-lg flex items-center justify-center mb-md group-hover:bg-primary group-hover:text-on-primary transition-colors">
          <span class="material-symbols-outlined"><?php echo $f[0]; ?></span>
        </div>
        <h3 class="font-headline-md text-[20px] mb-sm"><?php echo $f[1]; ?></h3>
        <p class="text-body-md text-on-surface-variant"><?php echo $f[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Pricing (driven by real plans in the database) -->
<section id="pricing" class="py-section bg-surface-container-low">
  <div class="max-w-7xl mx-auto px-gutter">
    <div class="text-center mb-xl">
      <h2 class="font-headline-lg text-headline-lg mb-md">Simple, transparent pricing.</h2>
      <p class="text-body-lg text-on-surface-variant">Start free for 7 days. Upgrade whenever you're ready.</p>
    </div>
    <?php
    $activePlans = array();
    if (isset($plans) && $plans) {
      foreach ($plans->result() as $p) {
        if (isset($p->active) && $p->active == '1') { $activePlans[] = $p; }
      }
    }
    $featuredIdx = (count($activePlans) >= 2) ? (int) floor((count($activePlans) - 1) / 2) : -1;
    ?>
    <?php if (!empty($activePlans)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg max-w-6xl mx-auto items-stretch">
      <?php foreach ($activePlans as $i => $p):
        $isFree = ((float) $p->amount == 0);
        $featured = ($i === $featuredIdx);
      ?>
      <div class="bg-white rounded-xl p-xl flex flex-col transition-all <?php echo $featured ? 'border-2 border-primary shadow-soft relative lg:scale-105 z-10' : 'border border-outline-variant hover:shadow-xl'; ?>">
        <?php if ($featured): ?>
        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary text-on-primary px-4 py-1 rounded-full text-caption font-bold tracking-widest uppercase">Most Popular</div>
        <?php endif; ?>
        <div class="mb-lg">
          <h3 class="font-bold text-lg mb-xs"><?php echo htmlspecialchars($p->name); ?></h3>
          <div class="flex items-baseline gap-xs">
            <?php if ($isFree): ?>
              <span class="text-4xl font-extrabold <?php echo $featured ? 'text-primary' : ''; ?>">Free</span>
            <?php else: ?>
              <span class="text-4xl font-extrabold <?php echo $featured ? 'text-primary' : ''; ?>">&#8377;<?php echo htmlspecialchars($p->amount); ?></span>
              <?php if (!empty($p->per)): ?><span class="text-on-surface-variant">/<?php echo htmlspecialchars($p->per); ?></span><?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
        <ul class="space-y-md mb-xl flex-1">
          <li class="flex items-center gap-md text-body-md"><span class="material-symbols-outlined text-success text-sm">check</span> <?php echo (int) $p->email_quota; ?> Email invites</li>
          <li class="flex items-center gap-md text-body-md"><span class="material-symbols-outlined text-success text-sm">check</span> <?php echo (int) $p->sms_quota; ?> SMS invites</li>
          <li class="flex items-center gap-md text-body-md"><span class="material-symbols-outlined text-success text-sm">check</span> <?php echo (int) $p->whatsapp_quota; ?> WhatsApp invites</li>
          <li class="flex items-center gap-md text-body-md"><span class="material-symbols-outlined text-success text-sm">check</span> <?php echo (int) $p->web_quota; ?> Review platform<?php echo ((int) $p->web_quota === 1) ? '' : 's'; ?></li>
          <li class="flex items-center gap-md text-body-md"><span class="material-symbols-outlined text-success text-sm">check</span> Smart Routing &amp; Analytics</li>
        </ul>
        <a href="<?php echo base_url('register'); ?>" class="w-full py-md rounded-lg font-bold text-center block transition-all <?php echo $featured ? 'bg-primary text-on-primary shadow-lg shadow-primary/20 hover:opacity-90' : 'border border-primary text-primary hover:bg-primary/5'; ?>">Get Started</a>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="text-center bg-white border border-outline-variant rounded-xl max-w-xl mx-auto p-xl">
      <p class="text-body-lg text-on-surface-variant mb-lg">Create your account and start your free 7-day trial — no card required.</p>
      <a href="<?php echo base_url('register'); ?>" class="inline-block bg-primary text-on-primary px-xl py-md rounded-lg font-bold hover:opacity-90 transition-all">Get Started Free</a>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- FAQ -->
<section class="py-section">
  <div class="max-w-3xl mx-auto px-gutter">
    <h2 class="font-headline-lg text-center mb-xl">Common Questions</h2>
    <div class="space-y-md">
      <?php
      $faqs = array(
        array('How does Smart Routing work?', 'When a customer rates you highly, they are prompted to post that review on your public platforms like Google. Lower ratings open a private feedback form that reaches your team directly, so you can resolve the issue.'),
        array('How do I invite customers?', 'Send a review link over Email, SMS or WhatsApp — individually or in bulk with a CSV import — or display a QR code at your location.'),
        array('Is there a free trial?', 'Yes. Every new account starts with a 7-day free trial that includes SMS, email and WhatsApp credits. No credit card is required to begin.'),
        array('Which platforms are supported?', 'You can route positive reviews to Google and any other public review platform you configure for your business.'),
      );
      foreach ($faqs as $q): ?>
      <details class="group p-md border border-outline-variant rounded-xl [&amp;_summary::-webkit-details-marker]:hidden">
        <summary class="flex justify-between items-center cursor-pointer font-bold">
          <span><?php echo $q[0]; ?></span>
          <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
        </summary>
        <div class="pt-md text-body-md text-on-surface-variant"><?php echo $q[1]; ?></div>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="py-section">
  <div class="max-w-5xl mx-auto px-gutter">
    <div class="bg-primary rounded-[2rem] p-xl md:p-24 text-center text-on-primary">
      <h2 class="font-display-lg text-display-lg mb-md text-white">Ready to take control of your reputation?</h2>
      <p class="text-body-lg mb-xl opacity-90 max-w-2xl mx-auto">Start collecting reviews today with a free 7-day trial.</p>
      <a href="<?php echo base_url('register'); ?>" class="inline-block bg-white text-primary px-xl py-md rounded-lg font-bold hover:bg-surface-bright transition-all">Start My Free Trial</a>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-surface-container-low border-t border-outline-variant">
  <div class="w-full py-xl px-gutter flex flex-col md:flex-row justify-between items-start gap-xl max-w-7xl mx-auto">
    <div class="max-w-sm space-y-md">
      <a href="<?php echo base_url(); ?>" class="font-headline-lg text-xl font-extrabold text-primary"><?php echo htmlspecialchars($site_name); ?></a>
      <p class="text-body-md text-on-surface-variant">Helping businesses grow through real customer feedback and smarter reputation management.</p>
    </div>
    <div class="grid grid-cols-2 gap-xl">
      <div class="space-y-md">
        <h4 class="font-bold">Product</h4>
        <ul class="space-y-sm">
          <li><a class="text-on-surface-variant hover:text-primary transition-colors" href="#how-it-works">How it Works</a></li>
          <li><a class="text-on-surface-variant hover:text-primary transition-colors" href="#features">Features</a></li>
          <li><a class="text-on-surface-variant hover:text-primary transition-colors" href="#pricing">Pricing</a></li>
        </ul>
      </div>
      <div class="space-y-md">
        <h4 class="font-bold">Account</h4>
        <ul class="space-y-sm">
          <li><a class="text-on-surface-variant hover:text-primary transition-colors" href="<?php echo base_url('login'); ?>">Login</a></li>
          <li><a class="text-on-surface-variant hover:text-primary transition-colors" href="<?php echo base_url('register'); ?>">Register</a></li>
          <li><a class="text-on-surface-variant hover:text-primary transition-colors" href="<?php echo base_url('support'); ?>">Support</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="max-w-7xl mx-auto px-gutter py-lg border-t border-outline-variant text-caption text-on-surface-variant text-center md:text-left">
    &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($site_name); ?>. All rights reserved.
  </div>
</footer>

</body>
</html>
