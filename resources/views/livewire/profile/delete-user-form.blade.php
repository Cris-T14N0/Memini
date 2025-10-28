<div class="flex justify-center">
    <section class="space-y-6 w-full max-w-xl">
        <header class="text-center">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Delete Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </header>

        <div class="flex justify-center">
            <x-danger-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            >
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
            <form wire:submit="deleteUser" class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                    {{ __('Tem a certeza que quer apagar a sua conta?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-center">
                    {{ __('Depois que a sua conta for eliminada, todos os seus recursos e dados serão eliminados permanentemente. Antes de eliminar a sua conta, faça o download de todos os dados ou informações que deseja manter.') }}
                </p>

                <div class="mt-6 flex justify-center">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                    <x-text-input
                        wire:model="password"
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}"
                    />
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-center" />

                <div class="mt-6 flex justify-center space-x-3">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button>
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </section>
</div>