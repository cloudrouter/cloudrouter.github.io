---
layout: post
title:  "CloudRouter 2.0 beta release notes"
date: 2015-07-16 
categories: cloudrouter releases
author: jbiddle 
---

**Features**

The CloudRouter 2.0 Beta release has been focused on expanding CloudRouter's capabilities, ensuring it remains at the forefront of Software Defined Networking (SDN) technologies, as well as improving stability and security. The following components have been added:

* Mininet - A tool for creating realistic virtual networks for development, testing and research

* FastNetMon - A high performance DoS/DDoS load analyzer for security management

* CoreOS rkt support - A composable, secure, and fast CLI for running containers

* ExaBGP - A lightweight BGP routing daemon


**Enhancements**

In addition to the new features, this release has also improved several existing components. The entire CloudRouter package has now been rebased from Fedora 20 to Fedora 22. This release also includes OpenDaylight Lithium and ONOS Cardinal, the latest versions of two core SDN technologies. This also means Java has now been upgraded to version 1.8, bringing increased performance and security improvements for both OpenDaylight and ONOS.

**Security** 

CloudRouter 2.0 beta incorporates patches for several security vulnerabilities:

* [Moderate] CVE-2015-3414 CVE-2015-3416: OpenDaylight SQLite memory
corruption leading to DoS and possible code execution

* [Moderate] CVE-2015-4000: OpenDaylight LOGJAM: TLS connections which
support export grade DHE key-exchange are vulnerable to MITM attacks

* [Low] CVE-2015-1857: OpenDaylight information disclosure

For more details, please see:

[https://cloudrouter.org/security/](https://cloudrouter.org/security/)

**Fixes**

The following bug fixes have been applied to CloudRouter 2.0 Beta. A detailed list of bug fixes will be presented in the final release notes.

[Fixed issues for beta](https://cloudrouter.atlassian.net/sr/jira.issueviews:searchrequest-printable/temp/SearchRequest.html?jqlQuery=filter+%3D+%22CR-2+bugs%22+AND+%28status+%3D+Resolved+OR+status+%3D+Closed%29+ORDER+BY+created+ASC&tempMax=1000)

