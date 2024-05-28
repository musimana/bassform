<hr class="my-8 border-gray-900 dark:border-gray-100" />

<p class="pb-4 text-justify">
    This privacy policy (“policy”) will help you understand how {{ config('metadata.author') }} (“our”, “us”, “we”) uses and protects the data you provide to us when you visit and use <a href="{{ route('home') }}" title="{{ config('app.name') }}" class="underline">{{ substr(route('home'), strpos(route('home'), '://') + 3) }}</a> (“app”, “service”, “website”).
    The policy also applies when you correspond with us in person, by letter, by phone, email or any other means.
    We reserve the right to change this policy at any time by publishing updates to this page.
    We are committed to protecting your data, please read the following carefully to understand how we will treat it.
</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Information We May Collect
</h3>

<p class="pb-4 text-justify">Personal data (as defined in the GDPR), or personal information, is any information about an individual from which that person can be then identified. It does not include data where the identity has been removed or has been replaced with artificial identifies or pseudonyms (Anonymous or Pseudonymised Data). When visiting our Sites, accessing our Services, Products or corresponding with us in person, by phone, email or any other method you may provide us with information that would be classed as personal data about you and others you are acting on behalf of. We may collect, use, store and/or transfer data depending on the product, services or site you are accessing, the different kinds of personal data are grouped together as follows;</p>

<ul class="pb-4">
    <li class="ml-4"><strong>Identity Data</strong> – which includes your first name, surname, username or similar identifier, marital status, title, date of birth and gender.</li>
    <li class="ml-4"><strong>Contact Data</strong> – which includes your billing address delivery address, home address, email address and telephone numbers.</li>
    <li class="ml-4"><strong>Financial Data</strong> – which includes your bank account and payment card details.</li>
    <li class="ml-4"><strong>Transaction Data</strong> – includes details about payments to and from you and other details of products and services you have purchased from us.</li>
    <li class="ml-4"><strong>Technical Data</strong> – includes internet protocol (IP) address, your login data, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform and other technology on the devices you use to access the Sites.</li>
    <li class="ml-4"><strong>Profile Data</strong> - which includes your username and password for any accounts set up to access our products and services, purchases or orders made by you, feedback responses.</li>
    <li class="ml-4"><strong>Usage Data</strong> – which includes information about how you use our Sites, products and services.</li>
    <li class="ml-4"><strong>Marketing and Communications Data</strong> – which includes your preferences in receiving marketing from us and our third parties and your communication preferences.</li>
</ul>

<p class="pb-4 text-justify">We may collect Special Categories of your Personal Data if required as part of the services or products you are using. Where we are required to collect personal data by law, or under the terms of a contract we hold with you and you fail to provide this data when requested, we may not be able to perform the contract we have or are entering with you. (for example, to provide you with web development services). In this case, it may be a requirement for us to cancel the service or product you have asked us to provide, should this happen we will notify you accordingly.</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Keeping your Data Secure
</h3>

<p class="pb-4 text-justify">Keeping your data secure is important to us, therefore, we have in place appropriate security measure to prevent unauthorised access, accidental loss, alteration or disclosure. We ensure that our computers and devices are fully updated with virus software and personal protection measures. In addition to this we limit access to your personal data to those employees, agents, contractors and other third parties who have a business need to know and therefore will only process your personal data on our instructions in accordance with this policy and are subject to a duty of confidentiality.</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    How we collect your Data
</h3>

<p class="pb-4 text-justify">We use different methods to collect data from and about you through;</p>

<ul class="pb-4">
    <li class="ml-4"><strong>Direct Interactions</strong> – You may give us any of the categories of data identified above by filling in forms on our Sites or by corresponding with us in person, by phone, email or any other method. This includes personal data you provide when you:
        <ul class="pb-4">
            <li class="ml-4">- Register to use our Sites;</li>
            <li class="ml-4">- Make a request for our products/services;</li>
            <li class="ml-4">- Requesting marketing communication to be sent to you or others you are acting on behalf of;</li>
            <li class="ml-8"><em>or</em></li>
            <li class="ml-4">- Providing feedback;</li>
            <li class="ml-4">- Third parties or publicly available sources – personal data about you may be received through various third parties and public sources such as analytics providers, advertising networks and/or search information providers based inside the European Economic Area (EEA);</li>
            <li class="ml-4">- Contact, Financial and Transaction Data (if applicable) from providers of technical, payment and delivery services inside the EEA.</li>
        </ul>
    </li>
</ul>

<h3 id="cookies" class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Cookies
</h3>

<p class="pb-4 text-justify">
    This site uses necessary first-party cookies for anti-forgery to prevent attacks.
    If you consent to us storing an acknowledgement of this on your device, by selecting 'Remember my choice' when accepting the app's cookie notification form,
    then we will also store a first-party cookie to record this consent on your device.
</p>

