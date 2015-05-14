---
layout: post
title: "Does the QEMU vulnerability CVE-2015-3456 (VENOM) affect CloudRouter?"
date: 2015-05-13
categories: cloudrouter
author: dfj
---

A memory corruption vulnerability affecting QEMU's floppy disk controller has recently been reported. This vulnerability allows an attacker in control of a virtual machine to attack the underlying hypervisor. A denial-of-service attack has been proven, and a code execution attack is likely to be possible.

CloudRouter itself is not affected by this vulnerability, as it does not include any vulnerable packages. CloudRouter is designed to function as a guest in virtualized environments, not a host. If you are running CloudRouter on a vulnerable host, you should patch the underlying host and then reboot the CloudRouter instance. For more details, see the [CrowdStrike advisory](http://venom.crowdstrike.com/).
