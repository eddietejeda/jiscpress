## AWS ##

[AWSCosts](AWSCosts.md)

Things work differently on Amazon Web Services. Even if you're used to working on virtual servers, you still need to understand the different pieces of Amazon Web Services. Despite offering virtual computing, it does not operate like a Virtual Private Server (VPS) hosting service. This page offers an overview to the features of AWS that the JISCPress project uses.

### Essential Reading ###

The [documentation](http://aws.amazon.com/documentation) is good and the [forums](http://developer.amazonwebservices.com/connect/forumindex.jspa) are lively. Get stuck in.

  * The two main Services we use are [EC2](http://aws.amazon.com/ec2/) and [Simple Storage Service S3](http://aws.amazon.com/s3/). Read those product pages first as a way in to the world of AWS. In addition, we use the [Elastic Block Store (EBS)](http://developer.amazonwebservices.com/connect/entry.jspa?externalID=1667) and an [Elastic IP address](http://docs.amazonwebservices.com/AWSEC2/latest/UserGuide/concepts-elastic-addressing.htm).
  * You really should read the [Elastic Compute Cloud User Guide](http://docs.amazonwebservices.com/AWSEC2/2009-04-04/UserGuide/) to understand how things work both conceptually and in practice. It will save you time!
  * If you are interested in working with the S3 API directly, there's a [guide to getting started](http://docs.amazonwebservices.com/AmazonS3/latest/gsg/).
  * There's a series of [Articles & Tutorials](http://developer.amazonwebservices.com/connect/kbcategory.jspa?categoryID=100) that you can dip into. For example, the tutorial on [running MySQL with EBS](http://developer.amazonwebservices.com/connect/entry.jspa?externalID=1663&categoryID=100) was very useful.
  * The [EC2 FAQ](http://developer.amazonwebservices.com/connect/entry.jspa?externalID=1145&categoryID=100) is very useful. Note the second question: [What happens to my data when my instance terminates?](http://developer.amazonwebservices.com/connect/entry.jspa?externalID=1145&categoryID=100#02) and [Can I have a static IP address?](http://developer.amazonwebservices.com/connect/entry.jspa?externalID=1145&categoryID=100#10)  There are other entries relating to DNS that are worth noting, too.
  * IBM Developer Works also have some [decent introductory tutorials](http://www.ibm.com/developerworks/views/architecture/libraryview.jsp?search_by=Cloud+computing+with+Amazon+Web+Services) on using AWS.

### An Overview ###

<img src='http://www.ukoln.ac.uk/repositories/digirep/images/c/c1/RepositoryStack-AWS.jpg' alt='AWS for Dummies' title='AWS for Dummies' />

[Image Credit](http://www.ukoln.ac.uk/repositories/digirep/index/Fedorazon_How_to_Guides).

The image above is a useful one to keep in mind.  We use EC2, EBS and S3 (+ an Elastic IP address). EC2 is the bare server providing CPU cycles. It comes with 160GB of storage but should you terminate the server (i.e. to save on costs or if there's an outage), you will lose all data on that server that has been created since you set it up ('bundled it').

Therefore, we use EBS, which acts as persistent attached disk space, to store important files such as the MySQL database and config files, apache config files, logs and the JISCPress WordPress MU installation. Note that we are not using EBS as redundant storage, but using it to extend the filesystem itself in the way [described here](http://developer.amazonwebservices.com/connect/entry.jspa?externalID=1663&categoryID=100).

We use S3 to store snapshot backups of EBS and to hold the bundled private AMI. S3 storage is highly secure and replicated around data centres wordwide.

We then use an Elastic IP address to provide a static IP address that can be used in our DNS records and associated with whatever AMI we have running in a matter of seconds.

### Third Party Management Tools ###

Although I briefly describe how to set up AWS EC2 and S3 using the AWS documentation, a number of free and commercial third-party management tools exist to do this via a web browser. i.e. [RightScale](http://rightscale.com) and [Elasticfox](http://developer.amazonwebservices.com/connect/entry.jspa?externalID=609)

### EC2 ###

First you need a server.

Amazon's [documentation](http://docs.amazonwebservices.com/AWSEC2/latest/GettingStartedGuide/index.html) on getting started is clear and useful. There are many different Amazon Machine Images (AMIs) available, but Amazon currently only provide Fedora 8 for Linux. Canonical provide images of Ubuntu but the AWS Ubuntu community also use [Hammond's AMIs http://alestic.com](Eric.md) which are kept current. There is also a mailing list for [Ubuntu on EC2](http://groups.google.com/group/ec2ubuntu). JISCPress is based on Hammond's current (29/06/09) European Jaunty 32bit server AMI (ami-0db89079).

Amazon's EC2 services can be managed by their [Console](https://console.aws.amazon.com/) but you should also set up and learn how to use the [commandline tools](http://docs.amazonwebservices.com/AWSEC2/latest/GettingStartedGuide/).

If you use OS X to work on AWS, you need to get your paths right. The Amazon documentation does not account for OS X. There's a good explanation on [this blog](http://www.robertsosinski.com/2008/01/26/starting-amazon-ec2-with-mac-os-x).

I added this to my .bash\_profile

```
export EC2_HOME=~/.ec2
export PATH=$PATH:$EC2_HOME/bin
export EC2_PRIVATE_KEY=`ls $EC2_HOME/pk-*.pem`
export EC2_CERT=`ls $EC2_HOME/cert-*.pem`
export JAVA_HOME=/System/Library/Frameworks/JavaVM.framework/Home/
export EC2_URL=https://eu-west-1.ec2.amazonaws.com
```

You can either choose to do everything via the commandline or use the Management Console for some tasks and the commandline for others.

[How to Customise an Existing Amazon EC2 Machine Image](http://s3.amazonaws.com/awsVideos/CustomizeAnExistingAMI/Customize%20an%20Existing%20AMI.html) (Video tutorial)
### S3 ###

Once you've got an AMI up and running and have access to the commandline tools, you should prepare your server and then 'bundle' the AMI as your own private machine and offload it to the S3 storage service.

Go here for [S3 documentation](http://docs.amazonwebservices.com/AmazonS3/latest/gsg/). This documentation assumes you have a working knowledge of a scripting or programming language and can work directly with the S3 API.  An alternative method of creating and managing S3 buckets would be to use a third-party management console or a [Firefox plugin](https://addons.mozilla.org/en-US/firefox/search?q=s3&cat=all).


### Elastic Block Storage ###

This is simply a way to add a disk to your AMI. There is good [documentation](http://docs.amazonwebservices.com/AWSEC2/latest/UserGuide/using-ebs.html) on setting EBS up and using it. We used the Management Console to handle this.

The reasons for using EBS is to safeguard against anything happening to your AMI and consequently losing important data. EBS provides persistent storage beyond the lifetime of any AMI it has been attached to. You should treat it like a disk and unmount it before detaching it from an AMI. You can snapshot EBS to create backups of the data, too. You can't easily mount S3 storage as a drive on your AMI, but you can do so with EBS.

## Elastic IP addresses ##

This provides a permanent, static IP address that you 'own'. There is good [documentation](http://docs.amazonwebservices.com/AWSEC2/latest/UserGuide/concepts-elastic-addressing.html) on what an elastic IP address is and how to use one. They are free as long as they are in use. They are useful because you can assign any of your AMIs to the IP address and use the address in your DNS records. For example, you might have two AMIs that you want to hot swap to a given domain name without having to change the DNS record for the domain name. Again, we used the Management Console to handle this.

### Tips ###

  * The Amazon documentation is, on the whole, very good. However, there are times when it is not clear whether the commandline tool they refer to is part of the local toolkit or on the AMI.

  * Once you've got a private AMI registered and you can login using ssh, you need to set up the server for handling web and mail traffic.

  * You should be aware that terminating your private AMI really does 'destroy' any changes you've made to the machine since it was last started. OS upgrades and changes to config files will all be lost if you terminate your AMI. You can however reboot your machine without terminating it and you will not lose data.

  * In addition, since JISCPress runs on Ubuntu, the [Ubuntu EC2 Starters Guide](https://help.ubuntu.com/community/EC2StartersGuide) might be useful.

  * Your AMI will be assigned a dynamic, alpha-numeric hostname. This means that you can't create your own reverse DNS record for your mail server and consequently a lot of mail from your server will be marked as spam. For our project purposes, we can probably live with this, but for a full-time production service, mail would need to be relayed by an external service. It's worth [checking the AWS forums](http://developer.amazonwebservices.com/connect/search.jspa?searchKB=true&searchForums=true&searchQuery=&threadID=&q=ptr+OR+%22reverse+dns%22&objID=f30&dateRange=last30days&userID=&numResults=15&rankBy=10001) to see if this situation has changed.

### Sharing AMIs ###

A deliverable of the JISCPress project is to end up with a public JISCPress AMI that other people can use. We'll be using the [documentation](http://docs.amazonwebservices.com/AWSEC2/latest/UserGuide/AESDG-chapter-sharingamis.html) on AWS to do this once the platform is finished and ready to share.