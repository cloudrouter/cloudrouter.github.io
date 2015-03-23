---
layout: post
title:  "Security hardening for native binaries in CloudRouter components"
date:   2015-03-15
categories: cloudrouter releases
author: dfj
---

CloudRouter is distributed in several flavors. At the time of writing, these include a disk image based on Fedora, Docker images based on Fedora and CentOS, and OSv images. Regardless of the flavor, most components of CloudRouter are derived from the underlying operating system, and not built or packaged by the CloudRouter project. The CloudRouter project does, however, build and package key components where it is important to differentiate from the version provided by the underlying operating system. One of these components is the BIRD route server.

BIRD is a route server written in C and compiled into a native binary. A reliable, high-performance, and secure route server is a critical component of CloudRouter. By default, BIRD does not enable some key compiler and linker flags to harden the binaries against exploitation of security vulnerabilities. The hardening-check tool reveals this:

<pre>$ hardening-check bird
bird:
Position Independent Executable: no, normal executable!
Stack protected: no, not found!
Fortify Source functions: no, only unprotected functions found!
Read-only relocations: yes
Immediate binding: no, not found!
</pre>

The CloudRouter BIRD package is built as an RPM, and this RPM is the basis for all CloudRouter distribution formats. The RPM spec files includes a macro that automatically enables a range of security hardening compiler and linker flags:

<pre>%global hardened_build 1
</pre>

With this in place, the hardening-check tool shows that all key hardening features are enabled:

<pre>$ hardening-check bird
bird:
Position Independent Executable: yes
Stack protected: yes
Fortify Source functions: yes (some protected functions found)
Read-only relocations: yes
Immediate binding: yes
</pre>

While the hardened_build macro makes hardening simple for RPM builds, it does not help people who are building BIRD manually. To address this, a CloudRouter developer has <a href="http://bird.network.cz/pipermail/bird-users/2015-February/009535.html">proposed a patch upstream</a> that enables hardening compiler and linker flags automatically:

&#8220;Default to secure&#8221; is an important principle for CloudRouter development. We integrate this idea into all versions of CloudRouter. Whether you&#8217;ve standardized on a Fedora disk image for flexibility, a Docker image for scalable deployment, or an OSv image for performance, you can be confident that the project team has made security a top priority. As CloudRouter continues to mature and incorporates more components built and packaged by the CloudRouter project, we will ensure that all appropriate security hardening mechanisms are enabled for these components.
