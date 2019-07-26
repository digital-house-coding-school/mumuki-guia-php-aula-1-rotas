public function testRotaRoleta(): void {
    $rotasGet = Route::$routesGet;
    
    $this->assertTrue(count($rotasGet) == 1, "Deveria ter uma rota por GET");
    
    $rota = $rotasGet[0];
    $rotaString = $rota["route"];
    
    $primeiroCaractere = substr($rotaString, 0, 1);
    
    if ($primeiroCaractere == "/") {
      $rotaString = substr($rotaString, 1);
    }
    
    $partesRota = explode("/", $rotaString);
    
    $this->assertTrue(count($partesRota) == 2, "A deveria ter duas partes. A primeira indicando o nome da rota e a segunda indicando um parâmetro. Estas partes devem estar separadas por uma /");

    $this->assertTrue($partesRota[0] == "roleta", "A rota por GET deve ser /roleta");
    
    $this->assertTrue(preg_match("/{[a-zA-Z]+}/", $partesRota[1]) === 1, "A segunda parte da rota não está indicando um parâmetro");
    
    $this->assertTrue($rota["action"] instanceof Closure, "O segundo parâmetro da rota deve ser uma função anônima");
    
    $reflection = new ReflectionFunction($rota["action"]);
    $arguments  = $reflection->getParameters();
    
    $this->assertTrue(count($arguments) == 1, "A função anônima deve receber um parâmetro");
    
    $resultado = $rota["action"](7);
    
    $this->assertTrue(is_string($resultado), "O resultado ao entrar na rota /roleta/7 deveria ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "aposta no número 7", "O resultado ao entrar na rota /roleta/7, deveria ser 'Aposta no número 7', mas foi recebido '$resultado'");
    
    $resultado = $rota["action"](11);
    
    $this->assertTrue(is_string($resultado), "O resultado ao entrar na rota /roleta/11 deveria ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "aposta no número 11", "O resultado ao entrar na rota /roleta/11, deveria ser 'Aposta no número 11', mas foi recebido '$resultado'");
    
    $resultado = $rota["action"](0);
    
    $this->assertTrue(is_string($resultado), "O resultado ao entrar na rota /roleta/0 deveria ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "aposta no número 0", "O resultado ao entrar na rota /roleta/0, deveria ser 'Aposta no número 0', mas foi recebido '$resultado'");
    
      $resultado = $rota["action"](36);
    
    $this->assertTrue(is_string($resultado), "O resultado ao entrar na rota /roleta/36 deveria ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "aposta no número 36", "O resultado ao entrar na rota /roleta/36, deveria ser 'Aposta no número 36', mas foi recebido '$resultado'");
    
    $resultado = $rota["action"](-2);
    
    $this->assertTrue(is_string($resultado), "O resultado ao entrar na rota /roleta/-2 deveria ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "número inválido", "O resultado ao entrar na rota /roleta/-2, deveria ser 'Número inválido', mas foi recebido '$resultado'");
    
    $resultado = $rota["action"](50);
    
    $this->assertTrue(is_string($resultado), "O resultado ao entrar na rota /roleta/50 deveria ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "número inválido", "O resultado ao entrar na rota /roleta/50, deveria ser 'Número inválido', mas foi recebido '$resultado'");
  }