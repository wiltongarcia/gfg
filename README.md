### How to Test

Please clone the repository and run:

```
docker-compose up --build
```

You're gonna receive the feedback from the container, when you see the message:

```
backend0 [200]: /healthcheck
```

You're ready to test, please to go to http://localhost:8001 and test the app.

### Architetural Decision

In order to simulate a Cloud environment with microservices I chose to use HAProxy as an Application Load Balancer (like the ELB on AWS) and Docker Compose, instead of using a scheduler like ECS or K8S.

In most Cloud environments we use Service Discovery to application to find and communicate with each other, to simulate that we some elasticity, I chose to use HAProxy and fixed IP's address, in this way if any container need to be restarted the communication is seemless.

![Alt text](https://github.com/wiltongarcia/gfg/blob/master/images/topology.png?raw=true "Topology")

# Application Structure

The application itself is made in PHP, using PHP7 and Lumen Micro Framework. I chose Elasticsearch as a search backend because Elasticsearch itself is one of the main products used today to full text search.

## Backend

I created a RESTFUL endpoint, this endpoint hits the controller and the controller parses the parameters using a library that abstracts the search to talk to the Elasticsearch. This library behaves like an ORM, delivering a model of the class that I used. The library also has a method that return a list of objects for the model that I used and the pagination meta-data.

#### Authentication

For the authentication between the Frontend and the Backend Apps I chose to use JWT (JSON Web Tokens), already thinking about an environment where another microservice is in charge of the creation of an authentication token for the application session.

#### Versioning

Using a modern approach in how to handle version for api's, I decided to create a context routing in haproxy pointing to the `v1` version, which is treated as a different application.

````
frontend http-backend
    bind *:8002
    acl is_v1 url_beg /v1
    use_backend backend_app if is_v1
    default_backend backend_app
````

##### Benefits of that

Using 2 different applications 
- Easier to maintain, since the code is not duplicated
- Helps in the deployment, since that can be based on git tags. 
- Troubleshoot the traffic, the requests and even if necessary check which customers are still using the old api version. 
- The capacity of scale the new application in an independent way, since one of the api's can grow more than other.

#### Tests

I performed 2 types of tests in the application, unit tests and integration tests.

##### Unit Test
For the package that handles the authentication using the JWT I wrote a unit tests, that tests the token verification (if empty, if expired, if valid).

##### Integration Test
The tests simulate a full request inside the application, I test the following behaviours:

- 'Get all' in the endpoint
- Filter per brand
- Test with search parameters using a string for full-text search
- Test with per page to define the size of the list
- A request withou a JWT, that expects a 401 (Unathorized)

## Frontend

The frontend was made using the less effort approach, just to pass the parameters to the backend itself. In this process is where the JWT is inserted in the call to the backend.

# Conclusion

In conclusion I believe that this project in the that's configured and coded is a good way to show how this application would behave in the production enviroment and also shows how to leverage on Docker Compose in the development environemnt.

Thanks for your time.
