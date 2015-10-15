---
layout: post
title:  What You Need to Know about ONOS and the Group's Chief Architect
date: 2015-10-15
categories: cloudrouter
author: jkt 
---

#What You Need to Know about ONOS and the Group's Chief Architect#

![Interview]({{ site.baseurl }}/wp-content/uploads/2015/10/image00.png)


The CloudRouter® Project is a collaborative open source project focused on developing a powerful, easy-to-use router designed for the cloud.  As one of our key features, CloudRouter provides a full-stack SDN implementation including ONOS and OpenDaylight.

What is ONOS and why did CloudRouter decide to include it if we're already shipping with OpenDaylight?  To help you fully understand ONOS, who is using it and why you might choose it, I sat down with Thomas Vachuska, chief architect for ONOS, to get the full story.

**Jay Turner: What is ONOS?**

THOMAS VACHUSKA: ONOS (Open Network Operating System) is an open source platform for developing network control applications and solutions.  It is designed to meet the demands of service provider networks, but it can certainly be applied to data center or campus networks as well.

Size and criticality of service provider networks require any control platform to be highly available, scalable and to perform well.  To achieve these goals, ONOS has been designed to operate as a distributed symmetric cluster, with all the nodes of the cluster being software-wise identical, and therefore capable of adopting workloads from any other node as a result of load-balancing or failures.

ONOS is a modular platform and its design strongly adheres to the principle of separation of concerns.  Its architecture goes to a great length to prevent specifics of control protocols to leak from the southbound code modules to the ONOS core and to application-level code.  This has been done in order to provide applications with high-level control and configuration abstractions, thus making them portable across devices that may be controlled or configured using a variety of protocols, whether it is OpenFlow, NETCONF/YANG, OVSDB or perhaps even SNMP.

ONOS is available under Apache 2.0 License.  It is currently on its 5th quarterly release.

**What is SDN?**

In my view, SDN is fundamentally about reinvigoriating the field of networking and increasing the level of competition.  The key to doing this is to find the proper balance between the agility of software and high-performance of the hardware.  Clearly, this rests on being able to separate the control plane from the data plane in order to allow control applications to be developed largely in software, where dev/test cycles are generally much shorter than what is expected in silicon.  Note that this is not about hardware becoming dumber.  Hardware should become simplier in some aspects and more malleable in others; it should focus on things that can't easily be done in software without sacrificing data-plane performance.  This is where I expect to see great things to come from P4.

So in my view, SDN is about far more than just L2, L3 or OpenFlow.  It's about teaching networks new tricks and opening the field to newcomers.  Where there is healthy competition, there is progress.

**Who is using ONOS?**

ONOS was initially developed by ON.Lab, which is a small non-profit funded by a number of partners, which include service providers and equipment vendors.  ONOS released to public in December 2014 and is available as open-source under Apache 2.0 License.  Since then, the number of partners, collaborators and individual code contributors has been quickly and steadily growing.

There are presently a number of deployments mostly on research networks such as Internet2 AL2S, FIU/AmLight, AARNET, GEANT, and GARR.

**What are your goals over the next year?**

The principal objective is to achieve field trial runs of the ONOS CORD use-case - Central Office Re-imagined as Data center - as well as multi-layer network control of optical networks.  However, on the technical side, we are also working on introducing additional functionality to the ONOS platform, such as the ability to dynamically adjust cluster size, to support geographically distributed cluster and to allow federation among different ONOS clusters.  We also want to make sure that ONOS has first-class support for OpenStack integration and for network virtualization; not just at the edge, but also in the core fabric.

ONOS project is seeing a surge of interest for collaboration and code contribution from the world-wide community and we strongly believe that this should be fostered.  This means that an increased portion of ONOS TST (Technical Steering Team) time will be dedicated for engagement with the broader community to review and guide additional ONOS-related projects, to provide tutorials, organize hackathons, etc.

**What high-availability technologies do you make use of?**

One of the key architectural tenets in ONOS is not to become dependent on any specific technology or protocol.  This includes the choise of distribution and failover mechanisms.

The design of each subsystem is organized to allow fully encapsulating the choice of technology used to distribute and persist a specific type of network state.  This has several benefits.  First of all, it allows us to treat each state differently and according to its own needs.  Some states need to be treated in a strongly-consistent or even in a transactionally-consistent manner, while some states lend themselves natrually to an eventually-consistent treatment.  Thus we recognize that not everything is a "nail" and apply the proper tool to the problem at hand.

For all consistent and transactional behaviours, ONOS employs a data store built using the Raft consensus protocol.  And for the eventually consistent behaviours the ONOS team developed our own disstributed map data structure that uses optimistic replication and gossip-based anti-entropy to quickly converge the entire cluster to the same state after nodes come up or after network partitions are healed.

All ONOS cluster messaging is conducted over a single shared channel, which is also used by the cluster membership and failure detector to exchange heartbeats in order to quickly detect node outages or network partitions.

In order to make it easy for application developers to manage any app specific state in a highly available fashion, ONOS exposes a set of core distributed state management primitives that serve to hide the complexity of state management thereby letting application developers focus their efforts more on expressing their core business logic.

