<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        class="btn btn-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</button>

    <!-- Modal -->
    <div
        class="modal fade"
        id="confirm-user-deletion"
        tabindex="-1"
        aria-labelledby="confirm-user-deletion-label"
        aria-hidden="true"
        x-data="{ open: false }"
        x-show="open"
        x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') open = true"
        x-on:close.window="if ($event.detail === 'confirm-user-deletion') open = false"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-user-deletion-label">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
                        @csrf
                        @method('delete')

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="{{ __('Password') }}"
                            />
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 d-flex justify-end">
                            <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger ms-3">
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript to handle modal behavior -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('confirmUserDeletion', () => ({
            open: false,
            close() {
                this.open = false;
            },
            openModal() {
                this.open = true;
            }
        }));
    });
</script>
