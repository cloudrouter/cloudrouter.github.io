**By David Jorm and Don Marti**

# Building OSv images using Docker

There are several ways to build OSv images. The two main options are [Capstan](http://osv.io/capstan/) and the OSv build script. Building images using Capstan has been discussed in a [previous blog post](https://cloudrouter.org/cloudrouter/2015/04/09/opendaylight-on-osv.html) - take a look if you’d like some background information. The build script hasn’t been discussed before, so let’s start by taking a look at it in more detail.

## OSv build script

OSv includes a range of [helper scripts](https://github.com/cloudius-systems/osv/tree/master/scripts) for building and running OSv images. The build script will compile OSv from the local source tree, then create a complete OSv image for a given application, based on the application’s Makefile. For more on `scripts/build`, see [the recent blog post on the OSv build system](http://osv.io/blog/blog/2015/04/08/makefile/).

Building OSv from source has several advantages, including the ability to build images targeting different execution environments. The [CloudRouter project](https://cloudrouter.org) is working on integrating the build script into its continuous integration system, automatically producing nightly rebuilds of all supported OSv application images.

The main problem with this approach is that it requires a system to be appropriately configured with all the necessary dependencies and source code to run builds. To build a scalable and reproducible continuous integration system, we really want to automate the provisioning of new build servers. An ideal way to achieve this goal is by creating a docker image that includes all the necessary components to produce OSv image builds.

# osv-builder: a docker based build/development environment for OSv

The [osv-builder docker image](https://registry.hub.docker.com/u/cloudrouter/osv-builder/) provides a complete build and development environment for OSv, including OSv application images and appliances. It has been developed by [Arun Babu Neelicattu](https://github.com/abn/) from [IIX](http://iix.net). To download the image, run:

```sh
docker pull cloudrouter/osv-builder
```

## Capstan

The image comes with Capstan pre-installed. Note that to use Capstan, you'll have to run the container with the --privileged option, as it requires the KVM kernel module. For example, to build and run the iperf application:

```
$ sudo docker run -it \
  --privileged \
  cloudrouter/osv-builder
bash-4.3# cd apps/iperf
bash-4.3# capstan build
Building iperf...
Downloading cloudius/osv-base/index.yaml...
154 B / 154 B [=================================================================================================================] 100.00 % 0
Downloading cloudius/osv-base/osv-base.qemu.gz...
20.09 MB / 20.09 MB [=======================================================================================================] 100.00 % 1m27s
Uploading files...
1 / 1 [=========================================================================================================================] 100.00 % bash-4.3# capstan run
Created instance: iperf
OSv v0.19
eth0: 192.168.122.15
------------------------------------------------------------
Server listening on TCP port 5001
TCP window size: 64.0 KByte (default)
------------------------------------------------------------
```
## Launching an interactive session

```sh
HOST_BUILD_DIR=$(pwd)/build
docker run -it \
  --volume ${HOST_BUILD_DIR}:/osv/builder \
  cloudrouter/osv-builder
```


This will place you into the OSv source clone.  You’ll see the prompt:
```sh
bash-4.3# 
```
Now, you can work with it as you normally would when working on OSv source.  You can build apps, edit build scripts, and so on. For example, you can run the following commands, once the above `docker run` commands has been executed, to build and run a tomcat appliance.

```sh
./scripts/build image=tomcat,httpserver
./scripts/run -V
```

## The `osv` Command

**Note** that the commands you run can be prefixed with `osv`, the source for which is available at `assets/osv`. For example you can build by:

```sh
docker run \
  --volume ${HOST_BUILD_DIR}:/osv/build \
  osv-builder \
  osv build image=opendaylight
```

Note that the _osv script_, by default provides the following convenience wrappers:

| Command  | Mapping |
| :------------ | :------------ |
| build _args_ | scripts/build |
| run _args_ | scripts/run.py |
| appliance _name_ _components_ _description_ | scripts/build-vm-img |
| clean | make clean |

If any other command is used, it is simply passed on as `scripts/$CMD "$@"` where `$@` is the arguments following the command.

You could also run commands as:

```sh
docker run \
  --volume ${HOST_BUILD_DIR}:/osv/build \
  osv-builder \
  ./scripts/build image=opendaylight
```

## Building appliance images

If using the pre-built version from docker hub, use `cloudrouter/osv-builder` instead of `osv-builder`.

```sh
HOST_BUILD_DIR=$(pwd)/build
docker run \
  --volume ${HOST_BUILD_DIR}:/osv/build \
  osv-builder \
  osv appliance zookeeper apache-zookeeper,cloud-init "Apache Zookeeper on OSv"
```

If everything goes well, the images should be available in `${HOST_BUILD_DIR}`. This will contain appliance images for [QEMU/KVM](http://wiki.qemu.org/KVM), [Oracle VirtualBox](https://www.virtualbox.org/), [Google Compute Engine](https://cloud.google.com/compute/) and [VMWare](https://www.vmware.com/) Virtual Machine Disk.

Note that we explicitly disable the build of [VMware ESXi](http://www.vmware.com/products/esxi-and-esx/overview) images since `ovftool` is not available.


## Building locally


As an alternative, you can build locally with a `docker build` command, using the [Dockerfile](https://registry.hub.docker.com/u/cloudrouter/osv-builder/dockerfile/) for osv-builder.

```sh
docker build -t osv-builder .
```


Then you can use a plain `osv-builder` image name instead of `cloudrouter/osv-builder`.

For more information regarding OSv Appliances and pre-built ones, check the [OSv virtual appliances page](http://osv.io/virtual-appliances/).

## Volume Mapping

| Volume  | Description |
| :------------ | :------------ |
| /osv | This directory contains the OSv repository. |
| /osv/apps | The OSv apps directory. Mount this if you are testing local applications. |
| /osv/build | The OSv build directory containing release and standalone directories. |
| /osv/images | The OSv image build configurations. |

## Sending OSv patches
If you’re following the [Formatting and sending patches](https://github.com/cloudius-systems/osv/wiki/Formatting-and-sending-patches) guide on the OSv web site, just copy your patches into the `builder` directory in the container, and they’ll show up under your `$HOST_BUILD_DIR`, ready to be sent to the mailing list.

## Conclusion

With the osv-builder docker image, building your own OSv images is now easier than ever before. If you are looking for a high-performance operating system to run your applications, go ahead and give it a try!

## About the authors

**David** is a product security engineer based in Brisbane, Australia. He currently leads product security efforts for IIX, a software-defined interconnection company. David has been involved in the security industry for the last 15 years. During this time he has found high-impact and novel flaws in dozens of major Java components. He has worked for Red Hat’s security team, led a Chinese startup that failed miserably, and wrote the core aviation meteorology system for the southern hemisphere. In his spare time he tries to stop his two Dachshunds from taking over the house.

**Don** is a technical marketing manager for Cloudius Systems, the OSv company. He has written for Linux Weekly News, Linux Journal, and other publications. He co-founded the Linux consulting firm Electric Lichen, which was acquired by VA Linux Systems. Don has served as president and vice president of the Silicon Valley Linux Users Group and on the program committees for Uselinux, Codecon, and LinuxWorld Conference and Expo.
