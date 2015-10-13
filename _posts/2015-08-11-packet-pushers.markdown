---
layout: post
title:  "CloudRouter Project in  Network Break 45"
date: 2015-08-11 
categories: cloudrouter
author: jkt 
---

I've been meaning to post this for a few weeks, and finally getting around to it.  The team over at [Packet Pushers](http://packetpushers.net/) were kind enough to cover the CloudRouter v2 Beta release a few weeks ago in [Network Break 45](http://packetpushers.net/podcast/podcasts/network-break-45/).  Thanks to [Greg](http://etherealmind.com/author/gregferro/) and [Drew](https://twitter.com/drewconrymurray) for their coverage.

While I highly recommend listening to the whole podcast, here's the transcript of the portion concerning CloudRouter.  The [corresponding audio]({{ site.baseurl }}/wp-content/uploads/2015/08/Network_Break_45_cloudrouter_clip.wav) is a great listen if you only have 5 minutes to devote!

### Transcript

**Drew**
>It wouldn't be The Network Break if we didn't talk about another project out there, CloudRouter.  I don't know if folks have heard about it.  It's fairly new.  They just came out with an announcement, they've released a recent beta of CloudRouter which is bundling OpenDaylight Lithium, and the latest ONOS release.

**Greg**
>CloudRouter is a software router, designed to run on physical, virtual, and cloud environments supporting software defined networking infrastructure.  I think it's really critical to understand the value of this, in that I was thinking carefully about some DevOps projects this week, and when you do DevOps, what you do is run a script and instantiate something.  If, every time you instantiate, let's say, a virtual data center hosting a virtual application, and you've got a router and a virtual firewall, and a virtual load balancer in there, if you were using commercial software licensed stuff, the actual amount of code you have to write to license that instance that you're creating is extraordinary.
>
>Having open source routers that you can just, give me a router, boom, give me another router, boom, is actually really, really valuable.  If you don't care whether you need a hundred or a thousand virtual routers, that actually changes the way you build your infrastructure.  If you're deploying an application, if you give your developers, let's say you're running a test suite, and the developer commits his code, he's one of fifty developers.  When he clicks the commit buttom, the GIT, Gerrit, Jenkins, Maven tools will all boot into action, spin up an environment, load the code, and then run a test suite against it.  If you run a Cisco router and an F5 load balancer, and a virtual, some vendors virtual firewall or virtual checkpoint for two hours while those tests run, how much money is that going to cost you?  Let's say you've got fifty developers, and each one has fifty environments.

**Drew**
>That's a lot of licenses.

**Greg**
>Just the cost alone, number one, and number two, how do you bill for that?  How do you validate that?  This is where these open source projects are going, CloudRouter is one of those, and software defined infrastructure has a licensing problem that they haven't yet solved.  If you're checking for licensing service, which a lot of vendors are offering, it's still far from perfect.  CloudRouter is bundling in OpenDaylight Lithium, which is the latest release of OpenDaylight, they've patched it all up.  You install the instance, you do an update, and then you decide whether you want to run Quagga or Bird, which VPN's software you wan, and it's a fully fledged router.  Whether it's commercial grade or not, I can't make any comments on this particular point Drew, I haven't dug into it, but it's certainly got some major commitments, so the people behind CloudRouter, the companies who are funding its development, its growth and where it came from, gives me some hope for the future.

**Drew**
>Yeah, the OpenDaylight folks seem to be supporting CloudRouter, and all the other stuff that's bundled in there, it seems like it's going to be a lively project, although it is still in beta, we haven't had an official release yet, and its still a fairly young project.

**Greg**
>I'm trying to remember where CloudRouter came from.  I remember getting briefed from them a while back, and I haven't managed to stay up to date, but it did spin out of a big serious company.

**Drew**
>IIX.

**Greg**
>Yeah, which is one of the internet exchange companies.

**Drew**
>Right, yeah, there's a really good interview with CloudRouter project lead, a guy named Jay Turner, on the Register, and we'll include a link in the show notes.  Just talking about what spurred this project, why he wanted to get involved, and it was essentially that manual router operations is really tedious, they've got points of presence all over the world, they wanted something fast and simple, and that was the spur.

**Greg**
>I like this point you've given us here, dead simple router.  You don't get that from traditional vendors, you're getting fifty other features you have no interest in, and you have to deal with those features being there.

**Drew**
>Yeah, when I saw that quote I was ...

**Greg**
>Have you been copying what I've been saying?

**Drew**
>Yeah, did Greg write this?

**Greg**
>Actually, I'm just copying what other people are saying.  I didn't invent it. 
