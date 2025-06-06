<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Student Coins Laravel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
    <h1 class="text-3xl font-semibold text-center mb-8 text-indigo-600">Entrar</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-6" novalidate>
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input
          id="email"
          name="email"
          type="email"
          autocomplete="email"
          required
          autofocus
          value="{{ old('email') }}"
          class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition"
        />
        @error('email')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
        <input
          id="password"
          name="password"
          type="password"
          autocomplete="current-password"
          required
          class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition"
        />
        @error('password')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center justify-between">
        <label class="inline-flex items-center text-sm text-gray-600">
          <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
          <span class="ml-2">Lembrar-me</span>
        </label>

        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Esqueceu a senha?</a>
      </div>

      <button
        type="submit"
        class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition"
      >
        Entrar
      </button>
    </form>
  </div>

</body>
</html>
