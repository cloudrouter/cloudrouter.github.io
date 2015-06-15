---
layout: post
title: "Secure Docker registry now available as a Docker image"
date: 2015-06-15
categories: cloudrouter
author: dfj
---

Docker provides an official [registry image](https://registry.hub.docker.com/_/registry/), making it quick and easy to deploy a private Docker registry instance. This can be very handy for development environments, as the CloudRouter project's Arun Babu Neelicattu has found. However, in more sensitive environments it is important to ensure that the Docker registry is secured with authentication and TLS/SSL. Arun has created a [secure Docker registry image](https://registry.hub.docker.com/u/alectolytic/secure-registry/), providing an out-of-the box secure environment. This image is also available on the [CloudRouter dockerhub repo](https://registry.hub.docker.com/u/cloudrouter/docker-registry-secure/). 

If you're using an RPM-based Linux distribution, Arun has also created a [secure Docker registry RPM](https://github.com/abn/docker-registry-rpm).If you want to spin up a quick registry but are worried about security, check it out!
