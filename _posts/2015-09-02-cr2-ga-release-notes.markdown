---
layout: post
title:  "CloudRouter 2.0 Release Notes"
date: 2015-09-02
categories: cloudrouter releases
author: jbiddle 
---

###Features

<span dir="ltr">The CloudRouter 2.0 release has been focused on expanding CloudRouter's capabilities, ensuring it remains at the forefront of Software Defined Networking (SDN) technologies, as well as improving stability and security. CloudRouter is also now offered in a wider array of formats to facilitate interoperability and flexibility. </span>


**New Packages** 

CloudRouter has continued to expand its functionality and versatility with a large collection of new packages added. Key inclusions are:

* Mininet - A tool for creating realistic virtual networks for development, testing and research

* FastNetMon - A high performance DoS/DDoS load analyzer for security management

* CoreOS rkt support - A composable, secure, and fast CLI for running containers

* ExaBGP - A lightweight BGP routing daemon

**New Formats** 

In response to community feedback, CloudRouter is now also built on CentOS 7, the open source platform derived from Red Hat Enterprise Linux. CloudRouter is also now available as an Amazon EC2 HVM AMI. You can download CloudRouter as both CentOS and Fedora based images [here](https://cloudrouter.org/download/), in the following formats: 

* Minimal and full virtual images in .raw and .vmdk formats

* CD/DVD live images

* Docker containers 

* OpenDaylight OSv images 

* rkt-compatible App Container Image (ACI) for BIRD 

* Amazon EC2 HVM AMI

###Enhancements

In addition to the new features, this release has also improved several existing components. The entire CloudRouter package has now been rebased from Fedora 20 to Fedora 22, along with the new CentOS 7 distribution. This release also includes OpenDaylight Lithium and ONOS Cardinal, the latest versions of two core SDN technologies. This also means Java has now been upgraded to version 1.8, bringing increased performance and security improvements for both OpenDaylight and ONOS.

###Security 

CloudRouter 2.0 incorporates patches for several security vulnerabilities:

[Moderate] CVE-2015-3414 CVE-2015-3416: OpenDaylight SQLite memory
corruption leading to DoS and possible code execution

[Moderate] CVE-2015-4000: OpenDaylight LOGJAM: TLS connections which
support export grade DHE key-exchange are vulnerable to MITM attacks

[Low] CVE-2015-1857: OpenDaylight information disclosure

For more details, please see:

[https://cloudrouter.org/security/](https://cloudrouter.org/security/)

### Bug Fixes

The following bug fixes have been applied: 

[Openvswitch is not available in CentOS repo](https://cloudrouter.atlassian.net/browse/CR-120) 
A dependency error occurred when attempting to add Mininet, due to CentOS not offering the necessary openvswitch package. CloudRouter is now packaged with openvswitch to prevent the dependency error. 

[exabgp not working on CentOS 7.1](https://cloudrouter.atlassian.net/browse/CR-118)
The exabgp package failed to correctly install on Docker images based on CentOS 7.1 due to missing EPEL repositories. The minimal CentOS 7.1 Docker image is now packaged with the correct EPEL repositories. 

[cr v2 needs to enable ipv4 forwarding](https://cloudrouter.atlassian.net/browse/CR-112)
CloudRouter 2.0 now has IPv4 forwarding enabled by default. 

[fastnetmon service doesn't come up](https://cloudrouter.atlassian.net/browse/CR-97)
The systemd .service file which is included in the upstream source needs to be more flexible to different distrobutions, as currently it hard-codes /opt/fastnetmon/fastnetmon as the location of the binary. In order to not disturb the pristine source, this fix patches the fastnetmon.service file in the spec file as a workaround until the problem is fixed upstream. 

[Mininet 2.2.0 rpm packages is missing a whole folder of classes](https://cloudrouter.atlassian.net/browse/CR-96)
The package "mininet-2.2.0-1.fc22.x86_64.rpm" was missing a directory of classes, which caused mininet to be non-functional: all commands failed because of import errors due to the missing classes. The correct directory has now been added. 

[Not able to Login After import to VirtualBox](https://cloudrouter.atlassian.net/browse/CR-69)
Images converted to a vdi file format for use with Virtual Box booted but couldn't log in using the default credentials supplied by the cloud-init ISO file. This was caused by an incorrect SELinux default parameter. The login now works as expected via ssh key or with the password loaded using cloud-init. 

[CloudRouter Images when launched on google cloud fails during cloud-init](https://cloudrouter.atlassian.net/browse/CR-60)
The cloud-init ISO failed when attempting to launch CloudRouter images on Google Cloud. This was caused by an older version of the cloud-init package in Fedora lacking appropriate GCE support. As the CloudRouter image has been rebased to Fedora 22, the updated cloud-init package provided now has support for GCE built in. 

[SELinux & permissions](https://cloudrouter.atlassian.net/browse/CR-5)
Due to SELinux default behaviour, when starting up a daemon like Quagga's bgpd with systemd and entering the interactive shell via vtysh, Quagga cannot persistently write out configuration files. The SELinux policy has been manually configured in the spec file until a solution is implemented upstream.

_Please refer to the [CloudRouter Project JIRA](https://cloudrouter.atlassian.net/browse/DOCKER-8?jql=%22Target%20Milestone%22%20%3D%20CR-2) for a full list of fixes and additions._ 