<table class="table-auto mt-4 mb-12 mx-4">
    <thead class="mb-2 border-b border-gray-900 pb-2 dark:border-gray-100">
        <tr class="text-left">
            <th class="p-2">Cookie</th>
            <th class="p-2">Common Name</th>
            <th class="p-2">Purpose</th>
            <th class="p-2">Storage Conditions</th>
            <th class="pt-2 px-2 pb-4">Expiry</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-left">
            <td class="pt-4 px-2 pb-2"><code>{{ Str::slug(config('app.name'), '_') . '_session' }}</code></td>
            <td class="p-2"><strong>Session Token</strong></td>
            <td class="p-2">Identifier to help preserve client-side state</td>
            <td class="p-2"><em>On use of the website</em></td>
            <td class="p-2">{{ config('session.lifetime') }} minutes after last use of the website</td>
        </tr>
        <tr class="text-left">
            <td class="p-2"><code>XSRF-TOKEN</code></td>
            <td class="p-2"><strong>XSRF Token</strong></td>
            <td class="p-2">Identifier to help prevent cross-site request forgery</td>
            <td class="p-2"><em>On use of the website</em></td>
            <td class="p-2">{{ config('session.lifetime') }} minutes after last use of the website</td>
        </tr>
        <tr class="text-left">
            <td class="p-2"><code>consent-storage-granted</code></td>
            <td class="p-2"><strong>Storage Consent Token</strong></td>
            <td class="p-2">Identifier to record consent for storing cookies on this device</td>
            <td class="p-2"><em>On indication of consent</em></td>
            <td class="p-2">365 x 24 hours from the time the relevant consent was indicated, or until this policy changes, whichever is sooner</td>
        </tr>
    </tbody>
</table>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Why we will use your Data
</h3>

<p class="pb-4 text-justify">Your personal data will be processed in accordance with Article 6 of the General Data Protection Regulation (GDPR) which states that there must be a lawful basis for processing personal data. Each lawful basis is set out below, and at least one must apply whenever personal data is processed.</p>

<ul class="pb-4">
    <li class="ml-4"><strong>Consent</strong>: you have given clear consent for us to process your personal data for a specific purpose</li>
    <li class="ml-4"><strong>Contract</strong>: processing is necessary for a contract we have with you, or because you have asked us to take specific steps before entering into a contract</li>
    <li class="ml-4"><strong>Legal obligation</strong>: it is necessary for us to comply with a legal or regulatory obligation (not including contractual obligations)</li>
    <li class="ml-4"><strong>Vital interests</strong>: processing is necessary to protect someone’s life</li>
    <li class="ml-4">
        <strong>Legitimate interests</strong>: processing is necessary for our legitimate interests (for example to administer and maintain our website(s)) or the legitimate interests of a third party unless there is a good reason to protect your personal data which overrides those legitimate interests. We make sure we consider and balance any potential impact on you (both positive and negative) and your rights before we process your personal data for our legitimate interests. We do not use your personal data for activities where our interests are overridden by the impact on you (unless we have your consent or are otherwise required or permitted to by law). We rely on the following interests when processing your personal data:
        <ul class="pb-4">
            <li class="ml-8">- To manage our business and comply with our obligations to our patients, staff and suppliers.</li>
            <li class="ml-8">- To protect our proprietary and commercially sensitive information.</li>
            <li class="ml-8">- To administer and maintain our websites.</li>
        </ul>
    </li>
</ul>

<p class="pb-4 text-justify">Your personal data may be processed on more than one lawful ground this will depend on the specific purpose for which we are using your data. Generally, we will not rely on consent as a legal basis for processing your personal data. However, where we do ask for your consent, we will do so in order to comply with the principle that any processing must be lawful, fair and transparent.</p>
<p class="pb-4 text-justify">For more information on the types of lawful basis that we will rely on to process your personal data can be found on the <a href="https://ico.org.uk/for-organisations/guide-to-data-protection/guide-to-the-general-data-protection-regulation-gdpr/lawful-basis-for-processing/" target="_blank" rel="noopener noreferrer" title="Visit the Information Commissioner’s Office (ICO) website" class="underline">Information Commissioner’s Office (ICO) website</a>.</p>
<p class="pb-4 text-justify">There may be a requirement to process your personal data on more than one lawful basis, depending on the specific purpose for which we are using your data. If you need details about the specific legal grounds, we are relying on to process your personal data then please contact us. (Contact Details listed below).</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Disclosing your Personal Data
</h3>

<p class="pb-4 text-justify">In order to provide you with our services/products it may be a requirement to share your personal data with the parties listed below. We require all third parties to respect the security of your personal data and to treat it in accordance with the law and our instructions, when they are processing personal data on our behalf. We do not allow our third-party service providers to use your personal data for their own purposes.</p>

