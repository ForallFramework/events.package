# Events - Version 0.0.1 Alpha

## Description

The "events" package for the Forall framework. This is an advanced and powerful event
handling system. It performs the following tasks:

* Offers packages the necessary code to implement their own event handling.
* Provides a generic global event emitter.

## Features

* Instance and static events.
* Event levels (`"...:<level-two>:<level-one>"`).
* Event bubbling in levels (one &rarr; two &rarr; ...).
* Event bubbling in class structure (class instance &rarr; class static &rarr; parent class static).

## Change log

The change-log can be found in `CHANGES.md` in this directory.

## License

Copyright (c) 2013 Avaq, https://github.com/Avaq

Forall is licensed under the MIT license. The license is included as LICENSE.md in the 
[Forall environment repository](https://github.com/ForallFramework/Forall).
