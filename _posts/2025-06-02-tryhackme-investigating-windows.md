---
title : "TryHackMe - Investigating Windows"
image : "/assets/images/post/Investigating-Windows.png"
author : "Vaishakh"
date: 2025-06-02 22:11:00 +0600
description : "A writeup on the TryHackMe room Investigating Windows"
tags : ["Windows"]

---

**Investigating Windows on TryHackMe: A Comedy of Clicks, Commands, and (Some) Lucky Guesses**

**Introduction: The Adventure Begins**

So, there I was, ready to take on the “Investigating Windows” room on TryHackMe. Armed with nothing but my wits, a suspiciously large cup of coffee, and the burning desire to click on things until something interesting happened, I dove right in. What followed was a journey filled with quick wins, a few “why do it the hard way?” moments, and the occasional “let’s just Google it” strategy. Here’s how it all went down—warts, wins, and wild guesses included.

**Question 1: The Fastest Win in the West**

*Q1. Whats the version and year of the windows machine?*

Who needs to execute code or run complicated scripts? Not me! As soon as I cracked open the VM, it was clear I was staring at a Windows Server. To find out which version, I simply opened Server Manager, navigated to the local server, and—voilà—the answer was staring right back at me. Sometimes, the simplest way is the best way (and the laziest, which is a bonus).

![A1]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-1.png)


**Questions 2 & 3: The Powershell Power Play**

*Q2. Which user logged in last?*

*Q3. When did John log onto the system last?*

Here’s where I faced a crossroads:

**Option A**: Manually parse through Event Viewer’s 4624 events to find the last successful logon and track when user John appeared.

**Option B**: Use the magical powers of the Internet and Powershell.

Guess which one I picked? (Hint: My sanity remains intact.)

With a quick search, I found these time-saving commands:

{% highlight ruby %}
Get-LocalUser

Get-LocalUser | Sort-Object LastLogon | Select-Object Name, Enabled, SID, LastLogon
{% endhighlight %}

These did the trick—no endless scrolling, just answers on a silver platter.

![A2,3]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-2-3-9.png)

**Question 4: The Suspicious CMD Chronicles**

*Q4. What IP does the system connect to when it first starts?*

Sometimes, being nosy pays off. Right after the VM booted, I spotted a suspicious command prompt window trying to connect to an IP address. My detective instincts (and a bit of paranoia) told me to jot it down immediately. Spoiler: That scribbled IP came in handy later. Trust your gut—and your sticky notes.

![A4]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/view-1.jpg)

**Question 5: Admins Assemble (with Powershell)**

*Q5. What two accounts had administrative privileges (other than the Administrator user)?*

A quick web search led me to another handy command:

{% highlight ruby %}
Get-LocalGroupMember Administrator
{% endhighlight %}

![A5]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-5.png)

Boom! No need to dig through endless menus. Sometimes, Google really is your best friend.

**Questions 6, 7, 8: Task Scheduler Shenanigans**

*Q6. Whats the name of the scheduled task that is malicous.*

*Q7. What file was the task trying to run daily?*

*Q8. What port did this file listen locally for?*

Could I have used Powershell again? Sure. But since I already had the machine at my fingertips, I went straight to Task Scheduler. Here’s what I learned:

Check each task’s trigger and action.

The third task was clearly up to no good—running a Powershell script in CMD and listening on a port.

Pro tip: If something looks sketchy in Task Scheduler, it probably is.

![A6,7,8]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-6-7-8.png)

**Question 9: Reusing the Magic**

For this one, I just reused the query from questions 2 and 3. If it ain’t broke, don’t fix it.

![A9]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-2-3-9.png)

**Question 10: Guesswork and Gut Feeling**

*Q10. At what date did the compromise take place?*

Sometimes, you’ve just got to trust your instincts. Knowing that new tasks were created, I guessed the attacker made the backdoor on the same day as the task creation. Sometimes, being a little lazy is the shortcut to being right.

![A10]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-10.png)

**Question 11: Event Viewer Detective**

*Q11. During the compromise, at what time did Windows first assign special privileges to a new logon?*

Windows events are your friends—if you know where to look. Filtering for event id 4738 in Event Viewer and narrowing down by date (thanks to clues from earlier) led me straight to the answer. Manual searching can be tedious, but it works when you know what you’re after.

![A11]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-11.png)

**Question 12: The Mimikatz Moment**

*Q12. What tool was used to get Windows passwords?*

Having used this tool before, I recognized the telltale signs—especially when I found mime.exe and a mime-out.txt file referenced in a scheduled task. All signs pointed to Mimikatz. Sometimes, experience is the best teacher (and snitch).

![A12]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-12.png)

**Questions 13: DNS Host File Surprises**

**Q13. What was the attackers external control and command servers IP?**

To answer these, I checked the DNS hosts file at C:\Windows\System32\drivers\etc\hosts. It was a wild guess, but it paid off—two answers for the price of one. Never underestimate the power of a hunch.

![A13]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-13-16.png)

**Question 14: The Inetdpub Incident**

*Q14. What was the extension name of the shell uploaded via the servers website?*

Curiosity struck when I noticed an odd file—inetdpub—on the disk. A quick search confirmed my suspicion: this was the answer I needed. Sometimes, being suspicious of random files is a good thing.

![A14]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-14.png)

**Question 15: The Writeup Rescue**

*Q15. What was the last port the attacker opened?*

I’ll be honest—this one stumped me. I had to consult a writeup from someone smarter (or at least more patient) than me. Sometimes, you just need a helping [hand].

[hand]: https://medium.com/@haircutfish/tryhackme-investigating-windows-task-1-investigating-windows-da65f32cf67f

![A15]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-15.png)

**Question 16: Hosts File Strikes Again**

*Q16. Check for DNS poisoning, what site was targeted?*

As mentioned earlier, the hosts file was a goldmine. The answer was staring me in the face all along.

![A16]({{site.baseurl}}/assets/images/post/TryHackMe-Investigating-Windows/T1-13-16.png)

**Conclusion: Lessons, Laughs, and a Few Lucky Breaks**

Wrapping up this room was a rollercoaster of quick wins, clever shortcuts, and the occasional wild guess that actually worked. If there’s one thing I learned, it’s that sometimes the easy way is the right way, and a little curiosity (mixed with a dash of paranoia) goes a long way. So, next time you’re investigating a Windows box—trust your gut, Google shamelessly, and never ignore a suspicious CMD window. Happy hacking!