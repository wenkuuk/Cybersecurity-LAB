

**Scenario:** A web developer at Mountain Top Solutions

discovers anomalous activity on a development server.

He reports unusual activity originating from the private network

*10. x.x.x* in the logs on the application development server.

Dwight also added that the server should only be accessed

directly from the console or from his laptop via ssh, which is in

the network 192.168.1.0/24. Can you investigate this anomaly?

Review different log types and audit rules to determine what is

happening.





Considering we have the logs:

\1. apache2 access and error logs

\2. audit logs

\3. auth.log

\4. syslog

**Initial Access:**

When we go through Syslog, we can straightforwardly to see the

hostname of the infected Apache server is: APPSERV-Chicago





And, from the apache logs, the suspicious IP that connects to the

Apache server is “10.0.2.5” with port “44322”

After this, we go through the Apache\_logs, and we can see the

attacker used “hydra” to brute-force the password with the





“wp\_login.php” payload through the HTTP Request POST

method.

**Execution&Enumeration:**

Once the attacker got into the Apache server, executed many

commands such as “grep”, “mktemp”, “awk”, “ls”, “cat” for

getting more internal information.





**Privilege Escalation:**

We can use the query “curl” or “wget” to see what files the

attacker downloaded.

LinePEAS is a common way for Linux escalating privilege.

Downloaded file “linpeas.sh”

Source [here](https://github.com/carlospolop/PEASS-ng/tree/master/linPEAS)





Apart from that, we also can see the “49512.py” and “btlo.zip”

downloaded files.

The 49521.py is downloaded from [exploit-db](https://www.exploit-db.com/)[ ](https://www.exploit-db.com/)[website](https://www.exploit-db.com/), and if we

look into this 49521.py and query this, we can see attackers

executed it via python3





And, 49532.py is utilized to escalate privilege with Sudo

vulnerability.

<https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2021-3156>

Query: ngrok.io

The attacker alternatively used another way to exploit, “wget” to

download “upload\_btlo.sh” from the remote server.

**Exfiltration:**





The attacker uploaded the “password” and “btlo.zip” credential

files to the remote server “134430fcb321[.]ngrok[.]io”

**After Exfiltration:**

Query: 49521

We can see the downloaded files are removed.

**Threat Vector:**

● 49521.py

● upload\_btlo.sh

● 134430fcb321[.]ngrok[.]io

● linpeas.sh

