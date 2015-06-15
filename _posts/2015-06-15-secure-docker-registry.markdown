---
layout: post
title: "Secure Docker registry now available as a Docker image"
date: 2015-06-15
categories: cloudrouter
author: dfj
---

Docker provides an official [registry image](https://registry.hub.docker.com/_/registry/), making it quick and easy to deploy a private Docker registry instance. This can be very handy for development environments, as the CloudRouter project's Arun Babu Neelicattu has found. However, in more sensitive environments it is important to ensure that the Docker registry is secured with authentication and TLS/SSL. Arun has created a [secure Docker registry image](https://registry.hub.docker.com/u/alectolytic/secure-registry/), providing an out-of-the box secure environment. This image is also available on the [CloudRouter dockerhub repo](https://registry.hub.docker.com/u/cloudrouter/docker-registry-secure/). 

If you're using an RPM-based Linux distribution, Arun has also created a [Docker registry RPM](https://github.com/abn/docker-registry-rpm). You can use this to install a local copy of the Docker registry. Note that this is not secure by default. You will have to either follow the Docker registry documentation on [SSL configuration](https://github.com/docker/distribution/blob/master/docs/deploying.md#making-your-registry-available) and [authentication](https://github.com/docker/distribution/blob/master/docs/deploying.md#making-your-registry-available); or install and configure an Nginx proxy similar to this [nginx configuration](https://github.com/abn/docker-registry-secure/blob/master/assets/nginx.conf).
