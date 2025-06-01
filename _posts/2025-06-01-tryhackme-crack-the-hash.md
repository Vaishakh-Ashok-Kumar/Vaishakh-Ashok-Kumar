---
title : "TryHackMe - Crack the Hash"
image : "/assets/images/post/crack-the-hash.png"
author : "Vaishakh"
date: 2025-06-01 19:26:00 +0600
description : "A writeup on the TryHackMe room Crack the Hash"
tags : ["Encryption"]

---
**Welcome to the Hash Bash: My TryHackMe Room Adventure**

If you’ve ever wondered what happens when you toss a bunch of passwords, secret messages, and a sprinkle of salt into the cyber blender, you’re in the right place. I just completed a TryHackMe room dedicated to the dark art of hash cracking, and I’m here to spill the (cryptographically secure) beans—with a side of humor.

**Hash, Encryption, Salt, Decryption: The One-Liners**

**Hash** : A hash is like a digital fingerprint for your data—a one-way function that turns anything (text, files, even your grocery list) into a fixed-length string that’s nearly impossible to reverse.

**Encryption** : Encryption is your data’s invisibility cloak—it scrambles information so only someone with the right key can unscramble it and read the original message.

**Salt** : Salt is the secret seasoning sprinkled on your password before hashing, making each hash unique—even if two people have the same password (think of it as adding hot sauce to every dish so no two taste the same).

**Decryption** : Decryption is the magic trick that turns encrypted (scrambled) data back into its original form, but only if you have the right key.

**What’s the Difference?**

Hashing is a one-way street—there’s no going back. Once you hash something, you can’t “unhash” it (unless you’re a wizard or have a rainbow table the size of the internet). Encryption, on the other hand, is a two-way street: you can lock (encrypt) and unlock (decrypt) the data as long as you have the key.

**The TryHackMe Room: Crack the Hash**

This room is all about rolling up your sleeves and getting your hands dirty with different types of hashes. If you’ve spent any time in cybersecurity, you know hashes are everywhere—from storing passwords to verifying file integrity. But sometimes, you need to crack those hashes, whether for a CTF challenge or a real-world pentest.

**My Toolbox:**

`hash-identifier` : This handy Kali Linux tool is like a hash detective—it helps you figure out which hashing algorithm was used just by looking at the hash.

`hashcat` & `johntheripper(john)` : The dynamic duo of hash cracking. With a trusty wordlist (like rockyou.txt), these tools can brute-force their way through hashes, even if they’re salted. Think of them as the Batman and Robin of password recovery.Hashcat [Sample] Hashes

[Sample]: https://hashcat.net/wiki/doku.php?id=example_hashes

`Online Tools`: When you’re feeling lazy (or efficient), online hash crackers can save you time. Just paste the hash, solve a captcha, and let the internet do the heavy lifting. [CrackStation].

[CrackStation]: https://crackstation.net/

**Now let's get started with the questions and their answers**

**Level 1**

**Q1.** `48bb6e862e54f2a795ffc4e541caed4d`

![A1]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L1-1.jpg)

**Q2.** `CBFDAC6008F9CAB4083784CBD1874F76618D2A97` 

![A2]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L1-2.jpg)

**Q3.** `1C8BFE8F801D79745C4631D09FFF36C82AA37FC4CCE4FC946683D7B336B63032`

![A3]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L1-3.jpg)

**Q4.** `$2y$12$Dwt1BZj6pcyc3Dy1FWZ5ieeUznr71EeNkJkUlypTsgbX1H68wsRom`

Now, let me tell you—finding the answer to this question felt like searching for a WiFi signal in the middle of the woods! I had to channel my inner detective and dig through the hashcat example hashes page. By matching the pattern of the mysterious hash with the samples provided, I finally cracked the code on which algorithm was used.

Once I nailed down the algorithm (thanks to those handy hashcat examples), I unleashed the power of hashcat itself to brute-force the answer. It was like playing a game of "Guess Who?" but with cryptography—spot the pattern, pick the right hash mode, and let hashcat do the heavy lifting. Victory never tasted so sweet (or so hashed)!

![A4]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L1-4-using-hashcat-1.jpg)
![A4]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L1-4-using-hashcat-2.jpg)

**Q5.** `279412f945939ba78ce0758d3fd83daa`

![A5]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L1-5.jpg)

**Level 2**

**Q1.** `F09EDCB1FCEFC6DFB23DC3505A882655FF77375ED8AA2D1C13F640FCCC2D0C85`

![A5]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L2-1.jpg)

**Q2.** `1DFECA0C002AE40B8619ECF94819CC1B`

![A5]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L2-2.jpg)

These next questions were tricky too, but just like question 4 in level 1, matching the hash patterns with examples on the hashcat page helped me identify the algorithm. Once that’s done, using hashcat to crack the hash becomes straightforward. The hashcat examples page is definitely a lifesaver when you’re stuck!

**Q3.** 

`Hash: $6$aReallyHardSalt$6WKUTqzq.UQQmrm0p/T7MPpMbGNnzXPMAXi4bJMl9be.cfi3/qxIf.hsGpS41BqMhSrHVXgMpdjS6xeKZAs02.`

`Salt: aReallyHardSalt`

Finding the type of hash

The $6$ prefix indicates this is a sha512crypt hash, which is commonly used in Unix/Linux systems for password storage

Using hashcat

![A3]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L2-3-using-hashcat.jpg)

**Q4.**

`Hash: e5d8870e5bdd26602cab8dbe07a942c8669e56d6`

`Salt: tryhackme`

Finding the type of hash 

![A4]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L2-4-using-hash-identifier.jpg)

Using hashcat

![A4]({{site.baseurl}}/assets/images/post/TryHackMe-Crack-the-hash/L2-4-using-hashcat.jpg)

**What Did I Learn?**

Hashing ≠ Encryption: You can’t “decrypt” a hash. You can only try to guess what input produced it by hashing lots of guesses and seeing if any match.

Salts are Saviors: Salting hashes makes life harder for attackers (and for you, if you’re the attacker), because it defeats precomputed tables like rainbow tables.

Not All Hashes Are Created Equal: Some algorithms (like MD5 and SHA-1) are old and breakable; others (like SHA-256, SHA-3, and BLAKE2) are much tougher nuts to crack.

Pro Tips for Fellow Hash Crackers:
Always identify the hash type first—using the wrong algorithm is like trying to open a door with a banana.

Use a solid wordlist. The bigger, the better (rockyou.txt is the classic, but don’t be afraid to get creative).

When in doubt, Google the hash. Sometimes someone else has already cracked it and posted the answer (thanks, internet!).

**Final Thoughts**

Cracking hashes is part science, part art, and part sheer stubbornness. Whether you’re using online tools for quick wins or going full manual with hashcat and johntheripper, remember: every hash cracked is a small victory in the never-ending battle for cybersecurity knowledge.

Stay salty, stay secure, and may your hashes always be strong!