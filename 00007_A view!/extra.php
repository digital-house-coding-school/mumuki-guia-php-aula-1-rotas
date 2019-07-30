$passouPelaView = false;

  function view($route, $vac = []) {
    global $passouPelaView;
    $passouPelaView = true;
    return $route;
  }

  class Route {
    public static $routesGet = [];
    public static $routesPost = [];

    public static function get($route, $action) {
      $newRoute = [
        "route" => $route,
        "action" => $action
      ];
      
      Route::$routesGet[] = $newRoute;
    }
    
    public static function post($route, $action) {
      $newRoute = [
        "route" => $route,
        "action" => $action
      ];
      
      Route::$routesPost[] = $newRoute;
    }

  }