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
    
    $this->assertTrue(count($partesRota) == 3, "A rota deveria ter três partes. A primeira indicando o nome da rota, a segunda e a terceira indicando um parâmetro. Estas partes devem estar separadas por uma /");

    $this->assertTrue($partesRota[0] == "roleta", "A rota por GET deve ser a /roleta");
    
    $this->assertTrue(preg_match("/{[a-zA-Z]+}/", $partesRota[1]) === 1, "A segunda parte da rota não está indicando um parâmetro");
    
    $this->assertTrue(preg_match("/{[a-zA-Z]+\?}/", $partesRota[2]) === 1, "A terceira parte da rota não está indicando um parâmetro opcional");
    
    $this->assertFalse($partesRota[1] === $partesRota[2], "Ambos parâmetros devem ter um placeholder diferente");
    
    $this->assertTrue($rota["action"] instanceof Closure, "O segundo parâmetro da rota deve ser uma função anônima");
    
    $reflection = new ReflectionFunction($rota["action"]);
    $arguments  = $reflection->getParameters();
    
    $this->assertTrue(count($arguments) == 2, "A função anônima deve receber dois parâmetros");
    
    $resul = $rota["action"](11, 200);
    
    $this->assertTrue(is_string($resul), "O resultado ao entrar na rota /roleta/11/200 devería ser uma string");
    
    $this->assertTrue(strtolower($resul) === "aposta 200 no número 11", "Ao entrar na rota /roleta/11/200, deveria ser 'Aposta 200 no número 11', mas foi recebido '$resul'");
    
      $resul = $rota["action"](0, 100);
    
    $this->assertTrue(is_string($resul), "O resultado ao entrar na rota /roleta/0/100 devería ser uma string");
    
    $this->assertTrue(strtolower($resul) === "aposta 100 no número 0", "Ao entrar na rota /roleta/0/100, deveria ser 'Aposta 100 no número 0', mas foi recebido '$resul'");
    
      $resul = $rota["action"](36, 500);
    
    $this->assertTrue(is_string($resul), "O resultado ao entrar na rota /roleta/36/500 devería ser uma string");
    
    $this->assertTrue(strtolower($resul) === "aposta 500 no número 36", "Ao entrar na rota /roleta/36/500, deveria ser 'Aposta 500 no número 36', mas foi recebido '$resul'");
    
    $resul = $rota["action"](-2,1000);
    
    $this->assertTrue(is_string($resul), "O resultado ao entrar na rota /roleta/-2/1000 devería ser uma string");
    
    $this->assertTrue(strtolower($resul) === "número inválido", "Ao entrar na rota /roleta/-2/1000, deveria ser 'Número inválido', mas foi recebido '$resul'");
    
    $resul = $rota["action"](50,1000);
    
    $this->assertTrue(is_string($resul), "O resultado ao entrar na rota /roleta/50/1000 devería ser uma string");
    
    $this->assertTrue(strtolower($resul) === "número inválido", "Ao entrar na rota /roleta/50/1000, deveria ser 'Número inválido', mas foi recebido '$resul'");
    
    $resul = $rota["action"](36);
    
    $this->assertTrue(is_string($resul), "O resultado ao entrar na rota /roleta/36 devería ser uma string");
    
    $this->assertTrue(strtolower($resul) === "aposta 50 no número 36", "Ao entrar na rota /roleta/36, deveria ser 'Aposta 50 no número 36', mas foi recebido '$resul'");
  }