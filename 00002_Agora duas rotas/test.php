public function testRotaGet(): void {
    $rotasGet = Route::$routesGet;
    
    $this->assertTrue(count($rotasGet) == 1, "Você precisa definir uma rota GET");
    
    $inicioRota = $rotasGet[0];
    
    $this->assertTrue($inicioRota["route"] == "inicio" || $inicioRota["route"] == "/cadastro", "A rota /cadastro não está definida");
    
    $this->assertTrue($inicioRota["action"] instanceof Closure, "O segundo parâmetro da rota deve ser uma função anônima");
  
    $resultado = $inicioRota["action"]();
    
    $this->assertTrue(is_string($resultado), "O resultado da rota /cadastro deve ser uma string");
    
    $this->assertTrue(strtolower($resultado) === "cadastro", "A rota /cadastro deve imprimir 'Cadastro', e foi impresso '$resultado'");
  }

public function testRotaPost(): void {
  $rotasGet = Route::$routesPost;
  
  $this->assertTrue(count($rotasGet) == 1, "Você precisa definir uma rota POST");
  
  $inicioRota = $rotasGet[0];
  
  $this->assertTrue($inicioRota["route"] == "inicio" || $inicioRota["route"] == "/cadastro", "A rota /cadastro por POST não está definida");
  
  $this->assertTrue($inicioRota["action"] instanceof Closure, "O segundo parâmetro da rota deve ser uma função anônima");

  $resultado = $inicioRota["action"]();
  
  $this->assertTrue(is_string($resultado), "O resultado da rota /cadastro deve ser uma string");
  
  $this->assertTrue(strtolower($resultado) === "bem vindo", "A rota /cadastro deve imprimir 'Bem vindo', e foi impresso '$resultado'");
}