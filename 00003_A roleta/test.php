  public function testRotaRoleta(): void {
    $rotasGet = Route::$routesGet;
    
    $this->assertTrue(count($rotasGet) == 1, "Você precisa definir uma rota GET");
    
    $rota = $rotasGet[0];
    $rotaString = $rota["route"];
    
    $primeiroCaracter = substr($rotaString, 0, 1);
    
    if ($primeiroCaracter == "/") {
      $rotaString = substr($rotaString, 1);
    }
    
    $partesRota = explode("/", $rotaString);
    
    $this->assertTrue(count($partesRota) == 2, "A rota deveria ter duas partes. A primera indicando o nome da rota e a segunda indicando um parâmetro. Essas partes devem ser separadas por uma /");

    $this->assertTrue($partesRota[0] == "roleta", "A rota por GET deve ser /roleta");
    
    $this->assertTrue(preg_match("/{[a-zA-Z]+}/", $partesRota[1]) === 1, "A segunda parte de rota não está indicando um parâmetro");
    
    $this->assertTrue($rota["action"] instanceof Closure, "Sua rota deve ter uma função anônima");
    
    $reflection = new ReflectionFunction($rota["action"]);
    $arguments  = $reflection->getParameters();
    
    $this->assertTrue(count($arguments) == 1, "A função anônima deve receber um parâmetro");
    
    $resultado = $rota["action"](7);
    
    $this->assertTrue(is_string($resultado), "O resultado ao entrar na rota /roleta/7 deveria ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "aposta no número 7", "O resultado ao entrar na rota /roleta/7, deveria ser 'Aposta no número 7', mas foi recebido '$resultado'");
    
    $resultado = $rota["action"](11);
    
    $this->assertTrue(is_string($resultado), "O resultado ao entrar na rota /roleta/11 deveria ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "aposta no número 11", "O resultado ao entrar na rota /roleta/11, deveria ser 'Aposta no número 11', mas foi recebido '$resultado'");
  }