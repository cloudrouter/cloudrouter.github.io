---
layout: post
title: Making OpenDaylight Helium successfully run on OSv
date: 2015-04-09
categories: cloudrouter
author: dfj
---

As discussed in a [previous blog post](https://cloudrouter.org/cloudrouter/releases/2015/03/31/software-defined-interconnection.html), CloudRouter provides an [OpenDaylight OSv image](https://cloudrouter.atlassian.net/wiki/display/CPD/Running+CloudRouter+OSv+Images). The OSv project maintains a [repository](https://github.com/cloudius-systems/osv-apps) of make files and glue code needed to run various applications on OSv. This included OpenDaylight Hydrogen, but not the current OpenDaylight Helium release. We thought we'd submit a quick patch upstream to upgrade to Helium, but it turned out to be a little more tricky than we first thought.

**Capstan**

First, we should take a quick look at [capstan](http://osv.io/capstan/), the tool used to simplify building and running OSv application images. The process of building the application is driven by a Makefile, using standard Makefile syntax. Here is a snapshot of the current OpenDaylight Helium Makefile for OSv:
    
~~~~~~
.PHONY: module

VERSION := 0.2.3-Helium-SR3
URL := https://nexus.opendaylight.org/content/repositories/opendaylight.release/org/opendaylight/integration/distribution-karaf/$(VERSION)/distribution-karaf-$(VERSION).zip

module: ROOTFS

distribution-karaf-$(VERSION).zip:
        wget $(URL)

opendaylight: distribution-karaf-$(VERSION).zip
        unzip -x distribution-karaf-$(VERSION).zip

ROOTFS/opendaylight: opendaylight
        mkdir -p ROOTFS/opendaylight
        cp -a distribution-karaf-$(VERSION)/bin distribution-karaf-$(VERSION)/configuration distribution-karaf-$(VERSION)/data distribution-karaf-$(VERSION)/deploy distribution-karaf-$(VERSION)/etc distribution-karaf-$(VERSION)/externalapps distribution-karaf-$(VERSION)/lib distribution-karaf-$(VERSION)/version.properties distribution-karaf-$(VERSION)/system ROOTFS/opendaylight

ROOTFS: ROOTFS/opendaylight

clean:
        rm -rf distribution-karaf-$(VERSION) ROOTFS
~~~~~~

Since OpenDaylight is a distributed as a pre-compiled Java application, the Makefile just needs to download and extract an OpenDaylight zip distribution. The process of running the application is driven by a Capstanfile, using a syntax similar to Dockerfiles. Here is a snapshot of the current OpenDaylight Helium Capstanfile:
    
~~~~~~
base: cloudius/osv-openjdk

cmdline: >
  --cwd=/opendaylight
  /java.so
  -Xms128M
  -Xmx2048m
  -XX:+UnlockDiagnosticVMOptions
  -XX:+UnsyncloadClass
  -XX:MaxPermSize=512m
  -Dcom.sun.management.jmxremote
  -Djava.endorsed.dirs=/opendaylight/lib/endorsed
  -Djava.ext.dirs=/usr/lib/jvm/java/jre/lib/ext:/usr/java/packages/lib/ext:/opendaylight/lib/ext
  -Dkaraf.instances=/opendaylight/instances
  -Dkaraf.home=/opendaylight
  -Dkaraf.base=/opendaylight
  -Dkaraf.data=/opendaylight/data
  -Dkaraf.etc=/opendaylight/etc
  -Djava.io.tmpdir=/opendaylight/data/tmp
  -Djava.util.logging.config.file=/opendaylight/etc/java.util.logging.properties
  -Dkaraf.startLocalConsole=true
  -Dkaraf.startRemoteShell=true
  -classpath /opendaylight/lib/karaf.branding-1.0.3-Helium-SR3.jar:/opendaylight/lib/karaf-jaas-boot.jar:/opendaylight/lib/karaf.jar:/opendaylight/lib/karaf-jmx-boot.jar:/opendaylight/lib/karaf-org.osgi.core.jar
  org.apache.karaf.main.Main

build: make
~~~~~~

The base element specifies that this image should be built on top of the existing osv-openjdk image. This automatically provides the JDK environment necessary to run OpenDaylight. The cmdline element specifies the command to be executed in order to run OpenDaylight.

**The problem: ClassNotFoundException**

After modifying the Makefile and Capstanfile to upgrade to OpenDaylight Helium, the capstan build process worked fine, but the image would throw a fatal exception at runtime:

~~~~~~
$ capstan run opendaylight
Created instance: opendaylight
OSv v0.16
eth0: 192.168.122.15
chdir: Quota exceeded
OpenJDK 64-Bit Server VM warning: Can't detect initial thread stack location - find_vma failed
Error occurred during initialization of VM
java.lang.Error: java.lang.
ClassNotFoundException: io.osv.OsvSystemClassLoader
    at java.lang.ClassLoader.initSystemClassLoader(ClassLoader.java:1507)
    at java.lang.ClassLoader.getSystemClassLoader(ClassLoader.java:1474)
Caused by: java.lang.ClassNotFoundException: io.osv.OsvSystemClassLoader
    at java.net.URLClassLoader$1.run(URLClassLoader.java:366)
    at java.net.URLClassLoader$1.run(URLClassLoader.java:355)
    at java.security.AccessController.doPrivileged(Native Method)
    at java.net.URLClassLoader.findClass(URLClassLoader.java:354)
    at java.lang.ClassLoader.loadClass(ClassLoader.java:425)
    at sun.misc.Launcher$AppClassLoader.loadClass(Launcher.java:308)
    at java.lang.ClassLoader.loadClass(ClassLoader.java:358)
    at java.lang.Class.forName0(Native Method)
    at java.lang.Class.forName(Class.java:270)
    at java.lang.SystemClassLoaderAction.run(ClassLoader.java:2234)
    at java.lang.SystemClassLoaderAction.run(ClassLoader.java:2220)
    at java.security.AccessController.doPrivileged(Native Method)
    at java.lang.ClassLoader.initSystemClassLoader(ClassLoader.java:1494)
    at java.lang.ClassLoader.getSystemClassLoader(ClassLoader.java:1474)
~~~~~~


Note that the "chdir: Quota exceeded" error was transient and unpredictable, but the ClassNotFoundException was consistent. Usually a ClassNotFoundException is due to a dependency missing on the classpath. After verifying that the classpath contained all the necessary classes, we were left unsure what was causing the exception. We initially thought it could be a [known issue]( https://github.com/cloudius-systems/osv/issues/527) related to the sequence of arguments provided, but that was not the culprit.

**The solution: java.ext.dirs**

After much head scratching, we realized that io.osv.OsvSystemClassLoader is loaded as a Java extension. This means it is not resolved via the classpath, but via the path specified by the java.ext.dirs property. The initial OpenDaylight Helium Capstanfile we wrote contained:

~~~~~~
-Djava.ext.dirs=/opendaylight/lib/ext
~~~~~~

By specifying a new java.ext.dirs value, the default value of /usr/lib/jvm/java/jre/lib/ext:/usr/java/packages/lib/ext was being overriden. The fix was to add these paths to the value specified in the Capstanfile:

~~~~~~
-Djava.ext.dirs=/usr/lib/jvm/java/jre/lib/ext:/usr/java/packages/lib/ext:/opendaylight/lib/ext
~~~~~~

With this fix in place, a patch was [submitted upstream](https://github.com/cloudius-systems/osv-apps/commit/f4e3f13e8c0fbf37405858e5f38ca1fac13d5d57) to complete the upgrade to OpenDaylight Helium. The CloudRouter project now provides a distribution of OpenDaylight Helium running on OSv. For more information, see the [CloudRouter wiki](http://wiki.cloudrouter.org/index.php/Running_CloudRouter_OSv_images).
