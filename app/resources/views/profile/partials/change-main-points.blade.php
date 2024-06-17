<section>
<form method="post" action="{{ route('profile.editP') }}" class="mt-6 space-y-3 flex flex-col">
        @csrf
        <h1>Pontos : {{Auth::user()->getPointTableInfo()->point_value}}</h1>
        <label for="points">TROCAR NUMERO DE PONTOS (nao recomendado)</label>
        <p style="margin-bottom: 0; padding-bottom: 0;" >digite a quantidade de pontos atuais do sou rewards</p>
        <input class="w-1/2" type="number" name="points">
        <button class="w-1/2 p-2 bg-gray-200">EDITAR PONTOS</button>
    </form>
</section>