
<div class="full-div">
    <div class="mid-div">
        <form action="/edit-table" method="POST">
            @csrf
            <h1>Editar Tarefa</h1>
            @csrf <!-- CSRF token for Laravel -->
            <input type="hidden" id="server_value" name="table_id" value="{{$points->id}}">
            <label for="task_name">Nome da Tarefa:</label>
            <input type="text" id="task_name" value="{{$points->name}}" name="task_name" required><br>
            <label for="table_type">Tipo da Tabela:</label>
            <select id="table_type" name="table_type" required>
                <option value="XBOX" {{ $points->type == 'XBOX' ? 'selected' : '' }}>XBOX</option>
                <option value="BING" {{ $points->type == 'BING' ? 'selected' : '' }}>BING</option>
                <option value="BING_VARIAVEL" {{ $points->type == 'BING_VARIAVEL' ? 'selected' : '' }}>BING_VARIAVEL</option>
                <option value="XBOX_VARIAVEL" {{ $points->type == 'XBOX_VARIAVEL' ? 'selected' : '' }}>XBOX_VARIAVEL</option>
            </select><br>
            <div class="check-fix">
                <label for="istreak">Tem Sequencia Diaria:</label>
                <input id="istreak" {{$points->is_streaked ? 'checked' : ''}} type="checkbox" name="istreak">
            </div>
            <div class="hiddenItems" style="display: {{$points->is_streaked ? 'block' : 'none'}};">
                <label for="current_sequence">Sequencia atual da tarefa:</label>
                <input type="number" value="{{$points->streak}}" id="current_sequence" name="current_sequence"><br>
            </div>
            <div class="check-fix">
                <label for="reset">Deseja Resetar Para Completar novamente? (irá subitrair os pontos)</label>
                <input type="checkbox" id="reset" name="reset">
            </div>
            <label for="points_value">Valor em pontos da Tarefa:</label>
            <input type="number" value='{{$points->point_value}}' id="points_value" name="points_value"><br>
            <script>
                document.addEventListener('DOMContentLoaded' , (event) => {
                    var is_streaked = document.getElementById('istreak');
                    var hiddenItems = document.querySelector('.hiddenItems');
        
                    function updateItems (){
                        if(is_streaked.checked){
                            hiddenItems.style.display = 'block';
                        }else{
                            hiddenItems.style.display = 'none';
                        }
                    }
                    is_streaked.addEventListener('change' , updateItems);
                })
            </script>
            <input type="submit" value="Submit">
        </form>
        <form action="/delete-table" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{$points->id}}">
            <input type="submit" style="background-color: red" value="DELETAR TABELA">
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
form {
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