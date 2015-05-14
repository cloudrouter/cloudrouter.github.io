---
layout: post
title: "CloudRouter now provides a BIRD App Container Image (ACI)"
date: 2015-05-14
categories: cloudrouter
author: dfj
---

One of CloudRouter's [core features](https://cloudrouter.org/features/) is support for a variety of container and unikernel environments. [Docker images](https://cloudrouter.atlassian.net/wiki/display/CPD/Running++CloudRouter+Docker+Images) and [OSv images](https://cloudrouter.atlassian.net/wiki/display/CPD/Running+CloudRouter+OSv+Images) are already available, and today we are excited to announce the [CloudRouter BIRD App Container Image](https://github.com/cloudrouter/cloudrouter-aci/tree/master/bird). App Container Images adhere to the [App Container spec](https://github.com/appc/spec), which is an emerging open standard format. There are multiple implementations, the most popular being the CoreOS project's [rkt](https://github.com/coreos/rkt).

Running the CloudRouter BIRD ACI is easy. After following the [rkt installation instructions](https://github.com/coreos/rkt/blob/master/README.md):

~~~~~~
$ git clone https://github.com/cloudrouter/cloudrouter-aci.git
Cloning into 'cloudrouter-aci'...
remote: Counting objects: 17, done.
remote: Compressing objects: 100% (15/15), done.
remote: Total 17 (delta 2), reused 16 (delta 1), pack-reused 0
Unpacking objects: 100% (17/17), done.
Checking connectivity... done.
$ cd cloudrouter-aci/bird/
$ make
DEST=image/rootfs ./loadbins /usr/sbin/bird
Loading /usr/sbin/bird
Loading /lib64/ld-linux-x86-64.so.2
Loading /lib64/libpthread.so.0
Loading /lib64/libc.so.6
mkdir -p image/rootfs/var/run
touch image/rootfs/var/run/bird.ctl
mkdir -p image/rootfs/etc
cp /etc/bird.conf image/rootfs/etc
cp manifest image/.
actool build image bird.aci
$ sudo rkt --insecure-skip-verify run bird.aci
bird: Chosen router ID 172.17.42.1 according to interface docker0
bird: Started
~~~~~~

Stay tuned for more news as we continue to make CloudRouter components available in a variety of container and unikernel environments.
