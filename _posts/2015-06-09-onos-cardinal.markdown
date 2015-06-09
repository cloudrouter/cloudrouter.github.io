---
layout: post
title: "CloudRouter now provides ONOS Cardinal"
date: 2015-06-09
categories: cloudrouter
author: dfj
---

Last week the Open Network Operating System (ONOS) project shipped the Cardinal release. ONOS Cardinal includes exciting new features such as support for MPLS, IPv6, and Netconf, as well as robust high-availability. CloudRouter now provides ONOS Cardinal as both an [RPM package](https://cloudrouter.org/repo/beta/x86_64/onos-1.2.0-1.noarch.rpm) and a [Docker image](https://registry.hub.docker.com/u/cloudrouter/onos-fedora/). Getting started with the Docker image is easy:

~~~~~~
$ sudo docker pull cloudrouter/onos-fedora
latest: Pulling from docker.io/cloudrouter/onos-fedora
ded7cd95e059: Pull complete 
878af2d10aea: Pull complete 
1242a96ae0da: Pull complete 
b8b14284644d: Pull complete 
f00c938be068: Pull complete 
1ddc7bebc2a7: Pull complete 
98b0a781fe67: Pull complete 
edcab0dc5de7: Pull complete 
7438758b1b44: Pull complete 
8ee8c981ddf3: Already exists 
48ecf305d2cf: Already exists 
Digest: sha256:f5b9759f579f77c1ddc69411f1d66baddbf90f798bb4bf7db0d20ade766e251d
Status: Downloaded newer image for docker.io/cloudrouter/onos-fedora:latest
$ sudo docker run -i cloudrouter/onos-fedora
Welcome to Open Network Operating System (ONOS)!

onos>
~~~~~~