<ul class="pb-4">
    <li class="ml-4">- Third parties who you authorise to provide services/products to you;</li>
    <li class="ml-4">- Sub-contractors for the performance of any contract(s) we enter into with you or them;</li>
    <li class="ml-4">- Healthcare professionals during the course of the services that both we and they provide to you;</li>
    <li class="ml-4">- Service providers acting as processors who provide IT and system administration services.</li>
    <li class="ml-4">- Professional advisers including lawyers, bankers, auditors and insurers based who provide consultancy, banking, legal, insurance and accounting services.</li>
</ul>

<p class="pb-4 text-justify">We do not transfer your personal data outside of the EEA if within the EEA or within the country of origin if outside the EEA.</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Change of Purpose
</h3>

<p class="pb-4 text-justify">Your personal data will only be used for the purpose it was originally collected, unless we reasonably consider that we need to use it for another reason and that reason is compatible with the original purpose. For an explanation as to how the processing for the new purpose is compatible with the original purpose, please contact us.</p>
<p class="pb-4 text-justify">If we need to use your personal data for an unrelated purpose, we will notify you and we will explain the legal basis which allows us to do so.</p>
<p class="pb-4 text-justify">Please note that we may process your personal data without your knowledge or consent, in compliance with the above rules, where this is required or permitted by law.</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Marketing
</h3>

<p class="pb-4 text-justify">You will be provided with choices regarding certain personal data uses, particularly around marketing and advertising. We may use your Identity, Contact, Technical, Usage and Profile Data to form a view on what we think may be a need or a want, or what may be of interest to you. This is how we determined which products, services and offers may be relevant for you (we call this marketing).</p>
<p class="pb-4 text-justify">You will receive marketing communications from us if you have requested information from us or purchased products or services from us and, in each case, you have not opted out of receiving that marketing. We will always obtain your consent prior to sharing your personal data with any other company for marketing purposes.</p>
<p class="pb-4 text-justify">You can ask us or third parties to stop sending you marketing messages at any time by logging into the Site and checking or unchecking relevant boxes to adjust your marketing preferences or by following the opt-out links on any marketing message sent to you or by contacting us at any time.</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Retention
</h3>

<p class="pb-4 text-justify">Your personal data will only be retained for as long as necessary to fulfil the purposes we collected it for, including for the purposes of satisfying any legal, accounting, or reporting requirements. To determine the appropriate retention period for personal data, we consider the amount, nature, and sensitivity of the personal data, the potential risk of harm from unauthorised use or disclosure of your personal data, the purposes for which we process your personal data and whether we can achieve those purposes through other means, and the applicable legal requirements.</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Your Legal Rights
</h3>

<p class="pb-4 text-justify">Under certain circumstances, you have rights under data protection laws in relation to your personal data. For further information please click on the link below to access the ICO website to find out more about <a href="https://ico.org.uk/your-data-matters/" target="_blank" rel="noopener noreferrer" title="Visit the Information Commissioner’s Office (ICO) website" class="underline">these rights</a>;</p>

<ul class="pb-4">
    <li class="ml-4"><strong>The right to be informed</strong></li>
    <li class="ml-4"><strong>The right of access</strong></li>
    <li class="ml-4"><strong>The right to get your data corrected</strong></li>
    <li class="ml-4"><strong>The right to erasure</strong></li>
    <li class="ml-4"><strong>The right to restrict processing</strong></li>
    <li class="ml-4"><strong>The right to data portability</strong></li>
    <li class="ml-4"><strong>The right to object</strong></li>
    <li class="ml-4"><strong>Rights in relation to automated decision making and profiling</strong></li>
</ul>

<p class="pb-4 text-justify">To exercise any of the rights set our above, please contact us;</p>
<p class="pb-4 text-justify">If you are unhappy with how we are processing your personal data, you have the right to complaint to ICO. The Information Commissioner can be contacted at: <a href="https://ico.org.uk/make-a-complaint/" target="_blank" rel="noopener noreferrer" title="Visit the Information Commissioner’s Office (ICO) complaints page" class="underline">ico.org.uk/make-a-complaint</a>.</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Fees
</h3>

<p class="pb-4 text-justify">No fees are required to access your personal data (or to exercise any of the other rights), however, we may charge a reasonable fee if your request is clearly unfounded, repetitive or excessive. Alternatively, we may refuse to comply with your request in these circumstances.</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    What we may need from you
</h3>

<p class="pb-4 text-justify">We may need to request specific information form you to help confirm your identity and ensure your right to access your personal data (or to exercise any of your other rights). This is a security measure to ensure that personal data is not disclosed to any person who has no right to receive it. We may also contact you to ask you for further information in relation to your request to speed up our response.</p>

<h3 class="w-full my-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">
    Time Limits
</h3>

<p class="pb-4 text-justify">It is our policy to respond to all legitimate requests within one month, however, on occasions it may take longer than a month if your request is particularly complex or you have made a number of requests. In this case, we will notify you and keep you updated throughout the process.</p>
