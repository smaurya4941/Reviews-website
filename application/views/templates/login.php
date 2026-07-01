<!DOCTYPE html><html class="light" lang="en" style=""><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Login | <?php echo htmlspecialchars(($this->st && $this->st->site_name) ? $this->st->site_name : 'Bizorm'); ?> - Reputation Management</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Plus+Jakarta+Sans:wght@600;700;800&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .shadow-soft {
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.1), 0 8px 10px -6px rgba(37, 99, 235, 0.05);
        }
        body {
            background-color: #f9f9ff;
        }
    </style>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-secondary": "#ffffff",
                    "on-tertiary-fixed-variant": "#7d2d00",
                    "surface-container-highest": "#d8e3fb",
                    "inverse-primary": "#b4c5ff",
                    "error": "#EF4444",
                    "secondary": "#795900",
                    "on-surface": "#111c2d",
                    "surface": "#f9f9ff",
                    "on-secondary-container": "#6f5100",
                    "on-error-container": "#93000a",
                    "success": "#10B981",
                    "secondary-fixed-dim": "#f9bd22",
                    "on-primary-fixed": "#00174b",
                    "background": "#f9f9ff",
                    "tertiary-fixed-dim": "#ffb596",
                    "surface-bright": "#f9f9ff",
                    "on-tertiary-fixed": "#360f00",
                    "on-tertiary": "#ffffff",
                    "on-secondary-fixed-variant": "#5c4300",
                    "on-error": "#ffffff",
                    "inverse-on-surface": "#ecf1ff",
                    "outline": "#737686",
                    "on-secondary-fixed": "#261a00",
                    "on-surface-variant": "#434655",
                    "secondary-container": "#ffc329",
                    "on-primary-fixed-variant": "#003ea8",
                    "primary-fixed-dim": "#b4c5ff",
                    "tertiary-container": "#bc4800",
                    "primary-fixed": "#dbe1ff",
                    "info": "#3B82F6",
                    "outline-variant": "#c3c6d7",
                    "on-primary": "#ffffff",
                    "primary-container": "#2563eb",
                    "surface-container-high": "#dee8ff",
                    "primary": "#004ac6",
                    "surface-subtle": "#F8FAFC",
                    "on-primary-container": "#eeefff",
                    "surface-container": "#e7eeff",
                    "surface-container-lowest": "#ffffff",
                    "error-container": "#ffdad6",
                    "on-tertiary-container": "#ffede6",
                    "surface-variant": "#d8e3fb",
                    "on-background": "#111c2d",
                    "surface-tint": "#0053db",
                    "surface-container-low": "#f0f3ff",
                    "surface-dim": "#cfdaf2",
                    "tertiary": "#943700",
                    "inverse-surface": "#263143",
                    "tertiary-fixed": "#ffdbcd",
                    "secondary-fixed": "#ffdf9f"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "sm": "8px",
                    "gutter": "24px",
                    "base": "4px",
                    "md": "16px",
                    "lg": "24px",
                    "xs": "4px",
                    "xl": "40px",
                    "section": "80px"
            },
            "fontFamily": {
                    "label-md": ["Inter"],
                    "headline-md": ["Plus Jakarta Sans"],
                    "body-lg": ["Inter"],
                    "headline-lg": ["Plus Jakarta Sans"],
                    "display-lg": ["Plus Jakarta Sans"],
                    "body-md": ["Inter"],
                    "headline-lg-mobile": ["Plus Jakarta Sans"],
                    "caption": ["Inter"]
            },
            "fontSize": {
                    "label-md": ["14px", {"lineHeight": "1", "letterSpacing": "0.01em", "fontWeight": "600"}],
                    "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "headline-lg": ["32px", {"lineHeight": "1.25", "fontWeight": "700"}],
                    "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
                    "headline-lg-mobile": ["28px", {"lineHeight": "1.25", "fontWeight": "700"}],
                    "caption": ["12px", {"lineHeight": "1.4", "fontWeight": "500"}]
            }
          },
        },
      }
    </script>
</head>
<?php
$site_name = ($this->st && $this->st->site_name) ? $this->st->site_name : 'Bizorm';
$site_logo = ($this->st && $this->st->site_logo) ? base_url('assets/images/') . $this->st->site_logo : base_url('assets/images/logo.png');
?>
<body class="min-h-screen flex flex-col md:flex-row overflow-x-hidden">
<!-- Brand/Illustration Side (Left) -->
<div class="hidden md:flex md:w-1/2 lg:w-3/5 bg-surface-container relative items-center justify-center p-xl overflow-hidden">
<!-- Background Animation/Decoration -->
<div class="absolute inset-0 z-0">
<div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-primary/5 rounded-full blur-3xl"></div>
<div class="absolute bottom-[-20%] left-[-10%] w-[600px] h-[600px] bg-secondary-container/10 rounded-full blur-3xl"></div>
</div>
<div class="relative z-10 max-w-xl text-center space-y-lg">
<div class="flex justify-center mb-xl">
<a href="<?php echo base_url(); ?>"><img alt="<?php echo htmlspecialchars($site_name); ?> Logo" class="h-24 md:h-32 object-contain filter drop-shadow-lg" src="<?php echo $site_logo; ?>"></a>
</div>
<div class="space-y-md">
<h1 class="font-display-lg text-display-lg text-primary">Master Your Brand's Narrative.</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-md mx-auto">
                    Collect reviews, route happy customers to Google, and turn feedback into growth — all from one dashboard.
                </p>
