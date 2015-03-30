---
layout: blog_section
title: Getting Started
permalink: /getting-started/
---

The CloudRouter project aims to provide a variety of cloud-ready distribution formats, including disk images, Docker images and OSv images. The CloudRouter 1.0 beta release is currently available as a pre-configured disk image. To install it, follow the instructions below.

**Download**

Two CloudRouter 1.0 Beta images are available: minimal and full. The minimal image includes the Fedora 20 base with updates applied and the CloudRouter repo pre-configured. The full image also includes several pre-installed packages to support software-defined interconnect, such as Bird, Quagga, and OpenDaylight.

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
            <td><a href="https://repo.cloudrouter.org/repo/beta/images/CloudRouter-Beta-Minimal-20150321.x86_64.raw.xz">Download</a> 374 MB</td>
            <td><a href="https://repo.cloudrouter.org/repo/beta/images/CloudRouter-Beta-Minimal-20150321.checksum.txt">Download</a></td>
            <td><a href="https://repo.cloudrouter.org/repo/beta/images/CloudRouter-Beta-Minimal-20150321.manifest.txt">Download</a> 8 KB</td>
        </tr>
        <tr>
            <td>Full</td>
            <td><a href="https://repo.cloudrouter.org/repo/beta/images/CloudRouter-Beta-Full-20150321.x86_64.raw.xz">Download</a> 947 MB</td>
            <td><a href="https://repo.cloudrouter.org/repo/beta/images/CloudRouter-Beta-Full-20150321.checksum.txt">Download</a></td>
            <td><a href="https://repo.cloudrouter.org/repo/beta/images/CloudRouter-Beta-Full-20150321.manifest.txt">Download</a> 12 KB</td>
        </tr>
    </tbody>
</table>

**Install**

<ul>
<li>CloudRouter can be run on a variety of cloud hosts. For local testing purposes, 
the KVM hypervisor with virt-manager is recommended. To install the image using virt-manager, follow these steps:</li>
</ul>

* Uncompress the image:

<pre>$ unxz CloudRouter-Beta-Full-20150321.x86_64.raw.xz</pre>

* Verify that the SHA-512 checksum is correct:

<pre>$ sha512sum CloudRouter-Beta-Full-20150321.x86_64.raw.xz
d73619f8aea2df8be134ab6ad28cb7ad89711388a0774ac6009cefcfa82aa3ccd4a7a3de4b59c4503307c39258b2c6934234b501059cca693d6f76664bae8ac2  CloudRouter-Beta-Full-20150321.x86_64.raw.xz</pre>

* Create a new virtual machine in virt-manager. When prompted, select the &#8220;Import existing disk image&#8221; option. Select CloudRouter-Beta-Full-20150321.x86_64.raw as the disk image. Alternatively, use virsh as shown in <a href="http://youtu.be/ISUJaYv0hg8">this video</a>.
* Select appropriate memory and CPU resources. 2048MB memory and 2 vCPUs are recommended.
* Start the virtual machine.

At this point you have CloudRouter running, but cannot login. For enhanced security, the CloudRouter image ships without any default credentials. A default &#8220;cloudrouter&#8221; user is provided, but no password is set. To set a password, you must create a metadata ISO image.

* Create a metadata ISO based on the instructions in <a href="https://www.technovelty.org//linux/running-cloud-images-locally.html">this blog post</a>. Alternatively, a pre-built metadata ISO is <a href="https://repo.cloudrouter.org/repo/beta/images/cr-init.iso">available here</a>. This ISO sets the fedora user&#8217;s password to &#8220;CloudRouter&#8221;. **DO NOT** use this ISO in production, it is strictly for test and demonstration purposes.
* In virt-manager, attach the metadata ISO to the CloudRouter VM as a CDROM storage device.
* Reboot your VM and login. Enjoy!

**Next Steps**

CloudRouter 1.0 beta is based on the <a href="https://getfedora.org/en/cloud/">Fedora 20 cloud image</a>, and includes a distribution of OpenDaylight Helium SR3. For information on installing and running OpenDaylight on CloudRouter, see the <a href="https://github.com/cloudrouter/cloudrouter.github.io/wiki/Running-OpenDaylight">Running OpenDaylight</a> wiki page. For more details on using OpenDaylight, see the upstream <a href="http://www.opendaylight.org/resources/getting-started-guide">OpenDaylight Getting Started Guide</a>.
