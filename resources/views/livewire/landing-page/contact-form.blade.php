<div>
    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 rounded">
            <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded">
            <p class="text-red-700 dark:text-red-400">{{ session('error') }}</p>
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <div>
            <label class="form-label block text-sm font-semibold mb-2">Insira o seu nome:</label>
            <input 
                type="text"
                wire:model="name"
                placeholder="Insira aqui (de preferência) o seu nome completo."
                class="form-input w-full px-4 py-3 rounded-md border @error('name') border-red-500 @enderror">
            @error('name') 
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <div>
            <label class="form-label block text-sm font-semibold mb-2">Insira o seu email:</label>
            <input 
                type="email"
                wire:model="email"
                placeholder="Insira aqui o seu email."
                class="form-input w-full px-4 py-3 rounded-md border @error('email') border-red-500 @enderror">
            @error('email') 
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <div>
            <label class="form-label block text-sm font-semibold mb-2">Qual é a sua pergunta?</label>
            <textarea 
                wire:model="question"
                rows="4"
                placeholder="Questione."
                class="form-input w-full px-4 py-3 rounded-md resize-none border @error('question') border-red-500 @enderror"></textarea>
            @error('question') 
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
            @enderror
        </div>

        <button 
            type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-md transition-colors duration-200">
            Enviar Mensagem
        </button>
    </form>
</div>