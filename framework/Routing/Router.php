<?php


namespace Framework\Routing;


class Router{

    /** @var array|array[]
     *  Possible Request Methods mapped to they respective routes
     */
    private array $routes = [
        "GET" => [],
        "POST" => [],
        "PATCH" => [],
        "DELETE" => [],
        "404" => [],
        "400" => []
    ];

    /** @var array
     *
     *  List of all Routes
     */
    private array $paths = [];

    /**
     *
     *  Add Routes to respective methodType Array
     *
     */
    private function addRoute(string $requestMethod, string $path, $closure){

        array_push($this->routes[$requestMethod],[$path => $closure]);

    }

    /**
     *
     *  Add Routes of type {$GET} into Routes Array
     *
     */
    public function get( string $path, $closure){

        $this->addRoute("GET", $path, $closure);

    }


    /**
     *
     *  Add Routes of type {$POST} into Routes Array
     *
     */
    public function post(string $path, $closure){

        $this->addRoute("POST", $path, $closure);

    }


    /**
     *
     *  Add Routes of type {$PUT} into the Routes Array
     *
     */
    public function put(string $path, $closure){

        $this->addRoute("PUT", $path, $closure);

    }


    /**
     *
     * Add Routes of type {$PATCH} into the Routes Array
     *
     */
    public function  patch(string $path, $closure){

        $this->addRoute("PATCH", $path, $closure);

    }

    /**
     *
     * Add Routes of type {$DELETE} in the Routes Array
     *
     */
    public function delete(string $path, $closure){

        $this->addRoute("DELETE", $path, $closure);

    }


    /**
     *  Add all registered routes to paths array
     */
    private function addRoutesToPathArray(){

        /** @var  paths
         *
         *  Combine all arrays added into a single array
         */
        $this->paths = array_merge(

            array_keys($this->routes["GET"]),
            array_keys($this->routes["POST"]),
            array_keys($this->routes["PUT"]),
            array_keys($this->routes["PATCH"]),
            array_keys($this->routes["DELETE"]),
            array_keys($this->routes["404"]),
            array_keys($this->routes["400"]),

        );
    }

    /**
     *  Register Routes Function
     *
     *  Adds all routes to the paths array
     */
    private function registerRoutes(){

        $this->addRoutesToPathArray();

    }

    private function FindRoutesAndReturnRelevantData(string $requestMethod, string $path){

        if(isset($this->paths[$requestMethod][$path])){

            $this->paths[$requestMethod][$path]();

        }
        elseif (in_array($path,$this->paths)){

            echo "<h1> Error 400 </h1>";

        }
        else{

            echo "<h1> Error 404 </h1>";

        }
    }

    public function RunApplication(string $requestMethod, string $path){

        /** Register Routes in Application */
        $this->registerRoutes();

        /** Check for route and return appropriate response */
        $this->FindRoutesAndReturnRelevantData($requestMethod,$path);

    }

    public function __construct(){

    }
}