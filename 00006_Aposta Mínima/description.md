Nosso sistema tem como regra que a aposta mínima é de R$ 50. Além disso, é definido que, se o usuário não esclarecer o valor de sua aposta, por padrão, assume-se que ele está apostando R$ 50.

Para isso, vamos modificar a rota da roleta para que a aposta seja opcional. Em outras palavras, nosso sistema deve ser capaz de reagir a:

> 1. **/roleta/12/500** indicando que o usuário aposta R$ 500 no número 12

> 2. **/roleta/35** indicando que o usuário aposta R$ 50 (padrão) no número 35