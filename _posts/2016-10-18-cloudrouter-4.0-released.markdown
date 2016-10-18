---
layout: post
title: "CloudRouter 4.0 Adds FD.io and Intel 40 GigE Card Support"
date: 2016-10-18
categories: cloudrouter
author: jkt
---

*Hardware performance results and easier programming give datacenter managers confidence that open source networking can replace proprietary gear*

SANTA CLARA, Calif. - October 18, 2016 - The CloudRouter® Project, a leading Linux-based open source routing and software-defined networking (SDN) project, today announced the general availability of CloudRouter 4.0. For the first time, CloudRouter includes FD.io (Fast data - Input/Output) and the Cisco-contributed Vector Packet Processing (VPP) library. FD.io brings the first implementation of a multi-architectural router to CloudRouter. Prior to this, people had to use the kernel for packet routing. 

According to Jay Turner, head of the CloudRouter Project, “After we shipped DPDK in CloudRouter 3.0, the community asked us to use FD.io as a layer 3 implementation of DPDK, which is a development kit. CloudRouter 4.0 with FD.io is a natural evolution of our goals to enable open source programmable routers on a range of hardware.”

"We're excited to see a cutting-edge open source networking project like CloudRouter ship FD.io as a key part of its distribution," said Ed Warnicke, TSC Chair at FD.io. "FD.io has gained adoption quickly thanks to an active open source network community with contributors/committers from more than a dozen companies including Cisco, Intel, Ericsson, Huawei, Red Hat, Comcast, and NXP and the high quality, mature, extremely high performance vector packet processor (VPP) technology on which its based. Today, it's clear that feature rich, modular, extremely high performance software-based packet processing for general-purpose CPUs has finally arrived. This is the dataplane we have all been looking for." 

The layer 3 implementation is important to the growing number of businesses deploying CloudRouter. Between CloudRouter 3.0 and CloudRouter 4.0 the community grew by 34%.

As part of the CloudRouter 4.0 release, the team partnered with Intel to test their GigE cards with FD.io. Tests results for Intel Ethernet Converged Network Adapter X710 GbE are available. 

“Our tests show that Intel Ethernet Converged Network Adapter X710 GbE cards have excellent performance with CloudRouter,” said Jay Turner. “We plan to expand our testing with other vendors and welcome cooperation from other hardware and software groups. Please contribute code or contact us about joint-testing.”

CloudRouter 4.0 new features summary:

* FD.io with support of Layer 2 and Layer 3 SDN and NFV architectures
  * Including Vector Packet Processing (VPP) 16.06 release
* OS: upgraded to Fedora 24 (from Fedora 23) 
  * NOTE: CentOS remains the same with 7.2
* SDN OS: ONOS 1.6 (GoldenEye, from ONOS 1.4) and OpenDaylight Beryllium (from Lithium) 
* DPDK 16.07 release 

CloudRouter 4.0 Production is available now for download and use. 
https://cloudrouter.org/getting-started/

**About the CloudRouter Project**

The CloudRouter Project is a collaborative open source project to develop a freely available software-based router designed to securely run on physical, virtual and cloud environments that support software-defined networking infrastructures. CloudRouter aims to facilitate migration to the cloud without giving up control over network routing and governance. It includes the features of traditional hardware routers, as well as support for emerging technologies such as containers and software-defined interconnection. To help bridge legacy infrastructure with the cloud, the project is focused on bringing simplicity to network interconnection, a traditionally complex process. The CloudRouter Project sponsors include Australian National University, CloudBees, Cloudius Systems, Console Inc., NGINX and OpenDaylight.

*CloudRouter is a registered trademark of Console Inc. All other trademarks are the property of their respective owners.*

Contact:
Jesse Casman for The CloudRouter Project
jcasman@oppkey.com
