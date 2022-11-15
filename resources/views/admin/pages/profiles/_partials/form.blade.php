@csrf
@include('admin.includes.alerts')
<div class="form-group">
    <label for="Nome">Nome</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Nome"
        value="{{ $profile->name ?? old('name') }}">
</div>
<div class=" form-group">
    <label for="Nome">Descrição</label>
    <input type="text" name="description" id="description" class="form-control" placeholder="Descrição"
        value="{{ $profile->description ?? '' }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Cadastrar</button>
</div>
