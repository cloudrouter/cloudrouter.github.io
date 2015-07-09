---
layout: post
title: "Use FastNetMon With Your CloudRouter Distribution"
date: 2015-07-09
categories: cloudrouter
author: jkt
---

Special thanks to Pavel Odintsov for providing much of the content for this blog.

![Pavel Odintsov]({{ site.baseurl }}/wp-content/uploads/2015/07/image00.jpg)

CloudRouter distributes [FastNetMon](https://github.com/FastVPSEestiOu/fastnetmon), a high performance DoS/DDoS load analyzer built on top of multiple packet capture engines, including NetFlow, IPFIX, sFLOW, netmap, PF_RING, and PCAP.  FastNetMon is distributed under the GPLv2 license.  The project is led by [Pavel Odintsov](https://www.linkedin.com/in/podintsov), CTO at FastVPS in beautiful Saint Petersburg, Russia.

FastNetMon detects hosts in a network with a large amount of packets per second/bytes per second or flow per second incoming or outgoing from certain hosts.  It can call an external script to notify people or automate an action such as switching off a server or moving the client to a blackhole.

Pavel developer FastNetMon after searching for an open source solution to use at his company FastVPS.  Since a suitable project didn't already exist, Pavel started his own.

A typical deployment of FastNetMon is shown in the network map below.

![Network Map]({{ site.baseurl }}/wp-content/uploads/2015/07/image01.png)

Features include:
* Process incoming and outgoing traffic
* Trigger block script if certain IP loads network with a large amount of packets/bytes/flows per second
* [Announce blocked IPs](https://github.com/FastVPSEestiOu/fastnetmon/blob/master/docs/EXABGP_INTEGRATION.md) to BGP router with [ExaBGP](https://github.com/Exa-Networks/exabgp)
* Integration with [Graphite](https://github.com/FastVPSEestiOu/fastnetmon/blob/master/docs/GRAPHITE_INTEGRATION.md)
* netmap support (open souce; wire speed processing; only Intel hardware NICs or any hypervisor VM type)
* Support for L2TP decapsulation, VLAN untagging, and MPLS processing in mirror mode
* Detection of DoS/DDoS in 1-2 seconds
* [Tested](https://github.com/FastVPSEestiOu/fastnetmon/blob/master/docs/PERFORMANCE_TESTS.md) at 10GigE with 12Mpps on Intel i7 3820 with Intel NIC 82599
* Complete plugin support
* Have [complete support](https://github.com/FastVPSEestiOu/fastnetmon/blob/master/docs/DETECTED_ATTACK_TYPES.md) for most popular attack types

A view of the traffic dashboard for FastNetMon is shown below.

![Traffic Dashboard]({{ site.baseurl }}/wp-content/uploads/2015/07/image02.png)

The next screen shows a mitigated attack in real-time.

![Traffic Dashboard]({{ site.baseurl }}/wp-content/uploads/2015/07/image03.png)

The main program screen is shown below.

![Program Screen]({{ site.baseurl }}/wp-content/uploads/2015/07/image04.png)

A flow refers to one or multiple udp, tcp, icmp connections with unique src IP, dst IP, src port, dst port, and protocol.

Example CPU load on Intel i72600 with Intel X540/82599 NIC on 400kpps load:

![CPU load]({{ site.baseurl }}/wp-content/uploads/2015/07/image05.png)

At CloudRouter, we put a lot of focus on security.  We [harden key open source components such as the BIRD route server]({{ site.baseurl }}/cloudrouter/releases/2015/03/15/security-hardening-for-native-binaries-in-cloudrouter-components.html) and use a [dedicated Nitrokey signing server with a hardware security module (HSM)]({{ site.baseurl }}/cloudrouter/releases/2015/02/10/signing-rpms-using-the-nitrokey-hardware-security-module-hsm.html).  Ultimately, the strength of the CloudRouter distribution comes from great open source projects like FastNetMon.  Thanks Pavel for all your work.

[Download CloudRouter Now]({{ site.baseurl }}/getting-started/)
