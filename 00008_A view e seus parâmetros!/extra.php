$passouPelaView = false;

  function view($route, $vac = []) {
    global $passouPelaView;
    
    $passouPelaView = true;
    
    if (!is_array($vac)) {
      echo "O segundo parâmetro enviado para a função deve ser um array";
      exit;
    }
    
    if (count($vac) != 2) {
      echo "Seu array só deve ter o nome e o sobrenome sendo enviados para a view";
      exit;
    }
    
    $aryaExiste = false;
    $starkExiste = false;
    foreach ($vac as $v) {
      if ($v === "Arya") {
        $aryaExiste = true;
      }
      if ($v === "Stark") {
        $starkExiste = true;
      }
    }
    
    if (!$aryaExiste || !$starkExiste) {
      echo "Não está enviando o nome e o sobrenome para a view";exit;
    }
    
    
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