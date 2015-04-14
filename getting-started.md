---
layout: blog_section
title: Getting Started
permalink: /getting-started/
---

The CloudRouter project aims to provide a variety of cloud-ready distribution formats, including disk images, Docker images and OSv images. The CloudRouter 1.0 beta release is currently available as a pre-configured disk image. To install it, follow the instructions below.

**Download**

Two CloudRouter 1.0 Beta images are available: minimal and full. The minimal image is a Fedora Remix, with updates applied and the CloudRouter repo pre-configured. The full image also includes several pre-installed packages to support software-defined interconnect, such as Bird, Quagga, and OpenDaylight.

<table style="border-spacing: 20px; border-collapse: separate;">
    <tbody>
        <tr>
            <th>Version</th>
            <th>x86_64 Image</th>
            <th>Image Checksum</th>
            <th>Manifest</th>
        </tr>
        <tr>
            <td>Minimal</td>
            <td><a href="https://repo.cloudrouter.org/beta/images/CloudRouter-Beta-Minimal-20150401.x86_64.raw.xz">Download</a> 376 MB</td>
            <td><a href="https://repo.cloudrouter.org/beta/images/CloudRouter-Beta-Minimal-20150401.checksum.txt">Download</a></td>
            <td><a href="https://repo.cloudrouter.org/beta/images/CloudRouter-Beta-Minimal-20150401.manifest.txt">Download</a> 8 KB</td>
        </tr>
        <tr>
            <td>Full</td>
            <td><a href="https://repo.cloudrouter.org/beta/images/CloudRouter-Beta-Full-20150401.x86_64.raw.xz">Download</a> 947 MB</td>
            <td><a href="https://repo.cloudrouter.org/beta/images/CloudRouter-Beta-Full-20150401.checksum.txt">Download</a></td>
            <td><a href="https://repo.cloudrouter.org/beta/images/CloudRouter-Beta-Full-20150401.manifest.txt">Download</a> 12 KB</td>
        </tr>
    </tbody>
</table>

**Note**: CloudRouter is not provided or supported by the Fedora Project. Official Fedora software is available through the <a href="http://fedoraproject.org">Fedora Project website</a>.

**Install**

<ul>
<li>CloudRouter can be run on a variety of cloud hosts. For local testing purposes, 
the KVM hypervisor with virt-manager is recommended. To install the image using virt-manager, follow these steps:</li>
</ul>

* Uncompress the image:

<pre>$ unxz CloudRouter-Beta-Full-20150401.x86_64.raw.xz</pre>

* Verify that the SHA-512 checksum is correct:

<pre>$ sha512sum CloudRouter-Beta-Full-20150401.x86_64.raw.xz 
20fb13191b3fa43a60e96321a80d4e94c7a4c66f06ff59cc336e7dea193ff28b4a18b3cd15cf6d1d0e4e83c0ba4545a3d395f8bc337f9ca1167769fac24edd7a  CloudRouter-Beta-Full-20150401.x86_64.raw.xz</pre>

* Create a new virtual machine in virt-manager. When prompted, select the &#8220;Import existing disk image&#8221; option. Select CloudRouter-Beta-Full-20150401.x86_64.raw as the disk image. Alternatively, use virsh as shown in <a href="http://youtu.be/ISUJaYv0hg8">this video</a>.
* Select appropriate memory and CPU resources. 2048MB memory and 2 vCPUs are recommended.
* Start the virtual machine.

At this point you have CloudRouter running, but cannot login. For enhanced security, the CloudRouter image ships without any default credentials. A default &#8220;cloudrouter&#8221; user is provided, but no password is set. To set a password, you must create a metadata ISO image.

* Create a metadata ISO based on the instructions in <a href="https://www.technovelty.org//linux/running-cloud-images-locally.html">this blog post</a>. Alternatively, a pre-built metadata ISO is <a href="https://repo.cloudrouter.org/beta/images/cr-init.iso">available here</a>. This ISO sets the cloudrouter user&#8217;s password to &#8220;CloudRouter&#8221;. **DO NOT** use this ISO in production, it is strictly for test and demonstration purposes.
* In virt-manager, attach the metadata ISO to the CloudRouter VM as a CDROM storage device.
* Reboot your VM and login. Enjoy!

**Next Steps**

CloudRouter 1.0 beta includes a distribution of OpenDaylight Helium SR3. For information on installing and running OpenDaylight on CloudRouter, see the <a href="https://github.com/cloudrouter/cloudrouter.github.io/wiki/Running-OpenDaylight">Running OpenDaylight</a> wiki page. For more details on using OpenDaylight, see the upstream <a href="http://www.opendaylight.org/resources/getting-started-guide">OpenDaylight Getting Started Guide</a>.
