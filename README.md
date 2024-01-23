# minhas anotações de PHP

# Referencias da linguagem

## Sintaxe básica

- Tags PHP
    
    O PHP deve ser interpolado no meio do arquivo com o uso de tags especificas, chamadas tags de fechamento. Essas tags contem o código PHP, como a `<?php CodeBlock >` que é a principal e mais comum, mas também existe a `<?= OneComand >` short open tag que serve para usos pontuais e curtos. A short open tag só pode ser usada contendo apenas um comando, função, etc… e se habilitada no servidor. 
    
    No arquivo `php.ini` podemos modificar as configurações de uso do PHP no servido.
    
    - Em caso de um arquivo que contenha apenas PHP não se deve fazer o fechamento da tag
    - O PHP precisa ter `;` no final de cada linha.
- Interpolação com HTML
    
    Tudo que não esteja dento das tags do PHP é ignorado pelo interpretador. Isso permite inserir código PHP entre o HTML. Essa regra é excedida em caso de estruturas condicionais como `if else` onde o PHP pode mostrar, ou não, conteúdos entre tags. 
    
- Separação de instruções
    
    Assim como perl ou C (e CSS) o PHP usa `;` no fechamento de cada bloco de comando para identificar que ele chegou no fim. A regra se excede caso seja o ultimo bloco de comando seguido pelo fechamento de uma tag
    
- Comentários
    
    O PHP aceita comentários de linha inteira como `# linha comentada` e `// linha comentada` e também aceita os de bloco como `/* bloco de comentario */` (certifique-se de não aninhar esse tipo de comentário, tal pratica ocasiona em erros). Os comentários feitos são aplicados apenas dentro das tags PHP, por tanto, algo na mesma linha após a tag não será comentado e etc… 
    
    - Comentários de documentação de classes e funções são feitos com `/**  */`

## Tipos

Cada expressão no PHP tem um dos seguintes tipos: 

- Bool (verdadeiro e falso)
    
    O tipo bool recebe apenas `True` ou `False`. Podemos declarar esse tipo atribuindo qualquer uma das palavras a uma variável 
    
- Int (números inteiros)
    
    O tipo Int é designado a qualquer numero inteiro, seja ele negativo ou não. No PHP podemos também declarar numero inteiros de outras formas além do sistema convencional, pode-se usar:
    
    - hexadecimal (16) `$hexa = 0x1A;`
    - octal (8) `$octa = 0o123;`
    - binario (2) `$bi = 0b11111111;`
    - decimal (10) `$deci = 1_234_567;`
    
    Também existem constantes que podem ser usadas para definir configurações de uma variável int, como:
    
    - `PHP_INT_SIZE` para definir o tamanho limite da variável (memória)
    - `PHP_INT_MAX` para definir o máximo da variável
    - `PHP_INT_MIN` para definir o mínimo da variável
    
    Em caso de um numero muito grande como `5000000000000 * 1000000`, ou `9223372036854775808`(que excede em 1 o numero limite), o PHP interpreta a variável com o tipo float.
    
- Float (números com virgula)
    
    O tipo float representa os números com virgula. No PHP só são analisados até a 5 casa após a virgula de um numero, quando ele é submetido a um teste de condicional ou operação.
    
- String (cadeia de carácteres)
    
    No PHP as strings podem ser especificadas de 4 formas:
    
    - ‘Aspas simples’
        
        As aspas simples servem para definir uma string padrão no PHP.
        
    - “Aspas duplas”
        
        As aspas duplas servem para definir strings que passam por um pequeno pré-processamento para substituição de caracteres que precisam de escape
        
        - Tabela de escapes
            
            
            | Sequências | Significado |
            | --- | --- |
            | \n | Nova linha (LF ou 0x0A (10) em ASCII) |
            | \r | Retorno de carro (CR ou 0x0D (13) em ASCII) |
            | \t | Tabulação horizontal (HT ou 0x09 (9) em ASCII) |
            | \v | Tabulação vertical (VT ou 0x0B (11) em ASCII) |
            | \e | Escape (ESC or 0x1B (27) em ASCII) |
            | \f | Form feed (FF ou 0x0C (12) em ASCII) |
            | \\ | contrabarra ou barra invertida |
            | \$ | Sinal de cifrão |
            | \" | aspas duplas |
            | \[0-7]{1,3} | A sequência é interpretada como um caractere em notação octal, que silenciosamente é extravasada para caber em um byte (e.g. "\400" === "\000") |
            | \x[0-9A-Fa-f]{1,2} | A sequência é interpretada como um caractere em notação hexadecimal |
            | \u{[0-9A-Fa-f]+} | A sequência é interpretada como um codepoint Unicode, que será impresso como uma string com a representação desse codepoint UTF-8 |
    - Sintaxe heredoc
        
        O heredoc é uma sintaxe que permite declarar grandes strings de forma mais simples, ele usa uma palavra chave de abertura e fechamento para envolver a string e também tem as funções das aspas duplas.
        
        ```php
        echo <<<END
            dsanan \n
            sjsna \n
            kajj \n
        END;
        ```
        
        - Não podem haver espaços após as palavras chaves e a indentação deve seguir regras especificas
    - Sintaxe nowdoc
        
        O nowdoc é como o heredoc porem sem as utilidades das aspas duplas
        
        ```php
        echo <<<'END'
            dsanan \n
            sjsna \n
            kajj \n
        END;
        ```
        
    - `PHP_EOL` pode ser concatenado com um `.` apos uma string para indicar o final de uma linha
    
    Dentro das aspas duplas ou da sintaxe heredoc podemos interpretar e imprimir variáveis. Existem duas formas e fazer isso, a simples e a complexa.
    
    - Sintaxe simples
        
        A sintaxe simples é caracterizada pelo `$` que vem antes do nome da variável e pode ser acompanhada de chaves para delimitar o nome da variável 
        
        - `echo “Temos sucos de vários sabores, também temos $bolo”` (imprime a variável “bolo” no final da frase)
        - `echo “Temos sucos de vários sabores, também temos ${bolo}s”` (imprime a variável “bolo” no final da frase, junto a letra s)
        
        Essas regras se aplicam a convocação de itens de listas e objetos.
        
        - `echo "$pessoa->john bebeu um pouco de suco de $sucos[0].”`
    - Sintaxe complexa
        
        A sintaxe complexa serve para casos de maior especificidade e exigência técnica. Ela consiste em simplesmente envolver a chamada de variável, função e etc… com chaves
        
        - `echo “sumonando itens de listas com sintaxe complexa | {$objeto->jane} ou {$objeto->{$nomes[0]}}";`
        
        Como mostra o exemplo também podemos usar a sintaxe para usar variáveis como índices de chamadas para objetos e e listas, porem esse valor é convertido em uma variável que tem escopo da string em que se localiza
        
- O PHP interpreta também como ***strings numéricas*** strings que sejam compostas, ou comecem, por números.
- Variáveis compostas
    
    O PHP tem conta como objetos apenas os resultados gerados por classes, porem a linguagem tem arrays com chaves de identificação individuais para cada item (que se pode-se usar como objetos).
    
    - No PHP usamos `$pessoas['lucas'];` para itens com chave de identificação ou `$pessoas[0];` para itens sem chave, e `$pessoas->lucas;` para objetos.
        - Arrays
            - Nomeação
                
                No PHP os arrays podem ter chaves de todos os tipos tendo variações no mesmo array, e em caso de as chaves de identificação não serem definidas os itens tem as contagens padrão de 0 ao numero final. Caso apenas um item tenha a chave definida ele será ignorado na contagem padrão, exceto se a chave for um inteiro, nesse caso ele altera a contagem fazendo os próximos itens serem nomeados a partir do valor de sua chave (esse maior valor persiste mesmo se o array for limpo mudando a nomeação de todos os itens permanentemente).
                
                ```php
                $array = array(
                         "a",
                         "b",
                    6 => "c",
                         "d",
                );
                var_dump($array);
                //retorna
                
                //array(4) {
                //  [0]=>
                //  string(1) "a"
                //  [1]=>
                //  string(1) "b"
                //  [6]=>
                //  string(1) "c"
                //  [7]=>
                // string(1) "d"
                //}
                ```
                
            - Manipulando itens
                
                Para adicionar um item a um array podemos usar `$arr[] = ‘novo valor’;` para um novo valor ao final de um array sem chaves de identificação, e `$arr['string'] = ‘novo valor’;` para adicionar um novo valor com uma chave identificadora chamada string.
                
                Também podemos deletar um array com `unset($arr);` ou apenas um item do próprio com `unset($arr[’item’]);`.
                
                No PHP também é possível inverter a sintaxe convertendo um array em variáveis `[$lucas, $pedro, $alex] = $arr;` cria 3 variáveis correspondentes (a sintaxe usa os índices em ordem padrão, por tento para arrays sem chaves é preciso tomar cuidado com itens adicionados ou apagados pois eles podem alterar a ordem padrão e causar erros, para isso existe a função `array_values()`). Essa sintaxe é frequentemente usada em loops.
                
                também podemos trocar variáveis com esse sintaxe
                
                ```php
                $a = 1;
                $b = 2;
                
                [$b, $a] = [$a, $b];
                
                echo $a;    // imprime 2
                echo $b;    // imprime 1
                ```
                
            - Mencionando itens
                
                Para mencionar um item de um array usamos `$array[’item’];` em casos que se tem chaves ou `$array[2];` quando não se tem chaves. Também podemos substituir a string chave dentro dos colchetes por uma variável
                
                ```php
                for ($i = 0; $i < $count; $i++) {
                    echo "\nVerificando $i: \n";
                    echo "Ruim: " . $array['$i'] . "\n";
                    echo "Bom: " . $array[$i] . "\n";
                    echo "Ruim: {$array['$i']}\n";
                    echo "Bom: {$array[$i]}\n";
                	  echo "ok: $foo[bar]\n";
                }
                ```
                
                Além disso podemos adicionar qualquer expressão dentro dos colchetes, seja uma função, soma e etc…
                
                Em casos que seja necessário reescrever um array pode-se usara a sintaxe `$array2 = [’lucas’, ‘pedro’, …$array1]` para representar todos os itens de um array (em casos de chaves repetidas a ultima sobrepõe as anteriores).  
                
            - Também podemos linkar arrays de forma que quando um é modificado o outro também é com a sintaxe `$array1 = &$array2;`
        - Objetos
            
            No PHP objetos são unicamente retornos de classes, não é possível declarar um objeto sem o uso de uma classe.
            
            ```php
            class foo
            {
                function do_foo()
                {
                    echo "Doing foo.";
                }
            }
            
            $bar = new foo;
            $bar->do_foo();
            ```
            
- Enumerations são uma camada de restrição sobre classes e constantes de classe, destinadas a fornecer uma maneira de definir um conjunto fechado de valores possíveis para um tipo.

