import re

with open('landing.html', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace Login button
content = content.replace(
    '<button class="hidden sm:block text-label-md font-label-md text-primary px-md py-sm hover:bg-surface-bright transition-all duration-200">Login</button>',
    '<a href="<?php echo base_url(\'login\'); ?>" class="hidden sm:block text-label-md font-label-md text-primary px-md py-sm hover:bg-surface-bright transition-all duration-200 text-center flex items-center">Login</a>'
)

# Replace Get Started button in nav
content = content.replace(
    '<button class="bg-primary-container text-on-primary-container px-lg py-sm rounded-lg font-label-md hover:opacity-90 active:scale-95 transition-all">Get Started</button>',
    '<a href="<?php echo base_url(\'register\'); ?>" class="bg-primary-container text-on-primary-container px-lg py-sm rounded-lg font-label-md hover:opacity-90 active:scale-95 transition-all text-center flex items-center">Get Started</a>'
)

# Replace Get Started for Free button in hero
content = content.replace(
    '<button class="bg-primary text-on-primary px-xl py-md rounded-lg font-label-md shadow-lg shadow-primary/20 hover:translate-y-[-2px] transition-all">Get Started for Free</button>',
    '<a href="<?php echo base_url(\'register\'); ?>" class="bg-primary text-on-primary px-xl py-md rounded-lg font-label-md shadow-lg shadow-primary/20 hover:translate-y-[-2px] transition-all text-center flex items-center inline-block">Get Started for Free</a>'
)

# Replace See How It Works button
content = content.replace(
    '<button class="border border-outline-variant text-on-surface px-xl py-md rounded-lg font-label-md hover:bg-surface-container-low transition-all">See How It Works</button>',
    '<a href="#how-it-works" class="border border-outline-variant text-on-surface px-xl py-md rounded-lg font-label-md hover:bg-surface-container-low transition-all text-center flex items-center inline-block">See How It Works</a>'
)

# Replace Start My Free Trial button
content = content.replace(
    '<button class="bg-white text-primary px-xl py-md rounded-lg font-bold hover:bg-surface-bright transition-all">Start My Free Trial</button>',
    '<a href="<?php echo base_url(\'register\'); ?>" class="bg-white text-primary px-xl py-md rounded-lg font-bold hover:bg-surface-bright transition-all text-center flex items-center inline-block">Start My Free Trial</a>'
)

# Replace logo link wrapper (if it's not wrapped in a tag)
content = content.replace(
    '<img alt="Bizorm Logo" class="h-10 object-contain"',
    '<a href="<?php echo base_url(); ?>"><img alt="Bizorm Logo" class="h-10 object-contain"'
)
content = content.replace(
    '1wScxzEm6ufN4P2OpeVNK6kvMZnSXpZ1iuQHmZWLpbsIQGRc8LpuBfp8Tg58q5PDe1AwvS04g"/>\n</div>',
    '1wScxzEm6ufN4P2OpeVNK6kvMZnSXpZ1iuQHmZWLpbsIQGRc8LpuBfp8Tg58q5PDe1AwvS04g"/></a>\n</div>'
)

# Other buttons like Pricing Get Started
content = content.replace(
    '<button class="w-full py-md border border-primary text-primary font-bold rounded-lg hover:bg-primary/5 transition-all">Get Started</button>',
    '<a href="<?php echo base_url(\'register\'); ?>" class="w-full py-md border border-primary text-primary font-bold rounded-lg hover:bg-primary/5 transition-all text-center block">Get Started</a>'
)
content = content.replace(
    '<button class="w-full py-md bg-primary text-on-primary font-bold rounded-lg shadow-lg shadow-primary/20 hover:opacity-90 transition-all">Get Started</button>',
    '<a href="<?php echo base_url(\'register\'); ?>" class="w-full py-md bg-primary text-on-primary font-bold rounded-lg shadow-lg shadow-primary/20 hover:opacity-90 transition-all text-center block">Get Started</a>'
)

with open('application/views/templates/home.php', 'w', encoding='utf-8') as f:
    f.write(content)
