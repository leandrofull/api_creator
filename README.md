# API Creator
Project in progress made only with PHP...<br/><br/>

✅<strong>paths.php</strong>

- Relative paths to app source code directories.<br/><br/>

✅<strong>/config</strong>

- env.php: Get environment variables;

- routes.php: Routes defined for the App.<br/><br/>

✅<strong>/controllers</strong>

- Controller.php: Empty class (for now);

- ExampleController.php: An example of how to create a controller.<br/><br/>

✅<strong>/public</strong>

- The app domain must point to the public folder.<br/><br/>

✅<strong>/request</strong>

- Request.php: Contains the necessary Request information to be able to process the input data;

- Response.php: Contains the methods for sending a response to the requester;

- Route.php: Contains the methods to add new routes to the App.<br/><br/>

✅<strong>/resources</strong>

- ExampleResource.php: An example of how to create a resource. A resource is responsible for formatting and validating input data, returning false for fields with invalid data and ignoring fields those that should not have arrived;

- ResourceInterface.php: By default all resources must implement this interface so that they maintain a standard.<br/><br/>

🛑<strong>In progress:</strong>

- /models, .env.example, auth...