Por padrão não é necessário definir um tipo fixo para uma variável, mas em caso da necessidade de uma variável com tipo estático pode-se usar a [declarações de tipo](https://www.php.net/manual/pt_BR/language.types.declarations.php). O PHP usa os tipos das variáveis para determinar quais operações podem, ou não, ser feitas. Entre tanto, o PHP tentara converter uma variável a um tipo que caiba na operação caso a variável não caiba na operação. Essa conversão de valores depende do contexto em que se utiliza o valor. [Transformações de tipos](https://www.php.net/manual/pt_BR/language.types.type-juggling.php).

- [A tabela de comparação de tipos](https://www.php.net/manual/pt_BR/types.comparisons.php)

Para tirar informações de valores podemos usar algumas funções que facilitam o processo como:

- `var_dump(var)` retorna todas as informações da variável
- `get_debug_type(var)` retorna o tipo de uma expressão
- `is_type(var)` para saber se é uma string de determinado tipo
    - `is_string(var)`
    - `is_number(var)`
    - etc…

É possível combinar tipos simples em tipos compostos. O PHP permite que os tipos sejam combinados das seguintes maneiras:

- Interseção de tipos de classes (interfaces e nomes de classes).
    
    Um tipo de interseção aceita valores que satisfazem várias declarações de tipo de classe, em vez de uma única. Os tipos individuais que formam o tipo de interseção são unidos pelo símbolo `&`. Portanto, um tipo de interseção composto pelos tipos `T`, `U`, e `V` será escrito como `T&U&V`.
    
- União de tipos.
    
    Um tipo de união aceita valores de vários tipos diferentes, em vez de um único. Tipos individuais que formam o tipo de união são unidos pelo `|` símbolo. Portanto, um tipo de união composto pelos tipos `T`, `U`, e `V` será escrito como `T|U|V`. Se um dos tipos for um tipo de interseção, ele precisa ser colocado entre parênteses para que seja escrito em DNF: `T|(X&Y)`.
    
- Utilizar `?` antes da declaração de tipo define que uma variável pode ser do tipo especificado ou do tipo `null`.

## Variáveis

No PHP declaramos variáveis dessa forma `$nome = “lucas”;`. Além disso é recomendado que variáveis sejam declaradas com valores atribuídos antes de serem usadas em código. Esse tipo de prática é útil para evitar erros predeterminando o tipo antes de aplica-la a testes.  

- regras para nome de identificadores de variáveis e constantes no PHP
    - Variáveis sempre começam com $
    - O segundo caractere depois só `$` só pode ser uma letra ou um `_`
    - Aceita caracteres [a-z], [A-Z], [0-9] e `_`
    - Aceita caracteres da tabela ASCII a partir de 128
    - Aceita acentos
    - A linguagem é case sensitive então ela identifica a diferença entre maiúsculas e minúsculas
    - Nomes de comandos não podem ser usados como identificadores
- Também temos variáveis já definidas por padrão no PHP [lista de variáveis predefinidas](https://www.php.net/manual/pt_BR/reserved.variables.php)

Também se tem uma categoria de variáveis do tipo array já definidas, essas são as super globais. Esse tipo de variável contem dados dos usuário, informações do servidor, cookies, e etc… Existem varias super globais e a disponibilidade de cada uma pode variar de acordo com o servidor e outras informações

- [lista de superglobals](https://www.php.net/manual/pt_BR/language.variables.superglobals.php)

Não existe uma forma de se declarar super globais. Não se pode declarar o nome de variáveis usando uma super global.

Podemos usar a palavra `global` antes da declaração de uma variável local para mostrar que estamos referenciando ela a uma variável de escopo global e não a uma variável local, também se pode usar a super global [$GLOBALS](https://www.php.net/manual/pt_BR/reserved.variables.globals.php).

Também á casos onde precisamos fazer com que uma função tenha um valor, contagem, dado (e etc…) que seja fixo e não redeclarado a cada chamada. Em situações assim podemos usar a palavra `static` antes da declaração de variável para que ela seja declarada apenas na primeira chamada da função e mantenha seu valor para chamadas posteriores.

Quando se cria um formulário em php é essencial que sejam constatados o método de envio e a ação que são escolhidos pelos parâmetros `<form method=”” action=""></form>` além também dos atributos `<input value=”” name=””></input>`

Ao clicar no botão de submissão será retornado o arquivo.php selecionado onde lá já existem super globais com um array contendo as informações do formulário 

- `$_GET` contem os dados caso tenha sido utilizado o método get
- `$_POST` contem os dados caso tenha sido utilizado o método get.
- `$_REQUEST` contem os dados do formulário independente do método de envio, apesar de utilizar mais memoria.
    - esse super global é a junção de outras super globais sendo elas
        - `$_GET`
        - `$_POST`
        - `$_COOKIES`

## Constantes

As constantes tem a palavra `const` antes do nome da variável e não usam o `$`, além disso todas as constantes devem ser definidas em letras maiúsculas e só suportam tipos escalares (bool, int, float, string) e arrays com conteúdos de expressões escalares.  (geralmente todas são de tipo int ou string, por tanto, acabam não tendo o tipo definido na declaração)

Diferente de uma variável as constantes são indicadas apenas com o nome, não necessitam de um `$`, e sempre são de um escopo global.

- Também temos as constantes magicas que são predefinidas e tem um valor relativo a algum fator [Constantes Mágicas](https://www.php.net/manual/pt_BR/language.constants.magic.php)

Fora isso o PHP tem outras constantes predefinidas que tem uma existência relativa a extensões [Constantes Predefinidas](https://www.php.net/manual/pt_BR/language.constants.predefined.php)

- Variáveis pré-definidas: [https://www.php.net/manual/pt_BR/reserved.variables.php](https://www.php.net/manual/pt_BR/reserved.variables.php)

## Expressões

O PHP é uma linguagem orientada a expressões, o que significa que tudo tem (e representa) um valor. A as seguintes expressões

- Incremento `$var++`
- Decremento `$var--`
- Incremento de quantias variadas `$var += 4`
- Decremento de quantias variadas `$var -= 4`
- Multiplicação de quantias variadas `$var *= 2`
- Operador condicional ternário `$teste ? $BlocoTrue : $BlocoFalse`

## Operadores

- Ordem de precedência
    
    
    | Associação | Operadores | Informação Adicional |
    | --- | --- | --- |
    | (não aplicável) | clone new | https://www.php.net/manual/pt_BR/language.oop5.cloning.php e https://www.php.net/manual/pt_BR/language.oop5.basic.php#language.oop5.basic.new |
    | direita | ** | https://www.php.net/manual/pt_BR/language.operators.arithmetic.php |
    | (não aplicável) | + - ++ -- ~ (int) (float) (string) (array) (object) (bool) @ | https://www.php.net/manual/pt_BR/language.operators.arithmetic.php (unário + e -), https://www.php.net/manual/pt_BR/language.operators.increment.php, https://www.php.net/manual/pt_BR/language.operators.bitwise.php, https://www.php.net/manual/pt_BR/language.types.type-juggling.php#language.types.typecasting e https://www.php.net/manual/pt_BR/language.operators.errorcontrol.php |
    | esquerda | instanceof | https://www.php.net/manual/pt_BR/language.operators.type.php |
    | (não aplicável) | ! | https://www.php.net/manual/pt_BR/language.operators.logical.php |
    | esquerda | * / % | https://www.php.net/manual/pt_BR/language.operators.arithmetic.php |
    | esquerda | + - . | https://www.php.net/manual/pt_BR/language.operators.arithmetic.php (binário + e -), https://www.php.net/manual/pt_BR/language.operators.array.php e https://www.php.net/manual/pt_BR/language.operators.string.php (. anteriormente ao PHP 8.0.0) |
    | esquerda | << >> | https://www.php.net/manual/pt_BR/language.operators.bitwise.php |
    | left | . | https://www.php.net/manual/pt_BR/language.operators.string.php (desde o PHP 8.0.0) |
    | não associativo | < <= > >= | https://www.php.net/manual/pt_BR/language.operators.comparison.php |
    | não associativo | == != === !== <> <=> | https://www.php.net/manual/pt_BR/language.operators.comparison.php |
    | esquerda | & | https://www.php.net/manual/pt_BR/language.operators.bitwise.php e https://www.php.net/manual/pt_BR/language.references.php |
    | esquerda | ^ | https://www.php.net/manual/pt_BR/language.operators.bitwise.php |
    | esquerda | | | https://www.php.net/manual/pt_BR/language.operators.bitwise.php |
    | esquerda | && | https://www.php.net/manual/pt_BR/language.operators.logical.php |
    | esquerda | || | https://www.php.net/manual/pt_BR/language.operators.logical.php |
    | direita | ?? | https://www.php.net/manual/pt_BR/language.operators.comparison.php#language.operators.comparison.coalesce |
    | não associativo | ? : | https://www.php.net/manual/pt_BR/language.operators.comparison.php#language.operators.comparison.ternary (esquerda anteriormente ao PHP 8.0.0) |
    | direita | = += -= *= **= /= .= %= &= |= ^= <<= >>= ??= | https://www.php.net/manual/pt_BR/language.operators.assignment.php |
- associatividade
    
    Associatividade é uma propriedade de operadores que dita por qual lado a expressão especifica será realizada, tendo a mesma precedência a ordem de execução dos operadores é da esquerda para direita, mas cada operador tem a sua ordem própria de realização (leitura) sendo geralmente D → E, e as vezes D → E.
    
- Tipos de operadores:
- Aritméticos
    
    
    | Exemplo | Nome | Resultado |
    | --- | --- | --- |
    | +$a | Identidade | Conversão de $a para int ou float conforme apropriado. |
    | -$a | Negação | Oposto de $a. |
    | $a + $b | Adição | Soma de $a e $b. |
    | $a - $b | Subtração | Diferença entre $a e $b. |
    | $a * $b | Multiplicação | Produto de $a e $b. |
    | $a / $b | Divisão | Quociente de $a e $b. |
    | $a % $b | Módulo | Resto de $a dividido por $b. |
    | $a ** $b | Exponencial | Resultado de $a elevado a $b. |
- Atribuição (recebimento)
    - De aritmética
        
        
        | Exemplo | Equivalente | Operação |
        | --- | --- | --- |
        | $a += $b | $a = $a + $b | Adição |
        | $a -= $b | $a = $a - $b | Subtração |
        | $a *= $b | $a = $a * $b | Multiplicação |
        | $a /= $b | $a = $a / $b | Divisão |
        | $a %= $b | $a = $a % $b | Módulo |
        | $a **= $b | $a = $a ** $b | Exponentiation |
    - De bits
        
        
        | Exemplo | Equivalente | Operação |
        | --- | --- | --- |
        | $a &= $b | $a = $a & $b | Bitwise E |
        | $a |= $b | $a = $a | $b | Bitwise Ou |
        | $a ^= $b | $a = $a ^ $b | Bitwise Xor |
        | $a <<= $b | $a = $a << $b | Desloca para esquerda |
        | $a >>= $b | $a = $a >> $b | Desloca para direita |
    
    | Exemplo | Equivalente | Operação |
    | --- | --- | --- |
    | $a .= $b | $a = $a . $b | Concatenação de strings |
    | $a ??= $b | $a = $a ?? $b | Aglutinação de nulls (null coalesce) |
- Bits
    
    
    | Exemplo | Nome | Resultado |
    | --- | --- | --- |
    | $a & $b | E (AND) | Os bits que estão ativos tanto em $a quanto em $b são ativados. |
    | $a | $b | OU (OR inclusivo) | Os bits que estão ativos em $a ou em $b são ativados. |
    | $a ^ $b | XOR (OR exclusivo) | Os bits que estão ativos em $a ou em $b, mas não em ambos, são ativados. |
    | ~ $a | NÃO (NOT) | Os bits que estão ativos em $a não são ativados, e vice-versa. |
    | $a << $b | Deslocamento à esquerda | Desloca os bits de $a em $b passos para a esquerda (cada passo significa "multiplica por dois") |
    | $a >> $b | Deslocamento à direita | Desloca os bits de $a em $b passos para a direita (cada passo significa "divide por dois") |
- Comparação
    
    
    | $a == $b | Igual | true se $a é igual a $b após equalização de tipos. |
    | --- | --- | --- |
    | $a === $b | Idêntico | true se $a é igual a $b, e eles são do mesmo tipo. |
    | $a != $b | Diferente | true se $a não é igual a $b depois de equalização de ativos. |
    | $a <> $b | Diferente | true se $a não é igual a $b depois de equalização de ativos. |
    | $a !== $b | Não idêntico | true se $a não é igual a $b, ou eles não são do mesmo tipo. |
    | $a < $b | Menor que | true se $a é estritamente menor que $b. |
    | $a > $b | Maior que | true se $a é estritamente maior que $b. |
    | $a <= $b | Menor ou igual | true se $a é menor ou igual a $b. |
    | $a >= $b | Maior ou igual | true se $a é maior ou igual a $b. |
    | $a <=> $b | Spaceship (nave espacial) | Um int menor que, igual a ou maior que zero quando $a é, respectivamente, menor que, igual a ou maior que $b. |
- Operador nulo `$var = $valor ?? $substituto` a variável recebe o valor do bloco se ele não for nulo, caso contrario recebe o substituto.
- Operador de controle de erro, se o sinal de `@` preceder qualquer expressão qualquer erro gerado será ignorado
- Operador de execução, usando a sintaxe ```` podemos englobar um comando que será executado no terminal
- Incremento
    
    
    | Exemplo | Nome | Efeito |
    | --- | --- | --- |
    | ++$a | Pré-incremento | Incrementa $a em um, e então retorna $a. |
    | $a++ | Pós-incremento | Retorna $a, e então incrementa $a em um. |
    | --$a | Pré-decremento | Diminuiu $a em um, e então retorna $a. |
    | $a-- | Pós-decremento | Retorna $a, e então diminuir $a em um. |
- Lógicos
    
    
    | Exemplo | Nome | Resultado |
    | --- | --- | --- |
    | $a and $b | E | true se ambos $a e $b é true. |
    | $a or $b | OU | true se $a ou $b é true. |
    | $a xor $b | XOR | true se $a ou $b é true, mas não ambos ao mesmo tempo. |
    | ! $a | Não | true se $a não é true. |
    | $a && $b | E | true se ambos $a e $b são true. |
    | $a || $b | OU | true se $a ou $b é true. |
- String
    - `.` serve para concatenar strings
    - `$A .= $B` seve para concatenar A mais B e atribuir ao A
- Arrays
    
    
    | Exemplo | Nome | Resultado |
    | --- | --- | --- |
    | $a + $b | União | União de $a e $b. |
    | $a == $b | Igualdade | true se $a e $b tem as mesmas chaves e valores. |
    | $a === $b | Identidade | true se $a e $b tem as mesmas chaves e valores, na mesma ordem e com os mesmos tipos. |
    | $a != $b | Desigualdade | true se $a não é igual $b. |
    | $a <> $b | Desigualdade | true se $a não é igual $b. |
    | $a !== $b | Não identidade | true se $a não é idêntico a $b. |
- Tipos
    
    O operador `instanceof` é usado para determinar se uma variável é um objeto de uma classe especifica.
    

## Estruturas de controle

- Construtores fundamentais não primários
    - `list()`
        
        Serve para transformar um array em varias variáveis
        
        ```php
        $info = array('Café', 'marrom', 'cafeína');
        
        // Listando todas as variáveis
        list($bebida, $cor, $substancia) = $info;
        echo "$bebida é $cor e $substancia o faz especial.\n";
        
        // Listando apenas alguns deles
        list($bebida, , $substancia) = $info;
        echo "$bebida tem $substancia.\n";
        
        // Ou ignoramos os primeiros valores para conseguir apenas o último
        list( , , $substancia) = $info;
        echo "I need $substancia!\n";
        ```
        
    - `array()`
        
        Serve para criar um array
        
        ```php
        $fruits = array (
            "fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
            "numbers" => array(1, 2, 3, 4, 5, 6),
            "holes"   => array("first", 5 => "second", "third")
        );
        
        $array = array(1, 1, 1, 1,  1, 8 => 1,  4 => 1, 19, 3 => 13);
        ```
        
    - `print` e `echo`
        
        Os dois comandos são iguais e servem para fazer retornos para o HTML. 
        
        ```php
        print '<p>Olá </p>';
        echo '<p>Mundo </p>';
        ```
        
- Condicionais
    - If
        
        ```php
        if ($a > $b) {
          echo "a is bigger than b";
          $b = $a;
        }
        ```
        
    - Else
        
        ```php
        if ($a > $b) {
          echo "a is greater than b";
        } else {
          echo "a is NOT greater than b";
        }
        ```
        
    - elseif
        
        ```php
        if ($a > $b) {
            echo "a é maior que b";
        } elseif ($a == $b) {
            echo "a é igual a b";
        } else {
            echo "a é menor que b";
        }
        ```
        
    - switch
        
        ```php
        switch ($i) {
            case 0:
                echo "i é igual a 0";
                break;
            case 1:
                echo "i é igual a 1";
                break;
            case 2:
                echo "i é igual a 2";
                break;
        }
        ```
        
    - match
        
        Funciona como o `switch` porem diferencia tipos e serve para valores que não são do tipo `int`
        
        ```php
        $comida = 'bolo';
        
        $valor_de_retorno = match ($comida) {
            'apple' => 'Essa comida é uma maçã',
            'bar' => 'Essa comida é um bar',
            'bolo' => 'Essa comida é um bolo',
        };
        
        var_dump($valor_de_retorno); // retorna:  essa comida é um bolo
        ```
        
- Repetição
    - while
        
        ```php
        $i = 1;
        while ($i <= 10) {
            echo $i++; 
        }
        ```
        
    - do-while
        
        ```php
        $i = 0;
        do {
            echo $i;
        } while ($i > 0);
        ```
        
    - for
        
        ```php
        for ($i = 1; $i <= 10; $i++) {
            echo $i;
        }
        ```
        
    - foreach
        
        ```php
        $arr = array(1, 2, 3, 4);
        foreach ($arr as &$valor) {
            $valor = $valor * 2;
        }
        // $arr is now array(2, 4, 6, 8)
        ```
        
    - Break
        
        O comando break serve para encerrar um ou mais loops antes do momento especificado. Para loops aninhados podemos usar `break 1;` para encerrar o loop que o comando se encontra, `break 2;` para o mesmo e também um escopo acima e assim por diante.
        
        - `break;` é o mesmo que `break 1;`
        
        ```php
        $i = 0;
        while (++$i) {
            switch ($i) {
                case 5:
                    echo "At 5<br />\n";
                    break 1;  /* Exit only the switch. */
                case 10:
                    echo "At 10; quitting<br />\n";
                    break 2;  /* Exit the switch and the while. */
                default:
                    break;
            }
        }
        ```
        
    - Continue
        
        O comando `continue X;` faz com que o resto do bloco de comandos não seja executando, podendo também receber um parâmetro numérico para ditar quantos escopos de loops a cima ele também deve finalizar.  
        
        ```php
        $array = ['zero', 'um', 'dois', 'três', 'quatro', 'cinco', 'seis'];
        foreach ($array as $chave => $valor) {
            if (!($chave % 2)) { // pula membros com chaves pares
                continue;
            }
            echo $valor . "\n";
        }
        
        // resultado:
        //um
        //três
        //cinco
        ```
        
- Outros
- Sintaxe alternativa
    
    No PHP podemos declarar uma estrutura com `:` no final e declarar seu final com `endESTRUTURA;` na linha desejada ao invés de envolver o bloco com um par de chaves  
    
    ```php
    <?php
    if ($a == 5):
        echo "a equals 5";
        echo "...";
    elseif ($a == 6):
        echo "a equals 6";
        echo "!!!";
    else:
        echo "a is neither 5 nor 6";
    endif;
    ?>
    
    <?php if ($a == 5): ?>
    A é igual a 5
    <?php endif; ?>
    ```
    
- Declarer
    
    O `declarer` serve para especificar configurações ou formas de funcionamento relevantes para uma parte do script. O comando funciona como uma função tendo 3 possibilidades de parâmetros por tanto, `tikcs`, `encoding`, `strict_type`. Cada um faz o comando ter uma função diferente
    
    - `ticks`
        
        Esse parâmetro faz com que a cada comando executado (os que tem `;` no final) seja contabilizado um tick e de tantos em tantos ticks uma função seja chamada. Para escolher a função usamos outra função chamada `register_tick_function(’nome-da-função-desejada’)`.
        
        ```php
        function tick_handler() 
            {
                echo "<br/>";
            }
            
            register_tick_function("tick_handler");
            declare(ticks=2) {
            
                echo 'a';
                echo 'b'; //chama a função
                echo 'a';
                echo 'b'; //chama a função
                echo 'a'; 
                echo 'b'; //chama a função   
                echo 'a';
                echo 'a'; //chama a função
                
            }
        ```
        
    - `encoding`
        
        Esse parâmetro deve ser usado no comando ao topo um arquivo para definir a leitura correta de caracteres.
        
        - `declare(encoding='ISO-8859-1');`
    - `strict_type`
        
        Esse parâmetro pode ser usado para obrigar um código a não tentar conversões de tipos e retornar erros quando necessário. Em casos onde o PHP faria uma conversão de um tipo para conseguir realizar uma expressão ou teste ele apenas retornara um erro se estive no escopo desse parâmetro. 
        
        ```php
        declare(strict_types=1);
        
        function sum(int $a, int $b) {
            return $a + $b;
        }
        
        var_dump(sum(1.5, 2.5)); //causa um erro 
        ```
        
        - Se removêssemos a primeira linha do script acima o PHP faria a conversão dos numero para o tipo int e o script funcionaria
- Require e include
    
    Esses comandos servem para inserir algum arquivo em meio a outro. O `require` e o `include` funcionam da mesma forma exceto pelo fato de que o `require` interrompe o fluxo do código se o diretório não é encontrado, já o `include` não.
    
    - Também á o `require_once` e o `include_once` que são idênticos ao `require` e `include` porem verificam se o arquivo ja foi requisitado/exigido antes, se sim, nada é feito, se não a requisição/exigência é feita.
    
    ```php
    // vars.php | primeiro arquivo
    <?php
    
    $color = 'green';
    $fruit = 'apple';
    
    ?>
    
    // test.php | segundo arquivo
    <?php
    
    echo "A $color $fruit"; // A
    
    include 'vars.php';
    
    echo "A $color $fruit"; // A green apple
    
    ?>
    ```
    
    Usar esses comandos é como copiar e colar o código do segundo arquivo no lugar da invocação, por tanto, fazer invocações dentro de funções reduz o escopo do arquivo a função e etc…
    
    - Assim como em funções podemos colocar o comando `return` em arquivos que serão convocados para que aja um retorno de um valor especifico
    
    ```php
    return.php
    <?php
    
    $var = 'PHP';
    
    return $var;
    
    ?>
    
    noreturn.php
    <?php
    
    $var = 'PHP';
    
    ?>
    
    testreturns.php
    <?php
    
    $foo = include 'return.php';
    
    echo $foo; // imprime 'PHP' porque é o retorno do arquivo
    
    $bar = include 'noreturn.php';
    
    echo $bar; // imprime 1 apenas porque o arquivo existe
    
    ?>
    ```
    
- goto
    
    Esse comando serve para pular de uma parte para outra do código. A identificação do código é feita através de uma chave composta por maiúsculas e minúsculas.
    
    - Não é valido saltar para arquivos ou escopos diferentes
    
    ```php
    goto a; // <--- pula da ca
    echo 'Foo';
    
    a: // <--- para ca
    echo 'Bar';
    
    //retorna:   Bar
    ```
    

## Funções

- Conceitos base
- Sintaxe
    
    Podemos colocar qualquer tipo de código valido dentro de uma função, fazer da seguinte forma para declarar e chamar uma função:
    
    ```php
    // declarando
    function foo($arg_1, $arg_2, /* ..., */ $arg_n)
    {
        echo "Exemplo de função.\n";
        return $valor_retornado;
    }
    
    // chamando
    
    foo(parametro_um, parametro_dois, ...)
    ```
    
    As funções podem ser chamadas antes de declaradas na ordem de execução do script, com tanto que, a declaração da função não esteja dentro de um escopo diferente do global.
    
- Parâmetros
    - Ao invés de usarmos uma função para receber, alterar e retornar um valor podemos receber um valor linkado e apenas altera-lo dentro da função usando o operador `&`.
        
        ```php
        function add_some_extra(&$string)
        {
            $string .= ' e alguma coisa mais.';
        }
        $str = 'Isto é uma string,';
        add_some_extra($str);
        echo $str;    // imprime 'Isto é uma string, e alguma coisa mais.'
        ```
        
    - Parâmetros
        
        Podemos usar a sintaxe padrão de declaração de variáveis para definir parâmetros com valores preestabelecidos. 
        
        ```php
        function makecoffee($type = "cappuccino")
        {
            return "Fazendo uma xícara de café $type.\n";
        }
        
        echo makecoffee(); // retorna: Fazendo uma xícara de café cappuccino
        echo makecoffee("espresso"); // retorna: Fazendo uma xícara de café espresso
        ```
        
        Também podemos usar a sintaxe `...$var` para adicionar uma variável de quantidades não definidas. Caso a função tenha mais de um parâmetro essa variável deve ficar por ultimo na declaração da função.
        
        - Essa sintaxe ainda serve para passar os dados de um array como argumentos de uma chamada de funções. `MinhaFunção(...[1, 4])`
        
        ```php
        function sum(...$numbers) {
            $acc = 0;
            foreach ($numbers as $n) {
                $acc += $n;
            }
            return $acc;
        }
        
        echo sum(1, 2, 3, 4);
        ```
        
        Ainda á a opção de anexar os valores dos parâmetros aos seus respectivos nomes na convocação da função `Minha_Função(value: $var);` 
        
- Retornos
    
    Podemos usar a sintaxe `retur` para retornar valores de funções, isso se aplica também a valores compostos.
    
    - O código abaixo equivale a receber cada um dos valores do array retornado em uma variável diferente.
    
    ```php
    function primeiros_numeros()
    {
        return [0, 1, 2];
    }
    
    [$zero, $one, $two] = primeiros_numeros(); 
    //             $zero = 0;
    //							 $one = 1;
    //							 $two = 2;
    
    function quadrado($num)
    {
        return $num * $num;
    }
    echo quadrado(4); // retorna 16
    ```
    
- Outros tipos e formas de funções:
- Funções em variáveis
    
    No PHP podemos usar uma variável para armazenar, e posteriormente, convocar uma função. Basta atribuir a variável o nome da função como uma string e depois chamar a variável com um par de parênteses como se fosse a própria função então o nome armazenado será usado com um par de parênteses.
    
    ```php
    function ResultRendering($n1, $n2, $UserValue = 'add') { 
            function CalcFunctionForAdd($x, $y) {return $x + $y;};
            function CalcFunctionForMultiply($x, $y) {return $x * $y;};
            function CalcFunctionForSubtract($x, $y) {return $x - $y;};
            
    
            $calc = match ($UserValue) {
                'add' => 'CalcFunctionForAdd',
                'mul' => 'CalcFunctionForMultiply',
                'sub' => 'CalcFunctionForSubtract',
            };
            echo $calc($n1, $n2);
        };
        ResultRendering(3, 2, 'mul');
    ```
    
    - Isso também se aplica a
- Funções anônimas
    
    Funções anônimas são funções sem nome que podem ser usadas para parâmetros de outras funções, atribuições a variáveis, uso em objetos e etc…
    
    Ao declararmos essa funções devemos apenas omitir o nome da função. Não se pode fazer uso de variáveis de escopo superior dentro da função, ou da variável `$this`.
    
    ```php
    echo preg_replace_callback( //encontra um trecho da string e aplica a função
            '~-([a-z])~', // Econtra o W e remove o - antes dele
    
            function ($match) { // Anonymous function
                return strtoupper($match[1]);
            }, 'hello-world');
    
    // retona HelloWord
    ```
    
- Arrow function
    
    As arrow functions funcionam como funções anônimas porem podem usar variáveis de escopos superiores.
    
    ```php
    $Var_fc = fn($x, $v) => $v + $x;
    echo $Var_fc(2, 8);
    ```
    

## Classes e objetos

- Básico
    
    Uma classe é um formato de objeto pronto que contem variáveis próprias denominadas propriedades, e funções próprias denominadas métodos. Ao nomear uma classe seguem-se as mesmas regras de nomeação de variáveis. Podemos atribuir uma classe a uma variável passando assim propriedades e métodos já estipulados.
    
    Podemos declarar itens (propriedades e métodos) de uma classe da mesma forma que faríamos fora dela. E para convocar esses itens basta usar o nome da classe seguido de uma seta e o item, dessa forma, `$MinhaClasse->MinhaFunção();` ou `$MinhaClasse->MinhaVariável;`.
    
    Podemos também declarar uma instancia de uma classe a uma variável atribuindo a própria a palavra `new` seguida do nome da classe.
    
    ```php
    class genericClass { // cria um formato de objeto(classe) denominado "genericClass"
            public $var = 'string';
            
            public function baseFunction() {
                echo $this->var;
            }
    
            public function anotherFunction() {
                echo '<br/>';
                $this->baseFunction();
                echo '<br/>';
            }
        }
    
        $myVar = new genericClass(); // atribui uma classe a uma variável
        $myVar->baseFunction(); // chama um método
        $myVar->anotherFunction();
    ```
    
    - A variável `$this` representa o próprio objeto dentro dele, ela é como um objeto que contem todos os métodos e propriedades
    - A também a possibilidade de declarar mais de uma variável referentes a mesma instancia, é só atribuir uma variável correspondente da instancia a uma nova variável.
    - Sub classes
        
        Á a possibilidade de fazer com que uma classe seja subsequente a outra tendo todos os seus métodos e propriedades herdados. Ao fazer isso também podemos sobrescrever itens da classe mãe (exceto os que forem definidos como `final`). E ainda podemos convocar métodos sobrescritos com o [parent::](https://www.php.net/manual/pt_BR/language.oop5.paamayim-nekudotayim.php) +método. 
        
        Uma subsequência(extensão) da classe a cima:
        
        ```php
        class ChildClass extends genericClass {
                public function otherFunction($selector = false) {
                    if ($selector) {
                        parent::otherFunction(); // método de mesmo nome porem da função mãe
                    }
                    echo '<br/> another string';
                }
            }
            $my_class = new ChildClass;
        
            $my_class->baseFunction();
            $my_class->otherFunction(false);
        ```
        
        - Para sobrescrever um método é preciso seguir as regras de [variância](https://www.php.net/manual/pt_BR/language.oop5.variance.php) (exceto se esse item for do tipo `private`). Essas são quebradas:
            - Se torna um parâmetro obrigatório em opcional.
            - Se adiciona novos parâmetros opcionais.
            - Se restringe mais a visibilidade de uma variável.
                - (Funções com um tipo especifico de retorno devem mantê-lo se sobrepostas.)
        - Também podemos usar o operador de ***nullSafe*** para selecionar uso, ou não uso, de operadores de classe como `->` e `::`.
        - Objetos podem ser passados como valor padrão de parâmetros mas não podem conter expressões para determinações, deve ser apenas `new objeto`.
    - Operador de escopo `::`
        
        O operador de escopo serve para acessar constantes ou métodos estáticos de uma classe
        
        - Fora da classe:
            - `$instanciaDaClasse::item` (item pode ser uma constante ou método estático)
        - Dentro da classe:
            - `self::métodoDaCLasseAtual` Chama um método estático da própria classe onde esta
                - como `$this->métodoDaClasseAtual` porem serve apenas para a classe onde se localiza, enquanto `$this` engloba classes de escopo superior também.
            - `parent::MétodoSobreposto` chama um método de uma classe mãe com um nome igual de um método sobreposto.
            - `static::item` é usado para acessar um item estático da classe por dentro dela.
        
        **`::class`**
        
- Informações na declaração
    - Como declarar itens
        - Visibilidade (e `redonly` + `static`)
            
            Um item precisa ser precedido de seu escopo de visibilidade ao declarado em uma função. Existem três tipos de visibilidade sendo elas:
            
            1. `public` Permite que o item seja ***modificado e chamado/lido de qualquer lugar***.
            2. `protected` Permite que o item seja ***modificado e chamado/lido apenas na classe original ou em classes subsequentes.***
            3. `private` Permite que o item seja ***modificado e chamado/lido somente na classe onde é declarado.***
            4. `redonly` Permite que o item seja ***declarado unicamente na inicialização (com** `__construct`**) da instancia da classe e posteriormente, lido em qualquer lugar.***   
            - `estatic` Permite ***apenas leitura em convocações diretas ao objeto**.*
                
                Ao tornar um item estático, omitimo-los em todas as instancias de uma classe e permitindo seu acesso apenas com a convocação direta da classe. Esses itens podem ser definidos de forma semelhante a padrão, sendo, `visibilidade static delcaração-padrão`. (Não se pode usar o `$this` dentro itens estáticos). Nesses itens se usa:
                
                - `Classe::ItemEstatico;` ao invés de `$instanciaDaClasse->itemDinamico;` para convocar um item estático
                    - (‘itemEstatico’ deve ser precedido com `$` para atributos, ou seguido de `()` para métodos).
            - (propriedades sem visibilidade declarada são salvas como `public`)
            - `final` Proíbe que uma classe ou item seja estendida  ou sobrescrito
            
            - Parte UM
            
            ```php
            class firstClass {
                    public static $sex = 'M';
                    public static function double($n1) {return $n1*2;}
            
                    public $name = 'lucas';
                    protected $address = '224 IabaBabaDu Street';
                    private $cardBalance = '0.02 :('; 
            
                    public function seeInfo() {
                        echo $this->name, '<br/>', // always available
                             $this->address, '<br/>', // only here and ata a children 
                             $this->cardBalance, '<br/>'; // only here 
                    }
                }
                class newClass extends firstClass {
                    public function seeNewInfo() {
                        echo $this->name, '<br/>', 
                             $this->address, '<br/>';
                            //  $this->cardBalance, '<br/>';   //<--- [ERROR] unavailable
                    }
                }
            ```
            
            - Parte DOIS
            
            ```php
            // public 
            $firstObject = new firstClass; 
            $firstObject->seeInfo();
            echo '<br/>';
            
            // pretected
            $newObject = new newClass;
            $newObject->seeNewInfo();
            echo '<br/>';
            
            //private 
            echo $firstObject->name;//       <-- can be used
            // echo $firstObject->address;      <-- can be used only at classes 
            // echo $firstObject->cardBalance;          <--can't be used
            echo '<br/>';
            
            // static 
            echo firstClass::$sex;
            echo firstClass::double(2);
            // echo $firstObject->sex;    <-- [ERROR]
            
            ```
            
        - Propriedades
            
            
            As propriedades podem ser definidas com este arquétipo:
            
            - Um modificador opcional de visibilidade
                - `public`, `protected`, `private` ou `redonly`.
            - Declaração de tipo (exceto o `callable`)
            - Nome da variável
            - Uma atribuição (semente se for uma constante)
            
            Exemplos:
            
            - Variável comum `public int $indereço;`
            - Constante `protected const NAME = “Lucas”;`
            
            Uma constante não muda de uma instancia para outra da classe, a própria é definida somente com uma atribuição padrão. Se for preciso fazer uma constante com valor definido por instancia ou por um método interno, então, usa-se o `redonly`.
            
        - Métodos
            
            Declaramos funções dentro de objetos quase de forma idêntica, com a exceção de que é obrigatório definir o tipo de retorno. Para isto só precisamos
            
            - Substituir isso *`function* number(float $age) {bloco de comando...}`
            - Por isso isso *`function* number(float $age): int {bloco de comando...}`
            
            Isso obriga o PHP a converter o valor de retorno para o tipo especificado ou se isso não for possível ele apenas retorna um erro.
            
    - Métodos mágicos
        
        > Obrigatórios
        > 
        > - Métodos de inicialização `__construct` e `__destruct()`. ()
        >     
        >     A função `__contruct()` pode ser declarada dentro de uma classe para definir propriedades, métodos ou executar um bloco de código na inicialização de um objeto da classe. Assim que se cria uma nova instancia de um objeto essa função é executada automaticamente na própria. (Essa função é geralmente utilizada para inicialização de variáveis).
        >     
        >     Se essa função for sobreposta por uma classe subsequente e ainda se precisar usar a função da classe mãe utiliza-se `parent::__construct();` dentro da nova função. (para essa função não é necessário compatibilidade de assinatura). 
        >     
        >     A função `__destruct` é chamada sempre que a instancia do objeto deixa de existir.
        >     
        >     ```php
        >     class generateUser {
        >             public const STORE = 'nike';
        >     
        >             public function __construct(
        >                 public string $name,
        >                 public string $email
        >     
        >             ) {
        >                 echo 'generate user ' . $name . ' ' . $email, '<br/>';
        >             }
        >         }
        >     
        >         class userFeature extends generateUser {
        >             public int $old;
        >             
        >             function __construct($name, $email, $old) {
        >                 $this->old = $old;
        >     
        >                 echo 'user feature ' . $old, '<br/>';
        >                 parent::__construct($name, $email);
        >             }
        >     
        >             function __destruct() {
        >                 echo 'deleted', '<br/>';
        >             }
        >         }
        >     
        >         $account = new generateUser('lucas', 'sla@gmail.com');
        >         echo '<br/>';
        >         $feature = new userFeature('pedro', 'tutu@gmail.com', 17);    
        >         $feature = null;
        >     ```
        >     
        >     Como mostra na segunda função a cima, podemos receber um valor como parâmetro no `__construct` e passa-lo para uma variável criada com valor ainda não declarado, através da função. Um forma mais pratica de se fazer isso é declarando as variáveis ja dentro dos parâmetros do `__constuct`, basta adicionar a declaração de visibilidade antes da variável, como mostra na primeira função
        >     
        >     - Múltiplas possibilidades de `__construct` e exemplo do `readoly`
        >         
        >         Também se pode usar múltiplas opções de `__construct` ao inicializar uma instancia. Cria-se um `__construct` com todas as possibilidades de parâmetros desejadas para cada possível inicialização, tendo a possibilidade de serem nulos. Posteriormente se definem métodos estáticos com parâmetros próprios que retornam uma copia do objeto passando seus parâmetros, e ignorando os demais parâmetros do `__construct`. Posteriormente criamos uma instancia da classe a partir do método estático desejado.
        >         
        >         ```php
        >         class generateAccount {
        >                 function __construct(
        >                     private ?string $user = null,
        >         
        >                     readonly ?string $password = null, // for admins
        >                     readonly ?string $email = null // for users
        >                 ) {}
        >         
        >                 public static function Admin(string $user, string $password) { 
        >                     echo 'Admin registered: ' . $user . ' | ' . $password, '<br/>';
        >                     return new static(user: $user, password: $password);
        >                 }
        >         
        >                 public static function User(string $user, string $email) {
        >                     echo 'User registered: ' . $user . ' | ' . $email, '<br/>';
        >                     return new static(user: $user, email: $email);
        >                 }
        >         
        >                 public function seeInfo() {
        >                     echo $this->user, '<br/>',
        >                          $this->password, '<br/>',
        >                          $this->email, '<br/>';
        >                 } 
        >             }
        >         
        >             // $user = new generateAccount();   <-- don't work 
        >         
        >             
        >             $admin = generateAccount::Admin('lucas', 'bubu'); 
        >             // $admin->password = 'ee';     [ERROR] for redonly
        >             echo $admin->password, '<br/>';   
        >         
        >             $user = generateAccount::User('pedro', 'dodo@gmail.develop');
        >             // $user->email = 'non.gmail.com';        [ERROR] for redonly
        >             echo $user->email, '<br/>';
        >         ```
        >         
        > - Métodos de overloading
        >     
        >     Funções de sobrecarga são métodos que são executados automaticamente quando uma ação especifica é exercida sobre, um item `private`, `protected` ou inexistente, de um objeto. Eles devem sempre ser declaradas como `public` e tem parâmetros já estipulados.
        >     
        >     - Para propriedades
        >     - `__set($name, $value)` é executado quando se tenta **atribuir valor** a uma propriedade inacessível por visibilidade `private`, `protected` ou inexistente.
        >         1. `$name` = item que tentou-se atribuir um valor 
        >         2. `$value` = valor que tentou-se atribuir a um item
        >     - `__get($name)` é executado quando se solicita retorno (tenta-se ler)  uma propriedade inacessível por visibilidade `private`, `protected` ou inexistente.
        >         1. `$name` = item que foi solicitado
        >     - `__isset($name)` é executado quando as funções `isset()` e `empty()` são usadas em uma propriedade inacessível por visibilidade `private`, `protected` ou inexistente.
        >         1. `$name` = item que foi testado
        >     - `__unset($name)` é executado se usar a função `unset()`  em uma propriedade inacessível por visibilidade `private`, `protected` ou inexistente.
        >         1. `$name` = nome da propriedade testada
        >     - Para métodos
        >     - `__call($name, $arguments)` é executado quando se tenta chamar um método inacessível por visibilidade `private`, `protected` ou inexistente.
        >         1. `$name` = método chamado
        >         2. `$arguments` = um array numerado com os argumentos usados na chamada 
        >     - `__callStatic($name, $arguments)` é executado quando se tenta chamar um método estático inacessível por visibilidade `private`, `protected` ou inexistente.
        >         1. `$name` = método chamado
        >         2. `$arguments` = um array numerado com os argumentos usados na chamada 
        >         - precisa ser declarado como `static`
        >     - Outros
        >     - `__clone()` é executado inicialmente na inicialização de um objeto que esta sendo clonado
        >         
        >         O retorno desse método é direcionado ao clone que estiver sendo criado, serve para retornar as variáveis do objeto principal para o novo clone.
        >         
        >     - Não se pode fazer uma chamada do próprio objeto dentro de um desses métodos pois não permitido que um método convoque a si mesmo novamente
        >     - código de exemplo
        >         
        >         
        >         Função
        >         
        >         ```php
        >         class overloadingMethods {
        >                 // for all
        >                 private $private_var = 1;
        >                 public $public_var = 0;
        >                 //only for clone
        >                 public $name = 'alex';
        >                 public $age = 17;
        >         
        >                 private static function staticAlarm() {
        >                     echo 'static alarm', BR;
        >                 } 
        >                 private function alarm() {
        >                     echo 'static alarm', BR;
        >                 } 
        >         
        >                 // to properties
        >                 public function __set(string $name, mixed $value) {
        >                     echo "var: $name cannot be declarete in this scope,
        >         								 value: $value was ignored", '<br/>'; 
        >                 }        
        >                 public function __get($name) {
        >                     echo "var: $name cannot be looked in this scope", '<br/>';
        >                 }
        >                 public function __isset($name) {
        >                     echo "var: $name are private", '<br/>';
        >                 }
        >                 public function __unset($name) {
        >                     echo "var: $name are private", '<br/>';
        >                 }
        >         
        >                 // to methods
        >                 public static function __callStatic($name, $arguments) {
        >                     echo "static method $name are private or not exist", '<br/>';
        >                 }
        >                 public function __call($name, $arguments) {
        >                     echo "method $name are private or not exist", '<br/>';
        >                 }
        >         
        >                 // to clone
        >                 function __clone() {
        >                     return $this;
        >                 }
        >             }
        >             
        >         ```
        >         
        >         Usos
        >         
        >         ```php
        >         $y = new overloadingMethods;
        >         
        >             // testing a propertis
        >             H2('__set');
        >             $y->private_var = 2; //     call  __set
        >             $y->public_var = 2; //       can maked
        >         
        >             H2('__get');
        >             echo $y->private_var; //           call  __get
        >             echo $y->public_var; //           can maked
        >             BR();
        >         
        >             H2('__isset');
        >             isset($y->private_var); //           call  __isset
        >             isset($y->public_var); //           can maked
        >         
        >             H2('__unset');
        >             isset($y->private_var); //           call  __unset
        >             isset($y->public_var); //           can maked
        >         
        >             // testing a methods 
        >             H2('__callStatic');
        >             $y::staticAlarm();       //call __callStatic
        >         
        >             H2('__call');
        >             $y->alarm();       //call __callStatic
        >         
        >             // clone
        >             H2('__clone');
        >             // two keys for one instance 
        >             $person_one = new overloadingMethods;
        >             $clone_one = $person_one;
        >         
        >             // new kay and new identical instance 
        >             $person_two = clone $person_one;
        >         
        >             echo $person_one->name, BR;
        >             $clone_one->name = 'lucas';
        >             
        >             echo $clone_one->name ,BR,
        >             $person_one->name, BR;
        >             BR();
        >                 
        >             echo $person_two->name, BR;
        >         ```
        >         
        - Outros
            
            > Serialização é o processo executável sobre instancias de classes para salvar a instancia especifica no seu estado especifico. Podemos fazer serializações em XML, JSON, em código binário e diversos outros formatos. Esse processo serve para salvar a instancia em um arquivo externo e poder envia-lo ou reutiliza-lo depois. Existem funções designadas para esse tipo de processo, sendo elas:
            > 
            > 1. `__sleep(): array` É executa antes de qualquer serialização, e ***precisa*** retornar um array com os valores a serem serializados . 
            >     1. (não pode retornar propriedades privadas de uma classe pai).
            > 2. `__serialize(): array` É igual o `__sleep()` porem tem maior ordem de precedência sendo o único executado caso o objeto tenha os dois.
            >     1. Pode retornar propriedades privadas de uma classe pai.
            >     2. Deve retornar um array associativo chaves-propriedades.
            > - `serialize()` checa se um objeto tem a função `__sleep()` e `__serialize()`.
            > 
            > ---
            > 
            > 1. `__wakeup(): void` É executado após uma desserialização e serve para reestabelecer conexões com bancos de dados e executar funções de inicialização.
            >     1. recebe como parâmetro o array de `__sleep()` ou `__serialize()`.
            > 2. `__unserialize([...]): void` É igual o `__wakeup()` porem tem maior ordem de precedência sendo o único executado caso o objeto tenha os dois.
            > - `unsearalize()` checa se um objeto tem a função `__wakeup()` e `__unserialize()`.
            - `__toString(): string` deve retornar o valor desejado de retorno do objeto quando ele é convertido para string
            - `__invoked(...value): mixed` é executado toda vez que o objeto é chamado como uma função
            - `__set_satate([…]): object` é responsável pelo valor de exportado quando aplicamos `var_export()` no objeto
            - `__debuginfo(): array` é responsável pelo valor impresso em `var_dump()`
                - se não definida todos os valores (incluindo `private` e `protected`) serão exibidos.
- *“Moldes”*
    - Classes abstrata
        
        Classes abstratas são como uma exigência de um formato abstrato que pode ser passado para outras classes quando adicionamo-las como classes filhas, da classe abstrata. Sendo subsequente de uma classe abstrata, a classe filha é obrigada a criar os métodos e atributos definidos como abstratos e seguir as regras de compatibilidade de assinatura com os mesmos, mas ainda tem acesso ao métodos normais. Qualquer classe com um ou mais itens abstratos deve ser definida como abstrata. 
        
        - esse tipo de classe não pode ser instanciada, por tanto, não se pode atribui-la a uma variável e fazer uso da própria unicamente (elas servem apenas para moldar outras classes).
        
        ```php
        abstract class exempleAbs{
                protected const VALUE = 3;
                static function seeData() {return 'name of user';}
        
                abstract static function multiply(int $n1); // definition of mandatory method
            }
            class extension extends exempleAbs {
                static function multiply(int $n1) { // mandatory method and parameter
                    $result = $n1* self::VALUE;
                    return $result;
                }    
            }
        
            echo extension::multiply(2), '<br />';
            echo extension::seeData(), '<br />';
        ```
        
    - Interfaces
        
        interfaces servem para definir métodos obrigatórios com ou sem parâmetros obrigatórios ou não. São como um formato a se ser seguido para classes, por tanto, servem exclusivamente para definir os métodos, não podendo passa-los. E passam apenas constantes já estabelecidos a para classes subsequentes. 
        
        Podemos usar `extends` de uma interface para outra para estende-las e usamos `implements` em uma classe para implementar a interface.
        
        ```php
        interface calcTamplate {
                public function add($n1, $n2);
                public function sub($n1, $n2);
            }
            interface strTamplate {
                public const STR = 'STR: ';
                public function concatenate($str1, $str2);
                public function upper($str);
            }
            interface ultra extends strTamplate, calcTamplate {}
        
            class calc implements calcTamplate{ // mandatory methods of calcTamplate
                public function add($n1, $n2) { return $n1 + $n2; }
                public function sub($n1, $n2) { return $n1 - $n2; }
            }
            class multiplyUse implements ultra { // mandatory methods of calcTamplate and strTamplate
                public function add($n1, $n2) { return $n1 + $n2; }
                public function sub($n1, $n2) { return $n1 - $n2; }
        
                public function concatenate($str1, $str2) {return self::STR . $str1 . $str2;}
                public function upper($str) {return strtoupper($str);}
            }
        
            $utility = new multiplyUse;
            echo $utility->concatenate('one', ' two'), '<br />';
        ```
        
    - A diferença entre os dois é que classes abstratas podem passar propriedades e métodos não marcados como abstratos para filhos além de poderem usar qualquer visibilidade. Já interfaces passam apenas obrigações de métodos e seus parâmetros de forma `public`, e propriedades constantes.
    - Interfaces em classes abstratas
        
        Uma classe abstrata com interface pode implementar apenas algumas de suas obrigatoriedades porem uma classe subsequente terá de ter todas as obrigatoriedades da interface e da classe abstrata, seja por herança ou declaração.
        
        - Exemplo seguinte aos anteriores:
        
        ```php
        interface strPrint {public function see($str);}
        
            abstract class anything implements ultra {
                public function add($n1, $n2) { return $n1 + $n2; }
        
                public function upper($str) {return strtoupper($str);}
            }
        
            class moreAnything extends anything implements strPrint { // because hava a methods at class anything
                public function sub($n1, $n2) { return $n1 - $n2; }
                public function concatenate($str1, $str2) {return self::STR . $str1 . $str2;}
        
                public function see($str) {echo $str;}
            }
        ```
        
    - Traints
        
        Traits são grupos de métodos e propriedades que podem ser atribuídos dentro de uma classe para passar toda sua herança. Os traits funcionam exatamente como classes porem não podem ser instanciados, servem apenas para passar sua herança. Podemos utilizar quantos traits quisermos dentro de uma classe 
        
        Ordem de precedência para sobreposição de funções:
        
        1. Classe atual
        2. Trait usado
        3. Classe mãe   
        
        ```php
        trait firstTrait { // [precedence 1]
                public function add($n1, $n2) { return $n1 + $n2; }
                public function equal() {return true;} //  first declaration at a trait
            }
            trait secondTrait {
                public function sub($n1, $n2) { return $n1 - $n2; }
                public function equal() {return false;} //  repeated declaration
            }
            trait thirdTrait {
                public const ADDRESS = 'dudu';
                public function upper($str) {return strtoupper($str);}
            }
            trait masterTrait {
                use firstTrait, secondTrait, thirdTrait {
                    firstTrait::equal insteadof secondTrait;
                    secondTrait::equal as falseEqual;
                    add as private; 
                }
                abstract public function namer();
        
                static public function create() {return 'new';}
            }
        
            class motherClass { // [predence 2]
                public function upper($str) {return 'VALUE' . $str;}
            }
            class childrenClass extends motherClass {  // [precende: 0]
                use masterTrait;
        
                public function namer() {return 'name';}  // mandatory for masterTrait
                public function concatenate($str1, $str2) {return $str1 . $str2;}
                public function seeAddress() {return self::ADDRESS;}
            }
        
            $x = new childrenClass;
            echo $x->upper('name'), '<br/>';
            echo $x->equal() ? 'yes': 'no', '<br/>';
            // echo $x->add(2, 2);                <-- dont exist anymore
            echo childrenClass::create(), '<br/>';
            echo $x->seeAddress();
        ```
        
        Em casos de itens repetidos de traits diferentes precisamos utilizar um par de chaves ao final do use para declarar qual o item que deve ser ignorado e qual deve ser aceito, usamos a sintaxe `traitDoItemAeito::ItemAceito insteadof traidDoItemIgnorado`. Podemos renomear os itens ignorados, com essa sintaxe, `traitDoitemIgnorado::itemIgnorado as NovoNomeDoItem`, dessa forma pode-se usar os dois itens apenas alterando o nome de um.  Se preciso também mudamos a visibilidade de um item com a sintaxe `item as NovaVisibilidade`.
        
        - Podemos aninhar traits dentro de traits para compilar varias em apenas uma, além de alocar todas as configurações do `use`.
        - Traits também suportam itens abstratos e itens estáticos.
            - (não é necessário a adição de `asbatract` na declaração da trait, apenas do item).
        - Propriedades de traits que estiverem sendo sobrepostas precisam ser compatíveis com a propriedade já definida no trait
            - (mesma visibilidade e tipo, modificador somente leitura e valor inicial)
- Classes anônimas
    
    Classes anônimas são utilizados quando se precisa fazer um uso rápido, unitário e etc… de um objeto, por exemplo, passa-lo como um parâmetro ou algo semelhante.
    
    declaramos uma classe anônima com a sintaxe `new class {}`. Essas classes podem ter `extends`, `implements` e `use` também, fazem tudo que uma classe normal faz.
    
    - Uma classe anônima definida dentro de outra classe não te acesso ao seu escopo, a menos que seja declarada como filha da própria.
    - Múltiplas classes anônimas criadas pela mesma declaração são instancias do mesmo objeto
    
    ```php
    abstract class someClass {abstract public function property();}
        interface someInterface {}
        trait someTrait {}
    
        function useCLassMethod($x) {
            $result = $x->property();
            return $result;
        }
        $MyValue = useCLassMethod(new class extends someClass implements someInterface {
            use someTrait;
            public function property() {return 'any value';}
        });
    
        echo $MyValue;
    ```
    
- Podemos usar um objeto em um loop como se fosse uma lista, de fora do objeto apenas propriedades publicas aparecem. Porém fazendo isso dentro do objeto podemos ver itens privados e protegidos
- Comparação e clonagem de objetos
    - Operações para comparação
        
        
        | Operação | Instancias  da mesma classe | Duas referencias para a mesma instância | Instancias de duas classes diferentes  |
        | --- | --- | --- | --- |
        | o1 == o2 | true | true | false |
        | o1 != o2 | false | false | true |
        | o1 === o2 | false | true | false |
        | o1 !== o2 | true | false | true |
    - Clonando objetos
        
        A dois tipos de clonagem de objetos:
        
        - uma nova chave referente a mesma instancia do objeto original
            - `$newObject = $Object;`
        - uma nova chave referente a uma nova instancia idêntica a instancia original
        
        Para fazermos isso basta usar a palavra `clone` ao invés de `new` na declaração da cópia, isso faz com que o método `__clone()` do objeto inicial seja executado na cópia. 
        
        ```php
        class object {
                public $name = 'alex';
                public $age = 17;
        
                function __clone() {
                    return $this;
                }
            }
        
        $Object = new object;
        $newObject = clone Object; 
        ```
        
- Late static bindings `::`
    
    O operador `::` serve para definir definir retornos e chamadas de métodos estáticos ou herdados. O lado esquerdo recebe um valor condizente ao tipo de retorno e o lado direito serve para o acessar. 
    
    > Dentro do objeto;:
    > 
    > - `static::value;` Acessa a propriedade estática `value` de um objeto, dentro dele, e a executa no seu próprio escopo.
    > 
    > <aside>
    > ⬆️ Usado quando não á sobreposições
    > 
    > </aside>
    > 
    > <aside>
    > ⬇️ Usados quando á sobreposições
    > 
    > </aside>
    > 
    > - `self::value;` Acessa a propriedade estática sobreposta `value` do próprio objeto e executa no seu escopo.
    >     - `self` é a representação do próprio objeto (que tem incluso suas heranças da classe pai, que nesse caso, já tem a propriedade declarada)
    > - `parent::value;` Acessa a propriedade estática sobreposta `value` do objeto pai e executa no seu escopo.
    >     - `prent` é a representação dos valores de herança.
    
    > Fora do objeto:
    > 
    > - `ClasName::metodo;` chama um método estático de um objeto
    

## Name Spaces

No PHP a importação de código é feita a partir da inclusão de arquivos, isso consiste em apenas inserir o arquivo importado no local de importe, o que pode causar sobreposição de nomes entre importações. Esse problema se resolve adicionando um `namespace` ao arquivo que será importado para que ele exija por padrão um diretório prévio (que é definido no `namespace`) para a chamada de seus itens.

- `namespaces` só são capazes de englobar funções, classes(e seus “moldes”) e constantes. Outras declarações dentro dos mesmos não são aceitas.
- Uso
    
    
    Arquivo-1.php
    
    ```php
    namespace sore;
    
    const table = 2;
    ```
    
    Arquivo-2.php
    
    ```php
    namespace objects;
    
    const table = 4;
    ```
    
    Arquivo-3.php
    
    ```php
    include 'diretorio.../Arquivo-1.php';
    include 'diretorio.../Arquivo-2.php';
    
    echo store\table; // retorna 2
    echo objects\table; // retorna 4
    ```
    
    Arquivo-3.php (com uso de abreviações)
    
    ```php
    include 'diretorio.../Arquivo-1.php';
    include 'diretorio.../Arquivo-2.php';
    use const store\table as s_T;
    use const objects\table as o_T;
    
    echo s_T; // retorna 2
    echo o_T; // retorna 4
    ```
    
    - nesse caso usaríamos a palavra `function` ao invés de `const` se `table` fosse uma função e não uma constante.
    - Também podemos crias `subnamespaces` , basta criar um arquivo como `namespace store/clother;` em um arquivo diferente de `namespace store;` e importar os dois para criar uma sub divisão de store chamada clothes.

---

- `__NAMESPAC__` é uma constante que contem o nome do `namespace` atual
- podemos adicionar `\` antes de um nome de declaração ou chamada dentro de um `namespace` para que ela seja declarado ou convocado com escopo global e não o localizada.
- caso uma chamada dentro de um `namespace` não seja encontrada o PHP verifica sua existência no escopo global e se possível a utiliza.

## Enums

Os enums permitem a criação de um tipo personalizado limitado a valores específicos. Criamo-los e definimos os possíveis tipos de formas semelhantes a classes, usando uma sintaxe própria. E aplicamos o tipo a uma variável atribuindo o enum com uma chamada estática do seu valor desejado.

<aside>
<img src="https://www.notion.so/icons/list_green.svg" alt="https://www.notion.so/icons/list_green.svg" width="40px" /> Diferença de enums e classes: [https://www.php.net/manual/pt_BR/language.enumerations.object-differences.php](https://www.php.net/manual/pt_BR/language.enumerations.object-differences.php)

</aside>

- Tipos enum não são validos em expressões de `>` e `<`, estão sujeitos a retornar false nesses casos.
- Enums seguem a mesma regra de nomenclatura do resto dos nomeáveis do PHP
- Podemos usar traits em enums porem eles não podem conter métodos ou resultaram em erro
- Podemos atribuir os tipos dos enums a declarações de valores com tanto que não se atribua um valor relativo de um enum a uma constante.
- Todas os cases dos enums tem um propriedade própria exclusiva de leitura que retorna o nome da case e outra que retorna um array com todos os possíveis tipos a serem declarados.
    - `echo Naipe::ouros->name, '<br/>';` (exemplo do código de casos puros)
    - `var_dump( size::cases() );` retorna o array com os tipos do enum

---

- Enums de caso puro: Tem o nome e valor pontual sem demais informações.
    
    ```php
    enum Naipe {
        case copas;
        case ouros;
        case paus;
        case espadas;
    };
    
    echo Naipe::ouros->name, '<br/>'; // retorna "ouros"
    
    $var = Naipe::copas;
    function teste(Naipe $x) {
        echo "true", '<br>';
    }
    teste($var);
    ```
    
- Backed enums: Tem substituições tipo `int` ou `string` atribuídas a cada case, dependendo da declaração do enum. Isso serve para conversões de tipos e armazenamento de dados.
    - Possuem uma propriedade adicional, também exclusiva de leitura, para ver o valor substituinte.
        - `echo Naipe::ouros->value, '<br/>';`
    - Pode-se passar apenas o valor de substituição para ter o nome da case retornado com os seguintes comandos
        - `from( int|string ): self`  caso não existe retorna um erro.
        - `tryFrom( int|string ): ?self`  caso não existe retorna null (geralmente utilizado para quando se sabe o tipo mas não se existe o valor).
    
    ```php
    enum Requests: int {
            case pizza = 0;
            case hamburguer = 1;
            case iceCream = 2;
            case sandwich = 3;
        }
    
        function search($Enum, $v) {
            $x = $Enum::tryFrom($v);
            if ($x == true) {
                return $x->name;
            } else {
                return "Dont't exist";
            }
        }
    
        echo search('Requests', 2), '<br>'; // return "iceCream"
        echo search('Requests', 7);         // return "Dont't exist"
    ```
    
- Métodos (estáticos e não estáticos) e interfaces em enums
    
    Podemos implementar interfaces e criar métodos para enums, caso definido dentro de uma enum o método conta como existente em cada uma das cases do enum, como instancias individuais. Esses métodos podem ser públicos privados ou protegidos (os últimos dois resultam no mesmo poia não se pode ter heranças) . E a propriedade `$this` referisse ao enum junto a sua própria instancia.
    
    - Interfaces devem ser implementadas após a declaração de tipo em backed enums
    
    ```php
    enum cards: string implements colors {
        case copas = 'c';
        case ouros = 'o';
        case paus = 'p';
        case espadas = 'e';
    
        function color(): string { // from interface
            return match($this) {
                cards::copas, cards::ouros => 'red <br>',
                cards::paus, cards::espadas => 'black <br>',
            };
        }
    
        function shape() {  // optional
            return 'retangled <br>';
        }
    }
    
    $var = cards::copas;
    echo $var->color();
    echo $var->shape();
    ```
    
    - Métodos estáticos
        
        ```php
        enum size {
            case big;
            case medium;
            case small;
            public const another = self::big;
        
            public static function initialize(float $v): static {
                return match(true) {
                    $v < 50 => static::small,
                    $v < 100 => static::medium,
                    default => static::big,
                };
            }
        }
        
        echo size::initialize(40)->name, '<br>'; // return small
        echo size::initialize(60)->name, '<br>';  // return medium
        echo size::initialize(190)->name, '<br>';  // return big 
        echo size::another->name, '<br>';
        ```
        
- Interfaces e classes pré-definidas: [https://www.php.net/manual/pt_BR/reserved.interfaces.php](https://www.php.net/manual/pt_BR/reserved.interfaces.php)

## Erros

Podemos controlar quais erros são reportados e quais são ignorados durante a execução na diretiva `erros_reportig` no arquivo `php.ini` ou fazer uma configuração local com a s função `erros_reporting()`. Recomenda-se que para a configuração global se use `E_ALL` pare sempre estar ciente e corrigir os problemas reportados pelo PHP. Já caso seja definido localmente, recomenda-se o uso de `E_ALL & ~E_NOTICE & ~E_DEPRECATED` para reportes menos detalhados e em alguns casos o próprio `E_ALL` para ser informado antecipadamente de futuros erros.

Também se tem no `php.ini` a diretiva `display_errors` que define se um erro é mostrado na saída do script, recomenda-se mantê-la desativada em uso do programa e ativada apenas no ambiente de desenvolvimento, para maior praticidade e segurança, pois pode exibir dados confidenciais e informações relevantes no retorno. 

Caso desejado pode-se registrar erros em um log ativando a diretiva `log_erros` que registrara todos os erros em um arquivo ou em um syslog selecionado pela diretiva `error_log`. São uteis no desenvolvimento para gerar relatórios de erros

- O PHP tem vários possíveis erros referentes a tipos específicos
    - lista de tipos de erros: [https://www.php.net/manual/pt_BR/errorfunc.constants.php](https://www.php.net/manual/pt_BR/errorfunc.constants.php)
- Se o PHP não manipular os erros da forma necessária pode-se usar a função `set_error_handler()` para instalar um manipulador de erros funcione e manipule os erros de forma adequada
- Execuções pré-definidas (erros): [https://www.php.net/manual/pt_BR/reserved.exceptions.php](https://www.php.net/manual/pt_BR/reserved.exceptions.php)

## Exceptions

O PHP tem uma classe denominada `Exception` que quando ***lançada*** uma instancia da própria retorna um erro com as informações passada em sua declaração. Essa classe serve para definir inputs de erros próprios para testes na execução do programa. A classe ainda tem propriedades especificas para a localização e identificação de onde foi lançada e porque.

- Itens da classe `Exception`
    
    ```php
    // NÃO DEVE SER DECLARADA | JA EXITE POR PADRÃO
    class Exception implements Throwable {  // Throwable é uma interface que faz com que a classe possa ser lançada pelo comando throw
        
    		// Itens que podem ser definidos na declaração
    		protected $message = 'Unknown exception';   // Mensagem da exceção
        private   $string;                          // Cache __toString
        protected $code = 0;                        // Código definido pelo usuário
        protected $file;                            // Nome do arquivo onde a exceção originou
        protected $line;                            // Número da linha onde a exceção originou
        private   $trace;                           // Backtrace
        private   $previous;                        // Exceção anterior (se exceção empilhada)
    
        public function __construct($message = '', $code = 0, Throwable $previous = null); // obriga alguns itens a serem definidos
        final private function __clone();           // Inibe a clonagem de exceções
    
    		// itens que não podem ser herdados
        final public  function getMessage();        // Mensagem da exceção
        final public  function getCode();           // Código definido pelo usuário
        final public  function getFile();           // Nome do arquivo onde a exceção originou
        final public  function getLine();           // Número da linha onde a exceção originou
        final public  function getTrace();          // Um array do backtrace()
        final public  function getPrevious();       // Exceção anterior
        final public  function getTraceAsString();  // Backtrace formatado como string
    
        // Ja existe mas pode ser sobrescrito
        public function __toString();               // String formatada da exceção
    ```
    

<aside>
⬆️ Também podemos criar classes filhas para a `Exception` para que possamos clona-las e adicionar outros métodos e atributos mas elas não podem sobrepor alguns métodos já existentes da  inicial e é **obrigatório** que se chame o antigo `__contruct()` dentro do novo caso ele seja sobreposto.

</aside>

- Disparamos um erro quando o comando `throw new MyException('[ERROR] ', 332, 'lucas');` ou  é executado.
    - Sendo o primeiro uma classe filha da `Exception`.

---

Testamos erros a partir de uma estrutura semelhante a estrutura padrão de controle, `elseif`. Essa estrutura tem 3 blocos

- `try {bloco 1}` que tenta executar o primeiro bloco
- `catch (MyException $e) {bloco 2}`  que executa o bloco 2 caso tenha avido um erro no bloco 1, com `$e` sendo o objeto disparador de erro para chamada de métodos e propriedades.
    - pode-se ter múltiplos blocos `catch` cada um referente a um disparador.
- `finally {bloco 3}` que executa o bloco 3 independentemente da ocorrência de erros
    - um `return` de mesmo escopo entre o `finally` e as outras partes é sobre posto com prioridade do `finally`

> Os dois últimos blocos são opcionais, basta que apenas um deles exista.
> 

```php
$test = 3;
    try {
        switch ($test) {
            case 1:
                echo 'good';
                break;
            case 2:
                throw new MyException('[ERROR] not exist', 2, 'lucas');
                break;
            case 3:
                throw new Exception('[ERROR] not working', 333);

        };
    } catch (MyException $e) {
        echo 'not can be maked ', get_class($e), $e->getMessage();
    } catch (Exception $e) {
        echo 'not can be maked ', get_class($e), $e->getMessage();
    } finally {
        echo '<br />' . 'good day';
    }
```

- A função `set_exception_handler()` seta uma função que é chamada no lugar de um bloco `catch` caso um `try` não o tenha

## Fibers

Fibers são um tipo de função para simular código assíncrono. Essas funções podem ter a execução pausada e retomada permitindo que intercalemos entre diferentes blocos de código. Declaramos  esse tipo de função, passando-as como parâmetro na inicialização de uma instância do objeto, pré-definido, “Fiber”. 

---

O comando abaixo retorna “11 22 33 44 ….” por causa da alternância entre as diferentes execuções da função. 

```php
function Loop(): void { 
  for ($i = 0; $i < 10; $i++) {
        Fiber::suspend($i); 
  }
};

$one = new Fiber(Loop(...));
$one->start();

$two = new Fiber(Loop(...));
$two->start();

for ($c = 0; $c < 10; $c++) {
  echo $one->resume(), '<br />';
  echo $two->resume(), '<br />';
}
```

Sem fibers o mesmo código retornaria “1234… 1234…” por causa do funcionamento padrão do interpretador, que é síncrono e linear. Esse comportamento é contornado pelas fibers, funções, que funcionam de forma assíncrona com o resto do código.

- Armazena e declara a função transformando-a em uma fiber

```php
$fiber = new Fiber(myFunction(...)); // armazena
$fiber->start(); // declara
```

- USO NO CÓDIGO PADRÃO E FORA DA FUNÇÃO

---

- Pausa o código principal e retoma o ultimo pause executado na função enviando `“value”` no seu lugar

```php
$fiber->Fiber::resume("value");
```

- USO NO CÓDIGO PADRÃO E FORA DA FUNÇÃO

---

- Pausa a função e retorna `“value-2”` para uso no lugar do ultimo pause do código principal.

```php
Fiber::suspend('value-2');
```

- USO DENTRO DA FUNÇÃO E NÃO FORA DELA

## Generators

Generators são funções que retornam valores mais de uma vez. Elas usam `yield` ao invés de return e quando o comando é executado ele salva o estado da função e o retoma na próxima chamada, e após, ela salva o estado para a próxima e assim por diante. Quando chamada novamente a função retoma a execução a partir do ultimo `yield` com os mesmo valores já armazenados antes.

- Quanto a função é chamada ela retorna um objeto que pode ser iterado(percorrido como um array), o que permite seu uso em loops.
- As funções generators são como funções normais exceto pelo `yield` qualquer função que tenha o  é um generator.
- Podemos chamar o `yield` sem valor para retornar `null`.

> O `yield from` executa a função todas as vezes possíveis e retorna todos os `yields` incluindo os aninhados.
> 

- retorno padrão

```php
function numbers() {
    for ($i = 0; $i < 10; $i++) {
        yield $i;
    }
    yield 33;
}

foreach (numbers() as $n) {
    echo $n, '<br />';
}
```

- yield from

```php
function x() {
  yield 2;
}
function another() {
  yield 1;
  yield from x();
}
function update() {
  yield 0;
  yield from another();
  yield from [3, 4];
}
foreach(update() as $msg) {
  echo $msg, "\n";
}
```

- Retorno de arrays

```php
function myArray($inf, $keys) {
    $count = 0;
    for($c = 0; $c < count($inf); $c+=2) {
      yield $keys[$count] => [$inf[$c], $inf[$c+1]]
      $count += 1; 
	}
}
$datas = ['lucas', 34, 'pedro', 5, 'joao', 42];
$id = [21, 22, 23];
foreach (myArray($datas, $id) as $key => $array) {
    echo "ID account: $key", '<br />';
    echo "name: $array[0]", '<br />';
    echo "age: $array[1]", '<br />';
    echo "<br />";
}
```

## Atributos

Atributos do PHP são objetos responsáveis por conter metainformações. Adicionamos um atributo criando uma instancia de objeto e classificando-a como atributo. Após isso, dentro da declaração de um objeto de funcionalidade, mencionamos os atributos para inserir suas informações. Isso serve para quando esse objeto seja lido eu depurado as informações do atributo estejam presentes. Esse tipo de recurso é util para bibliotecas e manipulação de informações contidas em objetos.

Digitando `#[Attribute]` a cima de uma classe, torna-a um atributo que pode ser implementado a classes, métodos e propriedades usando a linha `#[NomeDaClasse(’parametros’)]` a cima do item desejado.

- Exemplos
    
    
    ```php
    #[Attribute]
    class MyAttributeForProperty {
      public function __construct(
        public string $className,
        public string $propertyName,
    
      ) {
        echo'class '. $className;
        echo'function '. $propertyName;
      }
    }
    ```
    
    ```php
    #[Attribute]
    class MyAttributeForMethods {
      public function __construct(
        public string $className,
        public string $functionName,
        public array $paramethers
    
      ) {
        echo 'class '. $className;
        echo 'function '. $functionName;
        foreach ($paramethers as $paramether) {
            echo $paramether;
        }
      }
    }
    ```
    
    ```php
    class CreateUser {
     #[MyAttributeForProperty('CreateUser', 'local')] 
     public string $local = 'my house';
    
     #[MyAttributeForMethods('createUser', 'create', ['name', 'password'])]
      function create(string $name, int $password) {
        echo 'created:'. '<br>'. 
    		'  user: '. $name . '<br>' . 
    		' password:' . $password;
      }
    }
    ```
    

Após isso podemos fazer uso dos atributos com reflection acessando as informações respectivas de cada item. Basta usar `getAttribute()` no reflection do item bara obter uma lista dos seus atributos, e extrair suas informações executando o seu `__construct` aplicando o comando `newInstance()`.

    

```php
$property = new \ReflectionProperty(CreateUser::class, 'local');
echo '<pre>', var_dump($property->getAttributes()[0]->newInstance()), '</pre>'; // informações do atributo de local

$method = new \ReflectionMethod(CreateUser::class, 'create');
echo '<pre>', var_dump($method->getAttributes()[0]->newInstance()), '</pre>'; // informações do atributo de create
```

- Atributos pré-definidos: [https://www.php.net/manual/pt_BR/reserved.attributes.php](https://www.php.net/manual/pt_BR/reserved.attributes.php)

## Referencias

Referencias são como diferentes nomes para para um mesmo valor. Com elas podemos ter vários nomes para a mesma variável. Existem 3 opções de uso para referencias sendo elas:

- Atribuição por referencia
    
    podemos usar o comando `$a =& $b;` para atribuir o valor de `$b` a `$a` e ligar as variáveis de forma que quando uma muda a outra também muda.
    
- Passagem por referencia
    
    Podemos declarar uma variável da função com um `&` antes do `$` para fazer com que a variável passada como parâmetro mude junto com a variável respectiva de dentro da função. 
    
    ```php
    function add(&$v) {
            $v++;
        };
    
        $number = 2;
        echo $number, '<br>'; // 2
        add($number);
        echo $number, '<br>'; // 3
    ```
    
- Retorno por referencia
- Caso se passe uma variável indefinida por referencia ela é criada.
- `unset($var);` deleta o identificador `$var` mas mantem a variável com seu valor e os outros identificadores.
- Opções e parâmetros de contextos específicos: [https://www.php.net/manual/pt_BR/context.php](https://www.php.net/manual/pt_BR/context.php)
- Protocolos de web + funções para aceso de URLs e leitura de arquivos: [https://www.php.net/manual/pt_BR/wrappers.php](https://www.php.net/manual/pt_BR/wrappers.php)

# Segurança

## Testes

- Testes Automatizados para erros
    
    Fazemos testes criando um arquivo próprio para o teste e executando-o para saber se haverá erros, um erro é um retorno de resultado diferente do esperado. Existem quatro tipos de testes sendo realizados com mais frequência os mais simples (unidade) e menos frequentemente os que são mais complexos, tais testes são:
    
    - ***unidade / unitários***: frequentes e simples
        
        os de mais baixo nível que executam apenas 1 unidade, conceito geralmente representado por um único método e raramente por uma classe. Esses testes devem ser focados em unidades de forma individual, para garantir que o resultado de uma não interfira em outra. Escrevemos os arquivos desse tipo de teste com o padrão AAA:
        
        - Arrange: Preparação do scenario a ser testado
            - Criação das classes, código, variáveis, métodos e propriedades exigidas e etc…
        - Act: Execução do teste
            - Onde de fato são feitas as realizações que se espera obter um resultado especifico
        - Assert: Verificação do resultado obtido em relação ao resultado esperado
            - Parte destinada a comparar o valor esperado com o obtido pelo bloco anterior e gerar uma mensagem de sucesso ou de erro
        
        É uma pratica comum a esses testes a criação de dubles de classes que são como classes “falsas” para serem passadas a uma classe real que esta sobre testes, esses dubles tem o objetivo de funcionar com uma classe real a qual a classe testada ira interagir, são uteis para simular um real funcionamento dentro do sistema.
        
    - ***integração***: medianamente frequentes e simples
        
        São os testes que verificam a funcionabilidade entre partes do sistema (duas ou mais unidades), ou geralmente a integração de um sistema externo como API ou banco de dados
        
    - ***ponta a ponta / e2e***:
        
        Teste destinado a verificação de funcionamento final de um sistema, coisas como verificar se cada botão executa sua função corretamente, ver se as funcionalidades estão operando de forma correta e etc… Geralmente resume-se em rodar toda a aplicação, como abrir um site no caso de um projeto web ou rodar em um emulador um aplicativo mobila. 
        
        Tal tipo de teste é geralmente feito em ambientes artificiais e controlados. Isso é preciso para reduzir inconvenientes e problemas desnecessários, como uma adição real a um banco de dados ou uma compra verdadeira no sistema.
        
- Testes manuais
    - Testes de performance
        
        Verifica se a velocidade de acesso a bancos de dados, URLs APIs e etc… estão sendo feitos de forma eficaz
        
        - Existem ferramentas próprias para isso
    - Teste de mutação
        
        Pratica para testar a eficácia de um teste, consiste em introduzir um bug propositalmente no código para saber se o teste falhara resultado sucesso ou se ele é eficiente e resulta fracasso devido ao bug
        
        - Existem ferramentas próprias para isso
    - TDD: Test Drive Development
        
        Um desenvolvimento guiado pelos testes que resulta em maior segurança e menor margem de erros. Esse conceito baseia-se em criar os testes primeiro e após isso fazer o código de forma que ele funcione se aplicado ao teste, na pratica realizamos os seguintes passos:
        
        - Criar um teste que falha
        - Desenvolver um código que funciona no teste e o faça funcionar se aplicado ao mesmo
        - simplificar o código desenvolvido sem mudar os resultados
    - BDD: Behavior Driven Development
        
        Teste de comportamento que geralmente é representado por uma lista dimples, em linguagem humana, de resultados esperados para realizações  
        

# Referencias das funções

## Reflection

Meta programação é o conceito de manipular e usar como dados um programa usando outro programa. Reflection é uma forma de meta programação onde se usa a mesma linguagem no programa que é processado e no programa que está processando. No PHP usamos esse recurso criando uma instancia reflection da versão estática da classe que queremos testar.

Uma classe reflection é como uma forma de mapa da classe original onde podemos obter os caminhos da classe original mas não podemos mudar seus valores, para tal ato é preciso criar um ‘novo mapa’, uma instancia da classe reflection, onde essa sim, pode ter os valores visualizados e manipulados. Seguindo a mesma lógica não podemos obter um caminho de uma instancia do objeto reflection, pois ele pode não ser o ‘mapa original’, apenas os extraímos da própria reflection (A forma de molde). 

- Comandos para
- Classe e instancias
    - `$MinhaClasseReflection = new ReflectionClass(ClasseTestada::class);` Cria uma variável  ‘MinhaClasseReflection’, que contem uma classe reflection que corresponde à classe real ‘ClasseTestada’.
    
    Após isso podemos usar funções na variável obtida para extrair informações da classe posta em teste, funções essas que retornam arrays com os dados da classe.
    
    - `$MinhaClasseReflection->getProperties();` retorna um array com as propriedades da classe
    - `$MinhaClasseReflection->getMethods();` retorna um array com os métodos da classe
    - `$instance = $reflectionClass->newInstanceWithoutConstructor();` retorna uma nova **instancia** reflection de ‘ClasseTestada’ que não executara o método construtor.
    
    ---
    
    - `$method->getDocComment();` retorna o comentário de documentação de um método
        - Serve igual para propriedades
    - `$reflectionClass->getDocComment();` retorna o comentário de documentação da classe originaria de ‘reflection class’,
    - Mais comandos para manipulação de comentários de documentos na biblioteca reflection-docblock.
- Propriedades:
    - `$name = $MinhaClasseReflection->getProperty(’name’);` cria a variável ‘name’ com uma representação do *‘endereço’* do valor no objeto
    - `$name = new  ReflectionProperty(ClasseTestada::class, ‘propriedade’);` cria uma propriedade reflection diretamente, sem precisar criar uma classe reflection antes.
    - `$name->getValue(new ClasseTestada);` retorna o valor do endereço “name” de uma instancia reflection da classe ‘ClasseTestada’.
    - `$name->setValue($object);` retorna o valor do “endereço name” de uma instancia da classe ‘ClasseTestada’.
- Métodos
    - `$method = $MinhaClasseReflection->getMethod('SeeName');` retorna o método ‘SeeName’ da classe reflection “MinhaClasseReflection”
    - `$name = new  ReflectionMethod(ClasseTestada::class, ‘metodo’);` cria um método reflection diretamente, sem precisar criar uma classe reflection antes.
    - `echo $method->invoke($object);` executa um método sem parâmetros da instancia reflection de “$object”.
    - `echo $method->invokeArgs($object, ['now']);` executa um método da instancia reflection de “$object” passando os seus parâmetros por um array.
- Exemplos
    
    
    - **1°**
    
    ```php
    class Exemple {
        public string $DevName = 'lucas';
        private string $local;
        
        private function SeeLocal(): string {
            return $this->local;
        }
    }
    
    $reflectionClass = 	new ReflectionClass(Exemple::class);
    ```
    
    - **2°**
    
    ```php
    $object = $reflectionClass->newInstanceWithoutConstructor();
        
        $name->setValue($object, 'alex');
        var_dump($name->getValue($object));
    ```
    
    - **3°**
    
    ```php
    // see informations of exemple
    echo '<pre>', 
       var_dump(
    		 $reflectionClass->getProperties(), 
    		 $reflectionClass->getMethods()), 
    '</pre>';
    ```
