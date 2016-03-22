---
layout: post
title: "NFV Drives Need for Packet Crafter Tools Like Ostinato"
date: 2016-03-22
categories: cloudrouter
author: jkt
---

![Ostinato]({{ site.baseurl }}/wp-content/uploads/2016/03/site-logo.png)


Network functions virtualization (NFV) is a growing trend as service providers look to accelerate the deployment of new network services and reduce costs by leveraging Commercial Off-The-Shelf (COTS) hardware. It’s all about making more efficient use of network resources. NFV moves network functions like switching, routing, firewall, broadband remote access servers (BRAS), and more from hardware appliances over to virtualized x86 based server platforms.

Just like in the case of server virtualization, a successful NFV deployment requires thorough testing and end-to-end network validation to deliver on its promises. This is especially true of networking equipment vendors who are using it internally to test their products. Often, they are labbing a deployment using tools like Cisco VIRL, GNS3 or UnetLab.

The main use case is functional and performance testing of networking products. Network data packets contain many types of information including data, source address, destination address, version, length, protocol, and more. With packet crafting, one creates a completely new packet or edits the existing one. This new packet is then sent to the network and results are monitored.

Packet crafter/traffic generator tools like Hping, Ostinato, Scapy, Libcrafter and quite a few more are available and increasing seen as important tools for networking engineers.

I had a chance to ask Srivats P., the founder and maintainer of Ostinato, about some of the details of how Ostinato aims to be a solid tool without overkill. Srivats is a software developer and has been working on networking products and protocols for over 12 years.

![Srivats]({{ site.baseurl }}/wp-content/uploads/2016/03/srivats.jpg)

# How an Open Source Tool Like Ostinato Fits In

Srivats states that Ostinato helps make packet crafting and traffic generation affordable.

> The commercial solutions available today are so expensive 
> that even the big networking vendors don't have as many 
> of those as they would like. And sometimes, for example 
> for functional testing, the heavy duty commercial solutions 
> are overkill. Ostinato aims to provide a packet crafter 
> and generator for every network developer and engineer.

Ostinato is primarily a packet crafter and traffic generator and the focus is on functional testing. People have used it successfully for performance testing as well – it depends upon how powerful a platform you have (CPU and memory) and if it can push packets at the rate you want.

![ProTip]({{ site.baseurl }}/wp-content/uploads/2016/03/image02.png)

In the future, Ostinato will be adding measurement and analysis features such as latency, jitter and other QoS measures. There are feature requests for OWAMP, TWAMP and RFC2544 support.

# How Ostinato Differs From Other Open Source Options

Ostinato is cross platform and runs on all the major platforms – Windows, Linux, BSD and MacOS X. There is a GUI and a Python API for scripting/automation. 

Architecturally, it is implemented as two separate client and server components. However, this client-server separation is not like the iperf client-server. Rather the server component does the actual packet generation and stats collection, etc., and the client component is the GUI or the Python script configuring and managing the server. 

This client-server separation allows Ostinato several useful deployment models. You can run both of them on the same host, the default mode, or you can run them on separate hosts. One common deployment model is for the server to be running on the host in the lab while you use the client on your laptop to configure and control it. 

You can use the client to connect to multiple servers or multiple clients can connect to a single server and use the ports on the server in a mutually exclusive manner. The packet crafter allows you fine grained control on the value of each individual protocol field. All the commonly used protocols are implemented. You can configure multiple streams and transmission rates, bursts, number of packets, etc., for each of them. A statistics window in the GUI displays real-time port statistics. 

Srivats says:

> You can look at the [Ostinato](http://ostinato.org/) website for more 
> details. But, the best way to explore is to download and 
> run it. Binary packages are available for download for 
> all the major platforms. And if you need any help, drop 
> us a note on the [mailing list](mailto:ostinato@googlegroups.com).

# The Future of Ostinato

Ostinato is currently working on adding device emulation so that Ostinato could emulate multiple IP hosts and subnets and trigger/respond to Address Resolution Protocols (ARPs) and pings. You will not need to manually configure MAC addresses on your test streams and you will be able to avoid having to configure static ARPs on the Device Under Test (DUT). 

This will be part of the upcoming 0.8 release in Spring 2016. 

Srivats says:

> For the next release, it’s a toss up between expanding 
> the device emulation to do protocol emulation or change 
> gears and double down on the performance testing and 
> throughput part.

# A Note on Performance

Ostinato has, by their admission, not focused much on super high performance yet.

On an anecdotal level, however, the [PF_RING](http://www.ntop.org/products/packet-capture/pf_ring/) project has, according to Srivats, achieved “some good numbers” by linking the PF_RING enabled libpcap library instead of the standard one. And the developers from [PLVision have some DPDK based code, available on GitHub](https://github.com/PLVision/ostinato-dpdk), where they were able to get 10G line rate. They also wrote a couple of blog posts ([here](http://plvision.eu/blog/ostinato-and-intel-dpdk-10g-data-rates-report-on-intel-cpu/) and [here](http://plvision.eu/blog/ostinato-and-intel-dpdk-data-rates-report/)) about it reporting the numbers on their website. (Unfortunately that code doesn't seem to be maintained.)

# Conclusion

Packet crafter/traffic generator tools like Hping, Ostinato, Scapy, Libcrafter and others are very powerful and require significant networking skills. However, since NFV is a moving target and implementations vary widely, these types of tools provide the ability to adjust and customize as implementations progress. It’s safe to say, some sort of Packet crafter/traffic generator should be in any NFV toolbox.

#### Jay Turner, Head of CloudRouter Project

The CloudRouter® Project is a collaborative open source project that provides a powerful, easy-to-use router designed for the cloud. It is a full-stack software-defined network (SDN) implementation including OpenDaylight and ONOS, and ships with tools for Monitoring and availability and security and includes Support for containers and cloud images. CloudRouter ships with many tools including in the latest version a packet crafter and generator tool called Ostinato, one of two Security and Performance Testing tools. 
