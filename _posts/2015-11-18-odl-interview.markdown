---
layout: post
title:  The Future and Present of OpenDaylight
date: 2015-11-18
categories: cloudrouter
author: jkt 
---

OpenDaylight has become a household name in open source SDN.  Despite the fame of the project and use by many organizations, data center operators still have questions about the technology and the community.

With the recent new of ONOS joining the Linux Foundation, even more people are asking questions about the increasingly influential open source project.  Some people have even speculated that ONOS and OpenDaylight will merge in the future.  (See [ONOS & Linux Foundation Head Off War](http://www.lightreading.com/author.asp?section_id=274&doc_id=718708) and [Is ONOS About to Merge with OpenDaylight](http://www.lightreading.com/author.asp?section_id=274&doc_id=718708).

Recently I talked to Neela Jacques, executive direction for OpenDaylight, to get an explanation about what OpenDaylight is, how it is used right now, and how it can fit into software-defined networking (SDN) architecture today and in the future.

**Jay Turner: What is OpenDaylight?**

**Neela Jacques:** We are an open source community of over 500 developers working to build a common, interoperable open SDN platform. Since the OpenDaylight Project launched just a couple years ago, there are more than 20 solutions that embed, integrate or build upon our code base. Our user base includes folks from telecom, enterprise and research/academia including AT&T, Comcast, Orange, CableLabs, Telefonica, City of Bristol, Tencent, Caltech and a multitude of others. Our key goal is to unify the industry around a common code base to allow for innovation and interoperability.

**JT: Can you explain OpenDaylight's microservices architecture and what that means for users?**

**NJ:** OpenDaylight enables network services across a spectrum of hardware and multivendor environments. The microservices architecture lets users control applications, protocols and plug-ins, and also to connect external consumers and providers. OpenDaylight's development is driven by a large, global community that updates the platform roughly [every six months](https://www.opendaylight.org/roadmap) and continuously modifies it to support a growing number of SDN and [network functions virtualization] NFV use cases.

OpenDaylight uses a model-driven approach to describe the network, the functions to be performed on it and the resulting state/status achieved. By sharing YANG data structures in a common data store and messaging infrastructure, the core of OpenDaylight allows for fine-grained services to be created and then combined to solve more complex problems. In the OpenDaylight [MD-SAL](https://wiki.opendaylight.org/view/OpenDaylight_Controller:MD-SAL), any app or function can be bundled into a service and then then loaded into the controller. Services can be configured and chained together in different ways in order to match changing needs of the network.

**JT: How are people using OpenDaylight?**

**NJ:** We're seeing a broad range of [use cases and user stories](https://www.opendaylight.org/user-stories/) across telcos, service providers, enterprises and academics.

One is centralized visibility and control of their network; people need a management and orchestration layer and want to get immediate value out of the network they currently have.

We're also seeing people looking to take their network to the next level, where they need to be able to do proactive or reactive network management and traffic engineering, to be able to go down to the level of the app traffic or even down to the flow. What I'm seeing is that people want a bridge from A to B; there's the network that they have, and the network that they want, and it's going to take three, five or even ten years to get there depending on what we're talking about.

There's another set of use cases that are more greenfield, that are common in that they leverage the capabilities of OpenStack. We're seeing more and more instances of NFV where people are looking to do more than virtualize network functions, but in fact, orchestrate delivery of services to their customers and stakeholders. Finally, we're seeing a strong appetite as people move toward a cloud infrastructure. That requires a network that's as agile and on-demand as what they're seeing from their compute and storage infrastructure being delivered by OpenStack.

Examples of end users deploying OpenDaylight include AT&T, Caltech, Tencent, University of Bristol, KT and many others. AT&T has been very vocal about its use of OpenDaylight as the framework for the global SDN controller the company is developing to extend reach beyond Layers 0-3 to Layer 4-7. And OpenDaylight is already deployed in production as part of its Network on Demand offering.

Meanwhile, Tencent is re-envisioning its Data Center Interconnect network with SDN and OpenDaylight. Caltech, working with the Large Hadron Collider, have been building controllers based on OpenDaylight and leveraging OpenFlow to set up flow rules for distribution of hundreds of terabytes of data (200+ TB of data beyond 13 Tier 1 sites to 160 Tier 2 research sites and 300 Tier 3 sites) moving across the globe, basically enabling a hundreds of universities and research institutions to benefit from the data coming out of the Large Hadron Collider they would not otherwise have access to.

Entities pioneering the smart cities movement are also leveraging OpenDaylight. For example, the City of Bristol is building a fully programmable, citywide network using OpenDaylight. An OpenDaylight-based SDN controller will integrate traffic across Bristol's fiber optic network, LTE and experimental 5G wireless networks as well as starting with connecting a mesh network of 1,500 connected lamp posts. The province of Quebec is also deploying OpenDaylight and OpenStack as part of its Green Cloud buildout.

And this is only the beginning. As the platform and the role of SDN evolve, we expect OpenDaylight's use to grow and evolve across other industries as well.

**JT: What are your goals for OpenDaylight over the next year?  The next five years?**

**NJ:** Our key goal is to solve one of the principal problems of our time: the need for a common networking open platform onto which we can deliver the programmable networks the next generation of innovations will rely upon. Our goal is to serve the needs of existing networks that allow for innovation, from mobile, to [Internet of Things] IoT, and self-driving cars.

OpenDaylight's core purpose is to provide a bridge from the network that we have to the network that we need. In the short term that means providing an abstraction layer flexible enough to support a wide range of southbound protocols that ensures end users can manage the wide range of hardware they already have, as well as ensure that hardware is future-proofed.

Provide key microservices to serve a wide range of use cases that end users have today and may have in the future. A big key focus in next year is to support three major focus areas: better management of existing networks; support/enable NFV as well as OpenStack-based cloud.

Something important to me is not just what we do, but how we do it. I'm very focused as an executive director on ensuring we have a community that is authentic and open, that people like to work with and, finally, that is diverse. A key part of this has been the transition from being a developer-focused open source project to a welcoming balance of developers and end users who each work together and listen to each other to continue towards overall success of project.

**JT: People are curious about the recent announcement of ONOS project joining the Linux Foundation.  Can you provide your view on it?**

**NJ:** [I believe this is a positive move for the industry and for OpenDaylight](https://www.opendaylight.org/news/blogs/2015/10/my-perspective-onos-joining-linux-foundation), though there will be challenges in the short term. With both projects hosted by the Linux Foundation, each will be able to continue to innovate, while also driving toward greater synergies. The Linux Foundation is uniquely qualified when it comes to facilitating collaboration among open source projects.

The OpenDaylight developer community is committed to welcoming ONOS's developers. We already have multiple sub-communities within and outside of OpenDaylight exploring different technological approaches to SDN, and a number have already started working on how to take the best code from each project. With ONOS joining the Linux Foundation it is now much easier to facilitate collaboration as we rationalize where and when it makes sense for users.

We have a challenge in front of us: on one hand, we have great technology in both projects with strong proponents in both the developer and end user communities. At the same time, there is strong pressure from many to harmonize and integrate into the one common platform that our industry so sorely needs.

**JT: What is your connection to OpenStack?**

**NJ:** It is becoming increasingly clear that most next-gen apps will be deployed on private or public clouds. [OpenStack](http://www.thenewip.net/complink_redirect.asp?vl_id=13598) remains the dominant open source project and is a critical component of so many end users' existing and future infrastructures. The challenge has been that physical networks don't and haven't delivered the agility required by these new architectures. Many in the industry are keen to see an OpenDaylight and OpenStack infrastructure/combination. For example, these two projects make up the two most important components of the [Open Platform for NFV Project Inc.](http://www.thenewip.net/complink_redirect.asp?vl_id=13779) infrastructure stack.

Integration with OpenStack is has been a key area of investment for the OpenDaylight project of the last two years.

**JT: What is OPNFV and what is the connection to OpenDaylight?**

**NJ:** OPNFV is the industry's open source answer to NFV. Think of OpenDaylight and OPNFV as sister projects, with OPNFV strongly leveraging and contributing to OpenDaylight. Both are hosted by the Linux Foundation and together we are accelerating the pace of development and deployment by creating passionate communities with diverse technical experience ready to bring open source solutions to networking.

Before the formation of the OPNFV, I was in constant discussions with carriers and service providers that were keen to add network programmability and service agility to their networks. One recurring theme was around how quickly the industry could move from providing core technology that supports and enables SDN and NFV to providing solutions that carriers could deploy into their environments. Carriers often have very different needs and requirements compared to the broader enterprise and data center markets, so the formation of OPNFV was a necessary step toward tackling the problems of the world's leading carriers head-on and thus accelerating their adoption of SDN and NFV.

In a recent OpenDaylight user survey, NFV emerged as the most deployed use case. We're also seeing an evolution with regard to NFV, which is increasingly expanding beyond just telco application areas. Many who indicated NFV as their primary OpenDaylight use case are in the enterprise or academia/research space; this is indicative of NFV’s broad range of implementations outside the traditional telco space.

**JT: Do you have any performance testing figures we can highlight?**

**NJ:** The OpenDaylight community has core teams whose goal is to improve the quality of features across security, scalability, stability and performance, or "S3P" as we call it. This includes a focus on OVSDB, OpenFlow, NETCONF and the MD-SAL, which we refer to as the "bedrock" of OpenDaylight and it's where we run continuous tests to make sure the platform is reliable and fast. You can view live snapshots from our continuous integration system [here](https://jenkins.opendaylight.org/releng/view/openflowplugin/job/openflowplugin-csit-1node-cbench-performance-only-stable-lithium/plot/).
