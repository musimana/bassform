<h3 class="text-small-print">
    COOKIES
</h3>

<p class="text-small-print">
    This site uses necessary first-party cookies for anti-forgery to prevent attacks.
    If you consent to us storing an acknowledgement of this on your device,
    by selecting 'Remember my choice' when accepting the app's cookie notification form,
    then we will also store a first-party cookie to record this consent on your device.
</p>

<table class="text-small-print">
    <thead>
        <tr>
            <th>Cookie</th>
            <th>Common Name</th>
            <th>Purpose</th>
            <th>Storage Conditions</th>
            <th>Expiry</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ Str::slug(config('app.name'), '_') . '_session' }}</td>
            <td><strong>Session Token</strong></td>
            <td>Identifier to help preserve client-side state</td>
            <td><em>On use of the website</em></td>
            <td>{{ config('session.lifetime') }} minutes after last use of the website</td>
        </tr>

        <tr>
            <td>XSRF-TOKEN</td>
            <td><strong>XSRF Token</strong></td>
            <td>Identifier to help prevent cross-site request forgery</td>
            <td><em>On use of the website</em></td>
            <td>{{ config('session.lifetime') }} minutes after last use of the website</td>
        </tr>

        <tr>
            <td>consent-storage-granted</td>
            <td><strong>Storage Consent Token</strong></td>
            <td>Identifier to record consent for storing cookies on this device</td>
            <td><em>On indication of consent</em></td>
            <td>365 x 24 hours from the time the relevant consent was indicated, or until this policy changes, whichever is sooner</td>
        </tr>
    </tbody>
</table>
