<div>
    <div class="mid-div">
        <form action="/createNewTablePoint" method="post">
            @csrf
            <h1>CRIAÇÃO DE TAREFAS DO REWARDS</h1>
            @csrf <!-- CSRF token for Laravel -->
            <label for="task_name">Nome da Tarefa:</label>
            <input type="text" id="task_name" name="task_name"><br>
        
            <label for="table_type">Tipo da Tabela:</label>
            <select id="table_type" name="table_type">
                <option value="XBOX">XBOX</option>
                <option value="BING">BING</option>
            </select><br>
            <div class="check-fix">
                <label for="daily_accumulation">Tem acumulação diária:</label>
                <input type="checkbox" id="daily_accumulation" name="daily_accumulation">
            </div>
        
        
            <label for="current_sequence">Sequencia atual da tarefa:</label>
            <input type="number" id="current_sequence" name="current_sequence"><br>
        
            <label for="points_value">Valor em pontos da Tarefa:</label>
            <input type="number" id="points_value" name="points_value"><br>
        
            <input type="submit" value="Submit">
        </form>
    </div>
</div>

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

.mid-div{
    max-width: 600px;
    margin: 0 auto;
}
@media (max-width: 1250px) {
    .mid-div{
    max-width: 100%;
}
    h1{
        font-size: 37px;
    }
    label , input{
        font-size: 20px;
    }
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