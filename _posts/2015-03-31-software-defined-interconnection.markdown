---
layout: post
title: "Software-defined Interconnection: the future of Internet peering, powered by OpenDaylight and OSv"
date: 2015-03-31
categories: cloudrouter releases
author: dfj
---

Most users are aware of cloud computing as a general term behind such trends as "Software as a Service," where sites such as Salesforce.com can replace software run by a company IT department, or "Infrastructure as a Service" where virtual machines rented by the hour can replace conventional servers. But today, the technologies behind the cloud are changing the way that we connect the Internet at the most fundamental level, through Software Defined Interconnection (SDI).

**What is SDI?** A lot of manual work goes into hooking up the Internet between providers. The routers that send Internet traffic from one place to another can be configured to use "paid transit", where a single provider will route packets to any destination. But the more Internet traffic you’re responsible for, the more you can benefit from another arrangement, called "direct interconnection" where you set up your company’s routers to directly connect to another company’s. Most networks will always need to buy transit from somebody; the best you can hope for is that a portion of your traffic bypasses the transit provider and is directly delivered to the destination. Maximizing the amount of traffic that is directly peered leads to better performance, lower latency, lower packet loss, and greater security.

Today, most direct interconnection is typically set up manually, with a physical fiber cable connecting one organization’s network to another. Agreements to interconnect and peer are also reached manually, typically via email or face-to-face at peering conferences. When agreement is reached, network admins must ssh in to routers in order to manually configure such peering. It’s not efficient or scalable, and depends on individuals or select groups.

Once an organization has agreed that they want to directly connect with another organization, how do you handle changes to router and switch configuration? Probably the same way you used to manage your httpd.conf back in the 1990s! Network managers ssh in, and update config manually. Some networks have sophisticated management tools, but for many, "the state of the router is the canonical state."

SDI aims to improve all that. The OpenDaylight project is a common platform for network management that facilitates breaking traditional network devices such as switches and routers into separate "data plane" devices that handle high traffic volume and "control plane" devices that do management. Because the control plane device, or software-defined networking (SDN) controller, does not have the extreme throughput requirements of the data plane, it’s easy to virtualize.

**In the lab today** IIX is currently prototyping this next generation of devices in the lab, while more traditional network gear runs in production. The prototype system uses an [OpenFlow switch](http://en.wikipedia.org/wiki/OpenFlow) for data plane, and a separate OpenDaylight server for control plane. Switches rely on the SDN controller. In the event of an unknown packet, they forward it to the controller.

No configuration changes are needed on the data plane hardware, only on the SDN controller, which can be a virtual machine. OpenDaylight manages both layer 2, switching, and layer 3, routing, and the same OpenDaylight APIs can be used to change configuration at both levels. 

OpenDaylight is a pure Java application. It only requires the ability to run a JVM on the virtual machine. For security and ease of management, it can be advantageous to run an individual controller per customer. This means a lightweight, easy-to-manage guest OS is a big advantage. With OSv, IIX can deploy identical simple VMs for each customer, and the OpenDaylight APIs can be used to configure each one appropriately.

OSv’s high performance and low overhead allows for high density of VMs on standard physical hardware. And any compromise or configuration error should only affect one customer, because strong isolation is provided by a standard hypervisor, without the [complex security model of containerization](http://www.projectatomic.io/blog/2014/09/yet-another-reason-containers-don-t-contain-kernel-keyrings/)

**Conclusion** While Internet applications have gained from cloud technologies, the fundamental lower layers are still coming up to speed. OpenDaylight and OSv are bringing cloud economics to the lower levels of the stack.
