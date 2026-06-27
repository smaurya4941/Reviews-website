# Bizorm - Premium Reputation Management Platform

Bizorm is a comprehensive, modern feedback and reputation management platform designed to help businesses collect, track, and manage customer reviews. Recently overhauled with a premium "Modern Authority" aesthetic, the platform combines powerful backend PHP/CodeIgniter functionality with a state-of-the-art, responsive Tailwind CSS frontend interface.

---

## 🚀 Key Features & Capabilities

### 1. Seamless Authentication & Onboarding
*   **Frictionless Registration:** Users can easily sign up without encountering immediate subscription paywalls.
*   **Automatic Trials:** New accounts are automatically provisioned with a 7-day trial and default quotas behind the scenes, ensuring immediate access to the platform's core features.
*   **Secure Authentication:** Fortified login logic with proper redirect routing and CSRF-protected validation endpoints.

### 2. Premium Analytics Dashboard
*   **Modern Aesthetics:** Fully refactored from legacy Bootstrap to a high-end, compact Tailwind CSS layout featuring responsive sidebars and glassmorphic card designs.
*   **Dynamic Visualizations:** Integrated **Chart.js** renders real-time data visualizing:
    *   *Reviews per Platform* (Doughnut Chart)
    *   *Reviews Over Time* (Line Chart)
    *   *Rating Distribution* (Bar Chart)
*   **Campaign Management:** Easily create iframe-based review widgets and generate shareable links/QR Codes for customers directly from the dashboard.

### 3. Comprehensive Share & Broadcast System
*   **Multi-Channel Sharing:** Dedicated interfaces to send feedback requests via **Email, SMS, and WhatsApp**.
*   **Bulk Importing:** Users can upload CSV files to batch-import contacts for mass email and SMS distribution.
*   **Platform Integration:** Dynamically link campaigns to different platforms and auto-generate personalized subject lines and message bodies.

---

## 🛠️ Technology Stack

*   **Backend Framework:** CodeIgniter (PHP MVC Architecture)
*   **Database:** MySQL
*   **Frontend Styling:** Tailwind CSS (via CDN) + Custom Glassmorphism UI tokens.
*   **Interactivity & State:** jQuery & AJAX (Ensures smooth, page-reload-free interactions).
*   **Data Visualization:** Chart.js
*   **Security:** Native CodeIgniter CSRF protection implemented on all state-mutating requests.

---

## 📁 Project Structure (MVC)

*   **`/application/controllers/`**
    *   `User.php`: The core controller handling authentication, dashboard rendering, link generation, and share functionalities.
*   **`/application/models/`**
    *   `Usermodel.php`: Handles database operations, including trial provisioning, quota verification, and complex chart data aggregations.
*   **`/application/views/`**
    *   `users/dashboard.php`: The premium, standalone dashboard view.
    *   `users/share.php`: The tabbed, comprehensive feedback broadcasting view.
    *   `templates/`: Contains legacy headers and footers for older pages pending modernization.
*   **`/assets/`**
    *   Contains bespoke CSS overrides, JavaScript handlers (like `share.js`), and imagery.

---

## 🔧 Recent Modernization Efforts

The platform has recently undergone a massive UI/UX refactoring:
1.  **Compact UI Design:** Implemented a highly optimized, typography-focused Tailwind configuration (Plus Jakarta Sans & Inter) to maximize screen real estate and professional appeal.
2.  **Decoupled Architecture:** Core pages (`Dashboard` & `Share`) were unhooked from legacy Bootstrap wrappers to render completely independently as modern, standalone views.
3.  **Advanced Modals:** Upgraded legacy Bootstrap pop-ups into beautiful Tailwind `.modal-overlay` components with backdrop blurring.

---

## 💻 Local Development Setup

1.  Clone the repository into your local server (e.g., XAMPP/WAMP `htdocs` or equivalent).
2.  Import the Bizorm MySQL schema.
3.  Configure your database credentials in `application/config/database.php`.
4.  Ensure `application/config/config.php` has the correct `base_url` defined.
5.  *Note:* The current development environment bypasses strict SMTP email verification to allow for rapid local testing of the authentication flow.

*Built to empower businesses in establishing and mastering their digital authority.*
