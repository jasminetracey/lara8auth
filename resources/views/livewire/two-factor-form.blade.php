<section class="my-5">
    @if (session('status') == 'two-factor-authentication-enabled')
        <div class="mb-4 font-medium text-sm text-green-600">
            Two factor authentication has been enabled.
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Two-Factor Authentication</h5>

            @if (!empty($this->user->two_factor_secret))
                @if ($showQrCode)
                    <p>
                        Two factor authentication is now enabled. Scan the following QR code using your phone's
                        authenticator application.
                    </p>

                    <div>
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>
                @endif

                @if ($showRecoveryCodes)
                    <div class="mt-4">
                        <p>
                            Store these recovery codes in a secure password manager. They can be used to recover access
                            to your account if your two factor authentication device is lost.
                        </p>

                        <div>
                            @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                                <div>{{ $code }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-4">
                    @if ($showRecoveryCodes)
                        <button wire:click="
                            regenerateRecoveryCodes" class="btn btn-secondary">
                            Regenerate Recovery Codes
                        </button>
                    @else
                        <button wire:click="
                            showRecoveryCodes" class="btn btn-secondary">
                            Show Recovery Codes
                        </button>
                    @endif

                    <button wire:click="
                            disableTwoFactorAuth" class="btn btn-primary">
                        Disable Two-Factor Authentication
                    </button>
                </div>

            @else
                <div>
                    <p>
                        You have not enabled two factor authentication.
                    </p>

                    <button wire:click="
                            enableTwoFactorAuth" class="btn btn-primary">
                        Enable Two-Factor Authentication
                    </button>
                </div>
            @endif
        </div>
    </div>
</section>
