---
layout: post
title: "New CloudRouter 3.0 Release with 100 GigE Opens Doors for SDN"
date: 2016-03-29
categories: cloudrouter
author: jkt
---

*Free and open source SDN software router tested at 650 Gig/sec ships new major upgrades of ONOS, Fedora, iSDX, Linux DPDK, network traffic analyzer*

SANTA CLARA, Calif. - March 29, 2016 - The CloudRouter® Project, a leading Linux-based open source routing and software-defined networking (SDN) project, today announced the general availability of CloudRouter 3.0. This release ships with new versions of ONOS Drake 1.4, CentOS 7.2, and Fedora 23. Four new open source projects have been added including [iSDX](https://github.com/sdn-ixp/iSDX), an open source SDN exchange point, two new network traffic generator and analyzers, [Ostinato](http://ostinato.org/) and [pktgen-dpdk](http://dpdk.org/browse/apps/pktgen-dpdk/), and [pmacct](http://www.pmacct.net/), a network monitoring utility. 

CloudRouter now includes Linux DPDK kernel enhancements, tested by the CloudRouter team, with throughput in excess of 650 Gig/sec on commodity hardware. The upgrades help network architects with staged deployments of SDN.  

“The traditional way of building networks with vertically integrated, proprietary, over-priced boxes is being disrupted, and replaced by the new and much more open way of disaggregation, abstraction and easy composition of network resources. This transformation was driven by hyper-scale cloud and web services providers and is being widely accepted to power web-scale IT. The decoupling of software from hardware first happened on switches, and CloudRouter is bringing it one step further to routers. Mellanox is a supporter and driver of this transformation, and we build hardware for the new open composable networks that enable this transformation to happen without performance or infrastructure efficiency compromises,” said Chloe Jian Ma, Senior Director of Cloud Marketing at Mellanox. “We appreciate the open source networking community choosing Mellanox ConnectX-4 100Gb/s Ethernet adapters to develop the advanced packet processing capabilities, required in modern data centers.  It’s great to see projects like CloudRouter and DPDK helping to advance SDN and NFV architectures. Congratulations on releasing CloudRouter 3.0.” 

“Today’s announcement gives network administrators the choice of continuing to use CloudRouter as a software-based router or advancing into deployments of software-based controllers with whitebox hardware,” said Jay Turner, CloudRouter Project Lead and Senior Director of DevOps at IIX. “The community told us that they wanted the benefits of SDN in the future, but needed a bridge between old and new architectures. CloudRouter is an open source network innovation platform, and we believe it’s the most flexible SDN platform out, incorporating best-of-breed open source projects, fully tested for security and stability.”

CloudRouter developers package and test leading open source networking projects, including a full Linux OS. CloudRouter can be deployed in minutes from a virtual image, container, live CD, or from the AWS marketplace. Responding to community requests for higher performance to support SDN deployments for both layer 2 and layer 3 connections, the CloudRouter team incorporated new open source technology from the Data Plane Development Kit (DPDK) project to enhance network performance and support  for 100 GbE cards.

CloudRouter 3.0 new key features summary:

* 100 GigE Performance: new DPDK 2.2.0 kernel enhancements tested at 650 Gig/sec
* OS: upgraded to CentOS 7.2 or Fedora 23 
* SDN OS: ONOS 1.4 (Drake) in addition to OpenDaylight Lithium 
* SDN Exchange Point: iSDX for advanced routing interconnection
* Security and Performance Testing: pktgen-dpdk, Ostinato
* pmacct: network monitoring utility

CloudRouter 3.0 DPDK [performance test results]({{ site.baseurl }}/wp-content/uploads/2016/03/MellanoxTestResults.pdf).

CloudRouter 3.0 Production is available now for [download](https://repo.cloudrouter.org/3/) and use. 

**About the CloudRouter Project**

The CloudRouter Project is a collaborative open source project to develop a freely available software-based router designed to securely run on physical, virtual and cloud environments that support software-defined networking infrastructures. CloudRouter aims to facilitate migration to the cloud without giving up control over network routing and governance. It includes the features of traditional hardware routers, as well as support for emerging technologies such as containers and software-defined interconnection. To help bridge legacy infrastructure with the cloud, the project is focused on bringing simplicity to network interconnection, a traditionally complex process. The CloudRouter Project sponsors include Australian National University, CloudBees, Cloudius Systems, IIX, NGINX and OpenDaylight.

*CloudRouter is a registered trademark of IIX Inc. All other trademarks are the property of their respective owners.*