Virtualized or load-balanced access to the ONOS cluster (via CLI, REST API or GUI) can be provided using off-the-shelf solutions such as HAProxy or Nginx.  For simple cluster IP aliasing, ONOS comes with a small application that makes sure that ONOS cluster can be accessed using a single IP address.

**Explain "intent" and how networks reconfigure around downed connections**

One of the key northbound abstractions that ONOS provides for applications is intent-based programming.  In short, this means that an application can program the network behaviour by specifying what should be done, rather than specifying how it should be done.  This yields a number of benefits to the application and to the platform alike.  First of all, applications can be simplier in that they do not need to be aware of the topology of the network and consequently do not need to be aware of mutations in the topology.  They can simply define their intent and submit it.  The platform will notify them (via the listener mechanism) if the intent request cannot be satisfied for some reason.

The platform also benefits from this as it is given extra degrees of freedom on how to go about fulfilling the intent request.  This extra freedom can be used by the platform to reconcile what might otherwise be conflicting requests.

The ONOS intent framework continues to evolve.  One of the planned enhancements is to allow different regions of network to satisfy the same request differently; for example, a packet network may go about things differently than an optical network.  Intents will also become easier to stack, thus allowing just a few primitives to be combined in a number of different ways.

The intent framework will also be moved to sit atop the flow-objective sybsystem which allows ONOS and applications to operate on devices with diverse table pipelines and yet be completely agnostic of such differences.

**Do you have any performance testing figures we can highlight?**

With demonstrating ONOS performance, we wanted to go beyond the standard Cbench number.  In our view, Cbench demonstrates just the performance of the OpenFlow I/O loop.  While it is certainly necessary to have a well-running I/O loop, it is definitely not sufficient.  Therefore we set goals for ONOS to demonstrate its performance in a number of areas that we consider key to a scalable controller platform.

These include the throughput of pro-active flow control operations (both flow & intent-based) and the latency of reacting to environmental changes, e.g. device/port down.  We also wanted to demonstrate that an ONOS cluster exhibits desired scaling characteristics as the cluster size increases.  This is to validate that out distributed cluster-coordination is designed correctly.

Some of the key highlights are that a 7-node ONOS cluster can sustain 3.5 million pro-active flow operations per second and 220,000 pro-active intent operations per second in nearly linear scale-out fashion with respect to the number of nodes in the ONOS cluster.  We have also shown that ONOS can achieve low latency for reacting to topology changes, even as cluster size grows.  For positive news, such as devices or port down events, ONOS takes less than 5ms to recompute network graph and propagate topology change event apps on all nodes of the ONOS cluster.  For negative news, such as device or port/link up events, the time is a bit longer, but still well under 50ms.  This is by design, as it is far more critical for bad news to travel faster than good news.

It should be noted that for the flow and intent operation throughput tests, we used zero-resistance southbound providers.  This was done primarily to make sure that we have identified all bottlenecks in the ONOS components involved in these operations.  Presently, all hardware and software devices available today suffer their own bottlenecks along the control channel, and we wanted to make sure that no ONOS bottlenecks were being masked by the limitations of the device control channels.

**Explain the modular architecture**

The pivotal piece of the ONOS platform is its distributed core, which is isolated from the network environment using its southbound API.  This API provides high-level abstractions for various control protocol-specific providers to inform the core about the network environment and for accepting control edicts sent by the core or by the applications.  The high-level nature of these abstrations allows a variety of different control protocols to be used, and ultimately what RPC is used between the platform and the network devices becomes entirely secondary.  What really matters is what types of behaviours can be controlled, rather than what language is used to control them.  So in this way, the core does not become tainted by a protocol library du-jour, whether it is the latest version of OpenFlow or NETCONF libraries.

The northern surface of the core presents applications with a variety of high-level abstractions as a means for learning about the network environment and for affecting it. These include the full directed network graph, table pipeline-independent flow objectives service and topology-independent intentservice to name a few.

The core, although often visually depicted is a single block, is far from monolithic. In fact, it comprises of a large number of subsystem, each responsible for a fairly focused set of functionality. In this way, ONOS resembles a chassis with a number of subsystems, each acting as a software-blade that provides specific set of network control functionality and services that others can interact with. ONOS applications can deliver their own components, thus effectively extending the set of available network control features available in ONOS.

The distributed primitives used by the ONOS core are available as part of the ONOS SDK to allow ONOS applications to implement distributed stores for their own state, thus making sure that the entire system continues to be scalable and highly available.

ONOS design relies heavily on interfaces, thus making it easy to evolve the system gradually by replacing implementations with new or improved ones without affecting the rest of the system. In our view, this is key to enabling a large community of contributors to collaborate within the same code-base and without interfering with each other.

**What are your five-year goals?**

To be frank, I have not spent much time thinking about that.  I certainly hope that ONOS becomes a successful and widely-adopted platform, and one which gets used in way that we have not necessarily predicted.

In that time-frame, I would like to see ONOS-based deployments in a number of service provider data-centers and a number of key internet exchanges.  I expect that large-scale adoption may take even longer that that, given the hardware refresh cycles and the fact that, as I mentioned earlier, SDN is not about software alone.