</div>
<!-- Bento-style feature highlight cards -->
<div class="grid grid-cols-2 gap-md pt-xl">
<div class="glass-card p-md rounded-xl text-left shadow-soft transform hover:-translate-y-1 transition-transform">
<span class="material-symbols-outlined text-primary mb-sm">insights</span>
<h3 class="font-label-md text-label-md text-on-surface">Sentiment Analysis</h3>
<p class="font-caption text-caption text-on-surface-variant">Understand how customers really feel.</p>
</div>
<div class="glass-card p-md rounded-xl text-left shadow-soft transform hover:-translate-y-1 transition-transform">
<span class="material-symbols-outlined text-secondary mb-sm">star_rate</span>
<h3 class="font-label-md text-label-md text-on-surface">Review Aggregator</h3>
<p class="font-caption text-caption text-on-surface-variant">All your platforms in one view.</p>
</div>
</div>
</div>
</div>
<!-- Login Form Side (Right) -->
<div class="flex-1 flex flex-col justify-center items-center px-gutter py-xl bg-surface-container-lowest">
<div class="w-full max-w-[420px] space-y-xl">
<!-- Mobile Logo (Visible only on small screens) -->
<div class="md:hidden flex flex-col items-center space-y-md mb-xl">
<img alt="<?php echo htmlspecialchars($site_name); ?> Logo" class="h-16 object-contain" src="<?php echo $site_logo; ?>">
<h2 class="font-headline-lg-mobile text-headline-lg-mobile text-primary">Welcome Back</h2>
</div>
<!-- Flash / validation messages (visible on all screen sizes) -->
<?php if($this->session->flashdata('error')): ?>
    <div class="bg-error/10 border border-error/50 text-error p-3 rounded-lg text-sm">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata('success')): ?>
    <div class="bg-success/10 border border-success/50 text-success p-3 rounded-lg text-sm">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>
<?php echo validation_errors('<div class="bg-error/10 border border-error/50 text-error p-3 rounded-lg text-sm">', '</div>'); ?>
<!-- Header (desktop) -->
<div class="hidden md:block space-y-sm text-left">
<h2 class="font-headline-lg text-headline-lg text-on-surface">Welcome Back</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Please enter your details to sign in.</p>
</div>
<!-- Form -->
<form action="<?php echo base_url('login'); ?>" method="post" id="loginForm" class="space-y-lg">
<input type="hidden" class="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
<!-- Social Login -->


<div class="space-y-md">
<!-- Email -->
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface" for="email">Username</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline text-[20px]">mail</span>
<input class="w-full pl-xl pr-md py-md bg-surface-subtle border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-primary-container focus:border-primary transition-all outline-none" name="uname" id="uname" placeholder="Your Username" type="text" required>
</div>
</div>
<!-- Password -->
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
<input class="w-full pl-xl pr-md py-md bg-surface-subtle border border-outline-variant rounded-lg font-body-md text-body-md focus:ring-2 focus:ring-primary-container focus:border-primary transition-all outline-none" name="pwd" id="pwd" placeholder="Your Password" type="password" required>
</div>
</div>
</div>
<!-- Extras -->
<div class="flex items-center justify-between">
<label class="flex items-center gap-sm cursor-pointer group">
<input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary" type="checkbox">
<span class="font-caption text-caption text-on-surface-variant group-hover:text-on-surface transition-colors">Remember me</span>
</label>
<a class="font-caption text-caption text-primary font-bold hover:underline" href="<?php echo base_url('support'); ?>">Forgot password?</a>
</div>
<!-- Login Button -->
<button class="w-full py-md px-lg bg-primary text-on-primary rounded-lg font-label-md text-label-md shadow-soft hover:opacity-90 active:scale-[0.98] transition-all" type="submit">
                    Login to Workspace
                </button>
</form>
<!-- Footer Link -->
<p class="text-center font-body-md text-body-md text-on-surface-variant">
                Don't have an account? 
                <a class="text-primary font-bold hover:underline" href="<?php echo base_url('register'); ?>">Register for free</a>
</p>
</div>
<!-- Footer Info -->
<footer class="mt-auto pt-xl w-full max-w-[420px] flex flex-col md:flex-row justify-between items-center gap-md opacity-60">
<p class="font-caption text-caption text-outline">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($site_name); ?>. All rights reserved.</p>
<div class="flex gap-md">
<a class="font-caption text-caption text-outline hover:text-primary transition-colors" href="<?php echo base_url('support'); ?>">Help</a>
</div>
</footer>
</div>
<!-- Micro-interaction Script -->
<script>
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                const icon = input.parentElement.querySelector('.material-symbols-outlined');
                if (icon) { icon.classList.add('text-primary'); icon.classList.remove('text-outline'); }
            });
            input.addEventListener('blur', () => {
                const icon = input.parentElement.querySelector('.material-symbols-outlined');
                if (icon) { icon.classList.remove('text-primary'); icon.classList.add('text-outline'); }
            });
        });
    </script>


</body></html>