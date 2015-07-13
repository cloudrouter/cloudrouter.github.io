---
layout: post
title:  "CloudRouter's security philosophy"
date:   2015-07-13
categories: cloudrouter releases
author: dfj
---

CloudRouter provides a distribution of powerful and cutting-ege open source networking technologies. Some projects focus on software intended to be run in isolated environments, not connected to untrusted networks. CloudRouter's focus on enabling a wide range of networking scenarios makes it especially important to pay close attention to security. Security is therefore a key focus of the project, not an afterthought. We take a range of steps to ensure CloudRouter is as secure as possible, and welcome community input on further improvements.

**Package Hardening**

CloudRouter packages that include native binaries have security hardening compiler flags enabled as much as possible. For example, the CloudRouter BIRD package is built with a variety of hardening flags that catch security issues at build time, and improve security at runtime. For more details, see the [Security hardening for native binaries in CloudRouter components](/cloudrouter/releases/2015/03/15/security-hardening-for-native-binaries-in-cloudrouter-components.html) blog post.

**Package Signing**

Cryptographic signatures are used to ensure the integrity of CloudRouter packages. Currently, most packages are provided by the Fedora repositories. For details on how these packages are signed, see the Fedora documentation. Additional packages such as BIRD, ONOS, and OpenDaylight are provided by the CloudRouter repositories. These packages are signed using the CloudRouter Project key.

In order to ensure maximum security for our community, we are using a dedicated signing server with a hardware security module (HSM) that is not connected to the Internet. This drastically reduces the risk of a remote attacker compromising the CloudRouter Project key and attempting to sign malicious packages as legitimate components. For more details, see the [Signing RPMs using the Nitrokey hardware security module (HSM)](https://cloudrouter.org/cloudrouter/releases/2015/02/10/signing-rpms-using-the-nitrokey-hardware-security-module-hsm.html) blog post.

**Security Response & Advisories**

The CloudRouter security team actively monitors for vulnerabilities that affect CloudRouter packages. When vulnerabilities are found, a well-defined [security response process](https://cloudrouter.atlassian.net/wiki/display/CPD/Security+Response+Process) is followed. Once patched releases of CloudRouter are available, [security advisories](https://cloudrouter.org/security/) will be posted.

**Upstream Security**

The efforts outlined so far ensure that our packages are compiled securely and distributed with integrity, and that security vulnerabilities are addressed in a transparent fashion when they are identified. In an ideal world, CloudRouter packages would not have any security vulnerabilities to contend with in the first place. To reduce the risk of vulnerabilities, CloudRouter project members contribute their security skills to upstream projects such as ONOS and OpenDaylight, and we're looking forward to engaging with more upstreams in the near future.
