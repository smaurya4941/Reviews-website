import os

views = [
    'application/views/users/dashboard.php',
    'application/views/users/platforms.php',
    'application/views/users/plans.php',
    'application/views/users/company.php',
    'application/views/users/account.php',
    'application/views/users/report.php',
    'application/views/users/share.php'
]

for view in views:
    path = os.path.join('d:\\bizorm', view)
    if os.path.exists(path):
        with open(path, 'r', encoding='utf-8') as f:
            content = f.read()
        
        has_chartjs = 'chart.js' in content
        has_qrcode = 'qrcode.min.js' in content
        has_html2canvas = 'html2canvas.min.js' in content
        
        extra_scripts = ''
        if has_chartjs:
            extra_scripts += '<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>\n'
        if has_qrcode:
            extra_scripts += '<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>\n'
        if has_html2canvas:
            extra_scripts += '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>\n'
            
        header_end = content.find('</header>')
        main_end = content.find('</main>')
        
        if header_end != -1 and main_end != -1:
            new_content = "<?php $this->load->view('templates/tw_header'); ?>\n" + extra_scripts
            new_content += content[header_end + 9:main_end]
            new_content += "<?php $this->load->view('templates/tw_footer'); ?>\n"
            
            with open(path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print('Updated ' + view)
        else:
            print('Skipped ' + view + ' (tags not found)')
