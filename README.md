Ticketing Bundle v1
===================

Latest version. See 0.9 for [previous version](https://github.com/hackzilla/TicketBundle/tree/0.9.x).

Simple multilingual ticketing bundle to add to any project.
Languages: English, French, Russian, German and Spanish.

[![Build Status](https://travis-ci.org/hackzilla/TicketBundle.png?branch=master)](https://travis-ci.org/hackzilla/TicketBundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/091d37a9-7862-4365-952c-814ce95c4d6c/mini.png)](https://insight.sensiolabs.com/projects/091d37a9-7862-4365-952c-814ce95c4d6c)

Requirements
------------

* FOSUserBundle
* Knp Paginator
* Bootstrap v3 (optional) see: http://symfony.com/blog/new-in-symfony-2-6-bootstrap-form-theme

Demo
----

See [Ticket Bundle Demo App](https://github.com/hackzilla/TicketBundleDemoApp) for an example installation.  This can also be used for confirming bugs.

Installation
------------

Add HackzillaTicketBundle in your composer.json:

```json
{
    "require": {
        "hackzilla/ticket-bundle": "~1.0",
        "friendsofsymfony/user-bundle": "~2.0@dev",
    }
}
```

Follow [FOSUserBundle guide](https://github.com/FriendsOfSymfony/FOSUserBundle)


Install Composer

```
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

Now tell composer to download the library by running the command:

``` bash
$ composer update hackzilla/ticket-bundle
```

Composer will install the bundle into your project's `vendor/hackzilla` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FOS\UserBundle\FOSUserBundle(),
        new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        new Hackzilla\Bundle\TicketBundle\HackzillaTicketBundle(),
        // ...
        // Your application bundles
    );
}
```

### Step 3: Import the routing

``` yml
hackzilla_ticket:
    resource: "@HackzillaTicketBundle/Resources/config/routing.yml"
    prefix:   /
```

or 

``` yml
hackzilla_ticket:
    resource: "@HackzillaTicketBundle/Resources/config/routing/ticket.yml"
    prefix:   /ticket
```

### Step 4: Roles

All users can create tickets, even anonymous users.
You can assign ROLE_TICKET_ADMIN to any user you want to be able to administer the ticketing system.

### Step 5: Create tables

```app/console doctrine:schema:update --force```

Events
------

TicketBundle show fires events for creating, updating, and deleting of tickets.

* hackzilla.ticket.create
* hackzilla.ticket.update
* hackzilla.ticket.delete

See for example of how to create listener: http://symfony.com/doc/current/cookbook/service_container/event_listener.html


Change Log
----------

0.7
* TicketType and TicketMessageType have been moved into Form/Type folder.

0.9
* New template, and schema changes

1.0
* Moved UserInterface into bundle
* Moved Ticket Manager to its own namespace


Migrating to 1.0
----------------

* remove new Hackzilla\Bundle\FOSUserBridgeBundle\HackzillaFOSUserBridgeBundle() from AppKernel.php
* remove hackzilla/fosuser-bridge-bundle from composer.json

Pull Requests
-------------

I'm open to pull requests for additional languages, features and/or improvements.
