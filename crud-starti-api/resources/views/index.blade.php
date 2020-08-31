<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>
    <form action="{{ route('createUser') }}" method="post">
        {{-- @csrf --}}
        <input type="text" name="name" placeholder='Nome'>
        <input type="text" name="email" placeholder='E-mail'>
        <input type="password" name="password" placeholder='Senha'>
        <input type="text" name="address" placeholder='Endereço'>
        <input type="text" name="phone" placeholder='Telefone'>
        <!-- <input type="text" name="name" placeholder='Nome'> -->
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
