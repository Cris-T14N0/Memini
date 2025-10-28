<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Apagar conta') }}</flux:heading>
        <flux:subheading>{{ __('Apague a sua conta e todos os seus recursos') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Apagar conta') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Tem a certeza que quer apagar a sua conta?') }}</flux:heading>

                <flux:subheading>
                    {{ __('Assim que a sua conta for eliminada, todos os seus recursos e dados serão eliminados permanentemente. Antes de eliminar a sua conta, faça o download de todos os dados ou informações que deseja manter.') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" :label="__('Password')" type="password" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit">{{ __('Apagar conta.') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</section>
