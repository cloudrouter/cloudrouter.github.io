---
layout: blog_section 
title: Getting Started
permalink: /getting-started/
---

## About CloudRouter

CloudRouter is a software-based router designed to run on physical, virtual and cloud environments, supporting software-defined networking infrastructure. It includes the features of traditional hardware routers, as well as support for emerging technologies such as containers and software-defined interconnection. CloudRouter aims to facilitate migration to the cloud without giving up control over network routing and governance. 

CloudRouter 2.0 is now available! Read the release notes [here](https://cloudrouter.org/cloudrouter/releases/2015/09/02/cr2-ga-release-notes.html). 

CloudRouter is built as a [Fedora Remix](https://fedoraproject.org/wiki/Remix) and a [CentOS variant](https://www.centos.org/variants/). 

----

Note: The CloudRouter Project is not supported by the Fedora Project or the CentOS Project. Official Fedora software is available through the [Fedora Project website](http://fedoraproject.org), and CentOS is available through the [CentOS website](https://www.centos.org/).

----

## Download CloudRouter

CloudRouter is available in the following formats for both Fedora-based and CentOS-based images: 

* Live CD/DVD

* Virtual images in both .raw and .vmdk formats

* Amazon EC2 HVM AMIs 

* Docker containers

* OSv images

* rkt compatible containers

To download any of these images, please visit the CloudRouter Project's [download page](https://cloudrouter.atlassian.net/wiki/display/CPD/CloudRouter+Downloads). 

## Introduction 

This guide provides a set of instructions describing how to create a bootable CloudRouter image on a USB flash drive. For more comprehensive getting started instructions, please visit the [Getting Started Guide on the CloudRouter wiki](https://cloudrouter.atlassian.net/wiki/display/CPD/Getting+Started). You can use either a Fedora-based image or a CentOS-based image. These instructions use the Fedora image in examples. Ensure you have: 

* A clean USB drive with at least 4GB of storage space
* A CloudRouter [live image](https://cloudrouter.atlassian.net/wiki/display/CPD/CloudRouter+Downloads)
* Either a computer that allows USB-booting, or a suitable virtual machine (for more information about virtual machines see the [Getting Started wiki](https://cloudrouter.atlassian.net/wiki/display/CPD/Getting+Started))

### Creating a Bootable USB CloudRouter Image on Linux

This method will destroy any existing data on your USB. Ensure you have a clean, empty USB drive before you begin. This method uses the **dd** utility, which does not allow for data persistence but is suitable for creating a test instance of CloudRouter. **dd** is available and should work similarly across most Linux-based distributions; please refer to your distribution's documentation if you have any trouble. 

The basic command structure for **dd** looks like this: 

 `sudo dd if=example.iso of=/dev/usbname`
 
The `if=` argument provides the location of the live image, and the `of=` argument provides the destination, in this case, the USB device. 

1. Plug in your USB drive then open your command line. 
 
2. Note the filepath of your downloaded CloudRouter image:
	
	`~/Home/Downloads/CloudRouter-Live-2.0-BETA-fedora.iso`	
	 
3. Find out the allocated name of your USB device by running the **lsblk** command: 

        [username@localhost ~]$ lsblk 
        NAME                                          MAJ:MIN RM   SIZE RO TYPE  MOUNTPOINT
        sda                                             8:0    0 119.2G  0 disk  
        ├─sda1                                          8:1    0   200M  0 part  /boot/efi
        ├─sda2                                          8:2    0   500M  0 part  /boot
        └─sda3                                          8:3    0 118.6G  0 part  
          └─luks-6b665c1f-2604-45a7-6751-89b49efe192c 253:0    0 118.6G  0 crypt 
            ├─fedora-swap                             253:1    0   7.8G  0 lvm   [SWAP]
            ├─fedora-root                             253:2    0    50G  0 lvm   /
            └─fedora-home                             253:3    0  60.8G  0 lvm   /home
        sdb                                             8:16   1  14.9G  0 disk  
 
   In this case, the device is called **sdb**. In the above example, the device is already _unmounted_. If your device is mounted, use the **umount** command to unmount it: 
   
   `umount /dev/sdb`

4. Once you have the download location and the device location, and your device is unmounted, you can run the **dd** command: 

   `sudo dd if=~/Home/Downloads/CloudRouter-Live-2.0-BETA-fedora.iso of=/dev/sdb` 
   
   The **dd** utility works silently; do not interrupt the process. It might take some time to run, depending on the available RAM and the image size. Once it's completed, you should see an output like this: 
   
        4+1 records in
        4+1 records out
        2547646464 bytes (2.5 GB) copied, 252.723 s, 10.1 MB/s
        
5. Your USB image is now ready to use. The live CloudRouter image comes pre-configured with the username **cloudrouter** with the password **CloudRouter**. 

----

Note: These credentials are provided for testing purposes only and **should not** be used in production. 

----

### Creating a Bootable USB CloudRouter Image on Windows 

This procedure is based on UNetbootin, an open source tool recommended by multiple Linux distributions and suitable for most Windows versions. Download UNetbootin [here](http://unetbootin.github.io/).

Once UNetbootin is downloaded and running: 

1. Select the **Diskimage** option. 

2. Leave **ISO** selected and specify the downloaded image filepath by typing it in or browsing. 

3. Select **USB** as the target device and check that the tool has identified the correct location. 

4. Click **OK** and wait for the process to finish. 

5. Your USB image is now ready to use. The live CloudRouter image comes pre-configured with the username **cloudrouter** with the password **CloudRouter**. 

----

Note: These credentials are provided for testing purposes only and **should not** be used in production. 

---- 

## Resources

The CloudRouter community is new and still growing. To participate, visit the [community page](https://cloudrouter.org/community/) and see some of the ways you can get involved. 

You can also visit the [CloudRouter wiki](https://cloudrouter.atlassian.net/wiki/display/CPD/CloudRouter+Project+Documentation) to find more documentation, and to contribute your own. This website is a work in progress, and the more contributors we have, the better the community will be! 

