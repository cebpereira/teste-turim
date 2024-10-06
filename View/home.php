<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="Assets/css/style.css">
    <script src="Assets/js/home.js" defer></script>
</head>

<body>

    <div>
        <button onclick="gravar()">Gravar</button>
        <button onclick="ler()">Ler</button>
        <br><br>
        Nome: <input type="text" id="nomePessoa" />
        <button onclick="incluirPessoa()">Incluir</button>
    </div>

    <div class="container">
        <!-- Lado esquerdo: Lista de pessoas -->
        <div class="left-side">
            <table>
                <thead>
                    <tr>
                        <th>Pessoas</th>
                    </tr>
                </thead>
                <tbody id="listaPessoas">
                </tbody>
            </table>
        </div>

        <!-- Lado direito: Exibição do JSON -->
        <div class="right-side">
            <textarea class="output" id="jsonOutput" readonly>
            </textarea>
        </div>
    </div>

</body>

</html>