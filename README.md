# API Creator
Project in progress made only with PHP...

✅/config
-> env.php: Get environment variables;
-> routes.php: Routes defined for the App.

✅/controllers
-> Controller.php: Empty class (for now);
-> ExampleController.php: An example of how to create a controller.

✅/public
-> The app domain must point to the public folder.

✅/request
-> Request.php: Contains the necessary Request information to be able to process the input data;
-> Response.php: Contains the methods for sending a response to the requester;
-> Route.php: Contains the methods to add new routes to the App.

✅/resources
-> ExampleResource.php: An example of how to create a resource. A resource is responsible for formatting and validating input data, returning false for fields with invalid data and ignoring fields those that should not have arrived;
-> ResourceInterface.php: By default all resources must implement this interface so that they maintain a standard.

=======================================================================================================================================

🛑In progress:
-> /models, .env.example, auth...
