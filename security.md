---
layout: general_page
title: Security
permalink: /security/
---

## Package signing

CloudRouter 3.0 is a Fedora Remix. Most packages are provided by the Fedora repositories. For details on how these packages are signed, see the <a href="http://fedoraproject.org/wiki/Release_package_signing">Fedora documentation</a>. Additional packages such as OpenDaylight are provided by the CloudRouter repositories. These packages are signed using the CloudRouter Project key:

{% comment %}
TODO for enterprise
These packages are signed using the IIX Inc. signing key:
#### 5fbf0300: IIX, Inc. &lt;security@iix.net&gt;
<pre>pub  4096R/<a href="https://pgp.mit.edu/pks/lookup?op=get&amp;search=0xF77A405A56BF0300">56BF0300</a> 2015-01-09 <a href="https://pgp.mit.edu/pks/lookup?op=vindex&amp;search=0xF77A405A56BF0300">IIX Inc. &lt;security@iix.net&gt;</a>
<strong>Location:</strong> /etc/pki/rpm-gpg/RPM-GPG-KEY-cloudrouter 
<strong>Download:</strong> <a href="https://pgp.mit.edu/pks/lookup?op=vindex&amp;search=0xF77A405A56BF0300">pgp.mit.edu</a></pre>
{% endcomment %}

#### a4702bf1: CloudRouter Project &lt;security@cloudrouter.org&gt;
<pre><strong>pub: 2048R/191F16B0 2015-02-10 CloudRouter Project &lt;security@cloudrouter.org&gt;
Location:</strong> <strong>/etc/pki/rpm-gpg/RPM-GPG-KEY-CLOUDROUTER </strong>
<strong>Download: <a href="https://pgp.mit.edu/pks/lookup?op=get&amp;search=0x0A1E8B12191F16B0">pgp.mit.edu</a></strong></pre>

For added security, the CloudRouter Project key is stored on a hardware security module (HSM). For more details, see the blog post &#8220;<a title="Signing RPMs using the Nitrokey hardware security module (HSM)" href="/cloudrouter/releases/2015/02/10/signing-rpms-using-the-nitrokey-hardware-security-module-hsm.html">Signing RPMs using the Nitrokey hardware security module (HSM</a>)&#8221;.

## <span id="Reporting_security_issues" class="mw-headline">Reporting security issues</span>

Please report any security issues you find in CloudRouter to: <a href="mailto:security@cloudrouter.org">security@cloudrouter.org</a>

Anyone can post to this list. The subscribers are only trusted individuals who will handle the resolution of any reported security issues in confidence. In your report, please note how you would like to be credited for discovering the issue and the details of any embargo you would like to impose.

## <span id="Security_advisories" class="mw-headline">Security advisories</span>

{% for advisory in site.security_advisories reversed %}
### {{ advisory.url | split:"/" | last | remove: ".yaml" | remove: ".html" | remove: ".md" | remove: ".markdown" }}{% for vulnerability in advisory.vulnerabilities %} [{{ vulnerability.impact-assessment.rating | capitalize }}] {{ vulnerability.cve-id }}{% endfor %}: {{ advisory.title }}

#### Description
{{ advisory.description }}

{{ advisory.content }}

#### Credit
{% for reporter in advisory.reporters %}
{% assign num_issues_reported = reporter.reported | size %}
Issue{% if num_issues_reported > 1 %}s{% endif %} {{ reporter.reported | join: " " }} {% if num_issues_reported > 1 %}were{% else %}was{% endif %} reported by {{ reporter.name }} of {{reporter.affiliation }}.
{% endfor %}

{% endfor %}
