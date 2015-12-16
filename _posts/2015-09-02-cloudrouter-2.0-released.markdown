---
layout: post
title:  "CloudRouter 2.0 Released!"
date: 2015-09-02
categories: cloudrouter
author: jkt 
---

The CloudRouter® Project, the center for development of secure Linux-based open source routing and software-defined networking (SDN) technologies for large-scale cloud companies, data centers, enterprises, and network operators, today announces the general availability of CloudRouter 2.0.  This is the first release intended for production use and comes after a 160% increase in community contributions and rigorous testing in real-world product environments.

I am thrilled to release this milestone, and wish to thank the community for all their support getting to this milestone.  Since the 1.0 Beta launch in February, the Project has added 224 new packages.  Key additions include [ONOS](http://onosproject.org) for SDN architectures, [FastNetMon](https://github.com/FastVPSEestiOu/fastnetmon) for DDoS analysis, and [BGPStream](http://www.caida.org/~chiara/bgpstream-doc/bgpstream/) for BGP/ASN monitoring.

While I find 224 new packages exciting, it is another facet of this release which brings a huge smile to my face.  Many in the community have been very supportive of CloudRouter, but typically that support included a sentiment that having a CentOS-based version would **really** put things over the top.  And guess what??  That is what we did.  The CloudRouter Project will go forward with 2 different streams, one continuing to be a Fedora Remix, while the other a CentOS Variant.  The Fedora Remix will allow for rapid adoption of the newest technology while the CentOS Variant will provide a stable, and supported, foundation mandated by production utilization.

###Key Features###
* Java 1.8
* SDN: ONOS 1.2 (Cardinal) and OpenDaylight Lithium
* Security Monitoring: FastNetMon for DDoS and DOS detection and analysis, BGPStream for routing analysis
* Architecture Design: Mininet for SDN prototyping
* Containers: Docker, CoreOS Rkt, KVM
* Routing: ExaBGP, BIRD, Quagga
* Base functionality: IPSec, VPN, SSL, L2TP, failover and synchronization

CloudRouter 2.0 is available for [download](https://cloudrouter.atlassian.net/wiki/display/CPD/CloudRouter+Downloads) and use today!

