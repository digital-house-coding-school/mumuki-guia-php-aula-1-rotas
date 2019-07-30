public function testBemVindo(): void {
    global $passouPelaView;
    
    $passouPelaView = false;


    $rotasGet = Route::$routesGet;
    
    $this->assertTrue(count($rotasGet) == 1, "Deveria ter uma rota por GET");
    
    $rota = $rotasGet[0];
    $rotaString = $rota["route"];
    
    $primeiroCaracter = substr($rotaString, 0, 1);
    
    if ($primeiroCaracter == "/") {
      $rotaString = substr($rotaString, 1);
    }
    
    $partesRota = explode("/", $rotaString);
    
    $this->assertTrue(count($partesRota) == 3, "A rota deveria ter três partes. A primeira indicando o nome da rota, a segunda e a terceira indicando um parâmetro. Estas partes devem estar separadas por uma /");

    $this->assertTrue($partesRota[0] == "bemvindo", "A rota por GET deve ser /bemvindo");
    
    $this->assertTrue(preg_match("/{[a-zA-Z]+}/", $partesRota[1]) === 1, "A segunda parte da rota não está indicando um parâmetro");
    
    $this->assertTrue(preg_match("/{[a-zA-Z]+}/", $partesRota[2]) === 1, "A terceira parte da rota não está indicando um parâmetro");
    
    $this->assertFalse($partesRota[1] === $partesRota[2], "Ambos parâmetros devem ter um placeholder diferente");
    
    $this->assertTrue($rota["action"] instanceof Closure, "O segundo parâmetro da rota deve ser uma função anônima");
    
    $reflection = new ReflectionFunction($rota["action"]);
    $arguments  = $reflection->getParameters();
    
    $this->assertTrue(count($arguments) == 2, "A função anônima deve receber dois parâmetros");
    
    $resul = $rota["action"]("Arya", "Stark");
    
    $this->assertTrue($passouPelaView, "Parece que você não está utilizando a função view");
    
    $this->assertTrue($resul == "bemvindo", "Parece que você não está enviando o resultado para a view bemvindo");
  }