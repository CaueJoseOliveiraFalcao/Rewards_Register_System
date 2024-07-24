
<form action="/sendExtraPoint" method="POST">
    <h1>Pontos Extra</h1>
    @csrf <!-- CSRF token for Laravel -->
    <label for="task_name">Nome da Tarefa:</label>
    <input type="text" id="task_name" name="task_name" required><br>
    <input type="hidden" id="server_value" name="" value="{{$mainTable->point_value}}">
    <label for="table_type">Tipo da Tabela:</label>
    <select id="table_type" name="table_type" required>
        <option value="XBOX">XBOX</option>
        <option value="BING">BING</option>
    </select><br>
    <label for="points_value">Valor em pontos da Tarefa:</label>
    <input type="number"  id="value" name="points_value" required><br>
    <p>VALOR DE PONTOS APOS ALTERAÇÃO : <span id="final_value">{{$mainTable->point_value}}</span></p>
    <input type="submit" value="Submit">
    <script>
                var UserInput = document.getElementById('value')
        function updateFinalPoints() {
            var ServerValue = parseInt(document.getElementById('server_value').value);
            var userP = parseInt(document.getElementById('value').value);
            var sum = ServerValue + userP;
            document.getElementById('final_value').textContent = sum;
        }
        UserInput.addEventListener('input' , updateFinalPoints);

    </script>
</form>
<style>
    .check-fix{
        margin-top: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    .check-fix label{
        margin: 0;
        padding: 0;
    }
    body {
    font-family: Arial, sans-serif;
    padding: 20px;
}

form {
    max-width: 600px;
    margin: 0 auto;
}

label {
    display: block;
    margin-top: 10px;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

input[type="checkbox"] {
    margin-top: 5px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

@media (max-width: 768px) {
    label, input, select {
        width: auto;
        margin-top: 0;
        margin-right: 10px;
        display: inline-block;
    }

    input[type="submit"] {
        width: auto;
        margin-top: 10px;
    }
}

</style>