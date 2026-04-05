-- Privacy Policy and Terms of Use for Hmm Dating App
-- Run this SQL to update the pages table

-- Privacy Policy
UPDATE pages SET privacy = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Hmm Dating</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.7;
            color: #E8E8E8;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #0D0D0D 0%, #1A1A2E 50%, #16213E 100%);
            min-height: 100vh;
        }
        h1 {
            color: #E91E63;
            border-bottom: 2px solid #E91E63;
            padding-bottom: 10px;
            text-shadow: 0 0 20px rgba(233, 30, 99, 0.3);
        }
        h2 {
            color: #E91E63;
            margin-top: 30px;
            text-shadow: 0 0 10px rgba(233, 30, 99, 0.2);
        }
        h3 { color: #FF6B9D; }
        p, li { color: rgba(255, 255, 255, 0.85); }
        a { color: #E91E63; text-decoration: none; }
        a:hover { text-decoration: underline; }
        ul { padding-left: 20px; }
        li { margin: 8px 0; }
        .contact-info {
            background: rgba(233, 30, 99, 0.1);
            padding: 20px;
            border-radius: 12px;
            margin-top: 30px;
            border-left: 4px solid #E91E63;
            backdrop-filter: blur(10px);
        }
        .last-updated { color: rgba(255, 255, 255, 0.5); font-style: italic; }
        strong { color: #E91E63; }
    </style>
</head>
<body>
    <h1>Privacy Policy</h1>
    <p class="last-updated">Last Updated: January 11, 2026</p>

    <p>Welcome to <strong>Hmm Dating</strong>. We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our mobile application.</p>

    <h2>1. Information We Collect</h2>

    <h3>1.1 Personal Information</h3>
    <p>We collect information that you provide directly to us, including:</p>
    <ul>
        <li>Name, email address, and phone number</li>
        <li>Date of birth and gender</li>
        <li>Profile photos and bio information</li>
        <li>Location data (city, state, country)</li>
        <li>Interests, relationship goals, and preferences</li>
        <li>Social media links (Instagram, Facebook, YouTube)</li>
    </ul>

    <h3>1.2 Usage Information</h3>
    <p>We automatically collect certain information when you use the App:</p>
    <ul>
        <li>Device information (device type, operating system)</li>
        <li>App usage statistics and interaction data</li>
        <li>IP address and approximate location</li>
        <li>Chat messages and communication history</li>
    </ul>

    <h2>2. How We Use Your Information</h2>
    <p>We use the information we collect to:</p>
    <ul>
        <li>Create and manage your account</li>
        <li>Match you with other users based on preferences</li>
        <li>Enable communication between users</li>
        <li>Process payments and subscriptions</li>
        <li>Send notifications about matches and messages</li>
        <li>Improve our services and user experience</li>
        <li>Ensure safety and prevent fraud</li>
        <li>Comply with legal obligations</li>
    </ul>

    <h2>3. Sharing Your Information</h2>
    <p>We may share your information in the following situations:</p>
    <ul>
        <li><strong>With Other Users:</strong> Your profile information is visible to other users of the App</li>
        <li><strong>Service Providers:</strong> Third-party vendors who assist in operating our services</li>
        <li><strong>Legal Requirements:</strong> When required by law or to protect our rights</li>
        <li><strong>Business Transfers:</strong> In connection with merger, acquisition, or sale of assets</li>
    </ul>

    <h2>4. Data Security</h2>
    <p>We implement appropriate security measures to protect your personal information, including:</p>
    <ul>
        <li>Encryption of data in transit and at rest</li>
        <li>Secure server infrastructure</li>
        <li>Regular security assessments</li>
        <li>Access controls and authentication</li>
    </ul>

    <h2>5. Your Rights</h2>
    <p>You have the right to:</p>
    <ul>
        <li>Access your personal data</li>
        <li>Correct inaccurate information</li>
        <li>Delete your account and data</li>
        <li>Opt-out of marketing communications</li>
        <li>Control location sharing settings</li>
    </ul>

    <h2>6. Data Retention</h2>
    <p>We retain your personal information for as long as your account is active or as needed to provide services. You can delete your account at any time through the App settings.</p>

    <h2>7. Children''s Privacy</h2>
    <p>Hmm Dating is not intended for users under 18 years of age. We do not knowingly collect information from children under 18.</p>

    <h2>8. Changes to This Policy</h2>
    <p>We may update this Privacy Policy from time to time. We will notify you of any changes by updating the "Last Updated" date.</p>

    <div class="contact-info">
        <h2>9. Contact Us</h2>
        <p>If you have questions about this Privacy Policy, please contact us:</p>
        <p><strong>Hmm Dating</strong></p>
        <p>Email: <a href="mailto:info@elevenmonk.com">info@elevenmonk.com</a></p>
        <p>Phone: <a href="tel:+917021044529">+91-7021044529</a></p>
    </div>
</body>
</html>' WHERE id = 1;

-- Terms of Use
UPDATE pages SET termsofuse = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Use - Hmm Dating</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.7;
            color: #E8E8E8;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #0D0D0D 0%, #1A1A2E 50%, #16213E 100%);
            min-height: 100vh;
        }
        h1 {
            color: #E91E63;
            border-bottom: 2px solid #E91E63;
            padding-bottom: 10px;
            text-shadow: 0 0 20px rgba(233, 30, 99, 0.3);
        }
        h2 {
            color: #E91E63;
            margin-top: 30px;
            text-shadow: 0 0 10px rgba(233, 30, 99, 0.2);
        }
        h3 { color: #FF6B9D; }
        p, li { color: rgba(255, 255, 255, 0.85); }
        a { color: #E91E63; text-decoration: none; }
        a:hover { text-decoration: underline; }
        ul { padding-left: 20px; }
        li { margin: 8px 0; }
        .contact-info {
            background: rgba(233, 30, 99, 0.1);
            padding: 20px;
            border-radius: 12px;
            margin-top: 30px;
            border-left: 4px solid #E91E63;
            backdrop-filter: blur(10px);
        }
        .last-updated { color: rgba(255, 255, 255, 0.5); font-style: italic; }
        .warning {
            background: rgba(255, 193, 7, 0.15);
            padding: 15px;
            border-radius: 12px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
            color: #FFD54F;
        }
        .warning strong { color: #ffc107; }
        strong { color: #E91E63; }
    </style>
</head>
<body>
    <h1>Terms of Use</h1>
    <p class="last-updated">Last Updated: January 11, 2026</p>

    <p>Welcome to <strong>Hmm Dating</strong>. By accessing or using our mobile application, you agree to be bound by these Terms of Use. Please read them carefully.</p>

    <h2>1. Acceptance of Terms</h2>
    <p>By creating an account or using Hmm Dating, you agree to these Terms of Use and our Privacy Policy. If you do not agree, please do not use our services.</p>

    <h2>2. Eligibility</h2>
    <p>To use Hmm Dating, you must:</p>
    <ul>
        <li>Be at least 18 years of age</li>
        <li>Be legally permitted to use the service under applicable laws</li>
        <li>Not be a convicted sex offender</li>
        <li>Not have been previously banned from Hmm Dating</li>
    </ul>

    <h2>3. Account Registration</h2>
    <p>When you create an account:</p>
    <ul>
        <li>You must provide accurate and complete information</li>
        <li>You are responsible for maintaining account security</li>
        <li>You must not share your account with others</li>
        <li>You must notify us immediately of any unauthorized access</li>
    </ul>

    <h2>4. User Conduct</h2>
    <p>You agree NOT to:</p>
    <ul>
        <li>Harass, threaten, or intimidate other users</li>
        <li>Post false, misleading, or fraudulent information</li>
        <li>Upload inappropriate, offensive, or illegal content</li>
        <li>Use the app for commercial purposes without permission</li>
        <li>Impersonate another person or entity</li>
        <li>Violate any applicable laws or regulations</li>
        <li>Attempt to hack, disrupt, or damage our services</li>
        <li>Collect other users'' information without consent</li>
        <li>Send spam or unsolicited messages</li>
    </ul>

    <div class="warning">
        <strong>Warning:</strong> Violation of these rules may result in immediate account suspension or permanent ban without refund.
    </div>

    <h2>5. Content Guidelines</h2>
    <p>All content you post must:</p>
    <ul>
        <li>Be your own or you have permission to use</li>
        <li>Not contain nudity or sexually explicit material</li>
        <li>Not promote violence, discrimination, or illegal activities</li>
        <li>Not infringe on intellectual property rights</li>
    </ul>

    <h2>6. Premium Subscriptions</h2>
    <h3>6.1 Payment</h3>
    <ul>
        <li>Subscriptions are billed in advance on a recurring basis</li>
        <li>Payment is processed through secure payment gateways</li>
        <li>Prices may change with prior notice</li>
    </ul>

    <h3>6.2 Cancellation</h3>
    <ul>
        <li>You can cancel your subscription at any time</li>
        <li>Access continues until the end of the billing period</li>
        <li>No refunds for partial subscription periods</li>
    </ul>

    <h2>7. Heart Wallet</h2>
    <ul>
        <li>Hearts are virtual currency for in-app features</li>
        <li>Hearts have no real-world monetary value</li>
        <li>Hearts are non-refundable and non-transferable</li>
        <li>Unused hearts expire if your account is deleted</li>
    </ul>

    <h2>8. Safety</h2>
    <p>While we strive to maintain a safe environment:</p>
    <ul>
        <li>We do not conduct criminal background checks on users</li>
        <li>You are responsible for your own safety when meeting others</li>
        <li>Report suspicious or inappropriate behavior immediately</li>
        <li>Meet in public places for initial meetings</li>
    </ul>

    <h2>9. Intellectual Property</h2>
    <p>All content and materials on Hmm Dating, including the logo, design, and features, are owned by us and protected by intellectual property laws.</p>

    <h2>10. Disclaimer of Warranties</h2>
    <p>Hmm Dating is provided "as is" without warranties of any kind. We do not guarantee:</p>
    <ul>
        <li>Compatibility or matches with other users</li>
        <li>Uninterrupted or error-free service</li>
        <li>Accuracy of user-provided information</li>
    </ul>

    <h2>11. Limitation of Liability</h2>
    <p>To the maximum extent permitted by law, Hmm Dating shall not be liable for any indirect, incidental, or consequential damages arising from your use of the service.</p>

    <h2>12. Termination</h2>
    <p>We may suspend or terminate your account at any time for violation of these terms or for any other reason at our discretion.</p>

    <h2>13. Changes to Terms</h2>
    <p>We may modify these Terms at any time. Continued use after changes constitutes acceptance of the new Terms.</p>

    <h2>14. Governing Law</h2>
    <p>These Terms shall be governed by and construed in accordance with the laws of India.</p>

    <div class="contact-info">
        <h2>15. Contact Us</h2>
        <p>For questions about these Terms of Use, please contact us:</p>
        <p><strong>Hmm Dating</strong></p>
        <p>Email: <a href="mailto:info@elevenmonk.com">info@elevenmonk.com</a></p>
        <p>Phone: <a href="tel:+917021044529">+91-7021044529</a></p>
    </div>
</body>
</html>' WHERE id = 1;
