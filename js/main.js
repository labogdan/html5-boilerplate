// The module pattern is a good way to encapsulate your JavaScript functions
  // and properties.  The example below shows how to create a module, namespace
  // it, and specify public/private properties and functions.

  // Be aware that the Module Pattern is NOT generally used for object-oriented
  // programming.  It does not give you the ability to define a class that can
  // spawn objects based on its definition.  Although it is possible to jerry
  // rig the Module Pattern to define classes, there isn't a real benefit to
  // doing this as JavaScript has another facility for this.

  // If you are more interested in laying out a classical object-oriented
  // hierarchy, look at this example instead:
  // https://github.com/stevekwan/experiments/blob/master/javascript/class.html

  // However, be aware that JavaScript is not a classically object-oriented
  // language.  If you are trying to write true classical OOP in JavaScript,
  // you're probably doing it wrong.  :)

  // Advantages of the Module Pattern:
  // -Avoids nonsense with the "this" keyword, which often causes confusion
  // -Gives you basic encapsulation without having to write a lot of code
  // -If you are creating a singleton "class," the Module Pattern is for you.

  // Disadvantages of the Module Pattern:
  // -True class-based OOP doesn't work well with the Module Pattern.

  // First, let's create a namespace.  It's not required, but it's usually a
  // good idea.
  var MyNamespace = MyNamespace || {};

  MyNamespace.MyModule = function()  {

    var myPrivateProperty = 2;
    var myPublicProperty = 1;

    var myPrivateFunction = function()  {
      console.log("myPrivateFunction()");
    };

    var myPublicFunction = function()   {
      console.log("myPublicFunction()");

      myPrivateFunction();
    };

    var init = function()   {
      // Do some setup stuff
      console.log("init()");
    };

    // This is the part that separates the private and public stuff.  Anything
    // in this object becomes public.  Anything NOT in this object becomes
    // private.
    var oPublic =
    {
      init: init,
      myPublicProperty: myPublicProperty,
      myPublicFunction: myPublicFunction
    };

    return oPublic;
  }();


	console.log("Calling init()...");
	MyNamespace.MyModule.init();

	console.log("Calling myPublicFunction()...");
	MyNamespace.MyModule.myPublicFunction();

  
