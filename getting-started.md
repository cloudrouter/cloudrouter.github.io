---
layout: blog_section 
title: Getting Started
permalink: /getting-started/
---
## About CloudRouter

CloudRouter is a software-based router designed to run on physical, virtual and cloud environments, supporting software-defined networking infrastructure. It includes the features of traditional hardware routers, as well as support for emerging technologies such as containers and software-defined interconnection. CloudRouter aims to facilitate migration to the cloud without giving up control over network routing and governance. 

CloudRouter is a [Fedora Remix](https://fedoraproject.org/wiki/Remix). 

----

Note: The CloudRouter Fedora Remix is not supported by the Fedora Project. Official Fedora software is available through the [Fedora Project website]( http://fedoraproject.org ).

----

## Getting Started

This guide is for people interested in testing the capabilities of CloudRouter and finding out more about Software-Defined Networking. This getting started guide will cover: 

* Requirements and pre-requisites 
* Downloading the CloudRouter image
* Installing CloudRouter using virt-manager
* Testing the installation
* Some basic configuration tasks

## Requirements and Pre-requisites

### Concepts

**Software-Defined Networking** 

Software-Defined Networking (SDN)uses virtualization concepts to manage network services through abstraction of lower-level functionality. This is emerging technology and has the potential to change the way the Internet is connected. For a primer on SDN concepts, take a look at this [InfoWorld article from 2013](http://www.infoworld.com/article/2606200/networking/111753-Software-defined-networking-explained.html). 


**Linux**

You can install and run CloudRouter without a background in Linux, but understanding basic Linux commands and concepts will help with troubleshooting and configuration tasks. A very quick overview of UNIX-like environments, with some of the most commonly used commands, can be found [here](http://freeengineer.org/learnUNIXin10minutes.html).

**Virtualization** 

For the purposes of this getting started process, CloudRouter should be installed on a virtual machine, or using a container. This guide uses virt-manager, an open source virtualization platform project. Head to the [virt-manager project's website](http://virt-manager.org/) for more information. 

The instructions in this getting started guide assume that you have your chosen virtualization platform up and running before beginning this process. 


### Recommended System Requirements


2048MB memory and 2 vCPUs are recommended to run CloudRouter in a virtual machine environment. 

----

Note: the listed requirements are the same as those for Fedora Cloud. While CloudRouter is designed to be lightweight, some tasks might require more allocated memory and vCPUs. If you experience performance issues please [let us know](mailto:users@lists.cloudrouter.org).

---- 

## Download

Choose which version of CloudRouter you need and then follow the installation instructions. These images are in raw format and are compressed with **xz**.

### Minimal 

The minimal image is a Fedora Remix with the CloudRouter repository pre-configured. Use this image if you don't want all of the pre-installed packages provided by the full install. 

* [x86_64 Minimal Image](https://repo.cloudrouter.org/fedora/2/images/CloudRouter-2.0-BETA-fedora-minimal.raw.xz) 
* [Image Checksum](https://repo.cloudrouter.org/fedora/2/images/CloudRouter-2.0-BETA-fedora-minimal.checksum.txt) 
* [Manifest](https://repo.cloudrouter.org/fedora/2/images/CloudRouter-2.0-BETA-fedora-minimal.manifest) 

### Full

The full image is also a Fedora Remix with the CloudRouter repository pre-configured. In addition, it includes the following packages:

* [BIRD](http://bird.network.cz/)
* [Quagga](http://www.nongnu.org/quagga/)
* [OpenDaylight Helium](http://www.opendaylight.org/) 
* [Capstan](https://github.com/cloudius-systems/capstan/blob/master/README.md)
* [Mininet](http://mininet.org/)
* [ONOS](http://onosproject.org/)
* [FastNetMon](https://github.com/FastVPSEestiOu/fastnetmon)
* [ExaBGP](https://github.com/Exa-Networks/exabgp)

Use this image if you're unsure of which packages you might need for your setup. This is also suitable for live USB and CD images. 

* [x86_64 Image](https://repo.cloudrouter.org/fedora/2/images/CloudRouter-2.0-BETA-fedora-full.raw.xz)
* [Image Checksum](https://repo.cloudrouter.org/fedora/2/images/CloudRouter-2.0-BETA-fedora-full.checksum.txt)
* [Manifest](https://repo.cloudrouter.org/fedora/2/images/CloudRouter-2.0-BETA-fedora-full.manifest)

### Metadata ISO image 

For enhanced security, CloudRouter images ship without any default credentials. A default user called **cloudrouter** is provided, but no password is set. To generate a user profile and set a password, you need to create a metadata ISO. An ISO is a file that emulates a CD. Download or generate the ISO then attach it to the CloudRouter virtual machine (much like you would place a physical CD into a CD disk drive on your computer). 

If you're only testing CloudRouter, you can use the pre-generated metadata ISO we've provided. 

[Metadata ISO](https://repo.cloudrouter.org/fedora/2/images/cloudrouter-init.iso)

Alternatively, you can use the following script to generate the ISO: 

[Metadata ISO generator script](https://github.com/cloudrouter/cloudrouter/blob/master/contrib/make-cloud-init-iso.sh)

---

Important: The metadata image we provide is for testing only and **should not** be used in production. 

---

## Installation 

CloudRouter can be run on a variety of cloud hosts. This getting started guide provides explicit instructions for installing with virt-manager. If you're using a different virtualization platform, the installation and configuration basics are the same: 

* Download the image
* Create a new virtual machine using the CloudRouter image
* Add the metadata ISO to create a user 
* Begin networking and configuration tasks 

----

Note: All the code examples in the following installation procedures use the *full* package name. If you have downloaded the *minimal* image, remember to use the correct package name. 

----

### Install using the GUI

First, you need to uncompress your downloaded image and verify the checksum. 

* Uncompress the CloudRouter image by running this command in the directory the image is located in:

`$ unxz CloudRouter-Beta-Full-20150401.x86_64.raw.xz`

* Verify that the SHA-512 checksum is correct by running this command in the shell:

`$ sha512sum CloudRouter-Beta-Full-20150401.x86_64.raw.xz 20fb13191b3fa43a60e96321a80d4e94c7a4c66f06ff59cc336e7dea193ff28b4a18b3cd15cf6d1d0e4e83c0ba4545a3d395f8bc337f9ca1167769fac24edd7a  CloudRouter-Beta-Full-20150401.x86_64.raw.xz`

Once you have an uncompressed CloudRouter image, you can use it to create your virtual machine. 

* Open the virt-manager tool.
* Select **File**, then **New Virtual Machine**.
* Select **Import existing disk image** from the available options. 
* Either provide the filepath or select **Browse** to choose it manually. If you browse for the file, select **Browse Local** in the bottom left corner of the screen. 
* For **OS type** select Linux. 
* For **Version** select Fedora 22. 
* Set your memory and vCPU to a minimum of 2048 MiB and 2 vCPUs. 
* Give your virtual machine a name, such as "CloudRouter-test". 
* Click **Finish**. CloudRouter will automatically begin installing on the virtual machine. 
* If the installation was a success, you should have a running virtual machine with a command line interface that looks like this: 

[image]

### Attaching the Metadata ISO 

Your CloudRouter virtual machine should be installed but powered down. To attach the metadata ISO: 

* Open the virtual machine by selecting **Open**.
* Select the blue **i** button for more virtual machine details. 
* Select **Add Hardware** in the bottom corner. 
* Select the first option, **Storage**. 
* Select the second option, **Select managed or other existing storage**. 
* Enter the metadata ISO's filepath or select the **Browse** button to find it. 
* Set the bus type to **IDE**. 
* Set the device type to **CDROM device**. 
* Select finish. Your ISO will now appear in the list as IDE CDROM 1. 
* You can now log in as user **cloudrouter**, or the user you defined using the shell script. 

### Install using the Command Line

You can install and configure a CloudRouter virtual machine using the virt-install command. Here is an example of the necessary flags and arguments to use: 

`sudo virt-install --accelerate --hvm --os-type linux --os-variant fedora20 --name CloudRouter-Beta-Full-20150401 --vcpus 2 --ram 2048 --import --disk bus=virtio,path=/var/lib/libvirt/images/CloudRouter-Beta-Full-20150401.x86_64.raw --disk device=cdrom,bus=ide,path=/var/lib/libvirt/images/cloudrouter-init.iso --network bridge=virbr0,model=virtio --noautoconsole`

---

Note: Don't forget to have your metadata ISO image ready to go before running this command. The `--disk-device` argument is where you should provide the filepath to the ISO. 

---

You should now have a CloudRouter virtual machine installed and configured with a username and password. 

## Testing CloudRouter

To test your CloudRouter instance is working correctly, do one of the following: 

**For a minimal install** 

Attempt to install a package using **yum**. Try **BIRD**: 

`sudo yum install bird`

As CloudRouter comes with pre-configured repositories, the download will begin as soon as you confirm with **y**. 

**For a full install**

Run yum update to make sure you have the latest versions of all the included packages, or just pick a specific application to update: 

`sudo yum update`

`sudo yum update bird`


## Next Steps

### Running OpenDaylight

CloudRouter 1.0 beta includes a distribution of OpenDaylight Helium SR3. For information on installing and running OpenDaylight on CloudRouter, see the <a href="https://github.com/cloudrouter/cloudrouter.github.io/wiki/Running-OpenDaylight">Running OpenDaylight</a> wiki page. For more details on using OpenDaylight, see the upstream <a href="http://www.opendaylight.org/resources/getting-started-guide">OpenDaylight Getting Started Guide</a>.

### Bridging Public Clouds with CloudRouter

One of the main benefits of CloudRouter is its ability to bridge public cloud networks such as AWS EC2 and Google Cloud. You can read instructions on how to get your bridge set up in this [article on our wiki](https://cloudrouter.atlassian.net/wiki/display/CPD/Bridging+Public+Clouds+with+CloudRouter).



## Resources

The CloudRouter community is new and still growing. To participate, visit the [community page](https://cloudrouter.org/community/) and see some of the ways you can get involved. 

You can also visit the [CloudRouter wiki](https://cloudrouter.atlassian.net/wiki/display/CPD/CloudRouter+Project+Documentation) to find more documentation, and to contribute your own. This website is a work in progress, and the more contributors we have, the better the community will be! 

