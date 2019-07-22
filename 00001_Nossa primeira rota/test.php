public function testRota(): void {
    $rotasGet = Route::$rotasGet;
    
    $this->assertTrue(count($rotasGet) == 1, "Você precisa definir uma rota GET");
    
    $inicioRota = $rotasGet[0];
    
    $this->assertTrue($inicioRota["route"] == "inicio" || $inicioRota["route"] == "/inicio", "A rota /inicio não está definida");
    
    $this->assertTrue($inicioRota["action"] instanceof Closure, "O segundo parâmetro da rota deve ser uma função anônima");
    
    $resultado = $inicioRota["action"]();
    
    $this->assertTrue(is_string($resultado), "O resultado da rota /inicio deve ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "bem vindo", "A rota /inicio deve imprimir 'Bem vindo', e foi impresso '$resultado'");
  } 