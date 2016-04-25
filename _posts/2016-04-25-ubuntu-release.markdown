---
layout: post
title: "Ubuntu 16.04 LTS Released"
date: 2016-04-25
categories: cloudrouter
author: jkt
---

*Ubuntu 16.04 LTS (Xenial Xerus) Released*

Today marks the release of Ubuntu 16.04 LTS (Xenial Xerus).  We'd like to give our congratulations to Canonical for the upgrades they've made, especially the support for Open vSwitch integrated with DPDK, because of its ability to boost packet processing.  This approach to networking - an open source software switch combined with the Data Plane Development Kit - will help provide high-performance routing optimizations to those who want it.

We recently achieved [650Gbps](https://cloudrouter.org/cloudrouter/2016/03/29/cloudrouter-3.0-released.html) throughput on commodity hardware with the help of DPDK kernel enhancements, and are excited to see what other people can do with it.  DPDK assists with optimizing data paths, so you should be able to hit new highs with your networking speeds, like we did with Mellanox's 100GbE cards.

We'd like to invite all Ubuntu users to participate in open testing.  Please post any networking speed test results you get from using various switches - by sharing this information we can help make people more comfortable with using Linux for critical SDN architectures.

![working together]({{ site.baseurl }}/wp-content/uploads/2016/04/image00.png)

Thank you in advance for your work and for sharing your test results.  Let's see how fast we can push packet processing.
