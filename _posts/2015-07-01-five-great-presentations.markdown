---
layout: post
title: "5 Great Presentation from NANOG 64"
date: 2015-07-01
categories: cloudrouter
author: jkt
---

NANOG is the premier meeting for network operators in North America.  The meetings provide a forum for information exchange amoung network operators, engineers, and researchers.  NANOG meets three times each year, and includes panels, presentations, tutorial sessions, tracks, and informal BOFs.

[NANOG 64](https://www.nanog.org/meetings/nanog64/home) took place in San Francisco, June 1-3, 2015.  Overall it was a good event.  The growth of the conference over the past few iterations is impressive, with over 1,100 attendees gathering at the Westin St. Francis in San Francisco.  The downside of that growth is that the conference has clearly outgrown the space.  There simply was not sufficient space to properly navigate around, network, or even hold an impromptu meeting.

Overall, what was clear to me is the continued emergence of software in the network operations space.  There was even a [3-hour tutorial](https://www.nanog.org/meetings/abstract?id=2565), hosted by Facebook, walking through the basics of using Linux-based utilities for network monitoring, configuration, and automation. 

I spoke to quite a few people and attended a wide range of presentations.  Below are 5 great presentations from NANOG 64.

* Interesting presentation from the University of Southern California Information Sciences Institute discussing "Security Service for the Internet" via the [SENSS project](http://steel.isi.edu/Projects/SENSS/).  This technology puts control into the hands of users/victims, allowing him/her to decide what actions to undertake in the case of DDoS attacks.  The project is still in the early stages and the team is looking for feedback from ISPs and end-networks/enterprises to help guide the project.  [Presentation](https://www.nanog.org/sites/default/files/meetings/NANOG64/1008/20150601_Mirkovic_Senss_Security_Service_v1.pdf) and [Video](https://www.youtube.com/watch?v=Aa9NYHWRN2M)

* Very captivating presentation from Peter Hoose at Facebook concerning monitoring, managing and troubleshooting large-scale networks.  Peter walked through the debugging process for a particularily troublesome issue Facebook experienced with micro-bursts, and the multi-year effort involved in finding the root cause.  Along the way, the Facebook network engineers learned quite a bit about utilizing software for network problem triage, as well as wrote a fair bit of software automation.  [Presentation](https://www.nanog.org/sites/default/files//meetings/NANOG64/1019/20150601_Hoose_Monitoring_Managing_And_v1.pdf) and [Video](https://www.youtube.com/watch?v=BRY9xwg5nAU)

* David Temkin from Netflix walked through some of the steps they have undertaken to standardize their rack deployments in order to reduce the number of deployment mistakes, simplify management, all while extending their network reach and service area.  Not directly applicable to the CloudRouter Project, but fascinating to see how the "big boys" approach these sorts of issues.  [Presentation](https://www.nanog.org/sites/default/files//meetings/NANOG64/1014/20150601_Temkin_Netflix_Open_Connect__v5.pdf) and [Video](https://www.youtube.com/watch?v=pb4PsAkBdH8)

* Great presentation from Spotify concerning a new open source Python project aimed at simplifying network automation by providing a programmable abstraction layer with multi-vendor support.  The project is called [N.A.P.A.L.M.](https://github.com/spotify/napalm).  It currently support management of Arista EOS, Juniper JunOS, Cisco IOS-XR, and Fortigate FortiOS.  [Presentation](https://www.nanog.org/sites/default/files//meetings/NANOG64/1043/20150602_Jasinska_Network_Automation_And_v2.pdf) and [Video](https://www.youtube.com/watch?v=93q-dHC0u0I)

* Nice presentation from Google concerning [OpenConfig and Streaming Telemetry](https://www.nanog.org/sites/default/files//meetings/NANOG64/1011/20150604_George_Sdn_In_The_v1.pdf) which was one of several discussions/presentations focused on how to mine the necessary metrics out of software defined networks. [Presentation](https://www.nanog.org/sites/default/files//meetings/NANOG64/1011/20150604_George_Sdn_In_The_v1.pdf) and [Video](https://www.youtube.com/watch?v=_XBwRydxj1M)
