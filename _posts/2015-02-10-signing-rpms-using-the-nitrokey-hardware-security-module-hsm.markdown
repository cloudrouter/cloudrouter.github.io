---
layout: post
title:  "Signing RPMs using the Nitrokey hardware security module (HSM)"
date:   2015-02-10
categories: cloudrouter releases
author: dfj
---

The CloudRouter project takes security very seriously. Cryptographic signatures are used to ensure the integrity of the software we distribute. CloudRouter 1.0 beta is based on the Fedora 20 cloud image. Most packages are provided by the Fedora repositories. For details on how these packages are signed, see the <a href="http://fedoraproject.org/wiki/Release_package_signing">Fedora documentation</a>. Additional packages such as OpenDaylight are provided by the CloudRouter repositories. These packages are signed using the CloudRouter Project key.

<span dir="ltr">In order to ensure maximum security for our community, we are using a dedicated signing server with a hardware security module (HSM) that is not connected to the Internet.  This drastically reduces the risk of a remote attacker compromising the CloudRouter Project key and attempting to sign malicious packages as legitimate components.</span>

**Selecting a HSM**

A huge variety of HSMs are available. We went with <a href="https://www.nitrokey.com/">Nitrokey</a> as it had several key benefits:

<ul>
<li>Completely open source, including hardware</li>
<li>Low cost</li>
<li>Standard USB interface</li>
<li>Successfully used by <a href="https://blog.mozilla.org/security/2013/02/13/using-cryptostick-as-an-hsm/">mozilla for a similar use-case</a></li>
</ul>

**Installing the HSM**

Nitrokey provides great <a href="https://www.nitrokey.com/documentation/installation">installation documentation</a>, but it is Debian-specific, and we&#8217;re using Fedora. On Fedora 21 or RHEL/CentOS 7, the following steps are required to install the Nitrokey:

<ul>
<li># yum install -y libusb</li>
<li>Copy <a href="https://www.nitrokey.com/sites/default/files/40-nitrokey.rules">40-nitrokey.rules</a> to /etc/udev/rules.d/</li>
<li># udevadm control &#8211;reload</li>
</ul>
At this point the system is able to communicate with the Nitrokey device. To complete installation we need to upgrade to the latest firmware package. Upgrading firmware is <a href="https://www.nitrokey.com/en/doc/firmware-update-storage">clearly documented</a> by Nitrokey. There is one gotcha &#8211;  Nitrokey App&#8217;s graphical interface is based on a QT system tray widget. If you are using a non-KDE Linux desktop environment that does not support system tray widgets, then you may be unable to access the graphical interface. On Fedora 21, we had to temporarily switch from GNOME to KDE to make it work.

**Preparing the key**

Preparing the key is straightforward, but we ran into two limitations of Nitrokey that took some time to figure out. First, Nitrokey does not yet consistently support keys greater than 2048 bits in length. Second, making an off-card backup of the encryption key would consistently fail. With those constraints in mind, here is the process we used to generate the actual CloudRouter Project key:

<pre>$ gpg2 --card-edit
gpg/card&gt; admin
Admin commands are allowed

gpg/card&gt; generate
Make off-card backup of encryption key? (Y/n) n

gpg: NOTE: keys are already stored on the card!

Replace existing keys? (y/N) y

What keysize do you want for the Signature key? (2048)
What keysize do you want for the Encryption key? (2048)
What keysize do you want for the Authentication key? (2048)
Please specify how long the key should be valid.
0 = key does not expire
&lt;n&gt;  = key expires in n days
&lt;n&gt;w = key expires in n weeks
&lt;n&gt;m = key expires in n months
&lt;n&gt;y = key expires in n years
Key is valid for? (0)
Key does not expire at all
Is this correct? (y/N) y

GnuPG needs to construct a user ID to identify your key.

Real name: CloudRouter Project
Email address: security@cloudrouter.org
Comment:
You selected this USER-ID:
"CloudRouter Project &lt;security@cloudrouter.org&gt;"

Change (N)ame, (C)omment, (E)mail or (O)kay/(Q)uit? o
gpg: key 191F16B0 marked as ultimately trusted
public and secret key created and signed.

gpg: checking the trustdb
gpg: 3 marginal(s) needed, 1 complete(s) needed, PGP trust model
gpg: depth: 0  valid:   4  signed:   0  trust: 0-, 0q, 0n, 0m, 0f, 4u
pub   2048R/191F16B0 2015-02-10
Key fingerprint = 0FE8 73A5 A682 EFB1 8B05  D8B6 0A1E 8B12 191F 16B0
uid       [ultimate] CloudRouter Project &lt;security@cloudrouter.org&gt;
sub   2048R/85F05C49 2015-02-10
sub   2048R/9EE6A049 2015-02-10
</pre>

**Signing packages**

The CloudRouter Project maintains a dedicated signing server that is not connected to the internet. To ensure that the HSM-based key is used, the following line is added to ~/.rpmmacros on the signing server:

<pre>%_gpg_name CloudRouter Project &lt;security@cloudrouter.org&gt;
</pre>
Signing can then be performed using the command:

<pre>$ rpm --resign &lt;package&gt;.rpm
</pre>
GPG is invoked and asks for a pass phase for the key:

Enter pass phrase:

Since we&#8217;re using a HSM, this is actually asking for the device PIN. As we continue to enhance our build infrastructure, we aim to completely automate this process. Mozilla have developed an <a href="https://github.com/gdestuynder/pinentry-auto">automatic PIN entry tool</a> that we intend to use. Stay tuned for more details as our build infrastructure moves forward!

