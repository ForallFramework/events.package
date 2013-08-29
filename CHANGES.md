#### [Version 0.1.4 Beta](https://github.com/ForallFramework/loader.package/tree/0.1.4-beta)
_29-Aug-2013_

* Nothing.

#### [Version 0.1.3 Beta](https://github.com/ForallFramework/loader.package/tree/0.1.3-beta)
_29-Aug-2013_

* Removed the old main.php, and created an init.php which works with the new core package
  if it's installed.
* Renamed Events to EventDispatcher, and removed its dependency to the Forall core package.
* Removed code for non-implemented static event propagation.

#### [Version 0.1.2 Beta](https://github.com/ForallFramework/loader.package/tree/0.1.2-beta)
_20-Aug-2013_

* Added a main.php that uses forall.loader to initialize the Events class.
* Fixed: Missing abstract singleton methods in Events.
* Fixed: Chaining doesn't work in `EventDispatcherTraits::once()`.
* Fixed: Listener not passed by reference in `EventDispatcherInterface::once()`.
* Cleared trailing white-space.

#### [Version 0.1.1 Beta](https://github.com/ForallFramework/loader.package/tree/0.1.1-beta)
_17-Aug-2013_

* Added autoload clause to composer.json.

#### [Version 0.1.0 Beta](https://github.com/ForallFramework/loader.package/tree/0.1.0-beta)
_14-Aug-2013_

* Implemented Event class.
* Implemented EventDispatcherInterface class.
* Implemented EventDispatcherTraits class.
* Implemented the Events core class.

#### [Version 0.0.2 Alpha](https://github.com/ForallFramework/loader.package/tree/0.0.2-alpha)
_4-June-2013_

* Added the missing `CHANGES.md` file.
* Added composer.json and removed the old json files.


#### [Version 0.0.1 Alpha](https://github.com/ForallFramework/loader.package/tree/0.0.1-alpha)
_30-May-2013_

* First version.
