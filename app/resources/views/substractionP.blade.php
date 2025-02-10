<div class="mid-div">
    <form action="/createGift" method="POST">
        <h1>Resgate De Pontos</h1>
        @if(isset($errorMessage))
            <div style='color:red;'>
                {{ $errorMessage }}
            </div>
        @endif
        @csrf <!-- CSRF token for Laravel -->
        <label for="gift_name">Nome do Cartão Presente</label>
        <input type="text" id="gift_name" name="gift_name" required><br>
        <label for="gift_value">Valor Do Cartão Presente</label>
        <input type="number"  id="gift_value" name="gift_value" required><br>
        <input type="submit" value="Submit">
    </form>
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
        font-size: 21px;
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